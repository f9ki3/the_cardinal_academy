<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameOrEmail = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($usernameOrEmail) || empty($password)) {
        header("Location: login.php?status=1");
        exit;
    }

    // Find user by username or email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['acc_type'] = $user['acc_type'];

            // Redirect based on account type
            switch ($user['acc_type']) {
                case 'teacher':
                    header("Location: teacher/dashboard.php");
                    break;
                case 'parent':
                    header("Location: parent/dashboard.php");
                    break;
                case 'student':
                    header("Location: student/dashboard.php");
                    break;
                default:
                    header("Location: login.php?status=1");
                    break;
            }
            exit;
        } else {
            // Incorrect password
            header("Location: login.php?status=1");
            exit;
        }
    } else {
        // User not found
        header("Location: login.php?status=1");
        exit;
    }
} else {
    // Direct access
    header("Location: login.php?status=1");
    exit;
}
?>
