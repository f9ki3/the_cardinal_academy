<?php
session_start();
include '../db_connection.php'; // Adjust path accordingly

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_SESSION['user_id']);

    // Get and trim inputs
    $new_password = trim($_POST['new_password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Server-side validation
    if (strlen($new_password) < 8) {
        header("Location: profile.php?status=error&msg=Password must be at least 8 characters.");
        exit;
    }

    if ($new_password !== $confirm_password) {
        header("Location: profile.php?status=error&msg=Passwords do not match.");
        exit;
    }

    // Hash the password securely
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    // Prepare update query
    $sql = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        header("Location: profile.php?status=error&msg=Database error.");
        exit;
    }

    $stmt->bind_param('si', $password_hash, $user_id);

    if ($stmt->execute()) {
        // Optionally, you can log the user out to force re-login after password change
        // session_destroy();

        header("Location: profile.php?success=2.");
        exit;
    } else {
        header("Location: profile.php?success=3.");
        exit;
    }
} else {
    // Invalid request method
    header("Location: profile.php");
    exit;
}
?>
