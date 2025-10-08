<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $instructions = mysqli_real_escape_string($conn, $_POST['instructions']);
    $points = intval($_POST['points']);
    $due_date = $_POST['due_date'];
    $due_time = $_POST['due_time'];
    $course_id = intval($_POST['course_id']);
    $teacher_id = intval($_POST['teacher_id']);

    // Basic validation
    if (empty($title) || empty($instructions) || empty($points) || empty($due_date) || empty($due_time)) {
        header("Location: assignment.php?id={$course_id}&status=0"); // 0 = error
        exit();
    }

    // Handle file upload
    $attachment = NULL;
    if (isset($_FILES['assignment_file']) && $_FILES['assignment_file']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../static/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid('assignment_') . '.' . pathinfo($_FILES['assignment_file']['name'], PATHINFO_EXTENSION);
        $uploadFile = $uploadDir . $fileName;

        $allowedTypes = ['pdf', 'docx', 'pptx', 'txt', 'jpg', 'png'];
        $fileExtension = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedTypes)) {
            header("Location: assignment.php?id={$course_id}&status=invalidfile");
            exit();
        }

        if ($_FILES['assignment_file']['size'] > 10485760) { // 10MB limit
            header("Location: assignment.php?id={$course_id}&status=filesize");
            exit();
        }

        if (move_uploaded_file($_FILES['assignment_file']['tmp_name'], $uploadFile)) {
            $attachment = $fileName;
        } else {
            header("Location: assignment.php?id={$course_id}&status=uploadfail");
            exit();
        }
    }

    // Insert assignment
    $stmt = $conn->prepare("INSERT INTO assignments (course_id, teacher_id, title, instructions, points, due_date, due_time, attachment)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iississs", $course_id, $teacher_id, $title, $instructions, $points, $due_date, $due_time, $attachment);

    if ($stmt->execute()) {
        $assignment_id = $stmt->insert_id;

        // Fetch teacher name
        $teacher_stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE user_id = ?");
        $teacher_stmt->bind_param("i", $teacher_id);
        $teacher_stmt->execute();
        $teacher_result = $teacher_stmt->get_result();
        $teacher = $teacher_result->fetch_assoc();
        $teacher_name = htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']);

        // Fetch course name
        $course_stmt = $conn->prepare("SELECT course_name FROM courses WHERE id = ?");
        $course_stmt->bind_param("i", $course_id);
        $course_stmt->execute();
        $course_result = $course_stmt->get_result();
        $course = $course_result->fetch_assoc();
        $course_name = htmlspecialchars($course['course_name']);

        // Fetch students in the course
        $students_stmt = $conn->prepare("SELECT student_id FROM course_students WHERE course_id = ?");
        $students_stmt->bind_param("i", $course_id);
        $students_stmt->execute();
        $students_result = $students_stmt->get_result();

        // Insert notifications
        $notif_stmt = $conn->prepare("INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)");
        $now = date("Y-m-d H:i:s");

        while ($row = $students_result->fetch_assoc()) {
            $user_id = $row['student_id'];
            $message = $teacher_name . " posted a new assignment in " . $course_name . ": " . $title;
            $link = "view_assignment.php?id=" . $assignment_id . "&course_id=" . $course_id;

            // Insert new notification
            $notif_stmt->bind_param("isss", $user_id, $message, $link, $now);
            $notif_stmt->execute();

            // Increment user's notification count
            $update_notif = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
            $update_notif->bind_param("i", $user_id);
            $update_notif->execute();
            $update_notif->close();
        }

        header("Location: assignment.php?id={$course_id}&status=1");
        exit();
    } else {
        header("Location: assignment.php?id={$course_id}&status=error");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
