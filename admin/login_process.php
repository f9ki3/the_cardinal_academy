<?php
session_start();
include '../db_connection.php'; // Ensure this connects to your DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare SQL to find user by username or email with admin type
    $stmt = $conn->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND acc_type = 'admin' LIMIT 1");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Check hashed password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['acc_type'] = $user['acc_type'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit;
        }
    }

    // If we reach here, either user not found or password incorrect
    header("Location: index.php?status=1");
    exit;
} else {
    // Prevent direct access to this script
    header("Location: index.php");
    exit;
}
