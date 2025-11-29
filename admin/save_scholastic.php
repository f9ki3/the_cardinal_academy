<?php 
include 'session_login.php'; 
include '../db_connection.php';

$student_id = isset($_GET['student_number']) ? trim($_GET['student_number']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_number = trim($_POST['student_number']);
    $school = trim($_POST['school']);
    $district = trim($_POST['district']);
    $division = trim($_POST['division']);
    $region = trim($_POST['region']);
    $school_id = trim($_POST['school_id']);
    $classified_grade = trim($_POST['classified_grade']);
    $section = trim($_POST['section']);
    $school_year = trim($_POST['school_year']);
    $adviser_name = trim($_POST['adviser_name']); // <-- changed
    $general_average = floatval($_POST['general_average']);
    $scholastic_json = $_POST['scholastic_json'] ?? '[]';

    // Validate required fields
    if ($school===''||$district===''||$division===''||$region===''||$school_id===''||
        $classified_grade===''||$section===''||$school_year===''||$adviser_name==='') {
        $error = "Please fill in all required fields.";
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO scholastic_records 
            (student_number, school, district, division, region, school_id, classified_grade, section, school_year, adviser_name, general_average, scholastic_json) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssds", 
            $student_number, $school, $district, $division, $region, $school_id, $classified_grade, $section, $school_year, $adviser_name, $general_average, $scholastic_json
        );

        if ($stmt->execute()) {
            // Option 1: Using double quotes for variable interpolation
            header("Location: view_student_grades.php?student_id=$student_id&status=created");
            exit;

            // Option 2: Using concatenation
            // header('Location: scholastic.php?status=created&student_number=' . urlencode($student_id));
            // exit;
        } else {
            $error = "Failed to save record. " . $stmt->error;
        }

    }
}
?>