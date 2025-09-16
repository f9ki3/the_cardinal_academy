<?php
include '../db_connection.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $assignment_id = intval($_GET['id']);
    $action = $_GET['action'] == 'accept' ? 1 : 0;

    // Update the accept value in the database
    $query = "UPDATE assignments SET accept = $action WHERE assignment_id = $assignment_id";
    
    if (mysqli_query($conn, $query)) {
        // If successful, redirect back to the assignment page or reload the page
        echo json_encode(['success' => true, 'accept' => $action]);
    } else {
        // If there is an error, send a failure response
        echo json_encode(['success' => false]);
    }
    mysqli_close($conn);
} else {
    echo json_encode(['success' => false]);
}
?>
