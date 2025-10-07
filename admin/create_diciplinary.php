<?php
include 'session_login.php';
include '../db_connection.php';

$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data safely
    $student_id = $_POST['student_id'];
    $incident_date = $_POST['incident_date'];
    $incident_location = $_POST['incident_location'];
    $incident_description = $_POST['incident_description'];
    $violation_type = $_POST['violation_type'];
    $disciplinary_action = $_POST['disciplinary_action'];
    $witnesses = $_POST['witnesses'];
    $remarks = $_POST['remarks'];

    // Generate a unique disciplinary_id
    $disciplinary_id = 'DISC-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO student_disciplinary_records (disciplinary_id, student_id, incident_date, incident_location, incident_description, violation_type, disciplinary_action, witnesses, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $disciplinary_id, $student_id, $incident_date, $incident_location, $incident_description, $violation_type, $disciplinary_action, $witnesses, $remarks);

    if ($stmt->execute()) {
        // After successfully saving the disciplinary report
        header("Location: view_student_diciplinary.php?status=1&student_id=" . urlencode($student_id));
        exit;

        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>