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
     <form action="update_admission.php" method="POST">
        <div class="bg-white p-4 rounded-4 shadow-sm">
        <h2>Student Enrollment Form</h2>
        <p class="m-0 mb-4">Note: Please review all information from the form before proceed to payment plan</p>
        <hr>

        <!-- Learner Profile -->
<fieldset>
  <h4><strong>Student Profile</strong></h4>
  <div class="row g-3">
    <input type="hidden" name="admission_id" value="<?= htmlspecialchars($data['id'] ?? '') ?>">

     <div class="col-12 pt-3">
                  <?php
                    // Check if 'status' parameter exists in the URL
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];

                        // Display Bootstrap alert based on the status
                        if ($status === 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ✅ Enrollment form updated successfully!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } elseif ($status === 'error') {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ❌ Something went wrong. Please try again.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } elseif ($status === 'review') {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    ⚠️ Application is under review.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                    }
                    ?>

      </div>
      

    <div class="col-12 col-md-6">
      <label class="form-label text-muted">Admission Date</label>
      <input type="text" name="admission_date" class="form-control" value="<?= htmlspecialchars($data['admission_date'] ?? '') ?>" disabled>
    </div>

    <div class="col-12 col-md-6">
      <label class="form-label text-muted">QUEUE CODE</label>
      <input type="text" name="que_code" class="form-control" value="<?= htmlspecialchars($data['que_code'] ?? '') ?>" disabled>
    </div>

    <div class="col-12 col-md-6">
      <label class="form-label text-muted">LRN</label>
      <input type="text" name="lrn" class="form-control" value="<?= htmlspecialchars($data['lrn'] ?? '') ?>">
    </div>
    
    <div class="col-md-6">
      <label class="form-label text-muted">Status</label>
      <input type="text" name="status" class="form-control" value="<?= htmlspecialchars($data['status'] ?? '') ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label text-muted">Grade Level</label>
      <select class="form-select" name="grade_level" required>
        <option value="">Select Grade Level</option>
        <?php
        $grades = [
          'Nursery (with books)', 'Kinder (with books)',
          'Grade 1', 'Grade 2', 'Grade 3',
          'Grade 4', 'Grade 5', 'Grade 6',
          'Grade 7', 'Grade 8', 'Grade 9',
          'Grade 10', 'Grade 11', 'Grade 12'
        ];
        foreach ($grades as $grade) {
          $selected = (isset($data['grade_level']) && $data['grade_level'] === $grade) ? 'selected' : '';
          echo "<option value=\"$grade\" $selected>$grade</option>";
        }
        ?>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label text-muted">Strand</label>
      <input type="text" name="lastname" class="form-control" value="<?= htmlspecialchars(!empty($data['strand']) ? $data['strand'] : 'N/A') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Last Name</label>
      <input type="text" name="lastname" class="form-control" value="<?= htmlspecialchars($data['lastname'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">First Name</label>
      <input type="text" name="firstname" class="form-control" value="<?= htmlspecialchars($data['firstname'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Middle Name</label>
      <input type="text" name="middlename" class="form-control" value="<?= htmlspecialchars($data['middlename'] ?? '') ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label text-muted">Complete Residential Address</label>
      <input type="text" class="form-control" name="residential_address" value="<?= htmlspecialchars($data['residential_address'] ?? '') ?>" >
    </div>

    <div class="col-md-6">
      <label class="form-label text-muted">Gender</label>
      <select class="form-select" name="gender" required>
        <option value="male" <?= (isset($data['gender']) && $data['gender'] === 'male') ? 'selected' : '' ?>>Male</option>
        <option value="female" <?= (isset($data['gender']) && $data['gender'] === 'female') ? 'selected' : '' ?>>Female</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label text-muted">Birth Date</label>
      <input type="date" name="birthday" class="form-control" value="<?= htmlspecialchars($data['birthday'] ?? '') ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label text-muted">Birth Place</label>
      <input type="text" name="place_of_birth" class="form-control" value="<?= htmlspecialchars($data['place_of_birth'] ?? '') ?>">
    </div>

    <div class="col-md-3">
      <label class="form-label text-muted">Age</label>
      <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($data['age'] ?? '') ?>">
    </div>

    <div class="col-md-3">
      <label class="form-label text-muted">Religion</label>
      <input type="text" name="religion" class="form-control" value="<?= htmlspecialchars($data['religion'] ?? '') ?>">
    </div>

    <div class="col-md-3">
      <label class="form-label text-muted">Phone</label>
      <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($data['phone'] ?? '') ?>">
    </div>

    <div class="col-md-3">
      <label class="form-label text-muted">Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
    </div>

  </div>
</fieldset>

<!-- Guardian Profile -->
<fieldset>
  <h4 class="mt-5 mb-5"><strong> Requirements</strong></h4>
 
  <div class="row g-3">
    <!-- Student Requirements Checkboxes -->
    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="requirements[]" value="birth_cert" id="birth_cert"
              <?= !empty($data['birth_cert']) ? 'checked' : '' ?>>
        <label class="form-check-label" for="birth_cert">Birth Certificate (PSA Copy)</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="requirements[]" value="report_card" id="report_card"
              <?= !empty($data['report_card']) ? 'checked' : '' ?>>
        <label class="form-check-label" for="report_card">Original Report Card (Form 137)</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="requirements[]" value="good_moral" id="good_moral"
              <?= !empty($data['good_moral']) ? 'checked' : '' ?>>
        <label class="form-check-label" for="good_moral">Good Moral Certificate</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="requirements[]" value="id_pic" id="id_pic"
              <?= !empty($data['id_pic']) ? 'checked' : '' ?>>
        <label class="form-check-label" for="id_pic">2x2 ID Picture (White Background)</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="requirements[]" value="esc_cert" id="esc_cert"
              <?= !empty($data['esc_cert']) ? 'checked' : '' ?>>
        <label class="form-check-label" for="esc_cert">ESC Certification (Grade 11 and 12)</label>
      </div>
    </div>
  </div>



<hr class="my-5">
  <h4><strong>Guardian Profile</strong></h4>
  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label text-muted">Father’s Name</label>
      <input type="text" name="father_name" class="form-control" value="<?= htmlspecialchars($data['father_name'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Father’s Occupation</label>
      <input type="text" name="father_occupation" class="form-control" value="<?= htmlspecialchars($data['father_occupation'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Father’s Contact</label>
      <input type="text" name="father_contact" class="form-control" value="<?= htmlspecialchars($data['father_contact'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Mother’s Name</label>
      <input type="text" name="mother_name" class="form-control" value="<?= htmlspecialchars($data['mother_name'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Mother’s Occupation</label>
      <input type="text" name="mother_occupation" class="form-control" value="<?= htmlspecialchars($data['mother_occupation'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Mother’s Contact</label>
      <input type="text" name="mother_contact" class="form-control" value="<?= htmlspecialchars($data['mother_contact'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Guardian’s Name</label>
      <input type="text" name="guardian_name" class="form-control" value="<?= htmlspecialchars($data['guardian_name'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Guardian’s Occupation</label>
      <input type="text" name="guardian_occupation" class="form-control" value="<?= htmlspecialchars($data['guardian_occupation'] ?? '') ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label text-muted">Guardian’s Contact</label>
      <input type="text" name="guardian_contact" class="form-control" value="<?= htmlspecialchars($data['guardian_contact'] ?? '') ?>">
    </div>

    <div class="col-12 col-md-2">
      <button type="button" onclick="proceedToPayment()" class="btn btn-danger rounded-4 mt-3 w-100">Proceed</button>
    </div>

    <div class="col-12 col-md-2">
      <button type="submit" name="action" value="enroll"
              class="btn btn-outline-danger rounded-4 mt-3 w-100 d-flex align-items-center justify-content-center"
              id="update-btn">
        <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" id="update-spinner"></span>
        <span>Update</span>
      </button>
    </div>

    <script>
      document.querySelector('form').addEventListener('submit', function () {
        const btn = document.getElementById('update-btn');
        const spinner = document.getElementById('update-spinner');

        // Disable button and show spinner
        btn.disabled = true;
        spinner.classList.remove('d-none');
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
