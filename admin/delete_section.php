<?php
include 'session_login.php';
include '../db_connection.php';

// Validate ID from GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: subject_unit.php?status=error');
    exit;
}

$section_id = (int) $_GET['id'];

// 1. Update users: Set section_id to NULL for all students in this section
$update_stmt = $conn->prepare("UPDATE users SET section_id = NULL WHERE acc_type = 'student' AND section_id = ?");
$update_stmt->bind_param("i", $section_id);

if (!$update_stmt->execute()) {
    header("Location: sectioning.php?status=update_error&nav_drop=true");
    exit;
}

// 2. Delete the section from sections table
$delete_stmt = $conn->prepare("DELETE FROM sections WHERE section_id = ?");
$delete_stmt->bind_param("i", $section_id);

if ($delete_stmt->execute()) {
    header("Location: sectioning.php?status=deleted&nav_drop=true");
    exit;
} else {
    header("Location: sectioning.php?status=delete_error&nav_drop=true");
    exit;
}
?>
