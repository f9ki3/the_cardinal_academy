<?php
include '../db_connection.php';
include 'session_login.php';

// --- 1. Define Variables and Constants ---
$student_number = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';
$record_type    = isset($_POST['record_type']) ? trim($_POST['record_type']) : '';
$general_note   = $_POST['additional_notes'] ?? ''; // maps to general_note

// ✅ sent_home should be stored as ONLY "yes" or "no"
$sent_home = isset($_POST['sent_home']) ? strtolower(trim($_POST['sent_home'])) : 'no';
$sent_home = ($sent_home === 'yes') ? 'yes' : 'no'; // sanitize (anything else becomes "no")

// Nurse in-charge (input might be disabled)
$nurse_incharge_name = isset($_POST['nurse_incharge']) ? trim($_POST['nurse_incharge']) : '';
if ($nurse_incharge_name === '' && isset($full_name)) {
    $nurse_incharge_name = $full_name;
}

// --- 2. ID Generation Function ---
function generateMedicalID($conn) {
    // If the form supplied a unique ID like med_xxx, use it
    if (isset($_POST['medical_id']) && strpos($_POST['medical_id'], 'med_') === 0) {
        return $_POST['medical_id'];
    }

    $query  = "SELECT medical_id FROM student_health_records WHERE medical_id LIKE 'MED-%' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);
    $maxId  = 0;

    if ($result && $row = $result->fetch_assoc()) {
        $currentId = intval(substr($row['medical_id'], 4));
        $maxId = max($maxId, $currentId);
    }

    return sprintf("MED-%04d", $maxId + 1);
}

$medical_id = generateMedicalID($conn);

// --- 3. Main Submission Logic ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $student_number !== '' && $record_type !== '') {

    // A. Get numeric user_id for notifications / parent_link
    $stmtStudent = $conn->prepare("SELECT user_id AS student_id FROM users WHERE student_number = ?");
    if (!$stmtStudent) {
        die("Prepare failed (student): " . htmlspecialchars($conn->error));
    }

    $stmtStudent->bind_param("s", $student_number);
    $stmtStudent->execute();
    $resultStudent = $stmtStudent->get_result();
    $studentRow = $resultStudent->fetch_assoc();
    $stmtStudent->close();

    if (!$studentRow) {
        die("No student found with student number: " . htmlspecialchars($student_number));
    }

    $student_numeric_id = (int)$studentRow['student_id'];

    // B. Initialize fields (match your table schema)
    $height = NULL; $weight = NULL; $bloodPressure = NULL; $temperature = NULL;
    $pulse = NULL; $respiration = NULL; $activity = NULL; $sleep = NULL;

    $allergies = ''; $medications = ''; $conditions = ''; $recentIllness = '';
    $hospitalizations = ''; $vision = ''; $hearing = ''; $dental = '';
    $diet = ''; $mentalHealth = '';

    $notes = '';
    $medecine_request = '';
    $medecine_used = '';
    $medecine_qty = '';
    $reasons = '';

    // C. Populate by record type
    if ($record_type === 'Check Up') {

        $height = floatval($_POST['height'] ?? 0) ?: NULL;
        $weight = floatval($_POST['weight'] ?? 0) ?: NULL;

        $bp = trim($_POST['blood_pressure'] ?? '');
        $bloodPressure = ($bp !== '') ? $bp : NULL;

        $temperature = floatval($_POST['temperature'] ?? 0) ?: NULL;
        $pulse = intval($_POST['pulse'] ?? 0) ?: NULL;
        $respiration = intval($_POST['respiration'] ?? 0) ?: NULL;
        $activity = intval($_POST['activity'] ?? 0) ?: NULL;
        $sleep = intval($_POST['sleep'] ?? 0) ?: NULL;

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
        $medecine_used    = $_POST['medicine_used'] ?? '';
        $medecine_qty     = isset($_POST['medicine_qty']) ? trim($_POST['medicine_qty']) : '';

    } elseif ($record_type === 'Clinic Visit') {

        $reasons = $_POST['reason_for_visit'] ?? '';
    }

    // D. Insert including medecine_qty + sent_home ("yes"/"no")
    $sql = "
        INSERT INTO student_health_records (
            medical_id, student_id, height, weight, blood_pressure, temperature, pulse, respiration,
            allergies, medications, conditions, recent_illness, hospitalizations,
            vision, hearing, dental, activity, sleep, diet, mental_health,
            notes, general_note, types, medecine_request, medecine_used, medecine_qty, reasons, sent_home, nurse
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?, ?
        )
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('Prepare failed (insert): ' . htmlspecialchars($conn->error));
    }

    /*
      ✅ Correct bind types (29 total) with sent_home as STRING now:
      medical_id(s) student_id(s)
      height(d) weight(d) blood_pressure(s) temperature(d) pulse(i) respiration(i)
      allergies(s) medications(s) conditions(s) recent_illness(s) hospitalizations(s)
      vision(s) hearing(s) dental(s)
      activity(i) sleep(i) diet(s) mental_health(s)
      notes(s) general_note(s) types(s)
      medecine_request(s) medecine_used(s) medecine_qty(s) reasons(s)
      sent_home(s) nurse(s)
    */
    $types = "ss"       // 1-2
           . "ddsdii"   // 3-8
           . "sssss"    // 9-13
           . "sss"      // 14-16
           . "iiss"     // 17-20
           . "sss"      // 21-23
           . "ssss"     // 24-27 (request, used, qty, reasons)
           . "ss";      // 28-29 (sent_home, nurse)

    $stmt->bind_param(
        $types,
        $medical_id, $student_number,
        $height, $weight, $bloodPressure, $temperature, $pulse, $respiration,
        $allergies, $medications, $conditions, $recentIllness, $hospitalizations,
        $vision, $hearing, $dental,
        $activity, $sleep, $diet, $mentalHealth,
        $notes, $general_note, $record_type,
        $medecine_request, $medecine_used, $medecine_qty, $reasons,
        $sent_home, $nurse_incharge_name
    );

    if ($stmt->execute()) {

        // E. Notify parents
        $parentQuery = $conn->prepare("SELECT parent_id FROM parent_link WHERE student_id = ?");
        if ($parentQuery) {
            $parentQuery->bind_param("i", $student_numeric_id);
            $parentQuery->execute();
            $parentResult = $parentQuery->get_result();

            while ($parent = $parentResult->fetch_assoc()) {
                $parent_id = (int)$parent['parent_id'];

                $updateStmt = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
                if ($updateStmt) {
                    $updateStmt->bind_param("i", $parent_id);
                    $updateStmt->execute();
                    $updateStmt->close();
                }

                $sentHomeText = ($sent_home === 'yes') ? " (Sent Home)" : "";
                $message = "New $record_type record$sentHomeText added for student number $student_number by $nurse_incharge_name.";
                $link = "view_medical_detail.php?medical_id=" . urlencode($medical_id) . "&student_id=" . urlencode($student_number);
                $created_at = date("Y-m-d H:i:s");

                $logStmt = $conn->prepare("INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)");
                if ($logStmt) {
                    $logStmt->bind_param("isss", $parent_id, $message, $link, $created_at);
                    $logStmt->execute();
                    $logStmt->close();
                }
            }

            $parentQuery->close();
        }

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
