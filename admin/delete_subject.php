<?php
include 'session_login.php';
include '../db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: subject_unit.php?status=error');
    exit;
}

$id = (int) $_GET['id'];

// Prepare and execute delete query
$stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: subject_unit.php?status=deleted");
    exit;
} else {
    header("Location: subject_unit.php?status=error");
    exit;
}
?>
