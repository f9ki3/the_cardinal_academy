<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

$student = [];
$grades = [];
$gwa = 0;
$user_id = null;
$sectionInfo = null;

if (!empty($student_id)) {

    /* 1. GET user_id */
    $sqlUser = "SELECT user_id FROM users WHERE student_number = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("s", $student_id);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();
    $userRow = $resultUser->fetch_assoc();
    $stmtUser->close();

    if ($userRow) {
        $user_id = $userRow['user_id'];
    } else {
        die("User not found.");
    }

    /* 2. FETCH STUDENT INFO */
    $query = "SELECT * FROM users WHERE student_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();

    /* 3. FETCH GRADES */
    $sql = "
        SELECT 
            courses.course_name,
            cs.q1,
            cs.q2,
            cs.q3,
            cs.q4
        FROM course_students cs
        JOIN courses ON cs.course_id = courses.id
        WHERE cs.student_id = ? AND cs.status = 'pending'
    ";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $total_average = 0;
    $subject_count = 0;

    while ($row = $result2->fetch_assoc()) {
        $final = ($row['q1'] + $row['q2'] + $row['q3'] + $row['q4']) / 4;
        $status = ($final < 75) ? "Fail" : "Pass";

        // keep numeric values in array for JSON
        $row['final_grade'] = number_format($final, 2);
        $row['status']      = $status;

        $grades[] = $row;

        $total_average += $final;
        $subject_count++;
    }

    $stmt2->close();

    /* 4. COMPUTE GWA */
    if ($subject_count > 0) {
        $gwa = number_format($total_average / $subject_count, 2);
    }

    /* 5. FETCH LATEST ENROLLED SECTION */
    $sqlSection = "
        SELECT 
            st.enrolled_section,
            st.enrolled_date,
            s.section_name,
            s.grade_level,
            s.teacher_id,
            CONCAT(u.first_name, ' ', u.last_name) AS teacher_fullname
        FROM student_tuition st
        JOIN sections s ON s.section_id = st.enrolled_section
        JOIN users u ON u.user_id = s.teacher_id
        WHERE st.student_number = ?
        ORDER BY st.enrolled_date DESC
        LIMIT 1
    ";

    $stmtSec = $conn->prepare($sqlSection);
    $stmtSec->bind_param("s", $student_id);
    $stmtSec->execute();
    $resSec = $stmtSec->get_result();
    $sectionInfo = $resSec->fetch_assoc();
    $stmtSec->close();
}

/* Build JSON for scholastic (grades) */
$scholasticData = [];
foreach ($grades as $g) {
    $scholasticData[] = [
        "subject"      => $g["course_name"],
        "q1"           => (int)$g["q1"],
        "q2"           => (int)$g["q2"],
        "q3"           => (int)$g["q3"],
        "q4"           => (int)$g["q4"],
        "final_rating" => (float)$g["final_grade"],
        "remarks"      => $g["status"]
    ];
}
$scholastic_json = json_encode($scholasticData, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Grades Records</title>
<?php include 'header.php'; ?>

<style>
body{background:#F7F7F7;font-family:'Segoe UI';}
.record-section{background:#FFF;padding:2rem;border-radius:1rem;margin-bottom:2rem;box-shadow:0 4px 10px rgba(0,0,0,0.08);}
.record-item label{font-weight:600;font-size:0.875rem;color:#6C757D;}
.record-item .data{font-size:0.95rem;font-weight:500;}
.table th{font-weight:600;}
</style>
</head>
<body>
<div class="d-flex flex-row">

<?php include 'navigation.php'; ?>
<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container pt-3">

    <div class="record-section">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-8">
                <h5 class="fw-bolder">Student Details</h5>
            </div>

            <div class="col-12 col-md-4 d-flex justify-content-end">
                <!-- type="button" so it doesn't submit the form -->
                <button id="approveBtn" type="button" disabled style="background-color: #c71515ff" class="btn text-light me-2 rounded rounded-4 btn-sm border">
                    <i class="bi bi-check-circle me-1"></i> Approve
                </button>

                <button class="btn rounded rounded-4 btn-sm border">
                    <i class="bi bi-printer me-1"></i> Print
                </button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4 record-item">
                <label>Student Number</label>
                <div class="data"><?= htmlspecialchars($student['student_number'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Full Name</label>
                <div class="data">
                    <?= htmlspecialchars(($student['first_name'] ?? '') . " " . ($student['last_name'] ?? '')) ?>
                </div>
            </div>

            <div class="col-md-4 record-item">
                <label>Email</label>
                <div class="data"><?= htmlspecialchars($student['email'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Phone</label>
                <div class="data"><?= htmlspecialchars($student['phone_number'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Gender</label>
                <div class="data"><?= htmlspecialchars($student['gender'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Birth Date</label>
                <div class="data"><?= htmlspecialchars($student['birthdate'] ?? '-') ?></div>
            </div>

            <div class="col-md-4 record-item">
                <label>Address</label>
                <div class="data"><?= htmlspecialchars($student['address'] ?? '-') ?></div>
            </div>
        </div>

        <hr>

        <table class="table table-sm table-striped align-middle" id="gradesTable">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Q1</th>
                    <th>Q2</th>
                    <th>Q3</th>
                    <th>Q4</th>
                    <th>Average</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($grades) > 0): ?>
                    <?php foreach ($grades as $g): ?>
                        <tr>
                            <td><?= htmlspecialchars($g['course_name']) ?></td>
                            <td><?= (int)$g['q1'] ?></td>
                            <td><?= (int)$g['q2'] ?></td>
                            <td><?= (int)$g['q3'] ?></td>
                            <td><?= (int)$g['q4'] ?></td>
                            <td class="fw-bold"><?= $g['final_grade'] ?></td>
                            <td class="fw-bold"><?= $g['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center text-muted">No Active Subjects Enrolled.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="mt-2">
            <label class="fw-bold">General Average:</label>
            <span class="fw-bold fs-5" id="gwa_display"><?= $gwa ?></span>
        </div>

        <div class="rounded d-none bg-white p-3 mt-3">
            <form method="post" id="mainForm" onsubmit="return false;">
                <input type="hidden" name="scholastic_json" id="scholastic_json" value='<?= htmlspecialchars($scholastic_json) ?>'>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Student Number</label>
                        <input type="text" name="student_number" class="form-control" required value="<?= htmlspecialchars($student['student_number'] ?? '') ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">School ID</label>
                        <input type="text" name="school_id" class="form-control" required value="400858">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">School</label>
                        <input type="text" name="school" class="form-control" required value="The Cardinal Academy Inc.">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">District</label>
                        <input type="text" name="district" class="form-control" required value="4th">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Division</label>
                        <input type="text" name="division" class="form-control" required value="Bulacan">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Region</label>
                        <input type="text" name="region" class="form-control" required value="3">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">School Year</label>
                        <input type="text" name="school_year" class="form-control" required value="2025-2026">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Classified Grade</label>
                        <input type="text" name="classified_grade" id="classified_grade" class="form-control" required value="<?= htmlspecialchars($sectionInfo['grade_level'] ?? 'N/A') ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">General Average</label>
                        <input type="text" name="general_average" id="general_average" class="form-control" required value="<?= $gwa ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Section</label>
                        <input type="text" name="section" class="form-control" required value="<?= htmlspecialchars($sectionInfo['section_name'] ?? 'N/A') ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Adviser</label>
                        <input type="text" name="adviser_name" class="form-control" required value="<?= htmlspecialchars($sectionInfo['teacher_fullname'] ?? 'N/A') ?>">
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let gwa = parseFloat("<?= $gwa ?>");
    const approveBtn = document.getElementById("approveBtn");
    

    // Enable/disable approve button
    if (!isNaN(gwa) && gwa >= 75) {
        approveBtn.removeAttribute("disabled");
        approveBtn.classList.remove("border");
        approveBtn.classList.add("btn-success");
    } else {
        approveBtn.setAttribute("disabled", true);
    }

    // ---------- BUILD GRADES JSON ----------
    const gradesData = [
        <?php foreach ($grades as $g): ?>
        {
            subject: "<?= $g['course_name'] ?>",
            q1: <?= $g['q1'] ?>,
            q2: <?= $g['q2'] ?>,
            q3: <?= $g['q3'] ?>,
            q4: <?= $g['q4'] ?>,
            final_rating: <?= $g['final_grade'] ?>,
            remarks: "<?= $g['status'] ?>"
        },
        <?php endforeach; ?>
    ];

    

   // ---------- ON APPROVE CLICK ----------
    approveBtn.addEventListener("click", function () {

        const form = document.getElementById("mainForm");
        const scholasticField = document.getElementById("scholastic_json");

        // Save grades JSON into hidden input
        scholasticField.value = JSON.stringify(gradesData);

        // Log everything before sending
        console.log("Form Data:");
        const formData = new FormData(form);
        for (let [key, value] of formData.entries()) {
            console.log(key + ": " + value);
        }

        console.log("Grades JSON:");
        console.log(gradesData);

        // ----------- SEND TO save_scholastic.php -----------
        fetch("save_scholastic.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json()) // Expect JSON response from PHP
        .then(data => {
            console.log("Server Response:", data);

            const swalOptions = {
                title: data.status === "success" ? 'Success!' : 'Error',
                text: data.message,
                icon: data.status === "success" ? 'success' : 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'swal-confirm-teal-rounded'
                }
            };

            Swal.fire(swalOptions).then(() => {
                if (data.status === "success") {
                    window.location.reload();
                }
            });
        })
        .catch(err => {
            console.error("Error saving:", err);
            Swal.fire({
                title: 'Error',
                text: 'Failed to save data. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'swal-confirm-teal-rounded'
                }
            });
        });
    });


});
</script>

<style>
.swal-confirm-teal-rounded {
    background-color: #c71515ff !important; /* teal */
    color: white !important;
    border-radius: 50px !important;       /* fully rounded */
    padding: 0.5rem 1.5rem !important;
    border: none !important;
    font-weight: bold;
}

.swal-confirm-teal-rounded:hover {
    background-color: #940b0bff !important; /* darker teal on hover */
}
</style>
