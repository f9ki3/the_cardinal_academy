<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
// Get user ID from URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch user data from DB
$data = [];
if ($user_id > 0 && $conn) {
    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
    } else {
        die("❌ Database error: " . $conn->error);
    }
} else if (!$conn) {
    die("❌ DB connection error.");
}
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
      <form action="update_student.php" method="POST" enctype="multipart/form-data">
        <div class="bg-white p-4 rounded-4 shadow-sm">
          <h2>View Student Account</h2>
          <p class="m-0 mb-4">Note: Please review all information from the form.</p>
          <hr>

          <?php
                    // Check if 'status' parameter exists in the URL
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];

                        // Display Bootstrap alert based on the status
                        if ($status === 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ✅ Updated student account successfully!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } elseif ($status === 'error') {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ❌ Something went wrong. Please try again.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } elseif ($status === 'password_changed') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ⚠️ Passsword Changed!.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                    }
                    ?>

          <h4><strong>Account Information</strong></h4>
          <div class="row g-3">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($data['user_id'] ?? '') ?>">

            <div class="col-md-6">
              <label for="acc_type" class="form-label">Account Type</label>
              <select disabled name="acc_type" id="acc_type" class="form-control" required>
                <option value="">Select...</option>
                <option value="admin" <?= ($data['acc_type'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="teacher" <?= ($data['acc_type'] ?? '') === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                <option value="parent" <?= ($data['acc_type'] ?? '') === 'parent' ? 'selected' : '' ?>>Parent</option>
                <option value="student" <?= ($data['acc_type'] ?? '') === 'student' ? 'selected' : '' ?>>Student</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="username" class="form-label">Username</label>
              <input disabled type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($data['username'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" name="first_name" id="first_name" class="form-control" value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" name="last_name" id="last_name" class="form-control" value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" id="gender" class="form-control">
                <option value="">Select...</option>
                <option value="male" <?= ($data['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= ($data['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
                <option value="other" <?= ($data['gender'] ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="birthdate" class="form-label">Birthdate</label>
              <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?= htmlspecialchars($data['birthdate'] ?? '') ?>">
            </div>

            <div class="col-md-6">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?= htmlspecialchars($data['phone_number'] ?? '') ?>">
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <textarea name="address" id="address" class="form-control" rows="3"><?= htmlspecialchars($data['address'] ?? '') ?></textarea>
            </div>

            <div class="col-md-6">
              <label for="profile" class="form-label">Profile Picture</label>
              <input type="file" name="profile" id="profile" class="form-control">
            </div>

            <div class="col-md-6">
              <label for="rfid" class="form-label">RFID</label>
              <input type="number" name="rfid" id="rfid" class="form-control" value="<?= htmlspecialchars($data['rfid'] ?? '') ?>">
            </div>

            <div class="col-12 text-start pt-2">
              <button type="submit" class="btn bg-main text-light">Save User</button>
              <a href="students.php?nav_drop=true" class="btn btn-secondary ms-2">Back</a>
              <a href="change_password.php?id=<?= urlencode($data['user_id']) ?>&nav_drop=true" class="btn btn-secondary ms-2">Change Password</a>
              <!-- <a href="#" class="btn btn-secondary ms-2">Student Information</a> -->
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
