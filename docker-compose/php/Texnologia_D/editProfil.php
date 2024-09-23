<?php
session_start();

$is_invalid = false;
$theme = $_SESSION["theme"] ?? $_COOKIE['theme'] ?? 'light';
// Ensure user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Access user data from the session
$name = $_SESSION["name"];
$lastName = $_SESSION["lastName"];
$username = $_SESSION["username"];
$email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="editProfil.css">
</head>
<body>
    <div class="profile-container">
        <h1>O λογαρισμός σου</h1>
        
            <label>Name:</label>
            <p><?= htmlspecialchars($name) ?></p>

            <label>Last Name:</label>
            <p><?= htmlspecialchars($lastName) ?></p>

        
            <label>Username:</label>
            <p><?= htmlspecialchars($username) ?></p>

            <label>Email:</label>
            <p><?= htmlspecialchars($email) ?></p>

        <form action="deleteAccount.php" method="post">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <button type="submit">Delete Account</button>
        </form>
    </div>
    <script src="theme-toggle.js"></script> <!-- JavaScript for theme toggle -->

</body>
</html>
