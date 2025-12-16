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
  <title>The Cardinal Academy - Intermediate Registration</title>
  <?php include 'header.php'; ?>
  <style>
      /* CSS for the tab navigation */
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
      /* Ensure step 2 is hidden initially */
      #step2 {
        display: none;
      }
      /* Style for N/A checkbox column */
      .parent-na-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
      }
    </style>
</head>

<?php include 'navigation.php'; ?>
<body class="bg-light">

<div class="container py-5">
  <div class="bg-white p-4 rounded-4 shadow-sm">

    <form action="submit_admission.php" method="POST" enctype="multipart/form-data">
      <fieldset id="step1">
        <h4 class="text-center"><strong>Step 2</strong>: Learner Profile</h4>
        <p class="text-center m-0 mb-4">Status: please choose status if your new or old student.</p>
        
        <div class="tab-buttons">
          <a href="intermediate_old.php" type="button" class="tab-btn text-decoration-none text-muted" >Old Student</a>
          <a href="intermediate.php" type="button" class="tab-btn active text-decoration-none" >New Student</a>
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


          <div class="col-12 col-md-6">
            <label for="grade_level" class="form-label text-muted">Grade Level* </label>
            <select name="grade_level" id="grade_level" class="form-select">
              <option value="">Select grade level </option>
              <option>Grade 4</option>
              <option>Grade 5</option>
              <option>Grade 6</option>
            </select>
            <div id="grade_level-error" class="invalid-feedback d-none">Grade Level is required.</div>
          </div>

        <div class="col-12 col-md-6">
        <label for="lrn" class="form-label text-muted">Learner Reference Number (LRN)</label>
        <input type="text" name="lrn" id="lrn" 
                placeholder="Note: if not sure LRN leave empty." 
                class="form-control"
                maxlength="12"
                oninput="this.value = this.value.replace(/\D/g, '').slice(0, 12)">
        <div id="lrn-error" class="invalid-feedback d-none">LRN must be a 12-digit number.</div>
        </div>


          <div class="col-12 col-md-6">
            <label for="gender" class="form-label text-muted">Gender*</label>
            <select name="gender" id="gender" class="form-select">
              <option value="">Select gender</option>
              <option>Male</option>
              <option>Female</option>
            </select>
            <div id="gender-error" class="invalid-feedback d-none">Gender is required.</div>
          </div>


        <div class="col-12 col-md-6">
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
              <div id="age-error" class="invalid-feedback d-none">Age must be at least 5.</div> 
          </div>

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
            <select name="Region" class="form-select" onchange="updateResidentialAddress()"> 
              <option value="">Select region</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Region-error" class="invalid-feedback d-none">Region is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Province*</label>
            <select name="Province" class="form-select" onchange="updateResidentialAddress()">
              <option value="">Select province</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Province-error" class="invalid-feedback d-none">Province is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Municipal*</label>
            <select name="Municipal" class="form-select" onchange="updateResidentialAddress()">
              <option value="">Select municipal</option>
              <option disabled>Loading...</option>
            </select>
            <div id="Municipal-error" class="invalid-feedback d-none">City is required.</div>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label text-muted">Barangay*</label>
            <select name="Barangay" class="form-select" onchange="updateResidentialAddress()">
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

          <div class="col-12 text-center">
          <button type="button" class="btn btn-danger text-light mt-3 rounded-4 px-5" onclick="validateStep1()">Next</button>
        </div>


        </div>
      </fieldset>
      
      <fieldset id="step2" style="display: none">
        <h4><strong>Step 3</strong>: Parents and Guardian Profile</h4>
        
        <div class="row g-3 mb-4">
            
            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Father’s Name</label>
                <input type="text" name="father_name" class="form-control parent-field" data-related-check="fatherNotApplicable" placeholder="Enter father's name">
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label text-muted">Father’s Occupation</label>
                <input type="text" name="father_occupation" class="form-control parent-field" data-related-check="fatherNotApplicable" placeholder="Enter Occupation">
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label text-muted">Father’s Contact Number</label>
                <input type="text" name="father_contact" class="form-control parent-field" data-related-check="fatherNotApplicable"
                    placeholder="e.g. 09123456789" 
                    maxlength="11"
                    oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                >
            </div>
            
            <div class="col-12 col-md-1 parent-na-col order-1 order-md-last">
                <small class="text-muted d-block mb-1" style="line-height: 1;">
                    **Father N/A?**
                </small>
                <div class="form-check">
                    <input class="form-check-input not-applicable-check" type="checkbox" id="fatherNotApplicable">
                    <label class="form-check-label text-muted" for="fatherNotApplicable" style="font-size: 0.8rem;">N/A</label>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            
            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Mother’s Name</label>
                <input type="text" name="mother_name" class="form-control parent-field" data-related-check="motherNotApplicable" placeholder="Enter mother's name">
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label text-muted">Mother’s Occupation</label>
                <input type="text" name="mother_occupation" class="form-control parent-field" data-related-check="motherNotApplicable" placeholder="Enter Occupation">
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label text-muted">Mother’s Contact Number</label>
                <input type="text" name="mother_contact" class="form-control parent-field" data-related-check="motherNotApplicable"
                    placeholder="e.g. 09123456789" 
                    maxlength="11"
                    oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                >
            </div>

            <div class="col-12 col-md-1 parent-na-col order-1 order-md-last">
                <small class="text-muted d-block mb-1" style="line-height: 1;">
                    **Mother N/A?**
                </small>
                <div class="form-check">
                    <input class="form-check-input not-applicable-check" type="checkbox" id="motherNotApplicable">
                    <label class="form-check-label text-muted" for="motherNotApplicable" style="font-size: 0.8rem;">N/A</label>
                </div>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Contact Person*</label>
                <input type="text" required name="guardian_name" id="guardian_name" class="form-control" placeholder="Enter guardian's name">
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Contact Person's Occupation*</label>
                <input type="text" required name="guardian_occupation" class="form-control" placeholder="Note: N/A if None">
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Contact Person's Contact Number*</label>
                <input type="text" name="guardian_contact" id="guardian_contact" class="form-control" 
                    placeholder="e.g. 09123456789" 
                    maxlength="11"
                    oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                    required
                >
            </div>
            
            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Contact Person's Email*</label>
                <input type="email" name="email" class="form-control" placeholder="Note: active email for queue number" required>
                </div>
            
        </div>

        <div class="mt-4">
            <p class="text-muted" style="font-size: 15px; text-align: justify; line-height: 1.6;">
                As a student of The Cardinal Academy and as the parent/guardian of the above-named student, we affirm our commitment to abide by all school rules, acknowledge and support them, commit to respecting them, and accept full responsibility for upholding them.
            </p>
            <div class="form-check d-flex align-items-center justify-content-start">
                <input id="agreementCheckbox" class="form-check-input me-2" type="checkbox">
                <label class="form-check-label text-muted" for="agreementCheckbox">
                    I agree that all data provided is true and correct.
                </label>
            </div>
        </div>


        <div class="col-12 col-md-2">
            <button type="submit" id="submitBtn" disabled class="btn bg-danger text-light rounded-4 mt-3 w-100">Submit</button>
        </div>

      </fieldset>
    </form>

  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<script>
// --- Address Field Update ---
const residentialInput = document.getElementById("residential_address");
const streetInput = document.getElementById("street_address");
const houseInput = document.getElementById("house_address");
const barangaySelect = document.querySelector('select[name="Barangay"]');
const municipalSelect = document.querySelector('select[name="Municipal"]');
const provinceSelect = document.querySelector('select[name="Province"]');

function updateResidentialAddress() {
    let house = houseInput.value.trim();
    let street = streetInput.value.trim();
    let barangay = barangaySelect.value.trim();
    let municipal = municipalSelect.value.trim();
    let province = provinceSelect.value.trim();

    // Create a list of parts, filtering out empty strings/placeholders
    let parts = [
      house, 
      street, 
      barangay && barangay !== 'Select barangay' ? barangay : null,
      municipal && municipal !== 'Select municipal' ? municipal : null,
      province && province !== 'Select province' ? province : null
    ].filter(Boolean);

    let fullAddress = parts.join(", ");
    residentialInput.value = fullAddress;
}


// --- Age Calculation ---
function calculateAge() {
    const dobInput = document.getElementById('birth_date_input');
    const ageInput = document.getElementById('age_input');
    
    ageInput.value = '';

    const dobValue = dobInput.value;
    if (!dobValue) {
        return; 
    }

    try {
        const birthDate = new Date(dobValue);
        const today = new Date();

        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        if (age >= 0) {
            ageInput.value = age;
        } else {
            ageInput.value = 'Invalid Date';
        }
        
    } catch (e) {
        ageInput.value = 'Error';
        console.error("Age calculation error:", e);
    }
}


// --- Step Navigation Function ---
function showStep2() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
    window.scrollTo(0, 0); // Scroll to top for new step
}
// Renamed and corrected navigation function
function hide_step1() {
  showStep2();
}


// --- Step 1 Validation Logic (Updated Min Age to 5) ---
function validateStep1() {
  // Use 'birth_date_input' and 'age_input' for getting values since they have IDs
  const fields = [
    { id: 'grade_level', message: 'Grade Level is required' },
    { id: 'gender', message: 'Gender is required' },
    { id: 'last_name', message: 'Last Name is required', name: 'last_name' },
    { id: 'first_name', message: 'First Name is required', name: 'first_name' },
    { id: 'birth_date_input', message: 'Date of Birth is required', name: 'birth_date' },
    { id: 'birth_place', message: 'Place of Birth is required', name: 'birth_place' },
    // MINIMUM AGE CHECK SET TO 5
    { id: 'age_input', message: 'Age must be at least 5.', name: 'age', min: 5 }, 
    { id: 'religion', message: 'Religion is required', name: 'religion' },
    { id: 'phone', message: 'Phone number must be exactly 11 digits', pattern: /^\d{11}$/ },
    { id: 'Region', message: 'Region is required', type: 'select' },
    { id: 'Province', message: 'Province is required', type: 'select' },
    { id: 'Municipal', message: 'Municipal is required', type: 'select' },
    { id: 'Barangay', message: 'Barangay is required', type: 'select' },
    { id: 'street_address', message: 'Street address is required' },
    { id: 'house_address', message: 'House address is required' },
    { id: 'residential_address', message: 'Complete residential address is required', name: 'full_residential_address' }
  ];

  // LRN is optional, but if entered, it must be 12 digits
  const lrnInput = document.getElementById('lrn');
  const lrnValue = lrnInput.value.trim();
  if (lrnValue !== '') {
    fields.push({ id: 'lrn', message: 'LRN must be a 12-digit number', pattern: /^\d{12}$/ });
  }

  let isValid = true;
  let firstErrorElement = null;

  fields.forEach(field => {
    // Determine the element by ID or Name
    const el = document.getElementsByName(field.name || field.id)[0] || document.getElementById(field.id);
    // Determine the error div (using ID or Name in the error structure)
    const errorDiv = document.getElementById(`${field.id}-error` || `${field.name}-error`);

    if (!el || el.disabled) return;

    let value = el.value.trim();
    let showError = false;

    // 1. Check for required empty fields (excluding LRN if optional)
    if (value === '' && field.id !== 'lrn') { 
      showError = true;
    }
    
    // 2. Check pattern (LRN if entered, Phone always)
    if (field.pattern && !field.pattern.test(value)) {
      showError = true;
    }

    // 3. Check min age
    // AGE CHECK IS HERE: Set to min: 5
    if (field.min !== undefined && parseInt(value) < field.min) {
      showError = true;
    }

    // 4. Check select placeholders
    if (field.type === 'select' && value.includes('Select')) {
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
      if (!firstErrorElement) {
        firstErrorElement = el;
      }
    } else {
      el.classList.remove('is-invalid');
      if (errorDiv) {
        errorDiv.classList.add('d-none');
        errorDiv.style.display = 'none';
      }
    }
  });

  if (isValid) {
    showStep2();
  } else if (firstErrorElement) {
    firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
}

// --- Parent/Guardian Checkbox Logic and Submission ---
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.getElementById('submitBtn');
    const guardianNameInput = document.getElementById('guardian_name');
    const agreementCheckbox = document.getElementById('agreementCheckbox');
    const notApplicableCheckboxes = document.querySelectorAll('.not-applicable-check');
    
    // --- 1. Function to check form validity and enable/disable submit button ---
    function checkFormValidity() {
        const isGuardianNameFilled = guardianNameInput.value.trim() !== '';
        const isAgreementChecked = agreementCheckbox.checked;
        
        // This button requires Guardian Name and Agreement to be checked
        submitBtn.disabled = !(isGuardianNameFilled && isAgreementChecked);
    }
    
    // --- 2. Function to handle 'Not Applicable' functionality ---
    notApplicableCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Find all related input fields using the data attribute
            const relatedFields = document.querySelectorAll(`[data-related-check="${this.id}"]`);
            
            relatedFields.forEach(field => {
                if (this.checked) {
                    field.disabled = true;
                    field.value = '';
                    field.classList.remove('is-invalid'); // Clear visual errors
                } else {
                    field.disabled = false;
                }
            });
            checkFormValidity();
        });
    });

    // --- 3. Attach listeners for form flow and validation ---
    guardianNameInput.addEventListener('input', checkFormValidity);
    agreementCheckbox.addEventListener('change', checkFormValidity);
    
    // Address fields setup
    streetInput.addEventListener("input", updateResidentialAddress);
    houseInput.addEventListener("input", updateResidentialAddress);
    
    // Initial setup and calculations
    const dobInput = document.getElementById('birth_date_input');
    if (dobInput) {
        dobInput.addEventListener('change', calculateAge);
        if (dobInput.value) {
            calculateAge();
        }
    }
    checkFormValidity();
});
</script>


<script>
// --- Philippine Standard Geographic Code (PSGC) API Logic ---
document.addEventListener("DOMContentLoaded", function () {
  const regionSelect = document.querySelector('select[name="Region"]');
  const provinceSelect = document.querySelector('select[name="Province"]');
  const municipalSelect = document.querySelector('select[name="Municipal"]');
  const barangaySelect = document.querySelector('select[name="Barangay"]');

  // Utility function for fetch and select reset
  function resetSelects(select, defaultText, disable = false) {
      select.innerHTML = `<option value="">${defaultText}</option>`;
      select.disabled = disable;
      updateResidentialAddress(); // Update full address on selection change
  }
  
  // Disable province/municipal/barangay on load
  provinceSelect.disabled = true;
  municipalSelect.disabled = true;
  barangaySelect.disabled = true;

  // Load Regions
  fetch("https://psgc.gitlab.io/api/regions/")
    .then(res => res.json())
    .then(data => {
      resetSelects(regionSelect, 'Select region');
      data.forEach(region => {
        regionSelect.innerHTML += `<option value="${region.name}" data-code="${region.code}">${region.name}</option>`;
      });
    })
    .catch(e => {
        console.error("Error loading regions:", e);
        resetSelects(regionSelect, 'Error loading regions');
    });


  // Load Provinces on Region change
  regionSelect.addEventListener("change", function () {
    const selectedOption = this.options[this.selectedIndex];
    const regionCode = selectedOption.getAttribute('data-code');
    
    resetSelects(provinceSelect, 'Loading provinces...', true);
    resetSelects(municipalSelect, 'Select municipal', true);
    resetSelects(barangaySelect, 'Select barangay', true);

    if (!regionCode) return;

    fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces/`)
      .then(res => res.json())
      .then(data => {
        resetSelects(provinceSelect, 'Select province');
        data.forEach(province => {
          provinceSelect.innerHTML += `<option value="${province.name}" data-code="${province.code}">${province.name}</option>`;
        });
      })
      .catch(e => {
          console.error("Error loading provinces:", e);
          resetSelects(provinceSelect, 'Error loading provinces');
      });
  });

  // Load Municipalities on Province change
  provinceSelect.addEventListener("change", function () {
    const selectedOption = this.options[this.selectedIndex];
    const provinceCode = selectedOption.getAttribute('data-code');
    
    resetSelects(municipalSelect, 'Loading cities/municipalities...', true);
    resetSelects(barangaySelect, 'Select barangay', true);

    if (!provinceCode) return;

    fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
      .then(res => res.json())
      .then(data => {
        resetSelects(municipalSelect, 'Select municipal');
        data.forEach(city => {
          municipalSelect.innerHTML += `<option value="${city.name}" data-code="${city.code}">${city.name}</option>`;
        });
      })
      .catch(e => {
          console.error("Error loading municipalities:", e);
          resetSelects(municipalSelect, 'Error loading municipalities');
      });
  });

  // Load Barangays on Municipal change
  municipalSelect.addEventListener("change", function () {
    const selectedOption = this.options[this.selectedIndex];
    const municipalCode = selectedOption.getAttribute('data-code');
    
    resetSelects(barangaySelect, 'Loading barangays...', true);

    if (!municipalCode) return;

    fetch(`https://psgc.gitlab.io/api/cities-municipalities/${municipalCode}/barangays/`)
      .then(res => res.json())
      .then(data => {
        resetSelects(barangaySelect, 'Select barangay');
        data.forEach(barangay => {
          barangaySelect.innerHTML += `<option value="${barangay.name}">${barangay.name}</option>`;
        });
      })
      .catch(e => {
          console.error("Error loading barangays:", e);
          resetSelects(barangaySelect, 'Error loading barangays');
      });
  });
});
</script>