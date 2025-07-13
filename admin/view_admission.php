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
        <h2>Student Admission Form</h2>
        <p class="m-0 mb-4">Note: Please review all information from the form.</p>
        <hr>

        <!-- Learner Profile -->
        <fieldset>
          <h4><strong>Learner Profile</strong></h4>
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
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['status'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">LRN</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['lrn'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Grade Level</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['grade_level'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Strand</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars(!empty($data['strand']) ? $data['strand'] : 'N/A') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Last Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['lastname'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">First Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['firstname'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Middle Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['middlename'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Complete Residential Address</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['residential_address'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Gender</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['gender'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Birth Date</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['birthday'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Birth Place</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['place_of_birth'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Age</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['age'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Religion</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['religion'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Phone number</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['phone'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-3">
              <label class="form-label text-muted">Email</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>" disabled>
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
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['father_name'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Father’s Occupation</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['father_occupation'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Father’s Contact</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['father_contact'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Mother’s Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['mother_name'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Mother’s Occupation</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['mother_occupation'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Mother’s Contact</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['mother_contact'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Guardian’s Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['guardian_name'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Guardian’s Occupation</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['guardian_occupation'] ?? '') ?>" disabled>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted">Guardian’s Contact</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($data['guardian_contact'] ?? '') ?>" disabled>
            </div>
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
                // Select both buttons
                const approveBtn = document.getElementById('approve-btn');
                const reviewBtn = document.getElementById('review-btn');

                // Add a click listener to each
                [approveBtn, reviewBtn].forEach(btn => {
                  btn.addEventListener('click', () => {
                    // Show spinner inside the clicked button
                    btn.querySelector('.spinner-border').classList.remove('d-none');
                    // Optionally disable both buttons to prevent multiple submits
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
