

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quest Hub</title>
    <link rel="stylesheet" href="story-line.css">
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
    <section id="action-games">
        <div class="thumbnail">
            <img src="images/A.jpg" alt="Thumbnail">
            <h2>Story-Line Games </h2>
        </div>

        <section id="featured-games">

            <div class="container">

                <div class="game">
                    <a href="review_pg1.php?game_id=1"><img src="images/minecraft.jpg" alt="Game 1"></a>
                    <div class="game-info">
                        <h3><a href="review_pg1.php?game_id=1">Minecraft</a></h3>
                        <div class="reviews">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="rating">5/5</span>
                        </div>
                        <a href="more-options.html" class="see-more">See more options</a>
                    </div>
                </div>
    
                <div class="game">
                    <a href="review_pg1.php?game_id=3"><img src="images/Fortnite.jpg" alt="Game 1"></a>
                    <div class="game-info">
                        <h3><a href="review_pg1.php?game_id=3">Fortnite</a></h3>
                        <div class="reviews">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="rating">5/5</span>
                        </div>
                        <a href="more-options.html" class="see-more">See more options</a>
                    </div>
                </div>

                <div class="game">
                    <a href="review_pg1.php?game_id=15"><img src="images/Elden.webp" alt="Game 1"></a>
                    <div class="game-info">
                        <h3><a href="review_pg1.php?game_id=15">Elden Ring</a></h3>
                        <div class="reviews">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="rating">5/5</span>
                        </div>
                        <a href="more-options.html" class="see-more">See more options</a>
                    </div>
                </div>

                <div class="game">
                    <a href="review_pg1.php?game_id=19"><img src="images/Genshin.jpeg" alt="Game 1"></a>
                    <div class="game-info">
                        <h3><a href="review_pg1.php?game_id=19">Genshin Impact</a></h3>
                        <div class="reviews">
                            <span class="stars">⭐⭐⭐⭐</span>
                            <span class="rating">4/5</span>
                        </div>
                        <a href="more-options.html" class="see-more">See more options</a>
                    </div>
                </div>

            <div class="game">
                <a href="review_pg1.php?game_id=14"><img src="images/Cyberpunk.jpeg" alt="Game 2"></a>
                <div class="game-info">
                    <h3><a href="review_pg1.php?game_id=14">Cyberpunk 2077</a></h3>
                    <div class="reviews">
                        <span class="stars">⭐⭐⭐⭐</span>
                        <span class="rating">4/5</span>
                    </div>
                    <a href="more-options.html" class="see-more">See more options</a>
                </div>
            </div>
    

        </section>
    </section>
    
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
