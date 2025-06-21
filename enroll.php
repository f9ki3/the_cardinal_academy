
<?php
  $hideContact = true;
  $hideHome = true;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Cardinal Academy - Registration</title>
  <?php include 'header.php'; ?>
</head>

<?php include 'navigation.php'; ?>
<body class="bg-light">

<div class="container py-5">
  <div class="bg-white p-4 rounded-4 shadow-sm">

    <form action="submit_admission.php" method="POST" enctype="multipart/form-data">


        <h2>Admission Form</h2>
        <p class="m-0 mb-4">Note: please fill up this form for admission to school.</p>
        <hr>
      <!-- Student Profile -->
      <fieldset id="step1">
        <h4><strong>Step 1</strong>: Learner Profile</h4>
        <div class="row g-3">

          <div class="col-12 col-md-6">
            <label for="status" class="form-label text-muted">Status</label>
            <select name="status" id="status" class="form-select">
              <option value="">Select student status</option>
              <option>Old Student</option>
              <option>New Student</option>
            </select>
            <div id="status-error" class="invalid-feedback d-none">Status is required.</div>
          </div>

          <div class="col-12 col-md-6">
            <label for="lrn" class="form-label text-muted">Learner Reference Number (LRN)</label>
            <input type="text" name="lrn" id="lrn" placeholder="Note: For kinder that has no LRN leave empty." class="form-control">
            <div id="lrn-error" class="invalid-feedback d-none">LRN must be a 12-digit number.</div>
          </div>

          <div class="col-12 col-md-6">
            <label for="grade_level" class="form-label text-muted">Grade Level </label>
            <select name="grade_level" id="grade_level" class="form-select">
              <option value="">Select grade level </option>
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
            <div id="grade_level-error" class="invalid-feedback d-none">Grade Level is required.</div>
          </div>

          <div class="col-12 col-md-6">
            <label for="gender" class="form-label text-muted">Gender</label>
            <select name="gender" id="gender" class="form-select">
              <option value="">Select gender</option>
              <option>Male</option>
              <option>Female</option>
            </select>
            <div id="gender-error" class="invalid-feedback d-none">Gender is required.</div>
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
            <label class="form-label text-muted">Middle Name</label>
            <input type="text" name="middle_name" class="form-control" placeholder="Enter middle name">
            <div id="middle_name-error" class="invalid-feedback d-none">Middle Name is required.</div>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label text-muted">Date of Birth</label>
            <input type="date" name="birth_date" class="form-control">
            <div id="birth_date-error" class="invalid-feedback d-none">Date of Birth is required.</div>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label text-muted">Place of Birth</label>
            <input type="text" name="birth_place" class="form-control" placeholder="Enter place of birth">
            <div id="birth_place-error" class="invalid-feedback d-none">Place of Birth is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Age</label>
            <input type="number" name="age" class="form-control" placeholder="Enter age">
            <div id="age-error" class="invalid-feedback d-none">Age must be at least 4.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Religion</label>
            <input type="text" name="religion" class="form-control" placeholder="Enter religion">
            <div id="religion-error" class="invalid-feedback d-none">Religion is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Facebook Account</label>
            <input type="text" name="facebook" class="form-control" placeholder="Enter Facebook account">
            <div id="facebook-error" class="invalid-feedback d-none">Note: Leave as N/A is not applicable</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Note: active email for queue number">
            <div id="email-error" class="invalid-feedback d-none">Email is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Region</label>
            <select name="Region" class="form-select">
              <option value="">Select region</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Region-error" class="invalid-feedback d-none">Region is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Province</label>
            <select name="Province" class="form-select">
              <option value="">Select province</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Province-error" class="invalid-feedback d-none">Province is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Municipal</label>
            <select name="Municipal" class="form-select">
              <option value="">Select municipal</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Municipal-error" class="invalid-feedback d-none">City is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Barangay</label>
            <select name="Barangay" class="form-select">
              <option value="">Select barangay</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Barangay-error" class="invalid-feedback d-none">Barangay is required.</div>
          </div>

          <div class="col-12 col-md-2">
            <button type="button" class="btn btn-danger text-light mt-3 rounded-4 w-100" onclick="validateStep1()">Next</button>
          </div>

        </div>
      </fieldset>
      <!-- Guardian Profile -->
      <fieldset id="step2" style="display: none">
        <h4><strong>Step 2</strong>: Learner Profile</h4>
        <div class="row g-3">

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Father’s Name</label>
            <input type="text" name="father_name" class="form-control" placeholder="Enter father's name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Father’s Occupation</label>
            <input type="text" name="father_occupation" class="form-control" placeholder="Note: N/A if None">
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
            <input type="text" name="mother_occupation" class="form-control" placeholder="Note: N/A if None">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Mother’s Contact Number</label>
            <input type="text" name="mother_contact" class="form-control" placeholder="Enter contact number">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Guardian’s Name (Required)</label>
            <input type="text" required name="guardian_name" class="form-control" placeholder="Enter guardian's name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Guardian’s Occupation</label>
            <input type="text" required name="guardian_occupation" class="form-control" placeholder="Note: N/A if None">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Guardian’s Contact Number</label>
            <input type="text" required name="guardian_contact" class="form-control" placeholder="Enter contact number">
          </div>
          <div class="mt-4">
            <p class="text-muted" style="font-size: 15px; text-align: justify; line-height: 1.6;">
              As a student of The Cardinal Academy and as the parent/guardian of the above-named student, we affirm our commitment to abide by all school rules, acknowledge and support them, commit to respecting them, and accept full responsibility for upholding them.
            </p>
            <div class="form-check d-flex align-items-center justify-content-start">
              <input id="check" class="form-check-input me-2" type="checkbox" id="agreementCheckbox" required>
              <label class="form-check-label text-muted" for="agreementCheckbox">
                I agree that all data provided is true and correct.
              </label>
            </div>
          </div>


          <div class="col-12 col-md-2">
            <button type="submit"  id="submitBtn" disabled class="btn bg-danger text-light rounded-4 mt-3 w-100">Submit</button>
          </div>
        </div>

      </fieldset>

      <!-- Declaration -->
      
    </form>

  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<script>
  const checkbox = document.getElementById('check');
  const button = document.getElementById('submitBtn');

  checkbox.addEventListener('change', function () {
    button.disabled = !this.checked;
  });
</script>

<script>
  function hide_step1(){
    $('#step1').hide()
    $('#step2').show()
  }
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const regionSelect = document.querySelector('select[name="Region"]');
  const provinceSelect = document.querySelector('select[name="Province"]');
  const municipalSelect = document.querySelector('select[name="Municipal"]');
  const barangaySelect = document.querySelector('select[name="Barangay"]');

  // Load Regions
  fetch("https://psgc.gitlab.io/api/regions/")
    .then(res => res.json())
    .then(data => {
      data.forEach(region => {
        regionSelect.innerHTML += `<option value="${region.name}">${region.name}</option>`;
      });
    });

  // Load Provinces on Region change
  regionSelect.addEventListener("change", function () {
    const regionName = this.value;
    provinceSelect.innerHTML = '<option value="">Select province</option>';
    municipalSelect.innerHTML = '<option value="">Select municipal</option>';
    barangaySelect.innerHTML = '<option value="">Select barangay</option>';

    if (!regionName) return;

    fetch(`https://psgc.gitlab.io/api/regions/`)
      .then(res => res.json())
      .then(data => {
        const selectedRegion = data.find(r => r.name === regionName);
        if (selectedRegion) {
          return fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion.code}/provinces/`);
        }
      })
      .then(res => res?.json())
      .then(data => {
        if (!data) return;
        data.forEach(province => {
          provinceSelect.innerHTML += `<option value="${province.name}">${province.name}</option>`;
        });
      });
  });

  // Load Municipalities on Province change
  provinceSelect.addEventListener("change", function () {
    const provinceName = this.value;
    municipalSelect.innerHTML = '<option value="">Select municipal</option>';
    barangaySelect.innerHTML = '<option value="">Select barangay</option>';

    if (!provinceName) return;

    fetch("https://psgc.gitlab.io/api/provinces/")
      .then(res => res.json())
      .then(data => {
        const selectedProvince = data.find(p => p.name === provinceName);
        if (selectedProvince) {
          return fetch(`https://psgc.gitlab.io/api/provinces/${selectedProvince.code}/cities-municipalities/`);
        }
      })
      .then(res => res?.json())
      .then(data => {
        if (!data) return;
        data.forEach(city => {
          municipalSelect.innerHTML += `<option value="${city.name}">${city.name}</option>`;
        });
      });
  });

  // Load Barangays on Municipal change
  municipalSelect.addEventListener("change", function () {
    const municipalName = this.value;
    barangaySelect.innerHTML = '<option value="">Select barangay</option>';

    if (!municipalName) return;

    fetch("https://psgc.gitlab.io/api/cities-municipalities/")
      .then(res => res.json())
      .then(data => {
        const selectedMunicipal = data.find(m => m.name === municipalName);
        if (selectedMunicipal) {
          return fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedMunicipal.code}/barangays/`);
        }
      })
      .then(res => res?.json())
      .then(data => {
        if (!data) return;
        data.forEach(barangay => {
          barangaySelect.innerHTML += `<option value="${barangay.name}">${barangay.name}</option>`;
        });
      });
  });
});
</script>


<script>
function validateStep1() {
  const gradeLevel = document.getElementById('grade_level').value.trim().toLowerCase();

  const fields = [
    { id: 'status', message: 'Status is required' },
    { id: 'grade_level', message: 'Grade Level is required' },
    { id: 'gender', message: 'Gender is required' },
    { id: 'last_name', message: 'Last Name is required' },
    { id: 'first_name', message: 'First Name is required' },
    { id: 'middle_name', message: 'Middle Name is required' },
    { id: 'birth_date', message: 'Date of Birth is required' },
    { id: 'birth_place', message: 'Place of Birth is required' },
    { id: 'age', message: 'Age must be at least 4', min: 4 },
    { id: 'religion', message: 'Religion is required' },
    { id: 'facebook', message: 'Facebook Account is required' },
    { id: 'email', message: 'Email is required' },
    { id: 'Region', message: 'Region is required' },
    { id: 'Province', message: 'Province is required' },
    { id: 'Municipal', message: 'Municipal is required' },
    { id: 'Barangay', message: 'Barangay is required' }
  ];

  // Only include LRN in validation if not Kinder Garten
  if (gradeLevel !== 'kinder garten') {
    fields.push({ id: 'lrn', message: 'LRN must be a 12-digit number', pattern: /^\d{12}$/ });
  }

  let isValid = true;

  fields.forEach(field => {
    const el = document.getElementsByName(field.id)[0] || document.getElementById(field.id);
    const errorDiv = document.getElementById(`${field.id}-error`);

    if (!el) return;

    let value = el.value.trim();
    let showError = false;

    if (value === '') {
      showError = true;
    }

    if (field.pattern && !field.pattern.test(value)) {
      showError = true;
    }

    if (field.min !== undefined && parseInt(value) < field.min) {
      showError = true;
    }

    if (showError) {
      isValid = false;
      el.classList.add('is-invalid');
      if (errorDiv) {
        errorDiv.textContent = field.message;
        errorDiv.classList.remove('d-none');
        errorDiv.style.display = 'block';
      }
    } else {
      el.classList.remove('is-invalid');
      if (errorDiv) {
        errorDiv.classList.add('d-none');
        errorDiv.style.display = 'none';
      }
    }
  });

  if (!isValid) return false;

  // alert("All inputs are valid!");
  hide_step1()
}
</script>

<script>
document.getElementById('grade_level').addEventListener('change', function () {
  const grade = this.value.toLowerCase();
  const lrnInput = document.getElementById('lrn');
  const errorDiv = document.getElementById('lrn-error');

  if (grade === 'kinder garten') {
    lrnInput.disabled = true;
    lrnInput.value = '';
    lrnInput.classList.remove('is-invalid');
    if (errorDiv) {
      errorDiv.classList.add('d-none');
      errorDiv.style.display = 'none';
    }
  } else {
    lrnInput.disabled = false;
  }
});
</script>