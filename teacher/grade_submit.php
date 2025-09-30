<?php
include '../db_connection.php';
include 'session_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submission_id = isset($_POST['submission_id']) ? intval($_POST['submission_id']) : 0;
    $grade = isset($_POST['grade']) ? intval($_POST['grade']) : null;
    $feedback = isset($_POST['feedback']) ? trim($_POST['feedback']) : '';

    if ($submission_id && $grade !== null) {
        // Retrieve assignment_id for redirect
        $stmt_get = $conn->prepare("SELECT assignment_id FROM assignment_submissions WHERE submission_id = ?");
        $stmt_get->bind_param("i", $submission_id);
        $stmt_get->execute();
        $stmt_get->bind_result($assignment_id);
        $stmt_get->fetch();
        $stmt_get->close();

        // Update grade and feedback
        $stmt_update = $conn->prepare("UPDATE assignment_submissions SET grade = ?, feedback = ? WHERE submission_id = ?");
        $stmt_update->bind_param("isi", $grade, $feedback, $submission_id);
        if ($stmt_update->execute()) {
            $_SESSION['success'] = "Grade and feedback updated successfully!";
        } else {
            $_SESSION['error'] = "Failed to update grade.";
        }
        $stmt_update->close();

        // Redirect back to assignment page
        header("Location: view_assignment.php?status=1&id=" . $assignment_id);
        exit;
    } else {
        $_SESSION['error'] = "Invalid submission data.";
        header("Location: view_assignments.php"); // fallback
        exit;
    }
}
?>
