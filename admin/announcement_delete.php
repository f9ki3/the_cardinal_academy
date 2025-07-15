<?php
include 'session_login.php';
include '../db_connection.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute the delete query
    $sql = "DELETE FROM notification WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to the announcement page with a success message (optional)
        header("Location: announcements.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request: ID not specified.";
}
?>
