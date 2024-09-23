<?php
session_start(); 

$is_invalid = false;
$theme = $_SESSION["theme"] ?? $_COOKIE['theme'] ?? 'light';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php?redirect=createTask.php");
    exit;
}

// Access user data from the session
$username = $_SESSION["username"]; // Get the logged-in user's username

$mysqli = require 'database.php';

// Initialize message variable
$message = '';

// Handle task list and task creation
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['create_task'])) {
    $task_list_title = $_POST['task_list_title']; // Task list title from form
    $task_title = $_POST['task_title'];           // Task title from form

    // Insert the new task list with the owner's username
    $stmt = $mysqli->prepare("INSERT INTO task_lists (title, owner) VALUES (?, ?)");
    $stmt->bind_param("ss", $task_list_title, $username); // Bind the username as the owner

    if ($stmt->execute()) {
        // Get the last inserted list ID
        $list_id = $stmt->insert_id;

        // Insert the task with the new list ID
        $stmt = $mysqli->prepare("INSERT INTO tasks (title, list_id) VALUES (?, ?)");
        $stmt->bind_param("si", $task_title, $list_id);

        if ($stmt->execute()) {
            $message = "Task and task list created successfully!";
        } else {
            $message = "Error creating task: " . $mysqli->error;
        }
    } else {
        $message = "Error creating task list: " . $mysqli->error;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="create.css">
    <title>Δημιουργία εργασίας και λίστα εργασίας</title>
</head>
<body>

    <h1>Δημιουργία εργασίας και λίστα εργασίας</h1>
    <form method="POST" action="">
        <label for="task_list_title">Τίτλος λιστας εργασιών:</label>
        <input type="text" id="task_list_title" name="task_list_title" required><br>

        <label for="task_title">Τίτλος εργασίας:</label>
        <input type="text" id="task_title" name="task_title" required><br>

        <button type="submit" name="create_task">Δημιουργία εργασίας και λίστα εργασίας</button>

        <div class="view-tasks-container">
            <a href="view_tasks.php" class="view-tasks-button">Προβολή Tasks</a>
        </div>

    </form>

    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <script src="theme-toggle.js"></script> <!-- JavaScript for theme toggle -->

</body>
</html>
