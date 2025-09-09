<?php
include 'session_login.php';
include '../db_connection.php';

// Ensure POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php?status=error&message=" . urlencode("Invalid request method."));
    exit;
}

// Validate input
$course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
$student_ids = isset($_POST['student_ids']) && is_array($_POST['student_ids']) ? $_POST['student_ids'] : [];

if ($course_id <= 0 || empty($student_ids)) {
    header("Location: course_details.php?id={$course_id}&status=error&message=" . urlencode("Missing course ID or student IDs."));
    exit;
}

$conn->begin_transaction();

$students_added = 0;
$students_skipped = 0;

try {
    // Prepare statements
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM course_students WHERE course_id = ? AND student_id = ?");
    $insert_stmt = $conn->prepare("INSERT INTO course_students (course_id, student_id) VALUES (?, ?)");

    if (!$check_stmt || !$insert_stmt) {
        throw new Exception("Error preparing statements: " . $conn->error);
    }

    foreach ($student_ids as $student_id) {
        $student_id = intval($student_id);
        if ($student_id <= 0) continue;

        // Check if student is already enrolled
        $check_stmt->bind_param("ii", $course_id, $student_id);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->reset();

        if ($count > 0) {
            $students_skipped++;
            continue;
        }

        // Insert new student
        $insert_stmt->bind_param("ii", $course_id, $student_id);
        if (!$insert_stmt->execute()) {
            throw new Exception("Error inserting student ID {$student_id}: " . $insert_stmt->error);
        }
        $students_added++;
    }

    $conn->commit();

    // Determine status
    $status = ($students_skipped > 0) ? 1 : 0; // 1 if any student already exists, 0 if all added
    $message = "Added: {$students_added}, Already exist: {$students_skipped}";

    header("Location: student.php?id={$course_id}&status={$status}&message=" . urlencode($message));

} catch (Exception $e) {
    $conn->rollback();
    header("Location: student.php?id={$course_id}&status=error&message=" . urlencode("Error: " . $e->getMessage()));
}

$conn->close();
exit;
?>
