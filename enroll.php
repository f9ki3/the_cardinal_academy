<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Cardinal Academy - Registration</title>
  <link rel="stylesheet" href="style.css" />
  <?php include 'header.php'; ?>
</head>

<?php include 'navigation.php'; ?>
<body class="bg-light">

<div class="container py-5">
  <div class="bg-white p-4 rounded-4 shadow-sm">

    <form action="submit_registration.php" method="POST" enctype="multipart/form-data">
      <div class="d-flex justify-content-between align-items-center mb-4">
    <div class="text-center flex-fill step" id="step1">
      <i class="bi bi-lock-fill icon-step"></i>
      <div>Account</div>
    </div>
    <div class="text-center flex-fill step" id="step2">
      <i class="bi bi-person-fill icon-step"></i>
      <div>Personal</div>
    </div>
    <div class="text-center flex-fill step" id="step3">
      <i class="bi bi-image-fill icon-step"></i>
      <div>Image</div>
    </div>
  </div>

      <!-- Student Profile -->
      <fieldset>
        <legend class="mb-4 h4">Student’s Profile</legend>
        <div class="row g-3">

          <div class="col-12 col-md-6">
            <label for="status" class="form-label text-muted">Status</label>
            <select name="status" id="status" class="form-select">
              <option value="">Select student status</option>
              <option>Old Student</option>
              <option>New Student</option>
            </select>
          </div>

          <div class="col-12 col-md-6">
            <label for="lrn" class="form-label text-muted">Learner Reference Number (LRN)</label>
            <input type="text" name="lrn" id="lrn" placeholder="Enter LRN" class="form-control">
          </div>

          <div class="col-12 col-md-6">
            <label for="grade_level" class="form-label text-muted">Grade Level</label>
            <select name="grade_level" id="grade_level" class="form-select">
              <option value="">Select grade level</option>
              <option>Kinder Garten</option>
              <option>Grade 1</option>
              <option>Grade 2</option>
              <option>Grade 3</option>
              <option>Grade 4</option>
              <option>Grade 5</option>
              <option>Grade 6</option>
              <option>Grade 7</option>
              <option>Grade 8</option>
              <option>Grade 9</option>
              <option>Grade 10</option>
              <option>Grade 11</option>
              <option>Grade 12</option>
            </select>
          </div>

          <div class="col-12 col-md-6">
            <label for="gender" class="form-label text-muted">Gender</label>
            <select name="gender" id="gender" class="form-select">
              <option value="">Select gender</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>

          <div class="col-12">
            <label for="photo" class="form-label text-muted">Attach Formal Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Middle Name</label>
            <input type="text" name="middle_name" class="form-control" placeholder="Enter middle name">
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label text-muted">Date of Birth</label>
            <input type="date" name="birth_date" class="form-control">
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label text-muted">Place of Birth</label>
            <input type="text" name="birth_place" class="form-control" placeholder="Enter place of birth">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Age</label>
            <input type="number" name="age" class="form-control" placeholder="Enter age">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Religion</label>
            <input type="text" name="religion" class="form-control" placeholder="Enter religion">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Facebook Account</label>
            <input type="text" name="facebook" class="form-control" placeholder="Enter Facebook account">
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Region</label>
            <select name="Region" class="form-select">
              <option value="">Select region</option>
            </select>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Province</label>
            <select name="Province" class="form-select">
              <option value="">Select province</option>
            </select>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">City</label>
            <select name="City" class="form-select">
              <option value="">Select city</option>
            </select>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Barangay</label>
            <select name="Barangay" class="form-select">
              <option value="">Select barangay</option>
            </select>
          </div>

          <div class="col-12 col-md-2">
            <button type="button" class="btn bg-main text-light mt-3 rounded-4 w-100" onclick="validateStep1()">Next</button>
          </div>
        </div>
      </fieldset>

      <!-- Guardian Profile -->
      <fieldset class="mt-5">
        <legend class="mb-4 h4">Guardian Profile</legend>
        <div class="row g-3">

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Father’s Name</label>
            <input type="text" name="father_name" class="form-control" placeholder="Enter father's name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Father’s Occupation</label>
            <input type="text" name="father_occupation" class="form-control" placeholder="Enter occupation">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Father’s Contact Number</label>
            <input type="text" name="father_contact" class="form-control" placeholder="Enter contact number">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Mother’s Name</label>
            <input type="text" name="mother_name" class="form-control" placeholder="Enter mother's name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Mother’s Occupation</label>
            <input type="text" name="mother_occupation" class="form-control" placeholder="Enter occupation">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Mother’s Contact Number</label>
            <input type="text" name="mother_contact" class="form-control" placeholder="Enter contact number">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Guardian’s Name (optional)</label>
            <input type="text" name="guardian_name" class="form-control" placeholder="Enter guardian's name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Guardian’s Occupation</label>
            <input type="text" name="guardian_occupation" class="form-control" placeholder="Enter occupation">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Guardian’s Contact Number</label>
            <input type="text" name="guardian_contact" class="form-control" placeholder="Enter contact number">
          </div>

          <div class="col-12 col-md-2">
            <button type="button" class="btn bg-main text-light rounded-4 mt-3 w-100" onclick="validateStep2()">Next</button>
          </div>
        </div>
      </fieldset>

      <!-- Declaration -->
      <fieldset class="mt-5">
        <legend class="h4">Declaration</legend>
        <p class="text-muted" style="font-size: 15px; line-height: 1.6;">
          As a <strong>student of The Cardinal Academy</strong>, I hereby affirm my commitment to abide by all the rules.<br><br>
          As the <strong>parent/guardian of the above-named student</strong>, I acknowledge and support the rules.
        </p>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="chk1" name="declaration_1" required>
          <label class="form-check-label" for="chk1">
            We commit to respecting
          </label>
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="chk2" name="declaration_2" required>
          <label class="form-check-label" for="chk2">
            We accept full responsibility
          </label>
        </div>

        <div class="col-12 col-md-2">
          <button type="submit" class="btn btn-success w-100 rounded-4" onclick="return validateDeclaration()">Proceed</button>
        </div>
      </fieldset>
    </form>

  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
