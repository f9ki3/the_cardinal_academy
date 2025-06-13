<?php
session_start();
include '../db_connection.php'; // make sure this connects to your DB

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
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['acc_type'] = $user['acc_type'];

            // Redirect based on account type (optional)
            header("Location: dashboard.php");
            exit;
        } else {
            // Wrong password
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        // User not found
        $_SESSION['error'] = "User not found.";
    }

    header("Location: ../login.php");
    exit;
} else {
    // Direct access to login_process
    header("Location: ../login.php");
    exit;
}
?>
