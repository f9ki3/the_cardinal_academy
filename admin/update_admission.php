<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['admission_id']);

    // Prepare fields from form (ensure names match form inputs)
    $fields = [
        'lrn', 'firstname', 'middlename', 'lastname', 'status', 'gender', 'grade_level',
        'birthday', 'religion', 'place_of_birth', 'age', 'region', 'province', 'municipal', 'barangay',
        'facebook', 'email',
        'father_name', 'father_occupation', 'father_contact',
        'mother_name', 'mother_occupation', 'mother_contact',
        'guardian_name', 'guardian_occupation', 'guardian_contact'
    ];

    $data = [];
    foreach ($fields as $field) {
        $data[$field] = $_POST[$field] ?? null;
    }

    $stmt = $conn->prepare("
        UPDATE admission_form SET 
            lrn = ?, firstname = ?, middlename = ?, lastname = ?, status = ?, gender = ?, grade_level = ?,
            birthday = ?, religion = ?, place_of_birth = ?, age = ?, region = ?, province = ?, municipal = ?, barangay = ?,
            facebook = ?, email = ?,
            father_name = ?, father_occupation = ?, father_contact = ?,
            mother_name = ?, mother_occupation = ?, mother_contact = ?,
            guardian_name = ?, guardian_occupation = ?, guardian_contact = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        'ssssssssssisssssssssssssssi',
        $data['lrn'], $data['firstname'], $data['middlename'], $data['lastname'],
        $data['status'], $data['gender'], $data['grade_level'],
        $data['birthday'], $data['religion'], $data['place_of_birth'], $data['age'],
        $data['region'], $data['province'], $data['municipal'], $data['barangay'],
        $data['facebook'], $data['email'],
        $data['father_name'], $data['father_occupation'], $data['father_contact'],
        $data['mother_name'], $data['mother_occupation'], $data['mother_contact'],
        $data['guardian_name'], $data['guardian_occupation'], $data['guardian_contact'],
        $id
    );

    if ($stmt->execute()) {
        header("Location: view_enrollment.php?id=$id&status=success");
        exit;
    } else {
        echo "Update error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
