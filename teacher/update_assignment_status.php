<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assignment_id = intval($_POST['assignment_id']);
    $new_accept = $_POST['new_accept'];

    if (!empty($assignment_id) && ($new_accept === '0' || $new_accept === '1')) {
        $stmt = $conn->prepare("UPDATE assignments SET accept = ? WHERE assignment_id = ?");
        $stmt->bind_param("ii", $new_accept, $assignment_id);

        if ($stmt->execute()) {
            // ✅ Redirect with status=3 (updated accept status)
            header("Location: view_assignment.php?id={$assignment_id}&status=3");
            exit();
        } else {
            header("Location: view_assignment.php?id={$assignment_id}&status=error");
            exit();
        }
    } else {
        header("Location: view_assignment.php?status=invalid");
        exit();
    }
} else {
    header("Location: view_assignment.php?status=invalid_method");
    exit();
}
?>
