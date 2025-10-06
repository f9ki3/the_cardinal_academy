<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php 
$subjects_result = mysqli_query($conn, "SELECT id, subject_code, description FROM subjects");
if (!$subjects_result) {
    die("Error fetching subjects: " . mysqli_error($conn));
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
      <form action="create_teacher_account.php" method="POST" enctype="multipart/form-data">
        <div class="bg-white p-4 rounded-4 shadow-sm">
          <h2 class="fw-bold mb-2">Create Teacher Account</h2>
          <p class="text-muted mb-4">Please fill out all required information before submitting the form.</p>
          <hr>

          <div class="row g-3">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($data['user_id'] ?? '') ?>">

            <!-- Account Type -->
            <div class="col-md-6">
              <label for="acc_type" class="form-label">Account Type</label>
              <select disabled name="acc_type" id="acc_type" class="form-select" required>
                <option value="admin" <?= ($data['acc_type'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option selected value="teacher" <?= ($data['acc_type'] ?? '') === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                <option value="parent" <?= ($data['acc_type'] ?? '') === 'parent' ? 'selected' : '' ?>>Parent</option>
                <option value="student" <?= ($data['acc_type'] ?? '') === 'student' ? 'selected' : '' ?>>Student</option>
              </select>
            </div>

            <!-- Subject -->
            <div class="col-md-6">
              <label for="subject_title" class="form-label">Subject</label>
              <input 
                class="form-control" 
                list="subjects" 
                name="subject_title" 
                id="subject_title" 
                placeholder="Type or select a subject..."
                value="<?= htmlspecialchars($data['subject_title'] ?? '') ?>" 
                required
              >
              <datalist id="subjects">
                <?php 
                mysqli_data_seek($subjects_result, 0);
                while ($subject = mysqli_fetch_assoc($subjects_result)): 
                  $display = $subject['subject_code'] . ' - ' . $subject['description'];
                ?>
                  <option data-id="<?= $subject['id'] ?>" value="<?= htmlspecialchars($display) ?>"></option>
                <?php endwhile; ?>
              </datalist>
              <input type="hidden" name="subject_id" id="subject_id" value="<?= htmlspecialchars($data['subject_id'] ?? '') ?>">
            </div>

            <script>
            document.getElementById('subject_title').addEventListener('input', function() {
              const input = this.value;
              const options = document.getElementById('subjects').options;
              let subjectId = '';

              for (let i = 0; i < options.length; i++) {
                if (options[i].value === input) {
                  subjectId = options[i].dataset.id;
                  break;
                }
              }

              document.getElementById('subject_id').value = subjectId;
            });
            </script>

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

            <!-- Email -->
            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control" 
                placeholder="Enter teacher's email address"
                value="<?= htmlspecialchars($data['email'] ?? '') ?>" 
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
                value="<?= htmlspecialchars($data['phone_number'] ?? '') ?>"
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
              <a href="teacher.php" class="btn btn-outline-secondary ms-2 px-4 rounded-3">
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
