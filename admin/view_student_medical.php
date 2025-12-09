<?php 
// ---------------------------------------------------------------------
// --- FIX 1: Add Output Buffering and Error Suppression at the top ---
// ---------------------------------------------------------------------
ob_start(); // Start output buffering immediately
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING); // Suppress minor errors in includes if necessary

include 'session_login.php'; 
include '../db_connection.php'; 

// --- Configuration: Define fields for dynamic use in View Offcanvas ---
$checkUpTextFields = [
    'height' => 'Height (cm)',
    'weight' => 'Weight (kg)',
    'blood_pressure' => 'Blood Pressure',
    'temperature' => 'Temperature (°C)',
    'pulse' => 'Pulse (bpm)',
    'respiration' => 'Respiration (breaths/min)',
    'allergies' => 'Known allergies',
    'medications' => 'Current medications',
    'conditions' => 'Chronic illnesses / conditions',
    'recentIllness' => 'Recent illnesses / injuries',
    'hospitalizations' => 'Hospitalizations / surgeries',
    'vision' => 'Vision problems',
    'hearing' => 'Hearing problems',
    'dental' => 'Dental issues',
    'activity' => 'Physical activity (hours/week)',
    'sleep' => 'Sleep (hours/night)',
    'diet' => 'Dietary habits / restrictions',
    'mentalHealth' => 'Mental health concerns',
];

// ---------------------------------------------------------------------
// --- AJAX ENDPOINT LOGIC (Replaces fetch_medical_record.php) ---
// ---------------------------------------------------------------------

if (isset($_GET['action']) && $_GET['action'] === 'fetch_record_details') {
    // Clear any potentially buffered output (like errors from includes)
    ob_clean(); 
    
    header('Content-Type: application/json');

    $medical_id = isset($_GET['medical_id']) ? trim($_GET['medical_id']) : '';
    $student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

    if (empty($medical_id) || empty($student_id)) {
        echo json_encode(['error' => 'Missing required IDs.']);
        exit;
    }

    $query = "SELECT * FROM student_health_records WHERE medical_id = ? AND student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $medical_id, $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();

    if ($record) {
        if (isset($record['created_at'])) {
            $record['created_at'] = date("Y-m-d H:i:s", strtotime($record['created_at']));
        }
        echo json_encode($record);
    } else {
        echo json_encode(['error' => 'Record not found.']);
    }
    exit; // Stop further HTML execution
}

// ---------------------------------------------------------------------
// --- HTML PAGE GENERATION LOGIC (Default behavior) ---
// ---------------------------------------------------------------------

// --- Flush buffer *after* all includes are done if we are continuing to HTML ---
ob_end_flush(); 

// --- Fetch Student Information ---
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
.data-display {
    padding: 0.5rem;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    background-color: #f8f9fa;
    white-space: pre-wrap; /* Preserve line breaks in notes/textarea fields */
    min-height: 40px;
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
                    <input type="hidden" name="medical_id" value=""> 
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

                            <?php foreach ($checkUpTextFields as $id => $label): ?>
                                <?php 
                                // Skip fields already defined above (vitals)
                                if (in_array($id, ['height', 'weight', 'blood_pressure', 'temperature', 'pulse', 'respiration'])) continue;
                                ?>
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
                        <input type="text" name="nurse_incharge" id="nurse_incharge" value="<?= htmlspecialchars($full_name) ?>" readonly class="form-control common-field" required>
                        <div class="invalid-feedback">Nurse in charge is required.</div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-danger rounded-4">Save Record</button>
                        <button type="button" class="btn btn-outline-danger rounded-4" data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="viewRecordOffcanvas" aria-labelledby="viewRecordOffcanvasLabel" style="width: 100vw; max-width: 50vw;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="viewRecordOffcanvasLabel">Viewing Record: <span id="view_medical_id_header" class="text-danger"></span></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body">
            <div id="viewLoader" class="text-center p-5" style="display:none;"><div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div></div>
            
            <div id="viewContent" style="display: none;">
                
                <div class="mb-4">
                    <h6 class="fw-bold mt-2 border-bottom pb-2">General Record Details</h6>
                    <div class="row">
                        <div class="col-md-4 record-item"><label>Student ID</label><div class="data data-display" id="view_student_id"></div></div>
                        <div class="col-md-4 record-item"><label>Record Date</label><div class="data data-display" id="view_created_at"></div></div>
                        <div class="col-md-4 record-item"><label>Record Type</label><div class="data data-display" id="view_record_type"></div></div>
                        <div class="col-md-6 record-item"><label>Nurse Incharge</label><div class="data data-display" id="view_nurse_incharge"></div></div>
                    </div>
                </div>

                <div id="view_checkUpFields">
                    <h6 class="fw-bold mt-2 border-bottom pb-2">Vitals & Health Survey</h6>
                    <div class="row">
                        <div class="col-md-4 record-item"><label>Height (cm)</label><div class="data data-display" data-field="height"></div></div>
                        <div class="col-md-4 record-item"><label>Weight (kg)</label><div class="data data-display" data-field="weight"></div></div>
                        <div class="col-md-4 record-item"><label>Blood Pressure</label><div class="data data-display" data-field="blood_pressure"></div></div>
                        <div class="col-md-4 record-item"><label>Temperature (°C)</label><div class="data data-display" data-field="temperature"></div></div>
                        <div class="col-md-4 record-item"><label>Pulse (bpm)</label><div class="data data-display" data-field="pulse"></div></div>
                        <div class="col-md-4 record-item"><label>Respiration (breaths/min)</label><div class="data data-display" data-field="respiration"></div></div>
                        
                        <?php 
                        // Map form IDs to DB columns
                        $db_friendly_fields = [
                            'allergies', 'medications', 'conditions', 'recentIllness', 'hospitalizations', 
                            'vision', 'hearing', 'dental', 'activity', 'sleep', 'diet', 'mentalHealth'
                        ];
                        
                        foreach ($checkUpTextFields as $id => $label): 
                            $db_col = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $id));
                            if(in_array($db_col, $db_friendly_fields)):
                        ?>
                            <div class="col-md-4 record-item">
                                <label><?= $label ?></label>
                                <div class="data data-display" data-field="<?= $db_col ?>"></div>
                            </div>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
                
                <div id="view_medicineFields" style="display: none;">
                    <h6 class="fw-bold mt-2 border-bottom pb-2">Medicine Request Details</h6>
                    <div class="row">
                        <div class="col-md-6 record-item"><label>Medicine Requested</label><div class="data data-display" data-field="medecine_request"></div></div>
                        <div class="col-md-6 record-item"><label>Medicine Used</label><div class="data data-display" data-field="medecine_used"></div></div>
                    </div>
                </div>

                <div id="view_visitFields" style="display: none;">
                    <h6 class="fw-bold mt-2 border-bottom pb-2">Clinic Visit Details</h6>
                    <div class="row">
                        <div class="col-12 record-item"><label>Reason for Visit</label><div class="data data-display" data-field="reasons"></div></div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h6 class="fw-bold mt-2 border-bottom pb-2">Notes</h6>
                    <div class="col-12 record-item"><label>Additional Notes</label><div class="data data-display" id="view_additional_notes"></div></div>
                </div>

                <div class="col-12 mt-4">
                    <a href="#" id="view_delete_link" class="btn btn-danger rounded-4">Delete Record</a>
                    <button type="button" class="btn btn-outline-danger rounded-4" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $student_id_param = isset($_GET['student_id']) ? htmlspecialchars($_GET['student_id']) : '';
    ?>

    <?php if ($status == 1 && !empty($student_id_param)): ?>
    <div class="mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Medical record for <b>Student ID: <?php echo $student_id_param; ?></b> has been successfully saved.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php elseif ($status == 2 && !empty($student_id_param)): ?>
    <div class="mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Deleted!</strong> Medical record for <b>Student ID: <?php echo $student_id_param; ?></b> has been deleted.
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
        $query = $conn->prepare("SELECT id, medical_id, created_at, types, general_note FROM student_health_records WHERE student_id = ? ORDER BY created_at DESC");
        $query->bind_param("s", $student_id);
        $query->execute();
        $result = $query->get_result();
        ?>

        <div>
            <table id="medicalRecordsTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="20%">Medical ID</th>
                        <th width="20%">Date</th>
                        <th width="20%">Type</th>
                        <th width="30%">Notes</th>
                        <th width="5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr style="cursor:pointer;" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#viewRecordOffcanvas"
                            data-medical-id="<?php echo htmlspecialchars($row['medical_id']); ?>"
                            data-student-id="<?php echo htmlspecialchars($student_id); ?>">
                            
                            <td class="text-muted"><?php echo htmlspecialchars($row['medical_id']); ?></td>
                            
                            <td class="text-muted"><?php echo date("Y-m-d", strtotime($row['created_at'])); ?></td>
                            
                            <td class="text-muted"><?php echo htmlspecialchars($row['types']); ?></td>
                            
                            <td class="text-muted text-truncate" style="max-width: 200px;" title="<?php echo htmlspecialchars($row['general_note']); ?>">
                                <?php echo htmlspecialchars(substr($row['general_note'], 0, 50)) . (strlen($row['general_note']) > 50 ? '...' : ''); ?>
                            </td>
                            
                            <td class="text-muted">
                                <a href="delete_medical.php?id=<?php echo $row['id']; ?>&student_id=<?php echo urlencode($student_id); ?>" class="btn btn-sm" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this record?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr class="no-results">
                            <td colspan="5" class="text-center text-muted">No medical records found.</td>
                        </tr>
                    <?php endif; ?>
                    <tr class="no-results-search" style="display:none;">
                        <td colspan="5" class="text-center text-muted">No results found.</td>
                    </tr>
                </tbody>

            </table>
            <script>
            
            // --- Helper function to populate data or default N/A ---
            const populateField = (container, fieldName, value) => {
                let displayValue = (value === null || value === '' || value === '0' || value === '0.0') ? 'N/A' : value;
                
                let element = container.querySelector(`[data-field="${fieldName}"]`);
                if (element) {
                    element.textContent = displayValue;
                    element.classList.toggle('text-muted', displayValue === 'N/A');
                    element.classList.toggle('fst-italic', displayValue === 'N/A');
                } else {
                    let elementById = container.querySelector(`#view_${fieldName}`);
                    if (elementById) {
                        elementById.textContent = displayValue;
                        elementById.classList.toggle('text-muted', displayValue === 'N/A');
                        elementById.classList.toggle('fst-italic', displayValue === 'N/A');
                    }
                }
            };
            
            // --- AJAX Function to Fetch Data ---
            const fetchRecordDetails = (medicalId, studentId) => {
                const loader = document.getElementById('viewLoader');
                const content = document.getElementById('viewContent');
                
                loader.style.display = 'block';
                content.style.display = 'none';

                // URL now includes action=fetch_record_details to hit the PHP block at the top
                fetch(`view_student_medical.php?action=fetch_record_details&medical_id=${medicalId}&student_id=${studentId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Server returned an error:', data.error);
                            alert('Error fetching record: ' + data.error);
                            return;
                        }
                        
                        // Populate General Info
                        document.getElementById('view_medical_id_header').textContent = data.medical_id;
                        populateField(content, 'student_id', data.student_id);
                        populateField(content, 'created_at', data.created_at);
                        populateField(content, 'record_type', data.types); 
                        populateField(content, 'nurse_incharge', data.nurse); 
                        populateField(content, 'additional_notes', data.general_note);

                        // Dynamic Fields based on Type
                        const type = data.types;
                        const checkUpContainer = document.getElementById('view_checkUpFields');
                        const medicineContainer = document.getElementById('view_medicineFields');
                        const visitContainer = document.getElementById('view_visitFields');
                        
                        checkUpContainer.style.display = 'none';
                        medicineContainer.style.display = 'none';
                        visitContainer.style.display = 'none';
                        
                        let currentContainer;
                        if (type === 'Check Up') {
                            currentContainer = checkUpContainer;
                        } else if (type === 'Request Medicine') {
                            currentContainer = medicineContainer;
                        } else if (type === 'Clinic Visit') {
                            currentContainer = visitContainer;
                        }

                        if (currentContainer) {
                            currentContainer.style.display = 'block';
                            
                            // Populate all fields within the visible container using data-field attribute
                            currentContainer.querySelectorAll('[data-field]').forEach(el => {
                                const fieldName = el.getAttribute('data-field');
                                populateField(currentContainer, fieldName, data[fieldName]);
                            });
                        }
                        
                        // Set Delete Link (using the database 'id')
                        const deleteLink = document.getElementById('view_delete_link');
                        deleteLink.href = `delete_medical.php?id=${data.id}&student_id=${studentId}`;
                        deleteLink.onclick = (e) => {
                            e.stopPropagation(); 
                            return confirm(`Are you sure you want to delete the record ${data.medical_id}?`);
                        };

                        loader.style.display = 'none';
                        content.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        // This is the line that will now handle the SyntaxError if it persists
                        loader.style.display = 'none';
                        content.innerHTML = `<div class="alert alert-danger">Failed to load record details. Please check server logs for PHP errors. Error: ${error.message}</div>`;
                        content.style.display = 'block';
                    });
            };

            document.addEventListener('DOMContentLoaded', function() {
                
                // --- CREATE RECORD LOGIC (Form visibility and validation) ---
                const createRecordOffcanvas = document.getElementById('createRecordOffcanvas');
                const medicalForm = document.getElementById('medicalForm');
                const recordTypeRadios = document.querySelectorAll('.record-type-radio');
                const checkUpFields = document.getElementById('checkUpFields');
                const medicineFields = document.getElementById('medicineFields');
                const visitFields = document.getElementById('visitFields');

                const toggleFields = (selectedType) => {
                    const fieldGroups = {
                        'Check Up': { container: checkUpFields, selector: '.checkup-field' },
                        'Request Medicine': { container: medicineFields, selector: '.medicine-field' },
                        'Clinic Visit': { container: visitFields, selector: '.visit-field' }
                    };

                    Object.keys(fieldGroups).forEach(type => {
                        const { container, selector } = fieldGroups[type];
                        const fields = container.querySelectorAll(selector);

                        if (type === selectedType) {
                            container.style.display = 'flex';
                            container.classList.add('row'); 
                            fields.forEach(field => field.setAttribute('required', 'required'));
                        } else {
                            container.style.display = 'none';
                            container.classList.remove('row');
                            fields.forEach(field => {
                                field.removeAttribute('required');
                                field.classList.remove('is-invalid', 'is-valid'); 
                            });
                        }
                    });
                    
                    document.querySelectorAll('.common-field').forEach(field => field.setAttribute('required', 'required'));
                };

                if (createRecordOffcanvas) {
                    createRecordOffcanvas.addEventListener('show.bs.offcanvas', function (event) {
                        const button = event.relatedTarget; 
                        const studentId = button.getAttribute('data-student-id'); 
                        const studentIdInput = createRecordOffcanvas.querySelector('#studentID');
                        
                        if (studentIdInput) {
                            studentIdInput.value = studentId;
                        }
                        
                        medicalForm.reset();
                        const defaultRadio = document.getElementById('type_checkup');
                        if (defaultRadio) {
                            defaultRadio.checked = true;
                            toggleFields(defaultRadio.value);
                        }
                        recordTypeRadios.forEach(radio => radio.setAttribute('required', 'required'));
                        medicalForm.classList.remove('was-validated');
                        medicalForm.querySelectorAll('.is-invalid, .is-valid').forEach(el => el.classList.remove('is-invalid', 'is-valid'));
                    });
                }
                recordTypeRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.checked) {
                            toggleFields(this.value);
                        }
                    });
                });
                
                // Form Validation Logic
                if (medicalForm) {
                    const validateField = (field) => {
                        const parentContainer = field.closest('.col-12.row.g-3');
                        const isVisible = !parentContainer || parentContainer.style.display !== 'none';
                        
                        if (field.hasAttribute('required') && isVisible) {
                            if (!field.checkValidity()) {
                                field.classList.remove('is-valid');
                                field.classList.add('is-invalid');
                                return false;
                            }
                        }
                        field.classList.remove('is-invalid');
                        if (field.value.trim() !== '') {
                            field.classList.add('is-valid');
                        } else {
                            field.classList.remove('is-valid');
                        }
                        return true;
                    };
                    medicalForm.querySelectorAll('input:not([type="hidden"]), textarea').forEach(field => {
                        field.addEventListener('input', () => validateField(field));
                        field.addEventListener('change', () => validateField(field));
                    });
                    medicalForm.addEventListener('submit', function(e) {
                        let valid = true;
                        this.querySelectorAll('input:not([type="hidden"]):not([readonly]), textarea').forEach(field => {
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
                            const firstInvalid = this.querySelector('.is-invalid');
                            if (firstInvalid) {
                                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }
                        medicalForm.classList.add('was-validated');
                    });
                }
                
                
                // --- VIEW DETAILS LOGIC (AJAX trigger) ---
                const viewRecordOffcanvas = document.getElementById('viewRecordOffcanvas');
                if (viewRecordOffcanvas) {
                    viewRecordOffcanvas.addEventListener('show.bs.offcanvas', function (event) {
                        const triggerRow = event.relatedTarget; 
                        const medicalId = triggerRow.getAttribute('data-medical-id'); 
                        const studentId = triggerRow.getAttribute('data-student-id'); 
                        
                        if (medicalId && studentId) {
                            fetchRecordDetails(medicalId, studentId);
                        }
                    });
                }
                
                // --- TABLE SEARCH LOGIC ---
                const searchInput = document.getElementById('searchInput');
                const table = document.getElementById('medicalRecordsTable');
                const tbody = table.getElementsByTagName('tbody')[0];
                const rows = tbody.getElementsByTagName('tr');
                const noResultsRow = tbody.querySelector('.no-results-search');

                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const filter = searchInput.value.toLowerCase();
                        let visibleCount = 0;
                        
                        const defaultNoResults = tbody.querySelector('.no-results');
                        if (defaultNoResults) defaultNoResults.style.display = 'none';

                        for (let i = 0; i < rows.length; i++) {
                            if (rows[i].classList.contains('no-results-search')) continue;
                            
                            let rowText = rows[i].innerText.toLowerCase();
                            if (rowText.indexOf(filter) > -1) {
                                rows[i].style.display = '';
                                visibleCount++;
                            } else {
                                rows[i].style.display = 'none';
                            }
                        }

                        if (visibleCount === 0) {
                            noResultsRow.style.display = '';
                        } else {
                            noResultsRow.style.display = 'none';
                        }
                    });
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