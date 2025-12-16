<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function sanitize($data) {
        return htmlspecialchars(trim($data));
    }

    // --- Collect form data ---
    $status = sanitize($_POST['status'] ?? '');
    $lrn = sanitize($_POST['lrn'] ?? '');
    $residential_address = sanitize($_POST['residential_address'] ?? '');
    $grade_level = sanitize($_POST['grade_level'] ?? '');
    $strand = sanitize($_POST['strand'] ?? '');
    $gender = sanitize($_POST['gender'] ?? '');
    $last_name = sanitize($_POST['last_name'] ?? '');
    $first_name = sanitize($_POST['first_name'] ?? '');
    $middle_name = sanitize($_POST['middle_name'] ?? '');
    $birth_date = sanitize($_POST['birth_date'] ?? '');
    $birth_place = sanitize($_POST['birth_place'] ?? '');
    $age = sanitize($_POST['age'] ?? '');
    $religion = sanitize($_POST['religion'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $region = sanitize($_POST['Region'] ?? '');
    $province = sanitize($_POST['Province'] ?? '');
    $municipal = sanitize($_POST['Municipal'] ?? '');
    $barangay = sanitize($_POST['Barangay'] ?? '');
    $profile_picture = '';
    $admission_status = 'pending';
    $que_code = 'Q' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

    $father_name = sanitize($_POST['father_name'] ?? '');
    $father_occupation = sanitize($_POST['father_occupation'] ?? '');
    $father_contact = sanitize($_POST['father_contact'] ?? '');
    $mother_name = sanitize($_POST['mother_name'] ?? '');
    $mother_occupation = sanitize($_POST['mother_occupation'] ?? '');
    $mother_contact = sanitize($_POST['mother_contact'] ?? '');
    $guardian_name = sanitize($_POST['guardian_name'] ?? '');
    $guardian_occupation = sanitize($_POST['guardian_occupation'] ?? '');
    $guardian_contact = sanitize($_POST['guardian_contact'] ?? '');

    // --- Validation ---
    $errors = [];
    if (empty($status)) $errors[] = "Status is required.";
    if (empty($grade_level)) $errors[] = "Grade level is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (empty($last_name)) $errors[] = "Last name is required.";
    if (empty($first_name)) $errors[] = "First name is required.";
    if (empty($birth_date)) $errors[] = "Date of birth is required.";
    if (!is_numeric($age) || (int)$age < 4) $errors[] = "Age must be at least 4.";

    if (!empty($errors)) {
        echo "<h3>Form submission failed with the following errors:</h3><ul>";
        foreach ($errors as $error) echo "<li>$error</li>";
        echo "</ul>";
        exit;
    }

    $residential_address = "$barangay, $municipal, $province, $region, $residential_address";

    // --- Prepare Admission Insert dynamically ---
    $columns = [
        "lrn", "firstname", "middlename", "lastname", "status", "gender", "grade_level", "profile_picture",
        "birthday", "religion", "place_of_birth", "age", "email", "phone", "residential_address",
        "region", "province", "municipal", "barangay",
        "father_name", "father_occupation", "father_contact",
        "mother_name", "mother_occupation", "mother_contact",
        "guardian_name", "guardian_occupation", "guardian_contact",
        "admission_status", "que_code"
    ];

    if (!empty($strand)) $columns[] = "strand";

    $placeholders = implode(", ", array_fill(0, count($columns), "?"));

    $params = [
        $lrn, $first_name, $middle_name, $last_name, $status, $gender, $grade_level, $profile_picture,
        $birth_date, $religion, $birth_place, $age, $email, $phone, $residential_address,
        $region, $province, $municipal, $barangay,
        $father_name, $father_occupation, $father_contact,
        $mother_name, $mother_occupation, $mother_contact,
        $guardian_name, $guardian_occupation, $guardian_contact,
        $admission_status, $que_code
    ];

    if (!empty($strand)) $params[] = $strand;

    $types = str_repeat('s', count($params));
    $columns_str = implode(", ", $columns);

    $stmt = $conn->prepare("INSERT INTO admission_form ($columns_str) VALUES ($placeholders)");
    if (!$stmt) die("SQL prepare() failed: " . $conn->error);

    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {

        // --- Notifications ---
        $link = ($status === 'New Student') ? 'admission.php' : 'admission_old.php';
        $full_name = trim("$first_name $middle_name $last_name");
        $message = "New admission: $full_name for grade $grade_level level";

        $roles = ['Administrator','Assistant Principal','Registrar'];
        $role_placeholders = implode(',', array_fill(0, count($roles), '?'));
        $types_roles = str_repeat('s', count($roles));

        $user_stmt = $conn->prepare("SELECT user_id FROM users WHERE role IN ($role_placeholders)");
        $user_stmt->bind_param($types_roles, ...$roles);
        $user_stmt->execute();
        $result = $user_stmt->get_result();

        while ($user = $result->fetch_assoc()) {
            $user_id = $user['user_id'];

            $notif_stmt = $conn->prepare("INSERT INTO notifications (id, user_id, message, link) VALUES (UUID(), ?, ?, ?)");
            $notif_stmt->bind_param('sss', $user_id, $message, $link);
            $notif_stmt->execute();
            $notif_stmt->close();

            $conn->query("UPDATE users SET notification = notification + 1 WHERE user_id = '$user_id'");
        }

        $user_stmt->close();
        header("Location: success.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    echo "Invalid request method.";
}
?>
