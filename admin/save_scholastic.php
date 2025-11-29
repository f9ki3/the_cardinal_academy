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
    $adviser_name = trim($_POST['adviser_name']);
    $general_average = floatval($_POST['general_average']);
    $scholastic_json = $_POST['scholastic_json'] ?? '[]';

    // Validate required fields
    if ($school === '' || $district === '' || $division === '' || $region === '' || $school_id === '' ||
        $classified_grade === '' || $section === '' || $school_year === '' || $adviser_name === '') {
        $response = [
            'status' => 'error',
            'message' => 'Please fill in all required fields.'
        ];
        echo json_encode($response);
        exit;
    } else {
        // Insert into scholastic_records
        $stmt = $conn->prepare("INSERT INTO scholastic_records 
            (student_number, school, district, division, region, school_id, classified_grade, section, school_year, adviser_name, general_average, scholastic_json) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssds", 
            $student_number, $school, $district, $division, $region, $school_id, $classified_grade, $section, $school_year, $adviser_name, $general_average, $scholastic_json
        );

        if ($stmt->execute()) {
            // --- NEW QUERY: Get user_id from users ---
            $stmt2 = $conn->prepare("SELECT user_id FROM users WHERE student_number = ?");
            $stmt2->bind_param("s", $student_number);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $user = $result2->fetch_assoc();
            $stmt2->close();

            if ($user) {
                $user_id = $user['user_id'];

                // --- NEW QUERY: Update course_students.status to 'approved' ---
                $stmt3 = $conn->prepare("UPDATE course_students SET status = 'approved' WHERE student_id = ?");
                $stmt3->bind_param("i", $user_id);
                $stmt3->execute();
                $stmt3->close();
            }

            // Respond with JSON
            $response = [
                'status' => 'success',
                'message' => 'Record saved and student courses approved.'
            ];
            echo json_encode($response);
            exit;

        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to save record. ' . $stmt->error
            ];
            echo json_encode($response);
            exit;
        }

    }
}
?>
