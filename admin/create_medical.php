<?php
include '../db_connection.php';
include 'session_login.php';

// --- 1. Define Variables and Constants ---

// Variables from the POST request
$student_number = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';
$record_type = isset($_POST['record_type']) ? trim($_POST['record_type']) : '';
$general_note = $_POST['additional_notes'] ?? ''; // Maps to 'general_note' in schema

// FIX: Change nurse source. Form field is DISABLED, so $_POST['nurse_incharge'] will be empty.
// Use the session variable $full_name (assumed available from session_login.php)
$nurse_incharge_name = isset($_POST['nurse_incharge']) ? trim($_POST['nurse_incharge']) : '';
// --- END FIX ---


// --- 2. ID Generation Function ---

function generateMedicalID($conn) {
    // 1. If the form supplied a unique ID (e.g., med_6575a7b6c5d4e), use it immediately.
    if (isset($_POST['medical_id']) && strpos($_POST['medical_id'], 'med_') === 0) {
        return $_POST['medical_id']; 
    }
    
    // 2. FIX: Query only IDs that start with 'MED-' to find the sequential maximum.
    // Ordering by the extracted number is safer, but ordering by ID DESC and checking the highest is efficient.
    $query = "SELECT medical_id FROM student_health_records WHERE medical_id LIKE 'MED-%' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);
    $maxId = 0;
    
    if ($result && $row = $result->fetch_assoc()) {
        // Extract the numeric part (starting after the 4th character 'MED-')
        $currentId = intval(substr($row['medical_id'], 4));
        $maxId = max($maxId, $currentId);
    }
    
    // Calculate the next ID
    $newId = $maxId + 1;
    
    // Format the result as MED-0000 (4 digits with leading zeros)
    return sprintf("MED-%04d", $newId);
}

// Get the medical ID
$medical_id = generateMedicalID($conn);

// --- 3. Main Submission Logic ---

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($student_number) && !empty($record_type)) {

    // A. Get numeric user_id (student_numeric_id) for parent_link and notifications
    $stmtStudent = $conn->prepare("SELECT user_id AS student_id FROM users WHERE student_number = ?");
    $stmtStudent->bind_param("s", $student_number);
    $stmtStudent->execute();
    $resultStudent = $stmtStudent->get_result();
    $studentRow = $resultStudent->fetch_assoc();
    $stmtStudent->close();

    if (!$studentRow) {
        die("No student found with student number: $student_number");
    }

    $student_numeric_id = $studentRow['student_id'];

    // B. Initialize ALL schema-specific fields to NULL or default string values
    
    // Vitals and Survey Numeric Fields (can be NULL)
    $height = NULL; $weight = NULL; $bloodPressure = NULL; $temperature = NULL; 
    $pulse = NULL; $respiration = NULL; $activity = NULL; $sleep = NULL;
    
    // Text Fields (set to empty string '' if not used)
    $allergies = ''; $medications = ''; $conditions = ''; $recentIllness = ''; 
    $hospitalizations = ''; $vision = ''; $hearing = ''; $dental = ''; 
    $diet = ''; $mentalHealth = '';
    
    // Schema-specific optional fields
    $notes = ''; 
    $medecine_request = '';
    $medecine_used = '';
    $reasons = '';

    // C. Populate fields based on the selected record type
    if ($record_type === 'Check Up') {
        // Vitals: Use ternary to set to NULL if zero, otherwise use the float/int value
        $height = floatval($_POST['height'] ?? 0) ?: NULL;
        $weight = floatval($_POST['weight'] ?? 0) ?: NULL;
        $bloodPressure = $_POST['blood_pressure'] ?? '';
        $temperature = floatval($_POST['temperature'] ?? 0) ?: NULL;
        $pulse = intval($_POST['pulse'] ?? 0) ?: NULL;
        $respiration = intval($_POST['respiration'] ?? 0) ?: NULL;
        $activity = intval($_POST['activity'] ?? 0) ?: NULL;
        $sleep = intval($_POST['sleep'] ?? 0) ?: NULL;
        
        // Survey Text Fields
        $allergies = $_POST['allergies'] ?? '';
        $medications = $_POST['medications'] ?? '';
        $conditions = $_POST['conditions'] ?? '';
        $recentIllness = $_POST['recentIllness'] ?? '';
        $hospitalizations = $_POST['hospitalizations'] ?? '';
        $vision = $_POST['vision'] ?? '';
        $hearing = $_POST['hearing'] ?? '';
        $dental = $_POST['dental'] ?? '';
        $diet = $_POST['diet'] ?? '';
        $mentalHealth = $_POST['mentalHealth'] ?? '';
        
    } elseif ($record_type === 'Request Medicine') {
        $medecine_request = $_POST['medicine_requested'] ?? '';
        $medecine_used = $_POST['medicine_used'] ?? '';
        
    } elseif ($record_type === 'Clinic Visit') {
        $reasons = $_POST['reason_for_visit'] ?? '';
    }

    // D. Insert into the single student_health_records table
    $stmt = $conn->prepare("
        INSERT INTO student_health_records (
            medical_id, student_id, height, weight, blood_pressure, temperature, pulse, respiration,
            allergies, medications, conditions, recent_illness, hospitalizations,
            vision, hearing, dental, activity, sleep, diet, mental_health, 
            notes, general_note, types, medecine_request, medecine_used, reasons, nurse
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?, ?
        )
    ");

    if (!$stmt) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    $bind_string = str_repeat("s", 27); 

    // The order of variables must exactly match the column order above (27 total)
    $stmt->bind_param(
        $bind_string, 
        $medical_id, $student_number, 
        $height, $weight, $bloodPressure, $temperature, $pulse, $respiration,
        $allergies, $medications, $conditions, $recentIllness, $hospitalizations,
        $vision, $hearing, $dental, $activity, $sleep, $diet, $mentalHealth,
        $notes, $general_note, $record_type, 
        $medecine_request, $medecine_used, $reasons, $nurse_incharge_name
    );

    if ($stmt->execute()) {

        // E. Notification Logic
        $parentQuery = $conn->prepare("SELECT parent_id FROM parent_link WHERE student_id = ?");
        $parentQuery->bind_param("i", $student_numeric_id);
        $parentQuery->execute();
        $parentResult = $parentQuery->get_result();

        while ($parent = $parentResult->fetch_assoc()) {
            $parent_id = $parent['parent_id'];

            $updateStmt = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
            $updateStmt->bind_param("i", $parent_id);
            $updateStmt->execute();
            $updateStmt->close();

            $message = "New $record_type record added for student number $student_number by $nurse_incharge_name.";
            $link = "view_medical_detail.php?medical_id=" . urlencode($medical_id) . "&student_id=" . urlencode($student_number);
            $created_at = date("Y-m-d H:i:s");

            $logStmt = $conn->prepare("INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)");
            $logStmt->bind_param("isss", $parent_id, $message, $link, $created_at);
            $logStmt->execute();
            $logStmt->close();
        }

        $parentQuery->close();

        // Redirect after success
        header("Location: view_student_medical.php?status=1&student_id=" . urlencode($student_number) . "&type=" . urlencode($record_type));
        exit;

    } else {
        echo "<script>alert('Error saving record: " . htmlspecialchars($stmt->error) . "'); window.history.back();</script>";
    }

    $stmt->close();
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<script>alert('Error: Missing student ID or record type in submission.'); window.history.back();</script>";
    }
}

$conn->close();
?>