<?php
include 'session_login.php';
include '../db_connection.php';

// Validate ID from GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: sectioning.php?status=error&nav_drop=true');
    exit;
}

$section_id = (int) $_GET['id'];

// 1. Delete related records from master_list table
$delete_master_list = $conn->prepare("DELETE FROM master_list WHERE section_id = ?");
$delete_master_list->bind_param("i", $section_id);
$delete_master_list->execute();

// 2. Delete related records from class_schedule table
$delete_schedule = $conn->prepare("DELETE FROM class_schedule WHERE section_id = ?");
$delete_schedule->bind_param("i", $section_id);
$delete_schedule->execute();

// 3. Delete the section from sections table
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
