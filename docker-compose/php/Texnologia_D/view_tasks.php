<?php
session_start(); 

$is_invalid = false;
$theme = $_SESSION["theme"] ?? $_COOKIE['theme'] ?? 'light';

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to login page with a redirect parameter
    header("Location: login.php?redirect=view_tasks.php");
    exit;
}

// Access user data from the session
$name = $_SESSION["name"];
$lastName = $_SESSION["lastName"];
$username = $_SESSION["username"]; // This should be the username filled during signup
$email = $_SESSION["email"];

$mysqli = require 'database.php';

// Handle task list deletion via AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_list_id'])) {
    $list_id = $_POST['delete_list_id'];

    // Begin transaction to ensure both deletions happen together
    $mysqli->begin_transaction();
    try {
        // Delete all tasks associated with this task list
        $stmt = $mysqli->prepare("DELETE FROM tasks WHERE list_id = ?");
        $stmt->bind_param("i", $list_id);
        $stmt->execute();

        // Delete the task list itself
        $stmt = $mysqli->prepare("DELETE FROM task_lists WHERE id = ?");
        $stmt->bind_param("i", $list_id);
        $stmt->execute();

        // Commit transaction
        $mysqli->commit();
        echo "Task list and associated tasks deleted.";
    } catch (Exception $e) {
        $mysqli->rollback();
        echo "Error: " . $e->getMessage();
    }
    exit;
}

// Handle task addition via AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_task'])) {
    $list_id = $_POST['list_id'];
    $task_title = $_POST['task_title'];

    // Insert the new task into the tasks table
    $stmt = $mysqli->prepare("INSERT INTO tasks (title, list_id) VALUES (?, ?)");
    $stmt->bind_param("si", $task_title, $list_id);

    if ($stmt->execute()) {
        echo "Task added successfully.";
    } else {
        echo "Error adding task: " . $mysqli->error;
    }
    exit;
}

// Fetch current task lists and display the owner's username
$result = $mysqli->prepare("SELECT id, title, owner, created_at FROM task_lists");
$result->execute();
$result = $result->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="viewStyle.css">
</head>
<body>

<div id="task-list-container">
    
    <h2>Current Task Lists:</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($list = $result->fetch_assoc()) {
            echo "<div class='task-list-item' data-id='" . $list['id'] . "'>";
            echo "<h3>Λίστα Εργασιών: " . htmlspecialchars($list['title']) . " (Owner: " . htmlspecialchars($list['owner']) . ") - Δημιουργήθηκε: " . $list['created_at'] . "</h3>";
            echo " <button class='delete-btn' data-id='" . $list['id'] . "'>Delete</button>";
            echo " <button class='add-task-btn' data-id='" . $list['id'] . "'>Add Task</button>";
            echo " <button class='toggle-tasks-btn'>▶</button>"; // Arrow button
            echo "<div class='tasks-container' style='display:none;' data-list-id='" . $list['id'] . "'>";
            
            // Fetch and display tasks for this list (initially hidden)
            $tasks_result = $mysqli->query("SELECT * FROM tasks WHERE list_id = " . $list['id']);
            if ($tasks_result->num_rows > 0) {
                while ($task = $tasks_result->fetch_assoc()) {
                    echo "<p class='task-item'>" . htmlspecialchars($task['title']) . "</p>";
                }
            } else {
                echo "<p>No tasks found.</p>";
            }
            echo "</div>"; // Close tasks-container
            echo "</div>"; // Close task-list-item
        }
    } else {
        echo "<p>No task lists found.</p>";
    }
    ?>
</div>

<div id="add-task-form">
    <h3>Add Task to Task List</h3>
    <input type="text" id="task_title" placeholder="Enter task title">
    <button id="submit-task-btn">Add Task</button>
    <button id="cancel-task-btn">Cancel</button>
</div>

<!-- Message container -->
<div id="message-container" style="margin-top: 20px;"></div>

<script src="viewTasks.js"></script>
<script src="theme-toggle.js"></script> <!-- JavaScript for theme toggle -->

</body>
</html>
