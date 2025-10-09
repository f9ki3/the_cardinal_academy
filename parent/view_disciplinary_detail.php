<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';
$disciplinary_id = isset($_GET['disciplinary_id']) ? trim($_GET['disciplinary_id']) : '';

// Fetch student info
$data = [];
if (!empty($student_id)) {
    $query = "SELECT * FROM student_information WHERE student_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

// Fetch disciplinary record
$record = [];
if ($disciplinary_id) {
    $stmt = $conn->prepare("SELECT * FROM student_disciplinary_records WHERE disciplinary_id = ? AND student_id = ?");
    $stmt->bind_param("ss", $disciplinary_id, $student_id);
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
<title>Student Disciplinary Record</title>
<?php include 'header.php'; ?>
<style>
body {
    background-color: #F7F7F7;
    color: #333;
    font-family: 'Segoe UI', sans-serif;
}
.record-card, .record-section {
    background-color: #FFFFFF;
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
}
.record-section h5 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    padding-bottom: 0.25rem;
    color: #2C3E50;
}
.record-item {
    margin-bottom: 1rem;
}
.record-item label {
    display: block;
    font-weight: 600;
    font-size: 0.875rem;
    color: #6C757D;
}
.record-item .data {
    font-size: 0.95rem;
    font-weight: 500;
    color: #2C3E50;
}
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

<div class="pt-3">

    <!-- Header for print -->
    <div class="d-none pt-5 d-print-flex justify-content-center">
        <div class="d-flex align-items-center mb-4">
            <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px; width: auto;" class="me-3">
            <div>
                <h5 class="mb-0 fw-bold text-center">The Cardinal Academy, Inc.</h5>
                <small class="d-block text-center">Sullera Street in Pandayan, Meycauayan, Bulacan</small>
                <small class="d-block text-center">Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
            </div>
        </div>
    </div>

    <div class="d-none d-print-flex justify-content-center">
        <h3>Student Disciplinary Record</h3>
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
                        onclick="window.location.href='disciplinary.php?student_id=<?= urlencode($student_id) ?>'">
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
        <h5 class="fw-bolder">Disciplinary Details</h5>
        <?php if (!empty($record)): ?>
        <div class="row mt-2">
            <div class="col-md-4 record-item"><label>Created At</label><div class="data"><?= htmlspecialchars($record['created_at']) ?></div></div>
            <div class="col-md-4 record-item"><label>Disciplinary ID</label><div class="data"><?= htmlspecialchars($record['disciplinary_id']) ?></div></div>
            <div class="col-md-4 record-item"><label>Student ID</label><div class="data"><?= htmlspecialchars($record['student_id']) ?></div></div>

            <div class="col-md-4 record-item"><label>Incident Date</label><div class="data"><?= htmlspecialchars($record['incident_date']) ?></div></div>
            <div class="col-md-4 record-item"><label>Incident Location</label><div class="data"><?= htmlspecialchars($record['incident_location']) ?></div></div>
            <div class="col-md-4 record-item"><label>Description</label><div class="data"><?= htmlspecialchars($record['incident_description']) ?></div></div>

            <div class="col-md-4 record-item"><label>Violation Type</label><div class="data"><?= htmlspecialchars($record['violation_type']) ?></div></div>
            <div class="col-md-4 record-item"><label>Action Taken</label><div class="data"><?= htmlspecialchars($record['disciplinary_action']) ?></div></div>
            <div class="col-md-4 record-item"><label>Witnesses</label><div class="data"><?= htmlspecialchars($record['witnesses'] ?? '-') ?></div></div>

            <div class="col-md-4 record-item"><label>Remarks</label><div class="data"><?= htmlspecialchars($record['remarks'] ?? '-') ?></div></div>
        </div>
        <?php else: ?>
        <p class="text-muted">Disciplinary record not found for this student.</p>
        <?php endif; ?>
    </div>

</div>

</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
