<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quest Hub</title>
    <link rel="stylesheet" href="admin.css">
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

    <main class="admin-page">
        <h1>Dashboard</h1>
        <div class="admin-content">
            <div class="admin-section">
                <label for="game-photo">Upload Game's Photo</label>
                <div class="file-upload-wrapper">
                    <input type="file" id="game-photo" name="game-photo" accept="image/*" class="file-upload-input">
                    <label for="game-photo" class="file-upload-button"></label>
                </div>
            </div>

            <div class="admin-section">
                <label for="game-name">Game Name</label>
                <input type="text" id="game-name" name="game-name" required>
            </div>

            <div class="admin-section">
                <label for="awards-won">Awards Won</label>
                <input type="text" id="awards-won" name="awards-won">
            </div>

            <div class="admin-section">
                <label for="memory-size">Specifications</label>
                <input type="text" id="memory-size" name="memory-size">
            </div>

            <div class="admin-section">
                <label for="mode-type">Mode</label>
                <select id="mode-type" name="mode-type">
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>
            </div>

            <div class="admin-section">
                <label for="genre">Genre</label>
                <select id="genre" name="genre">
                    <option value="shooting">Shooting</option>
                    <option value="racing">Racing</option>
                    <option value="sports">Sports</option>
                    <option value="action">Action</option>
                </select>
            </div>

            <div class="admin-section">
                <label for="trailer-link">Trailer Link</label>
                <input type="url" id="trailer-link" name="trailer-link">
            </div>

            <div class="admin-section">
                <label for="ratings">Ratings (Stars)</label>
                <select id="ratings" name="ratings">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>


        </div>
        <div class="form-buttons">
            <button type="submit">Add Game</button>
            <button type="reset">Reset</button>
        </div>
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
