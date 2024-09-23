<?php
$response = ['status' => 'error', 'message' => '', 'field' => ''];

// Check if fields are empty
if (empty($_POST['name'])) {
    $response['message'] = "Name is required";
    $response['field'] = "name";
    echo json_encode($response);
    exit;
}

if (empty($_POST['lastName'])) {
    $response['message'] = "Last Name is required";
    $response['field'] = "lastName";
    echo json_encode($response);
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $response['message'] = "Valid email is required";
    $response['field'] = "email";
    echo json_encode($response);
    exit;
}

if (strlen($_POST['username']) < 3) {
    $response['message'] = "Username must be at least 3 characters";
    $response['field'] = "username";
    echo json_encode($response);
    exit;
}

if (strlen($_POST['password']) < 8) {
    $response['message'] = "Password must be at least 8 characters";
    $response['field'] = "password";
    echo json_encode($response);
    exit;
}

if ($_POST['password'] !== $_POST['password_confirmation']) {
    $response['message'] = "Passwords do not match";
    $response['field'] = "password_confirmation";
    echo json_encode($response);
    exit;
}

$mysqli = require __DIR__ . '/database.php';

// Check if email already exists
$sql_email = "SELECT * FROM users WHERE email = ?";
$stmt_email = $mysqli->stmt_init();

if (!$stmt_email->prepare($sql_email)) {
    $response['message'] = "SQL error: " . $mysqli->error;
    echo json_encode($response);
    exit;
}

$stmt_email->bind_param("s", $_POST['email']);
$stmt_email->execute();
$result_email = $stmt_email->get_result();

if ($result_email->num_rows > 0) {
    $response['message'] = "Email is already taken";
    $response['field'] = "email";
    echo json_encode($response);
    exit;
}

// Check if username already exists
$sql_username = "SELECT * FROM users WHERE username = ?";
$stmt_username = $mysqli->stmt_init();

if (!$stmt_username->prepare($sql_username)) {
    $response['message'] = "SQL error: " . $mysqli->error;
    echo json_encode($response);
    exit;
}

$stmt_username->bind_param("s", $_POST['username']);
$stmt_username->execute();
$result_username = $stmt_username->get_result();

if ($result_username->num_rows > 0) {
    $response['message'] = "Username is already taken";
    $response['field'] = "username";
    echo json_encode($response);
    exit;
}

// Insert new user if all validations pass
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$sql_insert = "INSERT INTO users (name, lastName, username, email, password_hash) VALUES (?, ?, ?, ?, ?)";
$stmt_insert = $mysqli->stmt_init();

if (!$stmt_insert->prepare($sql_insert)) {
    $response['message'] = "SQL error: " . $mysqli->error;
    echo json_encode($response);
    exit;
}

$stmt_insert->bind_param("sssss", $_POST['name'], $_POST['lastName'], $_POST['username'], $_POST['email'], $password_hash);

if ($stmt_insert->execute()) {
    $response['status'] = 'success';
    echo json_encode($response);
} else {
    $response['message'] = "Registration failed";
    echo json_encode($response);
}
?>