<?php
include 'session_login.php';
include '../db_connection.php';

if (isset($_GET['id'])) {
    $student_id = intval($_GET['id']);
    $parent_id = $_SESSION['user_id'] ?? 0;

    // Delete only if this student belongs to this parent
    $stmt = $conn->prepare("DELETE FROM parent_link WHERE parent_id = ? AND student_id = ?");
    $stmt->bind_param("ii", $parent_id, $student_id);
    if ($stmt->execute()) {
        // Success: redirect to dashboard with status=2
        header("Location: dashboard.php?status=2");
        exit;
    } else {
        // Failed deletion: redirect with error status
        header("Location: dashboard.php?status=0");
        exit;
    }
    $stmt->close();
} else {
    // Invalid student ID
    header("Location: dashboard.php?status=0");
    exit;
}

$conn->close();
?>
