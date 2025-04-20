<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Database connection
$host = 'localhost';
$dbname = 'GS';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Initialize variables
$game = [];
$awards = [];
$specs = [];
$mode = [];
$genre = [];
$reviews = [];
$trailerLink = '';
$errors = [];

// Fetch game details including trailer link
$gameId = $_GET['game_id'] ?? null;
if ($gameId) {
    $gameQuery = $pdo->prepare("SELECT *, TRAILER FROM GAMES WHERE GAME_ID = ?");
    try {
        $gameQuery->execute([$gameId]);
        $game = $gameQuery->fetch(PDO::FETCH_ASSOC);
        if ($game) {
            $trailerLink = $game['TRAILER']; // Fetch the trailer link from the database

            // Extract the video ID from the URL if necessary
            if (preg_match('/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $trailerLink, $matches)) {
                $trailerLink = $matches[1];
            }

            // Fetch awards
            $awardsQuery = $pdo->prepare("SELECT AWARD_DETAILS FROM AWARD WHERE GAME_ID = ?");
            $awardsQuery->execute([$gameId]);
            $awards = $awardsQuery->fetchAll(PDO::FETCH_ASSOC);

            // Fetch specifications
            $specsQuery = $pdo->prepare("SELECT SPEC_DETAILS FROM SPECIFICATION WHERE GAME_ID = ?");
            $specsQuery->execute([$gameId]);
            $specs = $specsQuery->fetch(PDO::FETCH_ASSOC);

            // Fetch mode type
            $modeQuery = $pdo->prepare("SELECT MODE_DETAILS FROM GAME_MODE WHERE GAME_ID = ?");
            $modeQuery->execute([$gameId]);
            $mode = $modeQuery->fetch(PDO::FETCH_ASSOC);

            // Fetch genre
            $genreQuery = $pdo->prepare("SELECT OPTIONS FROM GENRE WHERE GAME_ID = ?");
            $genreQuery->execute([$gameId]);
            $genre = $genreQuery->fetch(PDO::FETCH_ASSOC);

            // Fetch reviews
            $reviewsQuery = $pdo->prepare("SELECT USR.EMAIL_ID, USR.NAME, REVIEWS.REVIEWS_DESC FROM REVIEWS JOIN USR ON REVIEWS.EMAIL_ID = USR.EMAIL_ID WHERE REVIEWS.GAME_ID = ?");
            $reviewsQuery->execute([$gameId]);
            $reviews = $reviewsQuery->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $errors[] = "Game not found.";
        }
    } catch (PDOException $e) {
        $errors[] = "Error fetching game details: " . $e->getMessage();
    }
}

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviewText = htmlspecialchars($_POST['review-text'] ?? '');
    $email = $_SESSION['username'] ?? '';

    if ($reviewText && $email && $gameId) {
        // Check if the email exists in the USR table
        $userCheckQuery = $pdo->prepare("SELECT EMAIL_ID FROM USR WHERE EMAIL_ID = ?");
        $userCheckQuery->execute([$email]);
        $user = $userCheckQuery->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            try {
                $reviewQuery = $pdo->prepare("INSERT INTO REVIEWS (GAME_ID, EMAIL_ID, REVIEWS_DESC) VALUES (?, ?, ?)");
                $reviewQuery->execute([$gameId, $email, $reviewText]);

                // Refresh the page to display the new review
                header("Location: review_pg1.php?game_id=$gameId");
                exit();
            } catch (PDOException $e) {
                $errors[] = "Error inserting review: " . $e->getMessage();
            }
        } else {
            $errors[] = "User does not exist.";
        }
    } else {
        $errors[] = "Invalid review submission data.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Details - Quest Hub</title>
    <link rel="stylesheet" href="review_pg1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Tektur:wght@400..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <div class="navbar">
            <div class="container">
                <div class="navbar-left">
                    <div class="navbar-brand">
                        <img id="logo-img" src="logo.png" alt="Logo">
                        <a href="main1.php">QUEST HUB</a>
                    </div>
                    <ul class="nav">
                        <li><a href="main1.php" class="active">Home</a></li>
                        <li><a href="topPicks.php">Top Picks</a></li>
                        <li class="dropdown">
                            <a href="#">Genres <span class="arrow">&#9662;</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="action.php">Action</a></li>
                                <li><a href="shooting.php">Shooting</a></li>
                                <li><a href="sport.php">Sports</a></li>
                                <li><a href="Story-line.php">Story-Line</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="user-actions">
                    <img id="profile-img" src="profile.png" alt="Profile Image">
                    <span class="username"><?php echo $_SESSION['username']; ?></span>
                    <a href="main1.php?logout=true" class="logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <main class="game-details">
        <div class="content-wrapper">
            <section class="trailer">
                <?php if (!empty($trailerLink)) : ?>
                    <iframe src="https://www.youtube.com/embed/<?php echo htmlspecialchars($trailerLink); ?>" frameborder="0" allowfullscreen></iframe>
                <?php else : ?>
                    <p>No trailer available</p>
                <?php endif; ?>
            </section>

            <section class="game-info">
                <div class="info-container">
                    <div class="info-item">
                        <h2>Game Details</h2>
                        <ul>
                            <li><strong>Game Name:</strong> <span id="game-name"><?php echo htmlspecialchars($game['GAME_NAME'] ?? ''); ?></span></li>
                        </ul>
                    </div>
                    <div class="info-item">
                        <h2>Awards 🏆</h2>
                        <p id="award-name">
                            <?php foreach ($awards as $award) : ?>
                                <?php echo htmlspecialchars($award['AWARD_DETAILS'] ?? ''); ?><br>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    <div class="info-item">
                        <h2>Specifications ⚙️</h2>
                        <p id="memory-size"><?php echo htmlspecialchars($specs['SPEC_DETAILS'] ?? ''); ?></p>
                    </div>
                    <div class="info-item">
                        <h2>Mode Type 👾</h2>
                        <p id="mode-type"><?php echo htmlspecialchars($mode['MODE_DETAILS'] ?? ''); ?></p>
                    </div>
                    <div class="info-item">
                        <h2>Genre 👽</h2>
                        <p id="genre"><?php echo htmlspecialchars($genre['OPTIONS'] ?? ''); ?></p>
                    </div>
                    <div class="info-item">
                        <h2>Ratings</h2>
                        <p id="ratings"><?php echo str_repeat('⭐', $game['RATING'] ?? 0); ?></p>
                    </div>
                </div>
            </section>
        </div>

        <section class="reviews">
            <h2>User Reviews</h2>
            <div class="user-review">
                <?php foreach ($reviews as $review) : ?>
                    <div class="review">
                        <h3><?php echo htmlspecialchars($review['NAME'] ?? $review['EMAIL_ID']); ?></h3>
                        <p><?php echo htmlspecialchars($review['REVIEWS_DESC'] ?? ''); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <form class="add-review" method="post">
                <h3>Your Review Matters To Us 🖋️</h3>
                <textarea id="review-text" name="review-text" rows="4" placeholder="Write your review here..."></textarea>
                <button type="submit">Submit</button>
            </form>
        </section>

        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>About Us</h3>
                <p>Quest Hub is your ultimate destination for discovering, and reviewing the latest and greatest games. Join our community of passionate gamers today! 🤗</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="main1.php">Home</a></li>
                    <li><a href="topPicks.php">Top Picks</a></li>
                    <li><a href="main1.php">Genres</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="images/X.png" alt="X"></a>
                    <a href="#"><img src="images/insta.png" alt="Instagram"></a>
                    <a href="#"><img src="images/YT.png" alt="YouTube"></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p>Email: support@questhub.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Quest Hub. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>