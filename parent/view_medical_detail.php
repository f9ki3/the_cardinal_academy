<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';
$medical_id = isset($_GET['medical_id']) ? trim($_GET['medical_id']) : '';

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

$record = [];
if ($medical_id) {
    $stmt = $conn->prepare("SELECT * FROM student_health_records WHERE medical_id = ? AND student_id = ?");
    $stmt->bind_param("ss", $medical_id, $student_id);
    $stmt->execute();
    $record = $stmt->get_result()->fetch_assoc();
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

<div class=" pt-3">

    <div class="d-none pt-5 d-print-flex justify-content-center">
        <div class="d-flex align-items-center mb-4">
            <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px; width: auto;" class="me-3">
            <div>
            <h5 class="mb-0 fw-bold text-center">The Cardinal Academy, Inc.</h5>
            <small class="d-block text-center">Sullera Street in Pandayan, Meycauayan, Bulacan </small>
            <small class="d-block text-center">Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
            </div>
        </div>
        </div>
        

        <div class="d-none d-print-flex justify-content-center">
        <h3>Student Medical Records</h3>
    </div>
    <!-- Student Details -->
    <div class="record-section">
        <div class="d-flex flex-row justify-content-between">
            <h5 class="fw-bolder">Student Details</h5>
            <div class="col-md-8 d-flex flex-wrap gap-2 justify-content-md-end d-print-none">
                <button class="btn btn-sm border text-muted rounded-4" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print
                </button>
                <button class="btn btn-sm border text-muted rounded-4" 
                        onclick="window.location.href='medical.php?student_id=<?= urlencode($student_id) ?>'">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </button>

            </div>
        </div>
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
        </div>
        <hr class="text-muted">
        <h5 class="fw-bolder">Emergency Contacts</h5>
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
        </div>
        <hr class="text-muted">
        <h5 class="fw-bolder">Medical Details</h5>
        <?php if (!empty($record)): ?>
        <div class="row mt-2">
            <div class="col-md-4 record-item">
                <label>Date</label>
                <div class="data"><?= date('Y-m-d', strtotime($record['created_at'])) ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Height (cm)</label>
                <div class="data"><?= htmlspecialchars($record['height']) ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Weight (kg)</label>
                <div class="data"><?= htmlspecialchars($record['weight']) ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Blood Pressure</label>
                <div class="data"><?= htmlspecialchars($record['blood_pressure']) ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Temperature (°C)</label>
                <div class="data"><?= htmlspecialchars($record['temperature']) ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Pulse</label>
                <div class="data"><?= htmlspecialchars($record['pulse']) ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Respiration</label>
                <div class="data"><?= htmlspecialchars($record['respiration']) ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Allergies</label>
                <div class="data"><?= htmlspecialchars($record['allergies'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Medications</label>
                <div class="data"><?= htmlspecialchars($record['medications'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Conditions</label>
                <div class="data"><?= htmlspecialchars($record['conditions'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Recent Illness</label>
                <div class="data"><?= htmlspecialchars($record['recent_illness'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Hospitalizations</label>
                <div class="data"><?= htmlspecialchars($record['hospitalizations'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Vision</label>
                <div class="data"><?= htmlspecialchars($record['vision'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Hearing</label>
                <div class="data"><?= htmlspecialchars($record['hearing'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Dental</label>
                <div class="data"><?= htmlspecialchars($record['dental'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Activity (hrs/week)</label>
                <div class="data"><?= htmlspecialchars($record['activity'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Sleep (hrs/night)</label>
                <div class="data"><?= htmlspecialchars($record['sleep'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Diet</label>
                <div class="data"><?= htmlspecialchars($record['diet'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Mental Health</label>
                <div class="data"><?= htmlspecialchars($record['mental_health'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Notes</label>
                <div class="data"><?= htmlspecialchars($record['notes'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>General Note</label>
                <div class="data"><?= htmlspecialchars($record['general_note'] ?? '-') ?></div>
            </div>
        </div>
        <?php else: ?>
        <p class="text-muted">Medical record not found for this student.</p>
        <?php endif; ?>

    </div>
    
    
</div>

</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
