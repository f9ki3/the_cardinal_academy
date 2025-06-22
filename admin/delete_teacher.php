<?php
include 'session_login.php';
include '../db_connection.php';

// Handle only GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if user_id is passed
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: teacher.php?status=error");
        exit;
    }

    $user_id = (int) $_GET['id'];

    // Confirm user is a teacher
    $check_stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ? AND acc_type = 'teacher'");
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows === 0) {
        $check_stmt->close();
        header("Location: teacher.php?status=not_found");
        exit;
    }
    $check_stmt->close();

    // Delete the user
    $delete_stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    if ($delete_stmt) {
        $delete_stmt->bind_param("i", $user_id);
        if ($delete_stmt->execute()) {
            $delete_stmt->close();
            header("Location: teacher.php?status=deleted");
            exit;
        } else {
            $delete_stmt->close();
            header("Location: teacher.php?status=delete_failed");
            exit;
        }
    } else {
        header("Location: teacher.php?status=prepare_error");
        exit;
    }
} else {
    // Invalid request method
    header("Location: teacher.php?status=invalid_method");
    exit;
}
