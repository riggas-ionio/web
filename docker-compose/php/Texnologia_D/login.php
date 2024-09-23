<?php
session_start(); 

$is_invalid = false;
$theme = $_SESSION["theme"] ?? $_COOKIE['theme'] ?? 'light';

// Get the redirect parameter or set a default
$redirect = $_GET['redirect'] ?? 'home.php'; // Default to home.php if not set

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM users WHERE username = '%s'",
                   $mysqli->real_escape_string($_POST["username"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_regenerate_id(); // Prevent session fixation attacks

            // Store user data in session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["lastName"] = $user["lastName"];
            $_SESSION["email"] = $user["email"];
            
            // Store the theme preference in session
            $theme = $_POST["theme"] ?? 'light';
            $_SESSION["theme"] = $theme;
            
            // Set a cookie to remember the theme preference
            setcookie("theme", $theme, time() + (86400 * 30), "/"); // 30 days
            
            // Redirect to the specified page or home page
            header("Location: " . $redirect);
            exit;
        }
    }
    
    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginStyle.css">
</head>
<body>
    <form class="login-form" method="post" id="login-form">
        <h1>Login</h1>

        <!-- Display error message if invalid -->
        <?php if ($is_invalid): ?>
            <div class="error-message">Invalid login</div>
        <?php endif; ?>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Enter your username" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password">

        <!-- Hidden input to store the theme preference -->
        <input type="hidden" name="theme" id="theme" value="<?= htmlspecialchars($theme) ?>">

        <button type="submit">Log in</button>
    </form>
    <script src="theme-toggle.js"></script> <!-- JavaScript for theme toggle -->
</body>
</html>
