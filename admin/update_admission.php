<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: view_enrollment.php?status=error');  // direct hits not allowed
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
    if ($f === 'age') {                       // numeric field
        $data[$f] = ($_POST[$f] ?? '') === '' ? null : (int)$_POST[$f];
    } else {
        $data[$f] = isset($_POST[$f]) && $_POST[$f] !== '' ? trim($_POST[$f]) : null;
    }
}

/* ---------- 3. Build and prepare the UPDATE ---------- */
$sql = "
UPDATE admission_form SET
    lrn                 = ?, firstname           = ?, middlename          = ?, lastname            = ?,
    status              = ?, gender              = ?, grade_level         = ?, strand              = ?,
    birthday            = ?, religion            = ?, place_of_birth      = ?, age                 = ?,
    region              = ?, province            = ?, municipal           = ?, barangay            = ?,
    residential_address = ?, phone               = ?, email              = ?,
    father_name         = ?, father_occupation   = ?, father_contact      = ?,
    mother_name         = ?, mother_occupation   = ?, mother_contact      = ?,
    guardian_name       = ?, guardian_occupation = ?, guardian_contact    = ?
WHERE id = ?
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

/*
 * 29 parameters in total:
 *   • 11 strings before age
 *   • 1 integer  (age)
 *   • 16 strings
 *   • 1 integer  (id)
 */
$typeString = 'sssssssssss'  // 11 × s
            . 'i'            // age
            . 'ssssssssssssssss' // 16 × s
            . 'i';           // id (PK)

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
    // where
    $id
);

/* ---------- 4. Execute and redirect ---------- */
if ($stmt->execute()) {
    header("Location: view_enrollment.php?id=$id&status=success");
} else {
    header("Location: view_enrollment.php?id=$id&status=error");
}
exit;
?>
