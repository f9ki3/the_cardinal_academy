<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: view_enrollment.php?status=error');
    exit;
}

/* ---------- 1. Validate the primary key ---------- */
if (!isset($_POST['admission_id']) || !ctype_digit($_POST['admission_id'])) {
    header('Location: view_enrollment.php?status=error');
    exit;
}
$id = (int)$_POST['admission_id'];

/* ---------- 2. Collect all form fields ---------- */
$fields = [
    // learner
    'lrn','firstname','middlename','lastname','status','gender','grade_level','strand',
    'birthday','religion','place_of_birth','age',
    // address
    'region','province','municipal','barangay','residential_address',
    // contact
    'phone','email',
    // guardians
    'father_name','father_occupation','father_contact',
    'mother_name','mother_occupation','mother_contact',
    'guardian_name','guardian_occupation','guardian_contact'
];

$data = [];
foreach ($fields as $f) {
    if ($f === 'age') {
        $data[$f] = ($_POST[$f] ?? '') === '' ? null : (int)$_POST[$f];
    } else {
        $data[$f] = isset($_POST[$f]) && $_POST[$f] !== '' ? trim($_POST[$f]) : null;
    }
}

/* ---------- 3. Collect checkbox values (0 or 1) ---------- */
$req = $_POST['requirements'] ?? [];

$birth_cert  = in_array('birth_cert', $req) ? 1 : 0;
$report_card = in_array('report_card', $req) ? 1 : 0;
$good_moral  = in_array('good_moral', $req) ? 1 : 0;
$id_pic      = in_array('id_pic', $req) ? 1 : 0;
$esc_cert    = in_array('esc_cert', $req) ? 1 : 0;

/* ---------- 4. Build and prepare the UPDATE ---------- */
$sql = "
UPDATE admission_form SET
    lrn = ?, firstname = ?, middlename = ?, lastname = ?,
    status = ?, gender = ?, grade_level = ?, strand = ?,
    birthday = ?, religion = ?, place_of_birth = ?, age = ?,
    region = ?, province = ?, municipal = ?, barangay = ?,
    residential_address = ?, phone = ?, email = ?,
    father_name = ?, father_occupation = ?, father_contact = ?,
    mother_name = ?, mother_occupation = ?, mother_contact = ?,
    guardian_name = ?, guardian_occupation = ?, guardian_contact = ?,
    birth_cert = ?, report_card = ?, good_moral = ?, id_pic = ?, esc_cert = ?
WHERE id = ?
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

/*
 * Total parameters: 29 original + 5 checkboxes + 1 id = 35
 * Types: 11 strings + 1 int (age) + 16 strings + 5 ints (checkboxes) + 1 int (id)
 */
$typeString = 'sssssssssss'  // 11 × s
            . 'i'            // 1 × i (age)
            . 'ssssssssssssssss' // 16 × s
            . 'iiiii'         // 5 × i (checkboxes)
            . 'i';            // 1 × i (id)

$stmt->bind_param(
    $typeString,
    // learner
    $data['lrn'], $data['firstname'], $data['middlename'], $data['lastname'],
    $data['status'], $data['gender'], $data['grade_level'], $data['strand'],
    $data['birthday'], $data['religion'], $data['place_of_birth'], $data['age'],
    // address
    $data['region'], $data['province'], $data['municipal'], $data['barangay'],
    $data['residential_address'],
    // contact
    $data['phone'], $data['email'],
    // guardians
    $data['father_name'], $data['father_occupation'], $data['father_contact'],
    $data['mother_name'], $data['mother_occupation'], $data['mother_contact'],
    $data['guardian_name'], $data['guardian_occupation'], $data['guardian_contact'],
    // requirements
    $birth_cert, $report_card, $good_moral, $id_pic, $esc_cert,
    // where
    $id
);

/* ---------- 5. Execute and redirect ---------- */
if ($stmt->execute()) {
    header("Location: view_enrollment.php?id=$id&status=success");
} else {
    header("Location: view_enrollment.php?id=$id&status=error");
}
exit;
?>
