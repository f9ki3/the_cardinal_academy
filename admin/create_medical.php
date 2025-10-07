<?php
include '../db_connection.php';
include 'session_login.php';

$student_id = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';

function generateMedicalID($conn) {
    $query = "SELECT medical_id FROM student_health_records ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);
    if ($result && $row = $result->fetch_assoc()) {
        $lastId = intval(substr($row['medical_id'], 4)); // remove "MED-"
        $newId = $lastId + 1;
    } else {
        $newId = 1;
    }
    return sprintf("MED-%04d", $newId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medical_id = generateMedicalID($conn);

    // Retrieve and sanitize POST values
    $height = floatval($_POST['height'] ?? 0);
    $weight = floatval($_POST['weight'] ?? 0);
    $bloodPressure = $_POST['blood_pressure'] ?? '';
    $temperature = floatval($_POST['temperature'] ?? 0);
    $pulse = intval($_POST['pulse'] ?? 0);
    $respiration = intval($_POST['respiration'] ?? 0);
    $allergies = $_POST['allergies'] ?? '';
    $medications = $_POST['medications'] ?? '';
    $conditions = $_POST['conditions'] ?? '';
    $recentIllness = $_POST['recentIllness'] ?? '';
    $hospitalizations = $_POST['hospitalizations'] ?? '';
    $vision = $_POST['vision'] ?? '';
    $hearing = $_POST['hearing'] ?? '';
    $dental = $_POST['dental'] ?? '';
    $activity = intval($_POST['activity'] ?? 0);
    $sleep = intval($_POST['sleep'] ?? 0);
    $diet = $_POST['diet'] ?? '';
    $mentalHealth = $_POST['mentalHealth'] ?? '';
    $notes = $_POST['notes'] ?? '';
    $generalNote = $_POST['generalNote'] ?? '';

    $stmt = $conn->prepare("
        INSERT INTO student_health_records (
            medical_id, student_id, height, weight, blood_pressure, temperature, pulse, respiration,
            allergies, medications, conditions, recent_illness, hospitalizations,
            vision, hearing, dental, activity, sleep, diet, mental_health, notes, general_note
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // ✅ Correct binding types (22 total)
    $stmt->bind_param(
        "ssddsdii" . str_repeat("s", 7) . "ii" . str_repeat("s", 5),
        $medical_id, $student_id, $height, $weight, $bloodPressure, $temperature, $pulse, $respiration,
        $allergies, $medications, $conditions, $recentIllness, $hospitalizations, $vision, $hearing, $dental,
        $activity, $sleep, $diet, $mentalHealth, $notes, $generalNote
    );

    if ($stmt->execute()) {
        header("Location: view_student_medical.php?status=1&student_id=" . urlencode($student_id));
        exit;

    } else {
        echo "<script>alert('Error saving record: " . htmlspecialchars($stmt->error) . "');</script>";
    }

    $stmt->close();
}
?>
