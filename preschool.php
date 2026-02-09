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
    </style>
</head>

<?php include 'navigation.php'; ?>
<body class="bg-light">

<div class="container py-5">
  <div class="bg-white p-4 rounded-4 shadow-sm">

    <form id="enrollmentForm" action="submit_admission.php" method="POST" enctype="multipart/form-data">
      
      <fieldset id="step1">
        <h4 class="text-center"><strong>Step 2</strong>: Learner Profile</h4>
        <p class="text-center m-0 mb-4">Status: please choose status if your new or old student.</p>
        
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


          <div class="col-12 col-md-6">
            <label for="grade_level" class="form-label text-muted">Grade Level* </label>
            <select name="grade_level" id="grade_level" class="form-select">
              <option value="">Select grade level </option>
              <option>Nursery</option>
              <option>Kinder</option>
            </select>
            <div id="grade_level-error" class="invalid-feedback d-none">Grade Level is required.</div>
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


        <div class="col-12 col-md-4 d-none">
        <label for="phone" class="form-label text-muted">Phone Number*</label>
        <input type="text" value="09123456789" name="phone" id="phone" class="form-control" 
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
          
          <!-- ✅ Put these in your <head> (or before closing </head>) -->
          <link
            href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css"
            rel="stylesheet"
          />
          <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

          <!-- ✅ Your form field (NO hardcoded options; will be populated from city.json) -->
          <div class="col-12 col-md-6">
            <label class="form-label text-muted">Place of Birth*</label>

            <select id="birth_place" name="birth_place" class="form-select" required>
              <option value="" selected disabled>Type to search...</option>
            </select>

            <div class="invalid-feedback">
              Place of Birth is required.
            </div>
          </div>

          <script>
            /**
             * ✅ Uses ./city.json in this format:
             * [
             *   { "name": "Caloocan", "province": "MM", "city": true },
             *   { "name": "Pateros", "province": "MM" },
             *   { "name": "Bangued", "province": "ABR" }
             * ]
             *
             * ✅ Result:
             * - Dropdown is searchable (Tom Select)
             * - Options grouped by province code
             * - Label shows: "Name — PROV (City/Municipality)"
             */

            (function initBirthPlaceSelect() {
              const el = document.getElementById("birth_place");
              if (!el) return;

              // Optional: map province code -> display name (add more if you want)
              const PROVINCE_LABEL = {
                MM: "Metro Manila",
                ABR: "Abra",
                // add more codes here...
              };

              fetch("./city.json", { cache: "no-store" })
                .then((res) => {
                  if (!res.ok) throw new Error(`Failed to load city.json (${res.status})`);
                  return res.json();
                })
                .then((rows) => {
                  // ✅ sanitize + normalize
                  const items = (Array.isArray(rows) ? rows : [])
                    .filter((x) => x && typeof x.name === "string" && typeof x.province === "string")
                    .map((x) => ({
                      name: x.name.trim(),
                      province: x.province.trim(),
                      city: Boolean(x.city),
                    }))
                    .filter((x) => x.name && x.province);

                  // ✅ build province optgroups
                  const provinces = [...new Set(items.map((i) => i.province))].sort();

                  // clear placeholder options (Tom Select will use its own)
                  el.innerHTML = "";

                  // create optgroups
                  const groupEls = {};
                  for (const prov of provinces) {
                    const og = document.createElement("optgroup");
                    const provLabel = PROVINCE_LABEL[prov] ? `${PROVINCE_LABEL[prov]} (${prov})` : prov;
                    og.label = provLabel;
                    el.appendChild(og);
                    groupEls[prov] = og;
                  }

                  // add options into optgroups
                  // Sort by province then by name
                  items
                    .sort((a, b) => {
                      const p = a.province.localeCompare(b.province);
                      if (p !== 0) return p;
                      return a.name.localeCompare(b.name);
                    })
                    .forEach((item) => {
                      const opt = document.createElement("option");

                      // ✅ unique value (prevents collisions on same city name in diff provinces)
                      // you can change this to just item.name if you prefer
                      opt.value = `${item.name}|${item.province}`;

                      const typeLabel = item.city ? "City" : "Municipality";
                      opt.textContent = `${item.name} — ${item.province} (${typeLabel})`;

                      groupEls[item.province].appendChild(opt);
                    });

                  // ✅ Init Tom Select
                  new TomSelect(el, {
                    create: false,
                    maxItems: 1,
                    allowEmptyOption: true,
                    placeholder: "Type to search...",
                    searchField: ["text"],
                    sortField: [
                      { field: "$order" },
                      { field: "text", direction: "asc" },
                    ],
                    render: {
                      no_results: function (data, escape) {
                        return `<div class="no-results p-2">No match for "<strong>${escape(
                          data.input
                        )}</strong>"</div>`;
                      },
                    },
                  });

                  // ✅ If you want the submitted value to be ONLY the name (not "name|province"),
                  // add a hidden input and mirror the selected name there.
                  // Otherwise remove this block.
                  const hidden = document.createElement("input");
                  hidden.type = "hidden";
                  hidden.name = "birth_place_name";
                  hidden.id = "birth_place_name";
                  el.insertAdjacentElement("afterend", hidden);

                  el.addEventListener("change", () => {
                    const val = el.value || "";
                    const [name] = val.split("|");
                    hidden.value = name || "";
                  });
                })
                .catch((err) => {
                  console.error(err);
                  // Fallback: keep a single disabled option so the field doesn't look broken
                  el.innerHTML = `<option value="" selected disabled>Failed to load cities</option>`;
                });
            })();
          </script>

          <div class="col-12 col-md-6">
            <label class="form-label text-muted">Religion*</label>

            <select name="religion" id="religion" class="form-select" required>
              <option value="">Select religion...</option>

              <!-- Christian -->
              <option value="Roman Catholic">Roman Catholic</option>
              <option value="Protestant">Protestant</option>
              <option value="Evangelical">Evangelical</option>
              <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
              <option value="Aglipayan (Philippine Independent Church)">Aglipayan (Philippine Independent Church)</option>
              <option value="Jehovah's Witnesses">Jehovah's Witnesses</option>
              <option value="Seventh-day Adventist">Seventh-day Adventist</option>
              <option value="The Church of Jesus Christ of Latter-day Saints (Mormon)">The Church of Jesus Christ of Latter-day Saints (Mormon)</option>
              <option value="Born Again Christian">Born Again Christian</option>
              <option value="Orthodox Christian">Orthodox Christian</option>

              <!-- Islam -->
              <option value="Islam (Sunni)">Islam (Sunni)</option>
              <option value="Islam (Shia)">Islam (Shia)</option>

              <!-- Eastern Religions -->
              <option value="Buddhism">Buddhism</option>
              <option value="Hinduism">Hinduism</option>
              <option value="Taoism">Taoism</option>
              <option value="Confucianism">Confucianism</option>

              <!-- Indigenous / Others -->
              <option value="Indigenous Beliefs">Indigenous Beliefs</option>
              <option value="Agnostic">Agnostic</option>
              <option value="Atheist">Atheist</option>

              <!-- Must be last -->
              <option value="Others">Others</option>
            </select>

            <div id="religion-error" class="invalid-feedback">
              Religion is required.
            </div>
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

    <fieldset id="step2">
        <h4><strong>Step 3</strong>: Parents and Guardian Profile</h4>
        
        <div class="row g-3 mb-4">
            
            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Father’s Name</label>
                <input type="text" name="father_name" id="father_name" class="form-control parent-field" data-related-check="fatherNotApplicable" placeholder="Enter father's name">
                <div id="father_name-error" class="invalid-feedback d-none">Father's Name is required if not N/A.</div>
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label text-muted">Father’s Occupation</label>
                <input type="text" name="father_occupation" id="father_occupation" class="form-control parent-field" data-related-check="fatherNotApplicable" placeholder="Empty if N/A">
                <div id="father_occupation-error" class="invalid-feedback d-none">Father's Occupation is required if not N/A.</div>
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Father’s Contact Number</label>
                <input type="text" name="father_contact" id="father_contact" class="form-control parent-field" data-related-check="fatherNotApplicable"
                    placeholder="Empty if N/A" 
                    maxlength="11"
                    oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                >
                <div id="father_contact-error" class="invalid-feedback d-none">Father's Contact must be 11 digits if not N/A.</div>
            </div>
            
            <div class="col-12 col-md-2 d-flex flex-column align-items-center justify-content-center order-1 order-md-last text-center">
                <label class="form-label text-muted">Father's Not Applicable</label>
                <div class="form-check">
                    <input class="form-check-input not-applicable-check" type="checkbox" id="fatherNotApplicable">
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            
            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Mother’s Name</label>
                <input type="text" name="mother_name" id="mother_name" class="form-control parent-field" data-related-check="motherNotApplicable" placeholder="Enter mother's name">
                <div id="mother_name-error" class="invalid-feedback d-none">Mother's Name is required if not N/A.</div>
            </div>

            <div class="col-12 col-md-4">
                <label class="form-label text-muted">Mother’s Occupation</label>
                <input type="text" name="mother_occupation" id="mother_occupation" class="form-control parent-field" data-related-check="motherNotApplicable" placeholder="Empty if N/A">
                <div id="mother_occupation-error" class="invalid-feedback d-none">Mother's Occupation is required if not N/A.</div>
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Mother’s Contact Number</label>
                <input type="text" name="mother_contact" id="mother_contact" class="form-control parent-field" data-related-check="motherNotApplicable"
                    placeholder="Empty if N/A" 
                    maxlength="11"
                    oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                >
                <div id="mother_contact-error" class="invalid-feedback d-none">Mother's Contact must be 11 digits if not N/A.</div>
            </div>

            <div class="col-12 col-md-2 d-flex flex-column align-items-center justify-content-center order-1 order-md-last text-center">
                <label class="form-label text-muted">Mother’s Not Applicable</label>
                <div class="form-check">
                    <input class="form-check-input not-applicable-check" type="checkbox" id="motherNotApplicable">
                </div>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Contact Person*</label>
                <input type="text" required name="guardian_name" id="guardian_name" class="form-control" placeholder="Enter guardian's name">
                <div id="guardian_name-error" class="invalid-feedback d-none">Contact Person's Name is required.</div>
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Contact Person's Occupation <small class="text-muted">(optional)</small></label>
                <input type="text" name="guardian_occupation" id="guardian_occupation" class="form-control" placeholder="Empty if N/A">
                <div id="guardian_occupation-error" class="invalid-feedback d-none">Contact Person's Occupation is required.</div>
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Contact Person's Contact Number*</label>
                <input type="text" name="guardian_contact" id="guardian_contact" class="form-control" 
                    placeholder="e.g. 09123456789" 
                    maxlength="11"
                    oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" 
                    required
                >
                <div id="guardian_contact-error" class="invalid-feedback d-none">Contact Person's Contact must be 11 digits.</div>
            </div>
            
            <div class="col-12 col-md-3">
                <label class="form-label text-muted">Contact Person's Email*</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Note: active email for queue number" required>
                <div id="email-error" class="invalid-feedback d-none">Contact Person's Email is required.</div>
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

        <div class="col-12 d-flex justify-content-center gap-2 mt-3">
            <button type="button" class="btn btn-secondary text-light rounded-4 px-5" onclick="showStep1()">Back</button>
            <button type="button" id="submitBtn" onclick="validateStep2()" disabled class="btn bg-danger text-light rounded-4 px-5">Submit</button>
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

// Update on input changes
document.addEventListener("DOMContentLoaded", () => {
    streetInput.addEventListener("input", updateResidentialAddress);
    houseInput.addEventListener("input", updateResidentialAddress);
    // Select change listeners are also inline in the HTML (onchange="updateResidentialAddress()")
});


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


// --- Step Navigation Functions ---
function showStep2() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
    window.scrollTo(0, 0); // Scroll to top for new step
}

function showStep1() {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1').style.display = 'block';
    window.scrollTo(0, 0); // Scroll to top for step 1
}


// --- Step 1 Validation Logic ---
function validateStep1() {
  const gradeLevel = document.getElementById('grade_level').value.trim().toLowerCase();

  const fields = [
    { id: 'grade_level', message: 'Grade Level is required' },
    { id: 'gender', message: 'Gender is required' },
    { id: 'last_name', message: 'Last Name is required' },
    { id: 'first_name', message: 'First Name is required' },
    { id: 'birth_date_input', message: 'Date of Birth is required', name: 'birth_date' },
    { id: 'birth_place', message: 'Place of Birth is required' },
    { id: 'age_input', message: 'Age must be at least 4', name: 'age', min: 4 },
    { id: 'religion', message: 'Religion is required' },
    { id: 'phone', message: 'Phone number must be exactly 11 digits', pattern: /^\d{11}$/ },
    { id: 'Region', message: 'Region is required', type: 'select' },
    { id: 'Province', message: 'Province is required', type: 'select' },
    { id: 'Municipal', message: 'Municipal is required', type: 'select' },
    { id: 'Barangay', message: 'Barangay is required', type: 'select' },
    { id: 'street_address', message: 'Street address is required' },
    { id: 'house_address', message: 'House address is required' },
    // Hidden but checked:
    { id: 'residential_address', message: 'Complete residential address is required', name: 'full_residential_address' }
  ];


  let isValid = true;
  let firstErrorElement = null;

  fields.forEach(field => {
    const el = document.getElementsByName(field.name || field.id)[0] || document.getElementById(field.id);
    const errorDiv = document.getElementById(`${field.id}-error` || `${field.name}-error`);

    if (!el || el.disabled) return;

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

// --- Step 2 Validation (Submit) Logic ---
function validateStep2() {
    const fields = [
        { id: 'guardian_name', message: "Contact Person's Name is required." },
        // REMOVED Occupation validation from here
        { id: 'guardian_contact', message: "Contact Person's Contact must be 11 digits.", pattern: /^\d{11}$/ },
        { id: 'email', message: "Contact Person's Email is required." }
    ];

    let isValid = true;
    let firstErrorElement = null;

    fields.forEach(field => {
        const el = document.getElementById(field.id);
        const errorDiv = document.getElementById(`${field.id}-error`);
        
        if(!el) return;

        let value = el.value.trim();
        let showError = false;

        if (value === '') {
            showError = true;
        }

        if (field.pattern && !field.pattern.test(value)) {
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
            if (!firstErrorElement) firstErrorElement = el;
        } else {
            el.classList.remove('is-invalid');
            if (errorDiv) {
                errorDiv.classList.add('d-none');
                errorDiv.style.display = 'none';
            }
        }
    });

    if (isValid) {
        // If all valid, submit the form programmatically
        document.getElementById('enrollmentForm').submit();
    } else if (firstErrorElement) {
        firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}


// --- Guardian Profile Validation and Checkbox Logic ---
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.getElementById('submitBtn');
    
    // Inputs to check for enablement
    const guardianNameInput = document.getElementById('guardian_name');
    const guardianOccInput = document.getElementById('guardian_occupation');
    const guardianContactInput = document.getElementById('guardian_contact');
    const guardianEmailInput = document.getElementById('email');
    const agreementCheckbox = document.getElementById('agreementCheckbox');
    
    const notApplicableCheckboxes = document.querySelectorAll('.not-applicable-check');
    
    // --- 1. Function to check form validity and enable/disable submit button ---
    function checkFormValidity() {
        const isNameFilled = guardianNameInput.value.trim() !== '';
        // Removed OccFilled check, it is optional
        const isContactFilled = guardianContactInput.value.trim().length === 11;
        const isEmailFilled = guardianEmailInput.value.trim() !== '';
        const isAgreementChecked = agreementCheckbox.checked;

        // Button is disabled if ANY of these are false
        // Occupation is NOT included in this check anymore
        submitBtn.disabled = !(isNameFilled && isContactFilled && isEmailFilled && isAgreementChecked);
    }
    
    // --- 2. Function to handle 'Not Applicable' functionality ---
    notApplicableCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const relatedFields = document.querySelectorAll(`[data-related-check="${this.id}"]`);
            
            relatedFields.forEach(field => {
                if (this.checked) {
                    field.disabled = true;
                    field.value = '';
                } else {
                    field.disabled = false;
                }
            });
        });
    });

    // --- 3. Attach listeners for button enablement check ---
    guardianNameInput.addEventListener('input', checkFormValidity);
    guardianOccInput.addEventListener('input', checkFormValidity);
    guardianContactInput.addEventListener('input', checkFormValidity);
    guardianEmailInput.addEventListener('input', checkFormValidity);
    agreementCheckbox.addEventListener('change', checkFormValidity);

    // Initial checks
    checkFormValidity();
    
    // Also attach DOB calculator for initial load if necessary
    const dobInput = document.getElementById('birth_date_input');
    if (dobInput && dobInput.value) {
        calculateAge();
    }
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
      updateResidentialAddress();
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