<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confm_password = $_POST['confm-password'];

    if ($password !== $confm_password) {
        $message = "Passwords do not match. Please recheck.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check_user = "SELECT * FROM USR WHERE EMAIL_ID='$email'";
        $result = mysqli_query($conn, $check_user);

        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            $message = "User already registered. Please log in.";
        } else {
            $sql = "INSERT INTO USR (NAME, EMAIL_ID, PASS) VALUES ('$name', '$email', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                header("Location: login-1.php");
                exit();
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quest Hub</title>
    <link rel="stylesheet" href="signup-1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Tektur:wght@400..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
    <script>
        function showMessage() {
            var message = document.getElementById('message').value;
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body onload="showMessage()">
    <input type="hidden" id="message" value="<?php echo $message; ?>">
    <div class="container">
        <div class="big-card">
            <div id="small-card-1" class="small-card">
                <div id="title">
                    <img id="logo-img" src="logo.png">
                    <div id="title-name">QUEST HUB</div>
                </div>
                <div id="login-card">
                    <h2 id="Login-title">Sign Up</h2>
                    <h2 id="Welcome">Create Account 🚀</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div>
                            <label for="email">Email ID</label>
                            <input type="text" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div>
                            <label for="confm-password">Confirm Password</label>
                            <input type="password" id="confm-password" name="confm-password" required>
                        </div>
                        <button id="login-btn" type="submit">Sign Up</button>
                        <p>Already registered? <a href="login-1.php">Login here</a></p>
                    </form>
                </div>
            </div>
            <div id="small-card-2" class="small-card"></div>
        </div>
    </div>
</body>
</html>
