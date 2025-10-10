<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Create Admin Account</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container py-4">
      <form action="create_admin_account.php" method="POST" enctype="multipart/form-data">
        <div class="bg-white p-4 rounded-4">
          <h2 class="mb-2">Create Admin Account</h2>
          <p class="text-muted mb-4">Note: Please review all information from the form before submitting.</p>
          <hr>

          <div class="row g-3">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($data['user_id'] ?? '') ?>">

            <div class="col-md-6">
              <label for="acc_type" class="form-label">Account Type</label>
              <select disabled name="acc_type" id="acc_type" class="form-control" required>
                <option selected value="admin">Admin</option>
                <option value="parent">Parent</option>
                <option value="teacher">Teacher</option>
                <option value="student">Student</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control"
                     placeholder="Enter admin email address"
                     value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" name="first_name" id="first_name" class="form-control"
                     placeholder="Enter admin first name"
                     value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" name="last_name" id="last_name" class="form-control"
                     placeholder="Enter admin last name"
                     value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input type="text" name="phone_number" id="phone_number" class="form-control"
                     placeholder="e.g. 09XXXXXXXXX"
                     value="<?= htmlspecialchars($data['phone_number'] ?? '') ?>">
            </div>

            <div class="col-md-6">
              <label for="profile" class="form-label">Profile Picture</label>
              <input type="file" name="profile" id="profile" class="form-control"
                     accept="image/*">
              <small class="text-muted">Optional: Upload a profile image.</small>
            </div>

            <div class="col-12 text-start pt-3">
              <button type="submit" class="btn bg-main text-light px-4 rounded-4">Create Account</button>
              <a href="admin.php" class="btn btn-secondary ms-2 rounded-4 px-4">Back</a>
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
