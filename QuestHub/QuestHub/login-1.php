<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connect.php';

session_start();

$message = "";
$filterStatus = $_POST['filter_status'] ?? 'off';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $emailLower = strtolower($email);

    if ($filterStatus === 'off') {
        if (strpos($emailLower, "'or 1=1") !== false) {
            $_SESSION['username'] = "Injected User";
            header("Location: main1.php");
            exit();
        } elseif (strpos($emailLower, "'and select * from usr") !== false) {
            $sql = "SELECT * FROM USR";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Error: " . mysqli_error($conn));
            }

            $_SESSION['injection_data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            header("Location: injection.php");
            exit();
        }
    } else {
        if (strpos($emailLower, "'or 1=1") !== false || strpos($emailLower, "'and select * from usr") !== false) {
            echo "<script>alert('BLOCKED!!! Trying for SQL Injection.');</script>";
            exit();
        }
    }

    $stmt = $conn->prepare("SELECT * FROM USR WHERE EMAIL_ID=?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error: " . $stmt->error);
    }

    if ($result->num_rows == 0) {
        $message = "User not registered. Please sign up.";
    } else {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['PASS'])) {
            $_SESSION['username'] = $user['NAME'];
            header("Location: main1.php");
            exit();
        } else {
            $message = "Incorrect password. Please try again.";
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
    <link rel="stylesheet" href="login-1.css">
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

        function toggleFilter() {
            const filterSwitch = document.getElementById('toggle-switch');
            const filterStatus = document.getElementById('filter-status');
            filterStatus.value = filterSwitch.checked ? 'on' : 'off';
        }
    </script>
</head>
<body onload="showMessage()">
    <input type="hidden" id="message" value="<?php echo $message; ?>">
    <div class="container">
        <div class="big-card">
            <div id="small-card-1" class="small-card">
                <div id="title">
                    <div id="title-left">
                        <img id="logo-img" src="logo.png" alt="Quest Hub Logo">
                        <div id="title-name">QUEST HUB</div>
                    </div>
                    <div id="title-right">
                        <span class="filter-label">Filter</span>
                        <label class="switch">
                            <input type="checkbox" id="toggle-switch" onchange="toggleFilter()">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div id="login-card">
                    <h2 id="Login-title">Login</h2>
                    <h2 id="Welcome">Welcome Back!!! 👋</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <input type="hidden" id="filter-status" name="filter_status" value="off">
                        <button id="login-btn" type="submit">Login</button>
                        <p>Not registered yet? <a href="signup-1.php">Register here</a></p>
                    </form>
                </div>
            </div>
            <div id="small-card-2" class="small-card"></div>
        </div>
    </div>
</body>
</html>
