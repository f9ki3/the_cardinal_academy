<?php
include 'session_login.php';
include '../db_connection.php';

$student_id = $_SESSION['user_id'] ?? null;

if (!$student_id) {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submission_id = isset($_POST['submission_id']) ? intval($_POST['submission_id']) : 0;

    if ($submission_id > 0) {
        // Optionally fetch the submission first to delete uploaded files
        $stmt = $conn->prepare("SELECT file_path FROM assignment_submissions WHERE submission_id = ? AND student_id = ?");
        $stmt->bind_param("ii", $submission_id, $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $submission = $result->fetch_assoc();

        if ($submission) {
            // Delete uploaded files
            if (!empty($submission['file_path'])) {
                $files = json_decode($submission['file_path'], true);
                foreach ($files as $file) {
                    $filePath = "../static/uploads/" . $file;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            // Delete the submission record
            $stmtDel = $conn->prepare("DELETE FROM assignment_submissions WHERE submission_id = ? AND student_id = ?");
            $stmtDel->bind_param("ii", $submission_id, $student_id);
            $stmtDel->execute();
        }
    }

    // Redirect back to the assignment page
    header("Location: view_assignment.php?course_id=" . intval($_POST['course_id']) . "&id=" . intval($_POST['assignment_id'])."&success="."2");
    exit();
} else {
    die("Invalid request method.");
}
?>
