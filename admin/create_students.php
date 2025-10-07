<?php
include 'session_login.php';
include '../db_connection.php';

// Retrieve tuition_id from URL and validate
$tuition_id = isset($_GET['tuition_id']) ? intval($_GET['tuition_id']) : 0;
if ($tuition_id <= 0) {
    echo "Invalid tuition ID.";
    exit;
}

// Fetch tuition and student info
$sql = "
SELECT st.id AS tuition_id, st.student_number, si.firstname, si.middlename, si.lastname, si.gender, si.email, si.birthday, si.residential_address, si.phone
FROM student_tuition st
INNER JOIN student_information si ON st.student_number = si.student_number
WHERE st.id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tuition_id);
$stmt->execute();
$result = $stmt->get_result();

$student = $result->fetch_assoc() ?? [];
$stmt->close();

// Check if account already exists
$account_sql = "SELECT user_id, rfid FROM users WHERE student_number = ?";
$acc_stmt = $conn->prepare($account_sql);
$acc_stmt->bind_param("s", $student['student_number']);
$acc_stmt->execute();
$account_result = $acc_stmt->get_result();
$account = $account_result->fetch_assoc() ?? [];
$acc_stmt->close();

// Prepare data for form
$data = [
    "user_id"    => $account['user_id'] ?? '',
    "student_id" => $student['student_number'] ?? '',
    "email"      => $student['email'] ?? '',
    "first_name" => $student['firstname'] ?? '',
    "last_name"  => $student['lastname'] ?? '',
    "rfid"       => $account['rfid'] ?? '', // empty if no account yet
    "gender"     => $student['gender'] ?? '',
    "birthdate"  => $student['birthday'] ?? '',
    "phone"  => $student['phone'] ?? '',
    "address"    => $student['residential_address'] ?? '',
];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container py-4">
      <form action="create_student_account.php" method="POST" enctype="multipart/form-data">
        <div class="bg-white p-4 rounded-4">
          <h2 class="fw-bold mb-2">Create Student Account</h2>
          <p class="text-muted mb-4">Please fill out all the required fields before submitting the form.</p>
          <hr>

          <div class="row g-3">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($data['user_id'] ?? '') ?>">

            <!-- Account Type -->
            <div class="col-md-3">
              <label for="acc_type" class="form-label">Account Type</label>
              <select disabled name="acc_type" id="acc_type" class="form-select" required>
                <option value="admin" <?= ($data['acc_type'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="teacher" <?= ($data['acc_type'] ?? '') === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                <option value="parent" <?= ($data['acc_type'] ?? '') === 'parent' ? 'selected' : '' ?>>Parent</option>
                <option selected value="student" <?= ($data['acc_type'] ?? '') === 'student' ? 'selected' : '' ?>>Student</option>
              </select>
            </div>

            <div class="col-md-3">
              <label for="student_number" class="form-label">Student Number</label>
              <input 
                type="text" 
                name="student_number" 
                id="student_number" 
                class="form-control" 
                placeholder="Enter student number"
                value="<?= htmlspecialchars($data['student_id'] ?? '') ?>" 
                required
              >
            </div>

            <!-- Email -->
            <div class="col-md-3">
              <label for="email" class="form-label">Email</label>
              <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control" 
                placeholder="Enter student email address"
                value="<?= htmlspecialchars($data['email'] ?? '') ?>" 
                required
              >
            </div>


            <!-- RFID -->
            <div class="col-md-3">
              <label for="rfid" class="form-label">RFID</label>
              <input 
                type="text" 
                name="rfid" 
                id="rfid" 
                class="form-control" 
                placeholder="Enter RFID code"
                value="<?= htmlspecialchars($data['rfid'] ?? '') ?>" 
                required
              >
            </div>

            <!-- First Name -->
            <div class="col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input 
                type="text" 
                name="first_name" 
                id="first_name" 
                class="form-control" 
                placeholder="Enter first name"
                value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" 
                required
              >
            </div>

            <!-- Last Name -->
            <div class="col-md-6">
              <label for="last_name" class="form-label">Last Name</label>
              <input 
                type="text" 
                name="last_name" 
                id="last_name" 
                class="form-control" 
                placeholder="Enter last name"
                value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" 
                required
              >
            </div>

            <!-- Gender -->
            <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" id="gender" class="form-select">
                <option value="">Select gender...</option>
                <option value="male" <?= ($data['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= ($data['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
                <option value="other" <?= ($data['gender'] ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
              </select>
            </div>

            <!-- Birthdate -->
            <div class="col-md-6">
              <label for="birthdate" class="form-label">Birthdate</label>
              <input 
                type="date" 
                name="birthdate" 
                id="birthdate" 
                class="form-control" 
                value="<?= htmlspecialchars($data['birthdate'] ?? '') ?>"
              >
            </div>

            <!-- Phone Number -->
            <div class="col-md-6">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input 
                type="text" 
                name="phone_number" 
                id="phone_number" 
                class="form-control" 
                placeholder="Enter phone number"
                value="<?= htmlspecialchars($data['phone'] ?? '') ?>"
              >
            </div>

            <!-- Profile Picture -->
            <div class="col-md-6">
              <label for="profile" class="form-label">Profile Picture</label>
              <input 
                type="file" 
                name="profile" 
                id="profile" 
                class="form-control" 
                accept="image/*"
              >
            </div>

            <!-- Address -->
            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <textarea 
                name="address" 
                id="address" 
                class="form-control" 
                rows="3"
                placeholder="Enter complete address"
              ><?= htmlspecialchars($data['address'] ?? '') ?></textarea>
            </div>

            <!-- Submit -->
            <div class="col-12 text-start pt-3">
              <button type="submit" class="btn bg-main text-light px-4 rounded-3">
                <i class="bi bi-person-plus"></i> Create Account
              </button>
              <a href="students.php" class="btn btn-outline-secondary ms-2 px-4 rounded-3">
                <i class="bi bi-arrow-left"></i> Back
              </a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
