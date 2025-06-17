<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
// Get ID from URL
$admission_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch admission data
$data = [];
if ($admission_id > 0) {
    $query = "SELECT * FROM admission_form WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $admission_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
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
     <form action="approved_admission.php" method="POST">
        <div class="bg-white p-4 rounded-4 shadow-sm">
        <h2>Student Enrollment Form</h2>
        <p class="m-0 mb-4">Note: Please review all information from the form before proceed to payment plan</p>
        <hr>

        <!-- Learner Profile -->
        <fieldset>
          <h4><strong>Student Profile</strong></h4>
          <div class="row g-3">
          <input type="hidden" name="admission_id" value="<?= htmlspecialchars($data['id'] ?? '') ?>">

          <div class="col-12 col-md-6">
            <label for="lrn" class="form-label text-muted">Date</label>
            <input type="text" name="admission_date" class="form-control" value="<?= htmlspecialchars($data['admission_date'] ?? '') ?>" disabled>
          </div>

          <div class="col-12 col-md-6">
            <label for="lrn" class="form-label text-muted">QUEUE CODE</label>
            <input type="text" name="que_code" class="form-control" value="<?= htmlspecialchars($data['que_code'] ?? '') ?>" disabled>
          </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Status</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['status'] ?? '') ?>" >
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">LRN</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['lrn'] ?? '') ?>" >
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Grade Level</label>
              <select class="form-select" name="grade_level" required>
                <option value="">Select Grade Level</option>
                <option value="Nursery (with books)" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Nursery (with books)') ? 'selected' : '' ?>>Nursery (with books)</option>
                <option value="Kinder (with books)" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Kinder (with books)') ? 'selected' : '' ?>>Kinder (with books)</option>
                
                <option value="Grade 1" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 1') ? 'selected' : '' ?>>Grade 1</option>
                <option value="Grade 2" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 2') ? 'selected' : '' ?>>Grade 2</option>
                <option value="Grade 3" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 3') ? 'selected' : '' ?>>Grade 3</option>

                <option value="Grade 4" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 4') ? 'selected' : '' ?>>Grade 4</option>
                <option value="Grade 5" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 5') ? 'selected' : '' ?>>Grade 5</option>
                <option value="Grade 6" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 6') ? 'selected' : '' ?>>Grade 6</option>

                <option value="Grade 7" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 7') ? 'selected' : '' ?>>Grade 7</option>
                <option value="Grade 8" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 8') ? 'selected' : '' ?>>Grade 8</option>
                <option value="Grade 9" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 9') ? 'selected' : '' ?>>Grade 9</option>

                <option value="Grade 10" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 10') ? 'selected' : '' ?>>Grade 10</option>
                <option value="Grade 11" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 11') ? 'selected' : '' ?>>Grade 11</option>
                <option value="Grade 12" <?= (isset($data['grade_level']) && $data['grade_level'] === 'Grade 12') ? 'selected' : '' ?>>Grade 12</option>
              </select>
            </div>


            <div class="col-md-6">
              <label class="form-label text-muted">Gender</label>
              <select class="form-select" name="gender" required>
                <option value="Male" <?= (isset($data['gender']) && $data['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= (isset($data['gender']) && $data['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
              </select>
            </div>


            <div class="col-md-4">
              <label class="form-label text-muted">Last Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['lastname'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">First Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['firstname'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Middle Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['middlename'] ?? '') ?>" >
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Birth Date</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['birthday'] ?? '') ?>" >
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Birth Place</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['place_of_birth'] ?? '') ?>" >
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Age</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['age'] ?? '') ?>" >
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Religion</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['religion'] ?? '') ?>" >
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Facebook Account</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['facebook'] ?? '') ?>" >
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Email</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>" >
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Region</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['region'] ?? '') ?>" >
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Province</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['province'] ?? '') ?>" >
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Municipal</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['municipal'] ?? '') ?>" >
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Barangay</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['barangay'] ?? '') ?>" >
            </div>

          </div>
        </fieldset>

        <hr class="my-5">

        <!-- Guardian Profile -->
        <fieldset>
          <h4><strong>Guardian Profile</strong></h4>
          <div class="row g-3">

            <div class="col-md-4">
              <label class="form-label text-muted">Father’s Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['father_name'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Father’s Occupation</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['father_occupation'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Father’s Contact</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['father_contact'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Mother’s Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['mother_name'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Mother’s Occupation</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['mother_occupation'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Mother’s Contact</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['mother_contact'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Guardian’s Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['guardian_name'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Guardian’s Occupation</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['guardian_occupation'] ?? '') ?>" >
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Guardian’s Contact</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['guardian_contact'] ?? '') ?>" >
            </div>
            <div class="col-12 col-md-2">
              <button type="button" onclick="proceedToPayment()" class="btn btn-danger rounded-4 mt-3 w-100">Proceed</button>
            </div>

            <div class="col-12 col-md-2">
              <button type="submit" name="action" value="enroll" class="btn btn-outline-danger rounded-4 mt-3 w-100">Update</button>
            </div>
          </div>
        </fieldset>

      </div>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<script>
function proceedToPayment() {
    const grade = document.querySelector('select[name="grade_level"]').value;
    const admissionId = <?= json_encode($admission_id) ?>;

    if (!grade) {
        alert("Please select a grade level before proceeding.");
        return;
    }

    const url = `payment_plan.php?id=${admissionId}&grade=${encodeURIComponent(grade)}`;
    window.location.href = url;
}
</script>
