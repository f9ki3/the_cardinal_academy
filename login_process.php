<?php
session_start();
include 'db_connection.php'; // Ensure this file sets $conn correctly

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare SQL to find user by username or email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check hashed password
        if (password_verify($password, $user['password'])) {
            // Block admin login
            if ($user['acc_type'] === 'admin') {
                header("Location: login.php?status=unauthorized"); // You can customize this message
                exit;
            }

            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['acc_type'] = $user['acc_type'];

            // Redirect by role
            if ($_SESSION['acc_type'] === 'teacher') {
                header("Location: teacher/dashboard.php");
            } elseif ($_SESSION['acc_type'] === 'parent') {
                header("Location: parent/dashboard.php");
            } elseif ($_SESSION['acc_type'] === 'student') {
                header("Location: student/dashboard.php");
            } else {
                header("Location: login.php?status=1"); // fallback
            }

            exit;
        }

    } else {
        // User not found
        header("Location: login.php?status=1");
    }

    // Redirect back to login with error
    header("Location: login.php?status=1");
    exit;
} else {
    // Direct access to this script
    header("Location: login.php?status=1");
    exit;
}
