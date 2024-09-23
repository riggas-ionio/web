<?php
session_start();

// Ensure user is logged in and received a valid user ID
if (!isset($_SESSION["user_id"]) || !isset($_POST["user_id"])) {
    header("Location: login.php");
    exit;
}

$mysqli = require __DIR__ . "/database.php"; // Connect to the database

// Get the user ID from the POST request
$user_id = $_POST["user_id"];

// Generate placeholder values for the user data
$placeholder_name =  bin2hex(random_bytes(5));
$placeholder_lastName =  bin2hex(random_bytes(5));
$placeholder_username =  bin2hex(random_bytes(5)); // Unique identifier for the username
$placeholder_email =  bin2hex(random_bytes(5)). "@example.com"; // Unique identifier for email
$placeholder_password =  password_hash("randomPassword_" . bin2hex(random_bytes(6)), PASSWORD_DEFAULT); 

// SQL query to update the user's information with placeholder values
$sql = "UPDATE users SET name = ?, lastName = ?, username = ?, email = ?, password_hash = ? WHERE id = ?";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssssi", $placeholder_name, $placeholder_lastName, $placeholder_username, $placeholder_email, $placeholder_password, $user_id);

if ($stmt->execute()) {
    // Account marked as deleted successfully
    session_destroy(); // Log the user out by destroying the session
    header("Location: accountDeleted.php"); // Redirect to a page that confirms deletion
    exit;
} else {
    die("Error updating account.");
}
?>
