<?php
include '../db_connection.php';
include 'session_login.php';

$student_number = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($student_number)) {

    // 1️⃣ Get numeric student_id from users table using student_number
    $stmtStudent = $conn->prepare("SELECT user_id AS student_id FROM users WHERE student_number = ?");
    $stmtStudent->bind_param("s", $student_number);
    $stmtStudent->execute();
    $resultStudent = $stmtStudent->get_result();
    $studentRow = $resultStudent->fetch_assoc();
    $stmtStudent->close();

    if (!$studentRow) {
        die("No student found with student number: $student_number");
    }

    $student_id = $studentRow['student_id']; // numeric ID for parent_link

    // 2️⃣ Generate medical ID
    $medical_id = generateMedicalID($conn);

    // 3️⃣ Retrieve and sanitize POST values
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

    // 4️⃣ Insert student health record
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

    $stmt->bind_param(
        "ssddsdii" . str_repeat("s", 7) . "ii" . str_repeat("s", 5),
        $medical_id, $student_number, $height, $weight, $bloodPressure, $temperature, $pulse, $respiration,
        $allergies, $medications, $conditions, $recentIllness, $hospitalizations, $vision, $hearing, $dental,
        $activity, $sleep, $diet, $mentalHealth, $notes, $generalNote
    );

    if ($stmt->execute()) {

        // 5️⃣ Get parent_id(s) related to this student
        $parentQuery = $conn->prepare("SELECT parent_id FROM parent_link WHERE student_id = ?");
        $parentQuery->bind_param("i", $student_id);
        $parentQuery->execute();
        $parentResult = $parentQuery->get_result();

        while ($parent = $parentResult->fetch_assoc()) {
            $parent_id = $parent['parent_id'];

            // ✅ Update notification count for each parent
            $updateStmt = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
            $updateStmt->bind_param("i", $parent_id);
            $updateStmt->execute();
            $updateStmt->close();

            // ✅ Insert a log into notifications table
            $message = "New health record added for student number $student_number";
            $link = "view_medical_detail.php?medical_id=" . urlencode($medical_id) . "&student_id=" . urlencode($student_number);
            $created_at = date("Y-m-d H:i:s");

            $logStmt = $conn->prepare("INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)");
            $logStmt->bind_param("isss", $parent_id, $message, $link, $created_at);
            $logStmt->execute();
            $logStmt->close();

        }

        $parentQuery->close();

        // Redirect after success
        header("Location: view_student_medical.php?status=1&student_id=" . urlencode($student_number));
        exit;

    } else {
        echo "<script>alert('Error saving record: " . htmlspecialchars($stmt->error) . "');</script>";
    }

    $stmt->close();
}
?>
