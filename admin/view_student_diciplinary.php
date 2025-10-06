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
<title>Student Diciplinary Records</title>
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
        <h5 class="fw-bolder">Student Diciplinary Details</h5>
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
    </div>
    
    <div class="record-section">
    <div class="row align-items-center mb-3">
        <div class="col-12 col-md-6">
            <h5 class="fw-bolder mb-0">Disciplinary Records</h5>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-md-end gap-2 mt-2 mt-md-0">
            <input type="text" placeholder="Search Record Here..." class="form-control rounded-4" style="max-width: 250px;">
            <a href="create_diciplinary_record.php?student_id=<?php echo $student_id?>" class="btn btn-sm btn-danger rounded-4">+ Create Record</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Infraction</th>
                    <th>Severity</th>
                    <th>Action Taken</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-muted">2025-09-01</td>
                    <td class="text-muted">Late to Class</td>
                    <td class="text-muted">Minor</td>
                    <td class="text-muted">Verbal Warning</td>
                    <td class="text-muted">First offense, student apologized</td>
                    <td class="text-muted">
                        <button class="btn btn-sm"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">2025-05-15</td>
                    <td class="text-muted">Disruptive Behavior</td>
                    <td class="text-muted">Moderate</td>
                    <td class="text-muted">Parent Meeting</td>
                    <td class="text-muted">Repeated interruptions in class</td>
                    <td class="text-muted">
                        <button class="btn btn-sm"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">2024-11-20</td>
                    <td class="text-muted">Damage to Property</td>
                    <td class="text-muted">Severe</td>
                    <td class="text-muted">Suspension</td>
                    <td class="text-muted">Student responsible for repairing damages</td>
                    <td class="text-muted">
                        <button class="btn btn-sm"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</div>

</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
