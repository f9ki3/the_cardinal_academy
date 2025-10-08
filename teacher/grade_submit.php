<?php
include '../db_connection.php';
include 'session_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submission_id = isset($_POST['submission_id']) ? intval($_POST['submission_id']) : 0;
    $grade = isset($_POST['grade']) ? intval($_POST['grade']) : null;
    $feedback = isset($_POST['feedback']) ? trim($_POST['feedback']) : '';

    if ($submission_id && $grade !== null) {
        // Fetch assignment info including course_id
        $stmt_get = $conn->prepare(
            "SELECT s.assignment_id, s.student_id, a.title, a.course_id 
             FROM assignment_submissions AS s
             JOIN assignments AS a ON s.assignment_id = a.assignment_id
             WHERE s.submission_id = ?"
        );
        $stmt_get->bind_param('i', $submission_id);
        $stmt_get->execute();
        $stmt_get->bind_result($assignment_id, $student_id, $assignment_title, $course_id);
        $stmt_get->fetch();
        $stmt_get->close();

        // Update grade and feedback
        $stmt_update = $conn->prepare('UPDATE assignment_submissions SET grade = ?, feedback = ? WHERE submission_id = ?');
        $stmt_update->bind_param('isi', $grade, $feedback, $submission_id);

        if ($stmt_update->execute()) {
            // Fetch teacher name
            $teacher_id = $_SESSION['user_id'];
            $stmt_teacher = $conn->prepare('SELECT first_name, last_name FROM users WHERE user_id = ?');
            $stmt_teacher->bind_param('i', $teacher_id);
            $stmt_teacher->execute();
            $stmt_teacher->bind_result($first_name, $last_name);
            $stmt_teacher->fetch();
            $stmt_teacher->close();

            $teacher_name = htmlspecialchars($first_name . ' ' . $last_name);
            $assignment_title = htmlspecialchars($assignment_title);

            // Insert notification with both assignment_id and course_id
            $message = "{$teacher_name} graded your assignment: {$assignment_title}";
            $link = "view_assignment.php?id={$assignment_id}&course_id={$course_id}";
            $now = date("Y-m-d H:i:s");

            $stmt_notify = $conn->prepare('INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)');
            $stmt_notify->bind_param('isss', $student_id, $message, $link, $now);
            $stmt_notify->execute();
            $stmt_notify->close();

            // Increment student's notification count
            $stmt_count = $conn->prepare('UPDATE users SET notification = notification + 1 WHERE user_id = ?');
            $stmt_count->bind_param('i', $student_id);
            $stmt_count->execute();
            $stmt_count->close();

            $_SESSION['success'] = 'Grade and feedback updated successfully!';
        } else {
            $_SESSION['error'] = 'Failed to update grade.';
        }
        $stmt_update->close();

        header("Location: view_assignment.php?status=1&id={$assignment_id}");
        exit;
    } else {
        $_SESSION['error'] = 'Invalid submission data.';
        header('Location: view_assignments.php');
        exit;
    }
}
?>
