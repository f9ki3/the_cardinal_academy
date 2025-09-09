<?php
include 'session_login.php';
include '../db_connection.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$teacher_id = $_SESSION['user_id'];
$course_id = intval($_GET['id']);

// Fetch the course first to get cover photo
$stmt = $conn->prepare("SELECT cover_photo FROM courses WHERE id = ? AND teacher_id = ?");
$stmt->bind_param("ii", $course_id, $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $cover_photo = $row['cover_photo'];
} else {
    die("Course not found or you don't have permission to delete it.");
}
$stmt->close();

// Delete the course
$stmt = $conn->prepare("DELETE FROM courses WHERE id = ? AND teacher_id = ?");
$stmt->bind_param("ii", $course_id, $teacher_id);
if ($stmt->execute()) {
    // Optionally delete cover photo file
    if (!empty($cover_photo)) {
        $file_path = '../static/uploads/' . $cover_photo;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    header("Location: dashboard.php?success=Course deleted successfully");
    exit;
} else {
    echo "<p style='color:red;'>Failed to delete course: " . $stmt->error . "</p>";
}
?>
