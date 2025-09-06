<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
// Get ID from URL
$admission_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch admission data
$data = [];
if ($admission_id > 0) {
    $query = "SELECT * FROM admission_old WHERE id = ?";
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
<div class="d-flex flex-row">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container py-4">
     <form action="approved_admission2.php" method="POST">
      <input type="hidden" name="admission_id" value="<?= htmlspecialchars($data['id'] ?? '') ?>">

      <div class="bg-white p-4 rounded-4">
        <h2>Student Admission Form</h2>
        <p class="m-0 mb-4">Note: Please review all information from the form.</p>
        <hr>

        <fieldset>
          <div class="row g-3">

            <div class="col-12 col-md-4">
              <label for="grade_level" class="form-label text-muted">Grade Level</label>
              <input type="text" class="form-control" 
                    value="<?= htmlspecialchars($data['grade_level'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label for="gender" class="form-label text-muted">Gender</label>
              <select class="form-select" disabled>
                <option value="">Select gender</option>
                <option value="Male" <?= ($data['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= ($data['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
              </select>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Student Number</label>
              <input type="text" class="form-control"
                    value="<?= htmlspecialchars($data['student_id'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Last Name</label>
              <input type="text" class="form-control" 
                    value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">First Name</label>
              <input type="text" class="form-control" 
                    value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Middle Name <small class="text-muted">(optional)</small></label>
              <input type="text" class="form-control" 
                    value="<?= htmlspecialchars($data['middle_name'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Date of Birth</label>
              <input type="date" class="form-control" 
                    value="<?= htmlspecialchars($data['birth_date'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Place of Birth</label>
              <input type="text" class="form-control" 
                    value="<?= htmlspecialchars($data['birth_place'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Age</label>
              <input type="number" class="form-control" 
                    value="<?= htmlspecialchars($data['age'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Religion</label>
              <input type="text" class="form-control" 
                    value="<?= htmlspecialchars($data['religion'] ?? '') ?>" disabled>
            </div> 

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Guardian Phone Number</label>
              <input type="text" class="form-control" 
                    value="<?= htmlspecialchars($data['guardian_phone'] ?? '') ?>" disabled>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label text-muted">Email</label>
              <input type="email" class="form-control" 
                    value="<?= htmlspecialchars($data['email'] ?? '') ?>" disabled>
            </div>

          </div>
        </fieldset>

        <!-- Guardian Profile -->
        <fieldset>
          <div class="row g-3">

            <div class="col-12 col-md-2">
              <button id="approve-btn" type="submit" name="action" value="approved" class="btn btn-danger text-light rounded-4 mt-3 w-100">
                <span class="btn-text">Approve</span>
                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
              </button>
            </div>

            <div class="col-12 col-md-2">
              <button id="review-btn" type="submit" name="action" value="for_review" class="btn btn-outline-danger text-danger border-2 rounded-4 mt-3 w-100">
                <span class="btn-text">For Review</span>
                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
              </button>
            </div>

            <script>
              const approveBtn = document.getElementById('approve-btn');
              const reviewBtn = document.getElementById('review-btn');

              [approveBtn, reviewBtn].forEach(btn => {
                btn.addEventListener('click', () => {
                  btn.querySelector('.spinner-border').classList.remove('d-none');
                });
              });
            </script>

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
