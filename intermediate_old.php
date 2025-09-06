<?php
  $hideHome = true;
  $pageTitle = 'Services';
  $breadcrumbs = [
  ['label' => 'Home', 'url' => 'index.php'],
  ['label' => 'Enroll']];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Cardinal Academy - Registration</title>
  <?php include 'header.php'; ?>
</head>
<body class="bg-light">

<?php include 'navigation.php'; ?>

<div class="container py-5">
  <div class="bg-white p-4 rounded-4 shadow-sm">

    <form action="submit_admission2.php" method="POST" enctype="multipart/form-data">
      
      <fieldset id="step1">
        <h4 class="text-center"><strong>Step 2</strong>: Learner Profile</h4>
        <p class="text-center m-0 mb-4">Status: Please choose if you are a new or old student.</p>
        
        <style>
            .tab-buttons {
              display: flex;
              margin-bottom: 15px;
            }
            .tab-btn {
              flex: 1;
              padding: 10px;
              background-color: #f1f1f1;
              border: none;
              text-align: center;
              font-weight: bold;
              cursor: pointer;
              transition: 0.3s;
            }
            .tab-btn.active {
              background-color: #b72029;
              color: white;
            }
          </style>

          <div class="tab-buttons">
            <a href="old_preschool.php" class="tab-btn active text-decoration-none">Old Student</a>
            <a href="preschool.php" class="tab-btn text-muted text-decoration-none">New Student</a>
          </div>
         
        <div class="row g-3">
          
          <div class="col-12 col-md-4">
            <label for="grade_level" class="form-label text-muted">Grade Level </label>
            <select readonly name="grade_level" id="grade_level" class="form-select">
              <option value="">Select grade level</option>
              <option selected>Grade 4</option>
              <option>Grade 5</option>
              <option>Grade 6</option>
            </select>
            <div id="grade_level-error" class="invalid-feedback d-none">Grade Level is required.</div>
          </div>


          <div class="col-12 col-md-4">
            <label for="gender" class="form-label text-muted">Gender</label>
            <select name="gender" id="gender" class="form-select">
              <option value="">Select gender</option>
              <option>Male</option>
              <option>Female</option>
            </select>
            <div id="gender-error" class="invalid-feedback d-none">Gender is required.</div>
          </div>


         <div class="col-12 col-md-4">
            <label for="student_id" class="form-label text-muted">Student Number</label>
            <input type="text" name="student_id" id="student_id" class="form-control" 
                placeholder="e.g., 2025-812981" 
                >
            <div id="student_id-error" class="invalid-feedback d-none">Student number is required.</div>
        </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
            <div id="last_name-error" class="invalid-feedback d-none">Last Name is required.</div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
            <div id="first_name-error" class="invalid-feedback d-none">First Name is required.</div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Middle Name <small class="text-muted">(optional)</small></label>
            <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name (optional)">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Date of Birth</label>
            <input type="date" name="birth_date" class="form-control">
            <div id="birth_date-error" class="invalid-feedback d-none">Date of Birth is required.</div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Place of Birth</label>
            <input type="text" name="birth_place" class="form-control" placeholder="Enter place of birth">
            <div id="birth_place-error" class="invalid-feedback d-none">Place of Birth is required.</div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Age</label>
            <input type="number" name="age" class="form-control" placeholder="Enter age">
            <div id="age-error" class="invalid-feedback d-none">Age must be at least 4.</div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Religion</label>
            <input type="text" name="religion" class="form-control" placeholder="Enter religion">
            <div id="religion-error" class="invalid-feedback d-none">Religion is required.</div>
          </div> 

          <div class="col-12 col-md-4">
            <label for="guardian_phone" class="form-label text-muted">Guardian Phone Number</label>
            <input type="text" name="guardian_phone" id="guardian_phone" class="form-control" 
                    placeholder="e.g. 09123456789" 
                    maxlength="11"
                    oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                    >
            <div id="guardian_phone-error" class="invalid-feedback d-none">Guardian phone number must be exactly 11 digits.</div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Note: active email for queue number">
            <div id="email-error" class="invalid-feedback d-none">Email is required.</div>
          </div>

          </div>
      </fieldset>
      
      <div class="mt-4">
        <p class="text-muted" style="font-size: 15px; text-align: justify; line-height: 1.6;">
          As a student of The Cardinal Academy and as the parent/guardian of the above-named student, we affirm our commitment to abide by all school rules, acknowledge and support them, commit to respecting them, and accept full responsibility for upholding them.
        </p>
        <div class="form-check d-flex align-items-center justify-content-start">
          <input id="agreementCheckbox" class="form-check-input me-2" type="checkbox" required>
          <label class="form-check-label text-muted" for="agreementCheckbox">
            I agree that all data provided is true and correct.
          </label>
        </div>
      </div>

      <div class="col-12 col-md-2">
        <button type="submit" id="submitBtn" class="btn bg-danger text-light rounded-4 mt-3 w-100">Submit</button>
      </div>

    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
  const checkbox = document.getElementById('agreementCheckbox');
  const button = document.getElementById('submitBtn');

  checkbox.addEventListener('change', function () {
    button.disabled = !this.checked;
  });
</script>

</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const submitBtn = document.getElementById("submitBtn");

  // Utility: show/hide errors
  function showError(input, messageId, condition) {
    const errorDiv = document.getElementById(messageId);
    if (condition) {
      input.classList.add("is-invalid");
      errorDiv.classList.remove("d-none");
    } else {
      input.classList.remove("is-invalid");
      errorDiv.classList.add("d-none");
    }
  }

  // Select inputs
  const gender = document.getElementById("gender");
  const studentId = document.getElementById("student_id");
  const lastName = form.querySelector("[name='last_name']");
  const firstName = form.querySelector("[name='first_name']");
  const birthDate = form.querySelector("[name='birth_date']");
  const birthPlace = form.querySelector("[name='birth_place']");
  const age = form.querySelector("[name='age']");
  const religion = form.querySelector("[name='religion']");
  const guardianPhone = document.getElementById("guardian_phone");
  const email = form.querySelector("[name='email']");
  const checkbox = document.getElementById("agreementCheckbox");

  // Validate all fields
  function validateForm() {
    let valid = true;

    showError(gender, "gender-error", gender.value === "");
    if (gender.value === "") valid = false;

    showError(studentId, "student_id-error", studentId.value.trim() === "");
    if (studentId.value.trim() === "") valid = false;

    showError(lastName, "last_name-error", lastName.value.trim() === "");
    if (lastName.value.trim() === "") valid = false;

    showError(firstName, "first_name-error", firstName.value.trim() === "");
    if (firstName.value.trim() === "") valid = false;

    showError(birthDate, "birth_date-error", birthDate.value === "");
    if (birthDate.value === "") valid = false;

    showError(birthPlace, "birth_place-error", birthPlace.value.trim() === "");
    if (birthPlace.value.trim() === "") valid = false;

    showError(age, "age-error", age.value === "" || age.value < 4);
    if (age.value === "" || age.value < 4) valid = false;

    showError(religion, "religion-error", religion.value.trim() === "");
    if (religion.value.trim() === "") valid = false;

    showError(
      guardianPhone,
      "guardian_phone-error",
      guardianPhone.value.length !== 11
    );
    if (guardianPhone.value.length !== 11) valid = false;

    const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value);
    showError(email, "email-error", !emailValid);
    if (!emailValid) valid = false;

    if (!checkbox.checked) {
      valid = false;
    }

    return valid;
  }

  // On submit
  form.addEventListener("submit", function (e) {
    if (!validateForm()) {
      e.preventDefault(); // stop submission if invalid
    }
  });
});
</script>
