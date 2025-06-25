<?php
include 'session_login.php';
include '../db_connection.php';

// Check if schedule_id is set and numeric
if (!isset($_POST['schedule_id']) || !is_numeric($_POST['schedule_id'])) {
    header('Location: class_schedule.php?status=invalid');
    exit;
}

$schedule_id = (int) $_POST['schedule_id'];

// Prepare delete query
$stmt = $conn->prepare("DELETE FROM class_schedule WHERE id = ?");
$stmt->bind_param("i", $schedule_id);

// Execute and redirect
if ($stmt->execute()) {
    header("Location: class_schedule.php?id=" . $_GET['section_id'] . "&status=deleted");
    exit;
} else {
    echo "Error deleting schedule: " . $conn->error;
}
?>
