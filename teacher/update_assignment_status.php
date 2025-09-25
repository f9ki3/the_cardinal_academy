<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assignment_id = $_POST['assignment_id'];
    $new_accept = $_POST['new_accept'];

    if (!empty($assignment_id) && ($new_accept === '0' || $new_accept === '1')) {
        $stmt = $conn->prepare("UPDATE assignments SET accept = ? WHERE assignment_id = ?");
        $stmt->bind_param("ii", $new_accept, $assignment_id);
        if ($stmt->execute()) {
            header("Location: view_assignment.php?id=$assignment_id"); 
            exit;
        } else {
            echo "Failed to update assignment.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}
?>
