<?php
include 'session_login.php';
include '../db_connection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$conn) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed: " . mysqli_connect_error()], JSON_PRETTY_PRINT);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_POST['action'] ?? '') !== 'enroll') {
    http_response_code(400);
    echo json_encode(["error" => "Invalid request"], JSON_PRETTY_PRINT);
    exit;
}

// ----------------------
// Input
// ----------------------
$admission_id     = (int)($_POST['id'] ?? 0);
$payment_plan     = trim((string)($_POST['payment_plan'] ?? ''));
$enrolled_section = (int)($_POST['enrolled_section'] ?? 0);

// ✅ NEW: program_type (save to student_tuition.program_type)
$program_type     = trim((string)($_POST['program_type'] ?? ''));

$tuition_fee      = (float)($_POST['tuition_fee'] ?? 0);
$miscellaneous    = (float)($_POST['miscellaneous'] ?? 0);

$uniform_raw      = (string)($_POST['uniform'] ?? "0");
$uniform          = (float)preg_replace('/[^\d.]/', '', $uniform_raw);

$discount_type    = trim((string)($_POST['discount_type'] ?? '')); // percent|fixed|''(none)
$discount_value   = (float)($_POST['discount_value'] ?? 0);

$downpayment      = (float)($_POST['down'] ?? 0); // typed downpayment (NOT reg fee)

$uniform_cart     = (string)($_POST['uniform_cart'] ?? '[]');

// ✅ NEW: from hidden fields (computed in UI)
$payment_total_posted   = (float)($_POST['payment_total'] ?? 0);
$interest_amount        = (float)($_POST['interest_amount'] ?? 0);

// Basic validation
if ($admission_id <= 0 || $payment_plan === '' || $enrolled_section <= 0) {
    http_response_code(422);
    echo json_encode(["error" => "Invalid form data"], JSON_PRETTY_PRINT);
    exit;
}

// Optional: if you want to require program_type when discount is used
// if ($discount_type !== '' && $program_type === '') {
//     http_response_code(422);
//     echo json_encode(["error" => "Program type is required when discount is selected."], JSON_PRETTY_PRINT);
//     exit;
// }

// ----------------------
// Decode uniform cart safely
// ----------------------
$decoded_cart = json_decode($uniform_cart, true);
if (!is_array($decoded_cart)) $decoded_cart = [];
$cart_json = json_encode($decoded_cart, JSON_UNESCAPED_UNICODE);

// ----------------------
// ✅ DISCOUNT LOGIC (FOLLOW PREVIOUS):
// Discount base = tuition + misc + interest
// (Uniform is NOT part of discount base)
// Payment Total = base - discount
// ----------------------
$base = max(0, $tuition_fee + $miscellaneous + max(0, $interest_amount));

$discount = 0.00;
$dt = strtolower(trim($discount_type));

if ($dt === 'percent') {
    $dv = $discount_value;
    if ($dv < 0) $dv = 0;
    if ($dv > 100) $dv = 100;
    $discount = ($base * $dv) / 100.0;
} elseif ($dt === 'fixed') {
    $dv = $discount_value;
    if ($dv < 0) $dv = 0;
    $discount = min($dv, $base);
} else {
    $discount = 0.00;
}
$discount = max(0, min($discount, $base));

$payment_total_computed = max(0, $base - $discount);

// If posted payment_total is close (<= 0.50), accept it; otherwise trust computed
$payment_total = $payment_total_computed;
if ($payment_total_posted > 0 && abs($payment_total_posted - $payment_total_computed) <= 0.50) {
    $payment_total = $payment_total_posted;
}

// ----------------------
// Unique account number generator
// ----------------------
function generateUniqueAccountNumber(mysqli $conn): string {
    do {
        $account_number = str_pad((string)mt_rand(0, 99999999), 8, "0", STR_PAD_LEFT);
        $check = $conn->prepare("SELECT COUNT(*) FROM student_tuition WHERE account_number = ?");
        $check->bind_param("s", $account_number);
        $check->execute();
        $check->bind_result($count);
        $check->fetch();
        $check->close();
    } while ((int)$count > 0);

    return $account_number;
}

$account_number = generateUniqueAccountNumber($conn);

// ✅ Generate Student Number (Format: YYYY-XXXXX)
$year = date("Y");
$randomDigits = str_pad((string)mt_rand(0, 99999), 5, "0", STR_PAD_LEFT);
$student_number = $year . "-" . $randomDigits;

// ✅ Enrolled Date
$enrolled_date = date("Y-m-d H:i:s");

// ----------------------
// Check LRN + duplicate handling
// ----------------------
$sqlCheckLRN = "SELECT lrn FROM admission_form WHERE id = ?";
$stmt = $conn->prepare($sqlCheckLRN);
$stmt->bind_param("i", $admission_id);
$stmt->execute();
$res = $stmt->get_result();
$admission_data = $res ? $res->fetch_assoc() : null;
$stmt->close();

$lrn = $admission_data['lrn'] ?? null;

if ($lrn !== null && $lrn !== '' && $lrn !== "00000000000") {
    $sqlCheckDuplicate = "SELECT COUNT(*) AS count FROM student_information WHERE lrn = ?";
    $stmt = $conn->prepare($sqlCheckDuplicate);
    $stmt->bind_param("s", $lrn);
    $stmt->execute();
    $res = $stmt->get_result();
    $dup = $res ? $res->fetch_assoc() : null;
    $stmt->close();

    if ($dup && (int)$dup['count'] > 0) {
        http_response_code(409);
        echo json_encode(["error" => "Duplicate LRN: This LRN already exists in the system"], JSON_PRETTY_PRINT);
        exit;
    }
}

try {
    $conn->begin_transaction();

    // 1️⃣ Move admission_form -> student_information
    $is_zero_lrn = ($lrn === "00000000000");

    $sqlMove = $is_zero_lrn
        ? "INSERT IGNORE INTO student_information (
              student_number, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
              birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
              father_name, father_occupation, father_contact,
              mother_name, mother_occupation, mother_contact,
              guardian_name, guardian_occupation, guardian_contact,
              admission_status, que_code, phone, email, facebook, admission_date, strand,
              birth_cert, report_card, good_moral, id_pic, esc_cert
          )
          SELECT
              ?, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
              birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
              father_name, father_occupation, father_contact,
              mother_name, mother_occupation, mother_contact,
              guardian_name, guardian_occupation, guardian_contact,
              admission_status, que_code, phone, email, facebook, admission_date, strand,
              birth_cert, report_card, good_moral, id_pic, esc_cert
          FROM admission_form WHERE id = ?"
        : "INSERT INTO student_information (
              student_number, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
              birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
              father_name, father_occupation, father_contact,
              mother_name, mother_occupation, mother_contact,
              guardian_name, guardian_occupation, guardian_contact,
              admission_status, que_code, phone, email, facebook, admission_date, strand,
              birth_cert, report_card, good_moral, id_pic, esc_cert
          )
          SELECT
              ?, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
              birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
              father_name, father_occupation, father_contact,
              mother_name, mother_occupation, mother_contact,
              guardian_name, guardian_occupation, guardian_contact,
              admission_status, que_code, phone, email, facebook, admission_date, strand,
              birth_cert, report_card, good_moral, id_pic, esc_cert
          FROM admission_form WHERE id = ?";

    $stmt = $conn->prepare($sqlMove);
    $stmt->bind_param("si", $student_number, $admission_id);
    $stmt->execute();

    // If IGNORE inserted nothing (zero LRN case), reuse existing latest student_number for that LRN
    if ($is_zero_lrn && $stmt->affected_rows === 0) {
        $sqlGetExisting = "SELECT student_number FROM student_information WHERE lrn = ? ORDER BY student_number DESC LIMIT 1";
        $stmt2 = $conn->prepare($sqlGetExisting);
        $stmt2->bind_param("s", $lrn);
        $stmt2->execute();
        $res2 = $stmt2->get_result();
        if ($res2 && $res2->num_rows > 0) {
            $existing = $res2->fetch_assoc();
            $student_number = $existing['student_number'];
        }
        $stmt2->close();
    }
    $stmt->close();

    // 2️⃣ Delete admission_form record
    $sqlDelete = "DELETE FROM admission_form WHERE id = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $admission_id);
    $stmt->execute();
    $stmt->close();

    // 3️⃣ Insert student_tuition
    // ✅ Added: program_type
    $sqlTuition = "INSERT INTO student_tuition (
          account_number, student_number, payment_plan, enrolled_section,
          program_type,
          registration_fee, tuition_fee, miscellaneous, uniform, uniform_cart,
          discount_type, discount_value, discount_amount, downpayment,
          payment_total, interest,
          enrolled_date
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $reg_fee = 2500.00;

    $stmt = $conn->prepare($sqlTuition);

    // 17 params
    // s s s i s d d d d s s d d d d d s
    $stmt->bind_param(
        "sssisddddssddddds",
        $account_number,
        $student_number,
        $payment_plan,
        $enrolled_section,
        $program_type,
        $reg_fee,
        $tuition_fee,
        $miscellaneous,
        $uniform,
        $cart_json,
        $discount_type,
        $discount_value,
        $discount,
        $downpayment,
        $payment_total,
        $interest_amount,
        $enrolled_date
    );

    $stmt->execute();
    $tuition_id_new = $stmt->insert_id;
    $stmt->close();

    // 4️⃣ Update sections.enrolled (+1)
    $sqlUpdateSection = "UPDATE sections SET enrolled = enrolled + 1 WHERE section_id = ?";
    $stmt = $conn->prepare($sqlUpdateSection);
    $stmt->bind_param("i", $enrolled_section);
    $stmt->execute();
    $stmt->close();

    $conn->commit();

    header("Location: generate_cor.php?tuition_id=" . (int)$tuition_id_new);
    exit;

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(["error" => "Transaction failed: " . $e->getMessage()], JSON_PRETTY_PRINT);
    exit;
}
