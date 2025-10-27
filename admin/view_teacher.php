<?php 
include 'session_login.php'; 
include '../db_connection.php';

// Fetch subjects
$subjects_result = $conn->query("SELECT id, subject_code, description FROM subjects");

// Get user ID
$user_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch user data
$data = [];
if ($user_id > 0 && $conn) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
    } else {
        die("❌ Database error: " . $conn->error);
    }
} elseif (!$conn) {
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
      <form action="update_teacher.php" method="POST" enctype="multipart/form-data">
        <div class="bg-white p-4 rounded-4">
          <h2>View Teacher Account</h2>
          <p class="mb-4">Note: Please review all information from the form.</p>
          <hr>

          <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] === 'success'): ?>
              <div class="alert alert-success alert-dismissible fade show">✅ Updated teacher account successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php elseif ($_GET['status'] === 'error'): ?>
              <div class="alert alert-danger alert-dismissible fade show">❌ Something went wrong. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php elseif ($_GET['status'] === 'password_changed'): ?>
              <div class="alert alert-success alert-dismissible fade show">⚠️ Password changed!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <h4><strong>Account Information</strong></h4>
          <div class="row g-3">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($data['user_id'] ?? '') ?>">

            <!-- Account Type -->
            <div class="col-md-6">
              <label for="acc_type" class="form-label">Account Type</label>
              <select disabled name="acc_type" id="acc_type" class="form-control" required>
                <option value="">Select...</option>
                <?php foreach (['admin', 'teacher', 'parent', 'student'] as $type): ?>
                  <option value="<?= $type ?>" <?= ($data['acc_type'] ?? '') === $type ? 'selected' : '' ?>>
                    <?= ucfirst($type) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Subject Dropdown -->
            <div class="col-md-6">
              <label for="subject" class="form-label">Subject</label>
              <select name="subject" id="subject" class="form-select" required>
                <?php
                mysqli_data_seek($subjects_result, 0);
                $selectedSubject = $data['subject'] ?? '';
                while ($subject = mysqli_fetch_assoc($subjects_result)):
                  $value = $subject['description'];
                  $label = $subject['subject_code'] . ' - ' . $subject['description'];
                  $selected = ($selectedSubject === $value) ? 'selected' : '';
                ?>
                  <option value="<?= htmlspecialchars($value) ?>" <?= $selected ?>>
                    <?= htmlspecialchars($label) ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <!-- Username -->
            <div class="col-md-6">
              <label for="username" class="form-label">Username</label>
              <input disabled type="text" id="username" name="username" class="form-control"
                     value="<?= htmlspecialchars($data['username'] ?? '') ?>" required>
            </div>

            <!-- Email -->
            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control"
                     value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
            </div>

            <!-- First Name -->
            <div class="col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" id="first_name" name="first_name" class="form-control"
                     value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" required>
            </div>

            <!-- Last Name -->
            <div class="col-md-6">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" id="last_name" name="last_name" class="form-control"
                     value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" required>
            </div>

            <!-- Gender -->
            <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <select id="gender" name="gender" class="form-control">
                <option value="">Select...</option>
                <?php foreach (['male', 'female', 'other'] as $g): ?>
                  <option value="<?= $g ?>" <?= ($data['gender'] ?? '') === $g ? 'selected' : '' ?>>
                    <?= ucfirst($g) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Birthdate -->
            <div class="col-md-6">
              <label for="birthdate" class="form-label">Birthdate</label>
              <input type="date" id="birthdate" name="birthdate" class="form-control"
                     value="<?= htmlspecialchars($data['birthdate'] ?? '') ?>">
            </div>

            <!-- Phone Number -->
            <div class="col-md-6">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input type="text" id="phone_number" name="phone_number" class="form-control"
                     value="<?= htmlspecialchars($data['phone_number'] ?? '') ?>">
            </div>

            <!-- Address -->
            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <textarea id="address" name="address" class="form-control" rows="3"><?= htmlspecialchars($data['address'] ?? '') ?></textarea>
            </div>

            <!-- Profile Picture -->
            <div class="col-md-6">
              <label for="profile" class="form-label">Profile Picture</label>
              <input type="file" id="profile" name="profile" class="form-control">
            </div>

            <!-- Account Status -->
            <div class="col-md-6">
              <label for="acc_status" class="form-label">Account Status</label>
              <input type="text" id="acc_status" name="acc_status" class="form-control" 
                     value="<?= htmlspecialchars($data['acc_status'] ?? 'active') ?>" readonly>
            </div>

            <!-- Actions -->
            <div class="col-12 text-start pt-2">
              <button type="submit" class="btn bg-main text-light">Save User</button>
              <a href="teacher.php?nav_drop=true" class="btn btn-secondary ms-2">Back</a>
              <a href="change_password_teacher.php?id=<?= urlencode($data['user_id']) ?>&nav_drop=true" class="btn btn-secondary ms-2">Change Password</a>
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
