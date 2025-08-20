<?php
include 'session_login.php';
include '../db_connection.php';

// Validate ID from GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: uniforms.php?status=error&nav_drop=true');
    exit;
}

$uniform_id = (int) $_GET['id'];

// Delete the uniform from uniforms table
$delete_stmt = $conn->prepare("DELETE FROM uniforms WHERE id = ?");
$delete_stmt->bind_param("i", $uniform_id);

if ($delete_stmt->execute()) {
    header("Location: uniforms.php?status=deleted&nav_drop=true");
    exit;
} else {
    header("Location: uniforms.php?status=delete_error&nav_drop=true");
    exit;
}
?>
