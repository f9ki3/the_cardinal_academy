<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // A simple function to sanitize input data
    function sanitize($data) {
        return htmlspecialchars(trim($data));
    }

    // Generate unique queue code: Q + 6-digit random number
    function generateQueueCode($conn) {
        do {
            $code = 'Q' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $check = $conn->prepare("SELECT id FROM admission_old WHERE que_code = ?");
            $check->bind_param("s", $code);
            $check->execute();
            $check->store_result();
        } while ($check->num_rows > 0);
        $check->close();
        return $code;
    }

    $que_code       = generateQueueCode($conn);
    $grade_level    = sanitize($_POST['grade_level'] ?? '');
    $strand         = sanitize($_POST['strand'] ?? ''); 
    $strand         = !empty($strand) ? $strand : "N/A"; // ✅ Default to N/A
    $gender         = sanitize($_POST['gender'] ?? '');
    $student_id     = sanitize($_POST['student_id'] ?? '');
    $last_name      = sanitize($_POST['last_name'] ?? '');
    $first_name     = sanitize($_POST['first_name'] ?? '');
    $middle_name    = sanitize($_POST['middle_name'] ?? '');
    $birth_date     = sanitize($_POST['birth_date'] ?? '');
    $birth_place    = sanitize($_POST['birth_place'] ?? '');
    $age            = sanitize($_POST['age'] ?? '');
    $religion       = sanitize($_POST['religion'] ?? '');
    $guardian_phone = sanitize($_POST['guardian_phone'] ?? '');
    $email          = sanitize($_POST['email'] ?? '');

    // Basic validation to check for required fields
    $errors = [];
    if (empty($grade_level))    $errors[] = "Grade level is required.";
    if (empty($gender))         $errors[] = "Gender is required.";
    if (empty($student_id))     $errors[] = "Student ID is required.";
    if (empty($last_name))      $errors[] = "Last name is required.";
    if (empty($first_name))     $errors[] = "First name is required.";
    if (empty($birth_date))     $errors[] = "Date of birth is required.";
    if (empty($birth_place))    $errors[] = "Place of birth is required.";
    if (empty($age))            $errors[] = "Age is required.";
    if (empty($religion))       $errors[] = "Religion is required.";
    if (empty($guardian_phone)) $errors[] = "Guardian phone is required.";
    if (empty($email))          $errors[] = "Email is required.";

    if (!empty($errors)) {
        echo "<h3>Form submission failed with the following errors:</h3><ul>";
        foreach ($errors as $error) echo "<li>$error</li>";
        echo "</ul>";
        exit;
    }

    // SQL query to insert data into the admission_old table
    $sql = "INSERT INTO admission_old (
        que_code,
        grade_level, 
        strand,
        gender, 
        student_id, 
        last_name, 
        first_name, 
        middle_name, 
        birth_date, 
        birth_place, 
        age, 
        religion, 
        guardian_phone, 
        email
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("SQL prepare() failed: " . $conn->error);
    }

    // 's' for strings, 'i' for integer (age)
    $stmt->bind_param(
        "ssssssssssisss",
        $que_code,
        $grade_level,
        $strand,
        $gender,
        $student_id,
        $last_name,
        $first_name,
        $middle_name,
        $birth_date,
        $birth_place,
        $age,
        $religion,
        $guardian_phone,
        $email
    );

    if ($stmt->execute()) {
        // ✅ Store que_code in session or pass to success page
        header("Location: success.php?que_code=" . urlencode($que_code));
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
