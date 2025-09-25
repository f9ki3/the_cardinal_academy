<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assignment_id'])) {
    $assignment_id = intval($_POST['assignment_id']);

    // Optional: fetch the attachment file first and delete from server
    $stmt = $conn->prepare("SELECT attachment FROM assignments WHERE assignment_id = ?");
    $stmt->bind_param("i", $assignment_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if (!empty($row['attachment']) && file_exists("../uploads/" . $row['attachment'])) {
            unlink("../uploads/" . $row['attachment']);
        }
    }
    $stmt->close();

    // Optional: delete submission files
    $sub_stmt = $conn->prepare("SELECT file_path FROM assignment_submissions WHERE assignment_id = ?");
    $sub_stmt->bind_param("i", $assignment_id);
    $sub_stmt->execute();
    $sub_res = $sub_stmt->get_result();
    while ($sub = $sub_res->fetch_assoc()) {
        if (!empty($sub['file_path']) && file_exists("../uploads/" . basename($sub['file_path']))) {
            unlink("../uploads/" . basename($sub['file_path']));
        }
    }
    $sub_stmt->close();

    // Delete submissions
    $stmt = $conn->prepare("DELETE FROM assignment_submissions WHERE assignment_id = ?");
    $stmt->bind_param("i", $assignment_id);
    $stmt->execute();
    $stmt->close();

    // Delete assignment
    $stmt = $conn->prepare("DELETE FROM assignments WHERE assignment_id = ?");
    $stmt->bind_param("i", $assignment_id);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: assignment.php?id=" . $assignment_id . "&deleted=1");
        exit;
    } else {
        echo "Error deleting assignment: " . $conn->error;
    }
} else {
    header("Location: assignment.php");
    exit;
}
