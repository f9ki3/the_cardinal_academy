<?php
include 'session_login.php';
include '../db_connection.php';

// Check if schedule_id is set and numeric
if (!isset($_POST['schedule_id']) || !is_numeric($_POST['schedule_id'])) {
    header('Location: class_schedule.php?status=invalid');
    exit;
}

$schedule_id = (int) $_POST['schedule_id'];

// Get section_id from the schedule before deleting
$get_stmt = $conn->prepare("SELECT section_id FROM class_schedule WHERE id = ?");
$get_stmt->bind_param("i", $schedule_id);
$get_stmt->execute();
$result = $get_stmt->get_result();
$schedule_data = $result->fetch_assoc();

if (!$schedule_data) {
    header('Location: class_schedule.php?status=notfound');
    exit;
}

$section_id = $schedule_data['section_id'];

// Prepare delete query
$stmt = $conn->prepare("DELETE FROM class_schedule WHERE id = ?");
$stmt->bind_param("i", $schedule_id);

// Execute and redirect
if ($stmt->execute()) {
    header("Location: class_schedule.php?id=" . $section_id . "&status=deleted");
    exit;
} else {
    echo "Error deleting schedule: " . $conn->error;
}
?>
