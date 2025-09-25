<?php
include 'session_login.php';
include '../db_connection.php';

// Get student number from URL
$student_id = isset($_GET['student_number']) ? trim($_GET['student_number']) : '';
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch student details
$student = null;
if ($student_id !== '') {
    $stmt = $conn->prepare("SELECT * FROM student_information WHERE student_number = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}

// Fetch scholastic records for this student with optional search
$scholastic_records_data = [];
if ($student_id !== '') {
    if ($search_query !== '') {
        // Search by school, district, or division
        $stmt = $conn->prepare("SELECT * FROM scholastic_records 
                                WHERE student_number = ? 
                                AND (school LIKE CONCAT('%', ?, '%') 
                                    OR district LIKE CONCAT('%', ?, '%') 
                                    OR division LIKE CONCAT('%', ?, '%'))");
        $stmt->bind_param("ssss", $student_id, $search_query, $search_query, $search_query);
    } else {
        $stmt = $conn->prepare("SELECT * FROM scholastic_records WHERE student_number = ?");
        $stmt->bind_param("s", $student_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $scholastic_records_data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>AcadeSys - Student Information</title>
<?php include 'header.php'; ?>
<style>
/* Force container to use full width for print */
@media print {
    .container, .container-fluid, .mb-4 {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }
}
</style>
</head>
<body>
<div class="d-flex flex-row bg-white">
<?php include 'navigation.php'; ?>

<div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="my-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="rounded p-3">
                    <!-- Centered Header for Print -->
                    <div class="d-none d-print-flex justify-content-center w-100 mb-4">
                        <div class="text-center">
                            <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px; width: auto;" class="mb-2">
                            <h5 class="fw-bold mb-1">The Cardinal Academy, Inc.</h5>
                            <small class="d-block">Sullera Street in Pandayan, Meycauayan, Bulacan</small>
                            <small class="d-block">Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
                        </div>
                    </div>

                    <!-- Header and Search -->
                    <div class="row mb-4">
                        <div class="col-12 col-md-11 d-print-none">
                            <h4>Student Scholastic Record</h4>
                        </div>
                        <div class="col-12 col-md-1 d-print-none">
                        
                            <?php 
                                $aid = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                ?>

                                <form action="check_student.php" method="POST" class="d-inline">
                                    <input type="hidden" name="admission_id" value="<?= $aid; ?>">
                                    <button type="submit" class="btn mb-4 text-muted border rounded rounded-4 mt-3">
                                        <i class="fas fa-arrow-left me-1"></i> Back
                                    </button>
                                </form>
                        </div>
                    </div>

                    <?php if ($student): ?>
                    <!-- Learner's Personal Info -->
                    <div class="mb-4">
                        <div class="text-center text-light py-2" style="background-color: #b72029;">
                            <h5 class="mb-0">Learner's Personal Information</h5>
                        </div>
                        <div class="pt-4">
                            <div class="row align-items-center">
                                <?php 
                                $info_fields = [
                                    'Student Number' => 'student_number',
                                    'Full Name' => function($student) {
                                        $parts = [
                                            $student['firstname'] ?? '',
                                            $student['middlename'] ?? '',
                                            $student['lastname'] ?? ''
                                        ];
                                        return htmlspecialchars(implode(' ', array_filter($parts))) ?: '-';
                                    },
                                    'LRN' => 'lrn',
                                    'Gender' => 'gender',
                                    'Date of Birth' => 'birthday',
                                    'Address' => function($student) {
                                        $parts = [
                                            $student['residential_address'] ?? '',
                                            $student['barangay'] ?? '',
                                            $student['municipal'] ?? '',
                                            $student['province'] ?? ''
                                        ];
                                        return htmlspecialchars(implode(', ', array_filter($parts))) ?: '-';
                                    }
                                ];

                                foreach ($info_fields as $label => $field): ?>
                                    <div class="col-12 col-md-6">
                                        <p class="text-muted mb-1"><?= $label ?></p>
                                        <h6 class="fw-bold">
                                            <?php 
                                            echo is_callable($field) ? $field($student) : htmlspecialchars($student[$field] ?? '-');
                                            ?>
                                        </h6>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Scholastic Records -->
                    <div class="mb-4">
                        <div class="text-center text-light py-2" style="background-color: #b72029;">
                            <h5 class="mb-0">Scholastic Record</h5>
                        </div>

                        <div class="row mt-4 scholastic-records" style="font-size: 12px;">
                                <?php if(!empty($scholastic_records_data)): ?>
                                    <?php foreach($scholastic_records_data as $record_data): 
                                        $records = json_decode($record_data['scholastic_json'] ?? '[]', true);
                                    ?>
                                        <div class="col-12 col-md-6">
                                            <div class="border-4 border border-dark mb-4">
                                                <div class="row gx-3 gy-2 m-3">
                                                    <div class="col-12 col-md-8">
                                                        <p class="text-muted mb-0 small">School</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['school']) ?></h6>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p class="text-muted mb-0 small">School ID</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['school_id']) ?></h6>
                                                    </div>
                                                </div>
                                                <div class="row border-top gx-3 gy-2 mt-0 m-3">
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-muted mb-0 small">District</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['district']) ?></h6>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-muted mb-0 small">Division</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['division']) ?></h6>
                                                    </div>
                                                </div>
                                                <div class="row border-top gx-3 gy-2 mt-0 m-3">
                                                    <div class="col-12 col-md-4">
                                                        <p class="text-muted mb-0 small">Region</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['region']) ?></h6>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p class="text-muted mb-0 small">Classified</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['classified_grade']) ?></h6>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <p class="text-muted mb-0 small">Section</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['section']) ?></h6>
                                                    </div>
                                                </div>
                                                <div class="row border-top gx-3 gy-2 mt-0 m-3">
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-muted mb-0 small">School Year</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['school_year']) ?></h6>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-muted mb-0 small">Adviser/Teacher</p>
                                                        <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($record_data['adviser_name']) ?></h6>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center align-middle" style="font-size:12px;">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Subject</th>
                                                                <th>Q1</th>
                                                                <th>Q2</th>
                                                                <th>Q3</th>
                                                                <th>Q4</th>
                                                                <th>Final Rating</th>
                                                                <th>Remarks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(!empty($records)): ?>
                                                                <?php foreach($records as $rec): ?>
                                                                    <tr>
                                                                        <td><?= htmlspecialchars($rec['subject'] ?? '-') ?></td>
                                                                        <td><?= htmlspecialchars($rec['q1'] ?? '-') ?></td>
                                                                        <td><?= htmlspecialchars($rec['q2'] ?? '-') ?></td>
                                                                        <td><?= htmlspecialchars($rec['q3'] ?? '-') ?></td>
                                                                        <td><?= htmlspecialchars($rec['q4'] ?? '-') ?></td>
                                                                        <td><?= htmlspecialchars($rec['final_rating'] ?? '-') ?></td>
                                                                        <td><?= htmlspecialchars($rec['remarks'] ?? '-') ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <tr><td colspan="7">No records found.</td></tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="row p-3">
                                                    <div class="col-12 col-md-8">
                                                        <p class="text-muted mb-1">General Average</p>
                                                        <h6 class="fw-bold"><?= htmlspecialchars($record_data['general_average'] ?? '-') ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12">
                                        <div class="alert alert-warning">No records found for this student number or search query.</div>
                                    </div>
                                <?php endif; ?>
                            </div>

                    </div>

                    <?php else: ?>
                        <div class="alert alert-warning">Student not found.</div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
