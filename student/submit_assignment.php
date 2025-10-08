<?php
session_start();
require_once "../db_connection.php"; // DB connection file

$student_id = $_SESSION['user_id'] ?? null;

if (!$student_id) {
    die("Unauthorized access.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $assignment_id  = $_POST['assignment_id'] ?? null;
    $course_id      = $_POST['course_id'] ?? null;
    $submissionType = $_POST['submissionType'] ?? "file";

    $file_path = null;
    $file_url  = null;

    // === Handle Multiple File Upload ===
    if ($submissionType === "file" && isset($_FILES['fileInput'])) {
        $uploadDir = __DIR__ . "/../static/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $uploadedFiles = [];
        foreach ($_FILES['fileInput']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['fileInput']['error'][$key] === UPLOAD_ERR_OK) {
                $fileName   = time() . "_" . basename($_FILES['fileInput']['name'][$key]);
                $targetFile = $uploadDir . $fileName;
                if (move_uploaded_file($tmpName, $targetFile)) {
                    $uploadedFiles[] = $fileName;
                }
            }
        }

        if (!empty($uploadedFiles)) {
            $file_path = json_encode($uploadedFiles);
        }
    }

    // === Handle URL Submission ===
    if ($submissionType === "url" && !empty($_POST['urlInput'])) {
        $file_url = trim($_POST['urlInput']);
    }

    // === Prevent empty submission ===
    if (empty($file_path) && empty($file_url)) {
        die("Cannot submit an empty assignment.");
    }

    // === Insert submission into DB ===
    $sql = "INSERT INTO assignment_submissions 
            (student_id, assignment_id, submission_date, file_path, file_url, grade, feedback) 
            VALUES (?, ?, NOW(), ?, ?, NULL, NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $student_id, $assignment_id, $file_path, $file_url);

    if ($stmt->execute()) {

        // === Fetch teacher_id, course name, and assignment title in one query ===
        $infoQuery = "
            SELECT a.teacher_id, a.title AS assignment_title, c.course_name
            FROM assignments a
            JOIN courses c ON a.course_id = c.id
            WHERE a.assignment_id = ? LIMIT 1
        ";
        $infoStmt = $conn->prepare($infoQuery);
        $infoStmt->bind_param("i", $assignment_id);
        $infoStmt->execute();
        $infoResult = $infoStmt->get_result();

        if ($infoResult->num_rows > 0) {
            $info = $infoResult->fetch_assoc();
            $teacher_id       = $info['teacher_id'];
            $assignmentTitle  = $info['assignment_title'] ?? 'an assignment';
            $courseName       = $info['course_name'] ?? 'the course';

            // === Increment teacher’s notification count ===
            $updateNotif = "UPDATE users SET notification = notification + 1 WHERE user_id = ?";
            $notifStmt = $conn->prepare($updateNotif);
            $notifStmt->bind_param("s", $teacher_id);
            $notifStmt->execute();

            // === Fetch student’s full name ===
            $nameQuery = "SELECT first_name, last_name FROM users WHERE user_id = ?";
            $nameStmt = $conn->prepare($nameQuery);
            $nameStmt->bind_param("s", $student_id);
            $nameStmt->execute();
            $nameResult = $nameStmt->get_result();
            $student = $nameResult->fetch_assoc();

            $fullname = $student['first_name'] . " " . $student['last_name'];

            // === Notification message including assignment title & course name ===
            $message  = "$fullname submitted an assignment \"$assignmentTitle\" for \"$courseName\"";

            // === Insert notification log ===
            $logQuery = "
                INSERT INTO notifications (id, user_id, message, link, created_at)
                VALUES (UUID(), ?, ?, ?, NOW())
            ";
            $logStmt = $conn->prepare($logQuery);
            $link = "view_assignment.php?course_id=$course_id&id=$assignment_id";
            $logStmt->bind_param("sss", $teacher_id, $message, $link);
            $logStmt->execute();
        }

        // === Redirect back to assignment view ===
        header("Location: view_assignment.php?course_id=$course_id&id=$assignment_id&success=1");
        exit;
    } else {
        die("Database error: " . $stmt->error);
    }
}
?>
