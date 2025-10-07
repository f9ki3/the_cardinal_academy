<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Disciplinary Records</title>
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
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
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
    background-color: #F1F3F6;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #FAFAFA;
}
.table th {
    font-weight: 600;
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

    <!-- Disciplinary Records Section -->
    <div class="record-section">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-6">
                <h5 class="fw-bolder mb-0">Disciplinary Records</h5>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center gap-2 mt-2 mt-md-0">
                <input type="text" id="searchInput" placeholder="Search Record Here..." 
                    class="form-control rounded-4" style="max-width: 250px;">

                <a href="create_diciplinary_record.php?student_id=<?php echo $student_id ?>" 
                class="btn btn-sm btn-danger rounded-4 d-flex align-items-center px-3 py-2" 
                style="font-weight: 500;">
                + Create Record
                </a>
            </div>
        </div>

        <?php
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $student_id = isset($_GET['student_id']) ? htmlspecialchars($_GET['student_id']) : '';
        ?>

        <?php if ($status == 1 && !empty($student_id)): ?>
        <div class="mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Diciplinary record for <b>Student ID: <?php echo $student_id; ?></b> has been successfully saved.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php elseif ($status == 2 && !empty($student_id)): ?>
        <div class="mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Deleted!</strong> Diciplinary record for <b>Student ID: <?php echo $student_id; ?></b> has been deleted.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>

        <div class="table-responsive">
        <?php
        if (empty($student_id)) {
            echo "<div class='alert alert-warning'>No student selected.</div>";
            exit;
        }

        $stmt = $conn->prepare("SELECT * FROM student_disciplinary_records WHERE student_id = ? ORDER BY incident_date DESC");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <table id="disciplinaryTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Disciplinary ID</th>
                    <th>Date of Incident</th>
                    <th>Violation Type</th>
                    <th>Action Taken</th>
                    <th>Notes / Remarks</th>
                    <th>Witnesses</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr style="cursor:pointer;" onclick="window.location.href='view_disciplinary_detail.php?disciplinary_id=<?php echo urlencode($row['disciplinary_id']); ?>&student_id=<?php echo urlencode($student_id); ?>'">
                        <td class="text-muted"><?php echo htmlspecialchars($row['disciplinary_id']); ?></td>
                        <td class="text-muted"><?php echo htmlspecialchars($row['incident_date']); ?></td>
                        <td class="text-muted"><?php echo htmlspecialchars($row['violation_type']); ?></td>
                        <td class="text-muted"><?php echo htmlspecialchars($row['disciplinary_action']); ?></td>
                        <td class="text-muted"><?php echo htmlspecialchars($row['remarks']); ?></td>
                        <td class="text-muted"><?php echo htmlspecialchars($row['witnesses']); ?></td>
                        <td class="text-muted">
                            <a href="delete_disciplinary.php?disciplinary_id=<?php echo $row['disciplinary_id']; ?>&student_id=<?php echo urlencode($student_id); ?>" class="btn btn-sm" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this record?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr class="no-results">
                        <td colspan="7" class="text-center text-muted">No disciplinary records found.</td>
                    </tr>
                <?php endif; ?>
                <tr class="no-results-search" style="display:none;">
                    <td colspan="7" class="text-center text-muted">No results found.</td>
                </tr>
            </tbody>
        </table>

        <script>
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('disciplinaryTable');
        const tbody = table.getElementsByTagName('tbody')[0];
        const rows = tbody.getElementsByTagName('tr');
        const noResultsRow = tbody.querySelector('.no-results-search');

        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            let visibleCount = 0;

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

            noResultsRow.style.display = (visibleCount === 0) ? '' : 'none';
        });
        </script>

        </div>
    </div>

</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
