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

<?php include 'navigation.php'; ?>
<body class="bg-light">

<div class="container py-5">
  <div class="bg-white p-4 rounded-4 shadow-sm">

    <form action="submit_admission.php" method="POST" enctype="multipart/form-data">
      <!-- Student Profile -->
      <fieldset id="step1">
        <h4 class="text-center"><strong>Step 2</strong>: Learner Profile</h4>
        <p class="text-center m-0 mb-4">Status: please choose status if your new or old student.</p>
        
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
            <a href="old_preschool.php" type="button" class="tab-btn text-decoration-none text-muted" >Old Student</a>
            <a href="preschool.php" type="button" class="tab-btn active text-decoration-none" >New Student</a>
          </div>

         

        <div class="row g-3">

          <div class="col-12 d-none col-md-6">
            <label for="status" class="form-label text-muted">Status</label>
            <select name="status" id="status" class="form-select">
              <option >Old Student</option>
              <option selected>New Student</option>
            </select>
            <div id="status-error" class="invalid-feedback d-none">Status is required.</div>
          </div>


          <div class="col-12 col-md-4">
            <label for="grade_level" class="form-label text-muted">Grade Level* </label>
            <select name="grade_level" id="grade_level" class="form-select">
              <option value="">Select grade level </option>
              <option>Nursery</option>
              <option>Kinder</option>
            </select>
            <div id="grade_level-error" class="invalid-feedback d-none">Grade Level is required.</div>
          </div>

          <div class="col-12 col-md-6 d-none">
            <label for="lrn" class="form-label text-muted">Learner Reference Number (LRN)</label>
            <input type="text" name="lrn" id="lrn" placeholder="Note: For nursery that has no LRN leave empty." class="form-control">
            <div id="lrn-error" class="invalid-feedback d-none">LRN must be a 12-digit number.</div>
          </div>


          <div class="col-12 col-md-4">
            <label for="gender" class="form-label text-muted">Gender*</label>
            <select name="gender" id="gender" class="form-select">
              <option value="">Select gender</option>
              <option>Male</option>
              <option>Female</option>
            </select>
            <div id="gender-error" class="invalid-feedback d-none">Gender is required.</div>
          </div>


        <div class="col-12 col-md-4">
        <label for="phone" class="form-label text-muted">Phone Number*</label>
        <input type="text" name="phone" id="phone" class="form-control" 
                placeholder="e.g. 09123456789" 
                maxlength="11"
                oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                required>
        <div id="phone-error" class="invalid-feedback d-none">Phone number must be exactly 11 digits.</div>
        </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Last Name*</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
            <div id="last_name-error" class="invalid-feedback d-none">Last Name is required.</div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">First Name*</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
            <div id="first_name-error" class="invalid-feedback d-none">First Name is required.</div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Middle Name <small class="text-muted">(optional)</small></label>
            <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name (optional)">
          </div>


          <div class="col-12 col-md-6">
              <label class="form-label text-muted">Date of Birth*</label>
              <input type="date" name="birth_date" id="birth_date_input" class="form-control" onchange="calculateAge()">
              <div id="birth_date-error" class="invalid-feedback d-none">Date of Birth is required.</div>
          </div>

          <div class="col-12 col-md-6">
              <label class="form-label text-muted">Age*</label>
              <input type="text" name="age" id="age_input" class="form-control" placeholder="Please fill up birthday" readonly>
              <div id="age-error" class="invalid-feedback d-none">Age must be at least 4.</div>
          </div>

          <script>
          /**
           * Calculates the age based on the date of birth input and updates the age input field.
           */
          function calculateAge() {
              const dobInput = document.getElementById('birth_date_input');
              const ageInput = document.getElementById('age_input');
              
              // Clear previous value
              ageInput.value = '';

              const dobValue = dobInput.value;
              if (!dobValue) {
                  return; // Exit if no date is selected
              }

              try {
                  const birthDate = new Date(dobValue);
                  const today = new Date();

                  // Calculate the difference in milliseconds
                  let age = today.getFullYear() - birthDate.getFullYear();
                  const monthDiff = today.getMonth() - birthDate.getMonth();

                  // If the current month is less than the birth month, or if the months are the same 
                  // but the current day is less than the birth day, subtract one year.
                  if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                      age--;
                  }

                  // Display the calculated age
                  if (age >= 0) {
                      ageInput.value = age;
                  } else {
                      // Handle case where DOB is in the future (shouldn't happen with correct validation)
                      ageInput.value = 'Invalid Date';
                  }

                  // You might want to re-run validation logic here if required:
                  // validateAge(age); 
                  
              } catch (e) {
                  // Fallback for unexpected date format errors
                  ageInput.value = 'Error';
                  console.error("Age calculation error:", e);
              }
          }

          // Optional: Run on page load if the field is pre-populated (e.g., for editing)
          document.addEventListener('DOMContentLoaded', () => {
              // Attach the function to the 'change' event in case the inline 'onchange' is missed 
              // and also run on load if a value exists.
              const dobInput = document.getElementById('birth_date_input');
              if (dobInput) {
                  dobInput.addEventListener('change', calculateAge);
                  // Initial run if a value is present (e.g., on edit page load)
                  if (dobInput.value) {
                      calculateAge();
                  }
              }
          });
          </script>

          <div class="col-12 col-md-6">
            <label class="form-label text-muted">Place of Birth*</label>
            <input type="text" name="birth_place" class="form-control" placeholder="Enter place of birth">
            <div id="birth_place-error" class="invalid-feedback d-none">Place of Birth is required.</div>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label text-muted">Religion*</label>
            <input type="text" name="religion" class="form-control" placeholder="Enter religion">
            <div id="religion-error" class="invalid-feedback d-none">Religion is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Region*</label>
            <select name="Region" class="form-select">
              <option value="">Select region</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Region-error" class="invalid-feedback d-none">Region is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Province*</label>
            <select name="Province" class="form-select">
              <option value="">Select province</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Province-error" class="invalid-feedback d-none">Province is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Municipal*</label>
            <select name="Municipal" class="form-select">
              <option value="">Select municipal</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Municipal-error" class="invalid-feedback d-none">City is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Barangay*</label>
            <select name="Barangay" class="form-select">
              <option value="">Select barangay</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Barangay-error" class="invalid-feedback d-none">Barangay is required.</div>
          </div>

          <div class="col-12 d-none">
            <label for="residential_address" class="form-label text-muted">Complete Residential Address*</label>
            <input type="text" id="residential_address" name="full_residential_address" class="form-control" placeholder="e.g., Block No., Lot No., Street Name, Subdivision" readonly>
            <div id="residential_address-error" class="invalid-feedback d-none">Complete residential address is required.</div>
          </div>

          <div class="col-12 col-md-6">
            <label for="street_address" class="form-label text-muted">Street Name / Subdivision*</label>
            <input type="text" id="street_address" name="street_address" class="form-control" placeholder="e.g., Street Name, Subdivision">
            <div id="street_address-error" class="invalid-feedback d-none">Street name or subdivision is required.</div>
          </div>

          <div class="col-12 col-md-6">
            <label for="house_address" class="form-label text-muted">House No. / Lot / BLK / Building No.*</label>
            <input type="text" id="house_address" name="house_address" class="form-control" placeholder="e.g., House No., Lot, Block, Building No.">
            <div id="house_address-error" class="invalid-feedback d-none">House number or lot details are required.</div>
          </div>

          <script>
            const residentialInput = document.getElementById("residential_address");
            const streetInput = document.getElementById("street_address");
            const houseInput = document.getElementById("house_address");

            function updateResidentialAddress() {
              let house = houseInput.value.trim();
              let street = streetInput.value.trim();

              // Join values with comma if both exist
              let fullAddress = [street, house].filter(Boolean).join(", ");

              residentialInput.value = fullAddress;
            }

            // Update on typing
            streetInput.addEventListener("input", updateResidentialAddress);
            houseInput.addEventListener("input", updateResidentialAddress);
          </script>




         <div class="col-12 text-center">
          <button type="button" class="btn btn-danger text-light mt-3 rounded-4 px-5" onclick="validateStep1()">Next</button>
        </div>


        </div>
      </fieldset>
      <!-- Guardian Profile -->
      <fieldset id="step2" style="display: none">
        <h4><strong>Step 3</strong>: Parents and Guardian Profile</h4>
        <div class="row g-3">

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Father’s Name*</label>
            <input type="text" name="father_name" class="form-control" placeholder="Enter father's name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Father’s *</label>
            <input type="text" name="father_occupation" class="form-control" placeholder="Note: N/A if None">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Father’s Contact Number*</label>
            <input type="text" name="father_contact" class="form-control" 
                placeholder="e.g. 09123456789" 
                maxlength="11"
                oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                required
            >
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Mother’s Name*</label>
            <input type="text" name="mother_name" class="form-control" placeholder="Enter mother's name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Mother’s Occupation*</label>
            <input type="text" name="mother_occupation" class="form-control" placeholder="Note: N/A if None">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Mother’s Contact Number*</label>
            <input type="text" name="mother_contact" class="form-control" 
                placeholder="e.g. 09123456789" 
                maxlength="11"
                oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                required
            >
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Contact Person*</label>
            <input type="text" required name="guardian_name" class="form-control" placeholder="Enter guardian's name">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Contact Person's Occupation*</label>
            <input type="text" required name="guardian_occupation" class="form-control" placeholder="Note: N/A if None">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label text-muted">Contact Person's Email*</label>
            <input type="email" name="email" class="form-control" placeholder="Note: active email for queue number">
            <input type="hidden" required name="guardian_contact" class="form-control" 
                placeholder="e.g. 09123456789" 
                maxlength="11"
                oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                value="09123456789"
                required
            >
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
  { id: 'grade_level', message: 'Grade Level is required' },
  { id: 'gender', message: 'Gender is required' },
  { id: 'last_name', message: 'Last Name is required' },
  { id: 'first_name', message: 'First Name is required' },
  { id: 'birth_date', message: 'Date of Birth is required' },
  { id: 'birth_place', message: 'Place of Birth is required' },
  { id: 'age', message: 'Age must be at least 4', min: 4 },
  { id: 'religion', message: 'Religion is required' },
  { id: 'phone', message: 'Phone number must be exactly 11 digits', pattern: /^\d{11}$/ },
  { id: 'Region', message: 'Region is required' },
  { id: 'Province', message: 'Province is required' },
  { id: 'Municipal', message: 'Municipal is required' },
  { id: 'Barangay', message: 'Barangay is required' },
  { id: 'residential_address', message: 'Residential address is required' },
  { id: 'street_address', message: 'Street address is required' },
  { id: 'house_address', message: 'House address is required' }
];

// Only include LRN in validation if not nursery or kinder
if (gradeLevel !== 'nursery' && gradeLevel !== 'kinder garten') {
  fields.push({ id: 'lrn', message: 'LRN must be a 12-digit number', pattern: /^\d{12}$/ });
}

  // Only include LRN in validation if not Kinder Garten
  if (gradeLevel !== 'nursery') {
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

  if (grade === 'nursery') {
    lrnInput.disabled = true;
    lrnInput.value = '';
    lrnInput.classList.remove('is-invalid');
    if (errorDiv) {
      errorDiv.classList.add('d-none');
      errorDiv.style.display = 'none';
    }
  } else if (grade === 'kinder garten') {
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