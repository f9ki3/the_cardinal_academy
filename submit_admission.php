<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Helper function
    function sanitize($data) {
        return htmlspecialchars(trim($data));
    }

    // Step 1: Learner Profile
    $status = sanitize($_POST['status'] ?? '');
    $lrn = sanitize($_POST['lrn'] ?? '');
    $grade_level = sanitize($_POST['grade_level'] ?? '');
    $gender = sanitize($_POST['gender'] ?? '');
    $last_name = sanitize($_POST['last_name'] ?? '');
    $first_name = sanitize($_POST['first_name'] ?? '');
    $middle_name = sanitize($_POST['middle_name'] ?? '');
    $birth_date = sanitize($_POST['birth_date'] ?? '');
    $birth_place = sanitize($_POST['birth_place'] ?? '');
    $age = sanitize($_POST['age'] ?? '');
    $religion = sanitize($_POST['religion'] ?? '');
    $region = sanitize($_POST['Region'] ?? '');
    $province = sanitize($_POST['Province'] ?? '');
    $municipal = sanitize($_POST['Municipal'] ?? '');
    $barangay = sanitize($_POST['Barangay'] ?? '');
    $facebook = sanitize($_POST['facebook'] ?? '');
    $profile_picture = ''; // Set your logic here if uploading image
    $admission_status = 'Pending'; // default value
    $que = uniqid('Q'); // unique que ID
    $que_code = uniqid('CODE'); // unique que code

    // Step 2: Guardian Info
    $father_name = sanitize($_POST['father_name'] ?? '');
    $father_occupation = sanitize($_POST['father_occupation'] ?? '');
    $father_contact = sanitize($_POST['father_contact'] ?? '');
    $mother_name = sanitize($_POST['mother_name'] ?? '');
    $mother_occupation = sanitize($_POST['mother_occupation'] ?? '');
    $mother_contact = sanitize($_POST['mother_contact'] ?? '');
    $guardian_name = sanitize($_POST['guardian_name'] ?? '');
    $guardian_occupation = sanitize($_POST['guardian_occupation'] ?? '');
    $guardian_contact = sanitize($_POST['guardian_contact'] ?? '');

    // Validate
    $errors = [];
    if (empty($status)) $errors[] = "Status is required.";
    if (empty($grade_level)) $errors[] = "Grade level is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (empty($last_name)) $errors[] = "Last name is required.";
    if (empty($first_name)) $errors[] = "First name is required.";
    if (empty($birth_date)) $errors[] = "Date of birth is required.";
    if ((int)$age < 4) $errors[] = "Age must be at least 4.";

    if (!empty($errors)) {
        echo "<h3>Form submission failed with the following errors:</h3><ul>";
        foreach ($errors as $error) echo "<li>$error</li>";
        echo "</ul>";
        exit;
    }


    $stmt = $conn->prepare("INSERT INTO admission_form (
        que, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
        birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
        father_name, father_occupation, father_contact, mother_name, mother_occupation, mother_contact,
        guardian_name, guardian_occupation, guardian_contact, admission_status, que_code
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $residential_address = "$barangay, $municipal, $province, $region";

    $stmt->bind_param("sssssssssssssssssssssssssssss",
        $que, $lrn, $first_name, $middle_name, $last_name, $status, $gender, $grade_level, $profile_picture,
        $birth_date, $religion, $birth_place, $age, $residential_address, $region, $province, $municipal, $barangay,
        $father_name, $father_occupation, $father_contact, $mother_name, $mother_occupation, $mother_contact,
        $guardian_name, $guardian_occupation, $guardian_contact, $admission_status, $que_code
    );

    if ($stmt->execute()) {
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
