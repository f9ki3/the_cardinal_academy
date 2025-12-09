<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

$data = [];
if ($student_id > 0) {
    $query = "SELECT * FROM student_information WHERE student_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
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
<title>Student Medical Records</title>
<?php include 'header.php'; ?>
<style>
/* Overall background and text */
body {
    background-color: #F7F7F7; /* soft off-white */
    color: #333; /* smooth dark text */
    font-family: 'Segoe UI', sans-serif;
}

/* Container cards */
.record-card, .record-section {
    background-color: #FFFFFF; /* pure white card */
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); /* subtle shadow */
}

/* Section headings */
.record-section h5 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    padding-bottom: 0.25rem;
    color: #2C3E50; /* deep but soft heading */
}

/* Individual items */
.record-item {
    margin-bottom: 1rem;
}
.record-item label {
    display: block;
    font-weight: 600;
    font-size: 0.875rem;
    color: #6C757D; /* muted gray for labels */
}
.record-item .data {
    font-size: 0.95rem;
    font-weight: 500;
    color: #2C3E50; /* smooth dark for data */
}


/* Table styling */
.table-responsive {
    margin-top: 1.5rem;
}
.table {
    background-color: #FFFFFF;
    color: #2C3E50;
    border-radius: 0.5rem;
    overflow: hidden;
}
.table th, .table td {
    vertical-align: middle;
    padding: 0.6rem 0.75rem;
}
.table thead {
    background-color: #F1F3F6; /* soft header */
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #FAFAFA; /* subtle stripe */
}
.table th {
    font-weight: 600;
    color: #2C3E50;
}


/* Responsive spacing for columns */
.row > [class*='col-'] {
    margin-bottom: 1rem;
}
</style>

</head>
<body>
<div class="d-flex flex-row">
<?php include 'navigation.php'; ?>

<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container pt-3">

    
    <!-- Student Details -->
    <div class="record-section">
        <h5 class="fw-bolder">Student Medical Details</h5>
        <div class="row">
            <div class="col-md-4 record-item">
                <label>Student Number</label>
                <div class="data"><?= htmlspecialchars($data['student_number'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Full Name</label>
                <div class="data"><?= htmlspecialchars($data['firstname'] . ' ' . $data['middlename'] . ' ' . $data['lastname'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Email</label>
                <div class="data"><?= htmlspecialchars($data['email'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Phone</label>
                <div class="data"><?= htmlspecialchars($data['phone'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Gender</label>
                <div class="data"><?= htmlspecialchars($data['gender'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Birth Date</label>
                <div class="data"><?= htmlspecialchars($data['birthday'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Age</label>
                <div class="data"><?= htmlspecialchars($data['age'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Address</label>
                <div class="data"><?= htmlspecialchars($data['residential_address'] ?? '-') ?></div>
            </div>
            
            <div class="col-md-4 record-item">
                <label>Guardian's Name</label>
                <div class="data"><?= htmlspecialchars($data['guardian_name'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Guardian's Contact</label>
                <div class="data"><?= htmlspecialchars($data['guardian_contact'] ?? '-') ?></div>
            </div>
        </div>
        <!-- <h5 class="fw-bolder">Emergency Contacts</h5>
        <div class="row">
            <div class="col-md-4 record-item">
                <label>Father's Name</label>
                <div class="data"><?= htmlspecialchars($data['father_name'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Father's Contact</label>
                <div class="data"><?= htmlspecialchars($data['father_contact'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Father's Occupation</label>
                <div class="data"><?= htmlspecialchars($data['father_occupation'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Mother's Name</label>
                <div class="data"><?= htmlspecialchars($data['mother_name'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Mother's Contact</label>
                <div class="data"><?= htmlspecialchars($data['mother_contact'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Mother's Occupation</label>
                <div class="data"><?= htmlspecialchars($data['mother_occupation'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Guardian's Name</label>
                <div class="data"><?= htmlspecialchars($data['guardian_name'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Guardian's Contact</label>
                <div class="data"><?= htmlspecialchars($data['guardian_contact'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Guardian's Occupation</label>
                <div class="data"><?= htmlspecialchars($data['guardian_occupation'] ?? '-') ?></div>
            </div>
        </div> -->
    </div>
    
    <div class="record-section">
    <div class="row align-items-center mb-3">
    <div class="col-12 col-md-6">
        <h5 class="fw-bolder mb-0">Medical Records</h5>
    </div>

    <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center gap-2 mt-2 mt-md-0">
        <input type="text" id="searchInput" placeholder="Search Record Here..." 
            class="form-control rounded-4" style="max-width: 250px;">
        <a href="#" 
            class="btn btn-sm btn-danger rounded-4 d-flex align-items-center px-3 py-2" 
            style="font-weight: 500;"
            data-bs-toggle="offcanvas" 
            data-bs-target="#createRecordOffcanvas"
            data-student-id="<?php echo htmlspecialchars($student_id) ?>"> 
            + Create Record
        </a>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="createRecordOffcanvas" aria-labelledby="createRecordOffcanvasLabel" style="width: 100vw; max-width: 50vw;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="createRecordOffcanvasLabel">Create New Medical Record</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body">
                <form id="medicalForm" action="create_medical.php" method="POST" class="row g-3 needs-validation" novalidate>
                    <input type="hidden" name="medical_id" value="<?php echo uniqid('med_'); ?>">
                    <div class="col-12 mb-0">
                        <label class="form-label d-block fw-semibold">Select Record Type</label>
                        <div class="d-flex justify-content-between gap-2">
                            <input type="radio" class="btn-check record-type-radio" name="record_type" id="type_checkup" value="Check Up" autocomplete="off" required checked>
                            <label class="btn btn-outline-danger w-100 py-3" for="type_checkup">
                                <i class="fas fa-stethoscope d-block mb-1"></i> Check Up
                            </label>

                            <input type="radio" class="btn-check record-type-radio" name="record_type" id="type_medicine" value="Request Medicine" autocomplete="off">
                            <label class="btn btn-outline-danger w-100 py-3" for="type_medicine">
                                <i class="fas fa-pills d-block mb-1"></i> Request Medicine
                            </label>

                            <input type="radio" class="btn-check record-type-radio" name="record_type" id="type_visit" value="Clinic Visit" autocomplete="off">
                            <label class="btn btn-outline-danger w-100 py-3" for="type_visit">
                                <i class="fas fa-user-md d-block mb-1"></i> Clinic Visit
                            </label>
                            <div class="invalid-feedback col-12">Please select a record type.</div>
                        </div>
                    </div>
                    
                    
                    <div class="col-12 row g-3 mb-0 mt-0" id="dynamicFieldsContainer">

                        <div class="col-12 row g-3" id="checkUpFields">
                            <input type="hidden" name="student_id" class="form-control" id="studentID" value="<?= htmlspecialchars($data['student_number'] ?? '-') ?>" readonly>
                    
                            <div class="col-12"><h6 class="fw-semibold fw-semibold mt-2">Vitals & Health Survey</h6></div>

                            <div class="col-md-4">
                                <label for="height" class="form-label">Height (cm)</label>
                                <input type="number" name="height" class="form-control checkup-field" id="height" min="50" max="250">
                                <small class="text-muted">e.g., 160</small>
                                <div class="invalid-feedback">Please enter a valid height between 50 and 250 cm.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control checkup-field" id="weight" min="10" max="200">
                                <small class="text-muted">e.g., 55</small>
                                <div class="invalid-feedback">Please enter a valid weight between 10 and 200 kg.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="bloodPressure" class="form-label">Blood Pressure</label>
                                <input type="text" name="blood_pressure" class="form-control checkup-field" id="bloodPressure" 
                                    placeholder="e.g., 110/70" pattern="^\d{2,3}\/\d{2,3}$">
                                <small class="text-muted">e.g., 110/70</small>
                                <div class="invalid-feedback">Format must be like 120/80.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="temperature" class="form-label">Temperature (°C)</label>
                                <input type="number" step="0.1" name="temperature" class="form-control checkup-field" id="temperature" min="35" max="42">
                                <small class="text-muted">e.g., 36.6</small>
                                <div class="invalid-feedback">Temperature must be between 35°C and 42°C.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="pulse" class="form-label">Pulse (bpm)</label>
                                <input type="number" name="pulse" class="form-control checkup-field" id="pulse" min="40" max="200">
                                <small class="text-muted">e.g., 72</small>
                                <div class="invalid-feedback">Enter a pulse rate between 40 and 200 bpm.</div>
                            </div>

                            <div class="col-md-4">
                                <label for="respiration" class="form-label">Respiration (breaths/min)</label>
                                <input type="number" name="respiration" class="form-control checkup-field" id="respiration" min="10" max="40">
                                <small class="text-muted">e.g., 18</small>
                                <div class="invalid-feedback">Respiration must be between 10 and 40.</div>
                            </div>

                            <?php
                            $checkUpTextFields = [
                                'allergies' => 'Known allergies (e.g., peanuts, pollen)',
                                'medications' => 'Current medications (e.g., supplements)',
                                'conditions' => 'Chronic illnesses / conditions (e.g., asthma)',
                                'recentIllness' => 'Recent illnesses / injuries (past 6 months)',
                                'hospitalizations' => 'Hospitalizations / surgeries',
                                'vision' => 'Vision problems (e.g., uses glasses)',
                                'hearing' => 'Hearing problems (e.g., partial loss)',
                                'dental' => 'Dental issues (e.g., braces)',
                                'activity' => 'Physical activity (hours/week)',
                                'sleep' => 'Sleep (hours/night)',
                                'diet' => 'Dietary habits / restrictions',
                                'mentalHealth' => 'Mental health concerns',
                            ];
                            ?>

                            <?php foreach ($checkUpTextFields as $id => $label): ?>
                                <div class="col-md-4">
                                    <label for="<?= $id ?>" class="form-label"><?= $label ?></label>
                                    <?php if (in_array($id, ['conditions', 'recentIllness', 'hospitalizations', 'mentalHealth'])): ?>
                                        <textarea name="<?= $id ?>" id="<?= $id ?>" class="form-control checkup-field" rows="2"></textarea>
                                    <?php else: ?>
                                        <input type="text" name="<?= $id ?>" id="<?= $id ?>" class="form-control checkup-field">
                                    <?php endif; ?>
                                    <div class="invalid-feedback">This field is required for Check Up.</div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-12 row g-3" id="medicineFields" style="display: none;">
                            <div class="col-12"><h6 class="fw-semibold mt-2">Medicine Request Details</h6></div>
                            
                            <div class="col-md-6">
                                <label for="medicine_requested" class="form-label">Medicine Requested</label>
                                <input type="text" name="medicine_requested" id="medicine_requested" class="form-control medicine-field">
                                <div class="invalid-feedback">This field is required for Medicine Request.</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="medicine_used" class="form-label">Medicine Used</label>
                                <input type="text" name="medicine_used" id="medicine_used" class="form-control medicine-field">
                                <div class="invalid-feedback">This field is required for Medicine Request.</div>
                            </div>
                        </div>
                        <div class="col-12 row g-3" id="visitFields" style="display: none;">
                            <div class="col-12"><h6 class="fw-semibold mt-2">Clinic Visit Details</h6></div>
                            
                            <div class="col-md-12">
                                <label for="reason_for_visit" class="form-label">Reason for Visit</label>
                                <textarea name="reason_for_visit" id="reason_for_visit" class="form-control visit-field" rows="3"></textarea>
                                <div class="invalid-feedback">This field is required for Clinic Visit.</div>
                            </div>
                        </div>
                        </div>
                    <div class="col-12"><h6 class="fw-semibold fw-semibold mt-2">General Record Details</h6></div>
                    
                    <div class="col-md-6 mb-0 mt-0">
                        <label for="additional_notes" class="form-label">Additional Notes</label>
                        <textarea name="additional_notes" id="additional_notes" class="form-control common-field" rows="2" required></textarea>
                        <div class="invalid-feedback">Additional Notes are required.</div>
                    </div>

                    <div class="col-md-6 mb-0 mt-0">
                        <label for="nurse_incharge" class="form-label">School Nurse Incharge</label>
                        <input type="text" name="nurse_incharge" id="nurse_incharge" value="<?= htmlspecialchars($full_name) ?>" disabled class="form-control common-field" required>
                        <div class="invalid-feedback">Nurse in charge is required.</div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-danger rounded-4">Save Record</button>
                        <button type="button" class="btn btn-outline-danger rounded-4" data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const createRecordOffcanvas = document.getElementById('createRecordOffcanvas');
                const medicalForm = document.getElementById('medicalForm');
                const recordTypeRadios = document.querySelectorAll('.record-type-radio');

                const checkUpFields = document.getElementById('checkUpFields');
                const medicineFields = document.getElementById('medicineFields');
                const visitFields = document.getElementById('visitFields');

                // --- Core Logic: Show/Hide Fields and Manage Required Attributes ---
                const toggleFields = (selectedType) => {
                    // Define all field groups and their corresponding container
                    const fieldGroups = {
                        'Check Up': { container: checkUpFields, selector: '.checkup-field' },
                        'Request Medicine': { container: medicineFields, selector: '.medicine-field' },
                        'Clinic Visit': { container: visitFields, selector: '.visit-field' }
                    };

                    Object.keys(fieldGroups).forEach(type => {
                        const { container, selector } = fieldGroups[type];
                        const fields = container.querySelectorAll(selector);

                        if (type === selectedType) {
                            // Show container and set fields as required/enabled
                            container.style.display = 'flex';
                            container.classList.add('row'); // Re-add row class for grid
                            fields.forEach(field => field.setAttribute('required', 'required'));
                        } else {
                            // Hide container and remove required/disabled attributes
                            container.style.display = 'none';
                            container.classList.remove('row');
                            fields.forEach(field => {
                                field.removeAttribute('required');
                                field.classList.remove('is-invalid', 'is-valid'); // Clear validation state when hidden
                            });
                        }
                    });
                    
                    // Re-apply required status to common fields (always visible)
                    document.querySelectorAll('.common-field').forEach(field => field.setAttribute('required', 'required'));
                };


                // --- Event Listeners ---
                
                // 1. Offcanvas Open Listener (Pass student ID & set default form)
                if (createRecordOffcanvas) {
                    createRecordOffcanvas.addEventListener('show.bs.offcanvas', function (event) {
                        const button = event.relatedTarget; 
                        const studentId = button.getAttribute('data-student-id'); 
                        const studentIdInput = createRecordOffcanvas.querySelector('#studentID');
                        const studentIdDisplay = createRecordOffcanvas.querySelector('#studentIdDisplay');
                        
                        if (studentIdInput) {
                            studentIdInput.value = studentId;
                        }
                        
                        if (studentIdDisplay) {
                            studentIdDisplay.textContent = studentId;
                        }

                        // Reset form state on show
                        medicalForm.reset();
                        
                        // FIX: Explicitly set "Check Up" radio button as checked and show/validate fields
                        const defaultRadio = document.getElementById('type_checkup');
                        if (defaultRadio) {
                            defaultRadio.checked = true;
                            toggleFields(defaultRadio.value);
                        }

                        // Ensure the required check on radios is maintained
                        recordTypeRadios.forEach(radio => radio.setAttribute('required', 'required'));
                    });
                }

                // 2. Record Type Change Listener
                recordTypeRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.checked) {
                            toggleFields(this.value);
                        }
                    });
                });

                // 3. Form Validation Logic
                if (medicalForm) {
                    const validateField = (field) => {
                        // Determine if the field's container is visible (Check Up, Medicine, or Visit container)
                        const parentContainer = field.closest('.col-12.row.g-3');
                        const isVisible = !parentContainer || parentContainer.style.display !== 'none';
                        
                        // Only validate if required AND visible
                        if (field.hasAttribute('required') && isVisible) {
                            if (!field.checkValidity()) {
                                field.classList.remove('is-valid');
                                field.classList.add('is-invalid');
                                return false;
                            }
                        }

                        // Clear validation state if not required or valid
                        field.classList.remove('is-invalid');
                        if (field.value.trim() !== '') {
                            field.classList.add('is-valid');
                        } else {
                            field.classList.remove('is-valid');
                        }
                        return true;
                    };

                    // Realtime validation
                    medicalForm.querySelectorAll('input:not([type="hidden"]), textarea').forEach(field => {
                        field.addEventListener('input', () => validateField(field));
                        // Also run validation when a radio button is clicked (to clear fields that become hidden)
                        field.addEventListener('change', () => validateField(field));
                    });

                    // Prevent submit if invalid
                    medicalForm.addEventListener('submit', function(e) {
                        let valid = true;
                        
                        // Check all fields, focusing only on those that are visible or common/required
                        this.querySelectorAll('input:not([type="hidden"]):not([readonly]), textarea').forEach(field => {
                            // Check if common field OR if the field belongs to a visible dynamic group
                            const isCommon = field.classList.contains('common-field');
                            const parentContainer = field.closest('.col-12.row.g-3');
                            const isVisibleDynamic = parentContainer && parentContainer.style.display !== 'none';
                            
                            if (isCommon || isVisibleDynamic) {
                                if (!validateField(field)) {
                                    valid = false;
                                }
                            }
                        });
                        
                        if (!valid) {
                            e.preventDefault();
                            
                            // Scroll to the first invalid field
                            const firstInvalid = this.querySelector('.is-invalid');
                            if (firstInvalid) {
                                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }
                        
                        medicalForm.classList.add('was-validated');
                    });
                }
            });
        </script>
    </div>
    </div>

    <?php
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $student_id = isset($_GET['student_id']) ? htmlspecialchars($_GET['student_id']) : '';
    ?>

    <?php if ($status == 1 && !empty($student_id)): ?>
    <div class="mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Medical record for <b>Student ID: <?php echo $student_id; ?></b> has been successfully saved.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php elseif ($status == 2 && !empty($student_id)): ?>
    <div class="mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Deleted!</strong> Medical record for <b>Student ID: <?php echo $student_id; ?></b> has been deleted.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>




    <div class="table-responsive">
        <?php
            $student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

            if (empty($student_id)) {
                echo "<div class='alert alert-warning'>No student selected.</div>";
                exit;
            }

            // Fetch all records for this student
            $query = $conn->prepare("SELECT id, medical_id, height, weight, blood_pressure, temperature, notes, created_at FROM student_health_records WHERE student_id = ? ORDER BY created_at DESC");
            $query->bind_param("s", $student_id);
            $query->execute();
            $result = $query->get_result();
            ?>

            <div>
                <table id="medicalRecordsTable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Height (cm)</th>
                            <th>Weight (kg)</th>
                            <th>Blood Pressure</th>
                            <th>Temperature (°C)</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <tr style="cursor:pointer;" onclick="window.location.href='view_medical_detail.php?medical_id=<?php echo urlencode($row['medical_id']); ?>&student_id=<?php echo urlencode($student_id); ?>'">
                                <td class="text-muted"><?php echo date("Y-m-d", strtotime($row['created_at'])); ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($row['height']); ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($row['weight']); ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($row['blood_pressure']); ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($row['temperature']); ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($row['notes']); ?></td>
                                <td class="text-muted">
                                    <a href="delete_medical.php?id=<?php echo $row['id']; ?>&student_id=<?php echo urlencode($student_id); ?>" class="btn btn-sm" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this record?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr class="no-results">
                                <td colspan="7" class="text-center text-muted">No medical records found.</td>
                            </tr>
                        <?php endif; ?>
                        <!-- Hidden row for search "no results" -->
                        <tr class="no-results-search" style="display:none;">
                            <td colspan="7" class="text-center text-muted">No results found.</td>
                        </tr>
                    </tbody>

                </table>
                <script>
                const searchInput = document.getElementById('searchInput');
                const table = document.getElementById('medicalRecordsTable');
                const tbody = table.getElementsByTagName('tbody')[0];
                const rows = tbody.getElementsByTagName('tr');
                const noResultsRow = tbody.querySelector('.no-results-search');

                searchInput.addEventListener('input', function() {
                    const filter = searchInput.value.toLowerCase();
                    let visibleCount = 0;

                    for (let i = 0; i < rows.length; i++) {
                        // Skip the "no results" row
                        if (rows[i].classList.contains('no-results-search')) continue;

                        let rowText = rows[i].innerText.toLowerCase();
                        if (rowText.indexOf(filter) > -1) {
                            rows[i].style.display = '';
                            visibleCount++;
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }

                    // Show or hide "no results" row
                    if (visibleCount === 0) {
                        noResultsRow.style.display = '';
                    } else {
                        noResultsRow.style.display = 'none';
                    }
                });
                </script>


            </div>

    </div>
</div>

</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
