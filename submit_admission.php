<?php
// submit_admission.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize helper
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
    $facebook = sanitize($_POST['facebook'] ?? '');
    $region = sanitize($_POST['Region'] ?? '');
    $province = sanitize($_POST['Province'] ?? '');
    $municipal = sanitize($_POST['Municipal'] ?? '');
    $barangay = sanitize($_POST['Barangay'] ?? '');

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

    // Optionally: Validate required fields, example:
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

    // --- Save to database or process data ---
    // Example only: Display collected data
    echo "<h2>Form Submitted Successfully!</h2>";
    echo "<h4>Learner Profile</h4>";
    echo "<ul>";
    echo "<li>Status: $status</li>";
    echo "<li>LRN: $lrn</li>";
    echo "<li>Grade Level: $grade_level</li>";
    echo "<li>Gender: $gender</li>";
    echo "<li>Name: $last_name, $first_name $middle_name</li>";
    echo "<li>Date of Birth: $birth_date</li>";
    echo "<li>Place of Birth: $birth_place</li>";
    echo "<li>Age: $age</li>";
    echo "<li>Religion: $religion</li>";
    echo "<li>Facebook: $facebook</li>";
    echo "<li>Address: $barangay, $municipal, $province, $region</li>";
    echo "</ul>";

    echo "<h4>Guardian Info</h4>";
    echo "<ul>";
    echo "<li>Father: $father_name ($father_occupation) - $father_contact</li>";
    echo "<li>Mother: $mother_name ($mother_occupation) - $mother_contact</li>";
    echo "<li>Guardian: $guardian_name ($guardian_occupation) - $guardian_contact</li>";
    echo "</ul>";

    // Example: You can now insert this into your DB using mysqli or PDO.
    // Optional: Redirect with success message
    // header("Location: success.php");
} else {
    echo "Invalid request method.";
}
?>
