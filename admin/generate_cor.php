<?php
include 'session_login.php';
include '../db_connection.php';

// Retrieve tuition_id from URL and validate
$tuition_id = isset($_GET['tuition_id']) ? intval($_GET['tuition_id']) : 0;
if ($tuition_id <= 0) {
    echo json_encode(["error" => "Invalid tuition ID."]);
    exit;
}

// Prepare SQL to fetch tuition along with student, section, and teacher info
$sql = "
SELECT 
    st.id AS tuition_id,
    st.student_number,
    st.account_number,
    si.lrn,
    si.firstname,
    si.middlename,
    si.lastname,
    si.grade_level AS student_grade_level,
    si.status,
    si.gender,
    si.profile_picture,
    si.email,
    si.birthday,
    si.residential_address,
    st.payment_plan,
    st.registration_fee,
    st.tuition_fee,
    st.miscellaneous,
    st.uniform,
    st.uniform_cart,
    st.discount_type,
    st.discount_value,
    st.discount_amount,
    st.downpayment,
    st.enrolled_date,
    sec.section_id,
    sec.section_name,
    sec.grade_level AS section_grade_level,
    sec.teacher_id,
    sec.room,
    sec.strand AS section_strand,
    sec.capacity,
    sec.enrolled,
    sec.school_year,
    u.first_name AS teacher_firstname,
    u.last_name AS teacher_lastname
FROM student_tuition st
INNER JOIN student_information si ON st.student_number = si.student_number
INNER JOIN sections sec ON st.enrolled_section = sec.section_id
INNER JOIN users u ON sec.teacher_id = u.user_id
WHERE st.id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tuition_id);

if (!$stmt->execute()) {
    echo json_encode(["error" => "Failed to execute query."]);
    exit;
}

$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    $tuition = [
        "tuition_id"           => $row['tuition_id'],
        "student_number"       => $row['student_number'],
        "account_number"       => $row['account_number'],
        "lrn"                  => $row['lrn'],
        "firstname"            => $row['firstname'],
        "middlename"           => $row['middlename'],
        "lastname"             => $row['lastname'],
        "student_grade_level"  => $row['student_grade_level'],
        "status"               => $row['status'],
        "email"               => $row['email'],
        "gender"               => $row['gender'],
        "profile_picture"      => $row['profile_picture'],
        "birthday"             => $row['birthday'],
        "residential_address"  => $row['residential_address'],
        "payment_plan"         => $row['payment_plan'],
        "registration_fee"     => (float)$row['registration_fee'],
        "tuition_fee"          => (float)$row['tuition_fee'],
        "miscellaneous"        => (float)$row['miscellaneous'],
        "uniform"              => (float)$row['uniform'],
        "uniform_cart"         => json_decode($row['uniform_cart'], true),
        "discount_type"        => $row['discount_type'],
        "discount_value"       => (float)$row['discount_value'],
        "discount_amount"      => (float)$row['discount_amount'],
        "downpayment"          => (float)$row['downpayment'],
        "enrolled_date"        => $row['enrolled_date'],
        "section_id"           => $row['section_id'],
        "section_name"         => $row['section_name'],
        "section_grade_level"  => $row['section_grade_level'],
        "teacher_id"           => $row['teacher_id'],
        "room"                 => $row['room'],
        "section_strand"       => $row['section_strand'],
        "capacity"             => $row['capacity'],
        "enrolled"             => $row['enrolled'],
        "school_year"          => $row['school_year'],
        "teacher_firstname"    => $row['teacher_firstname'],
        "teacher_lastname"     => $row['teacher_lastname']
    ];

    // echo json_encode($tuition);
} else {
    echo json_encode(["error" => "Tuition record not found."]);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AcadeSys – Certificate of Registration</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-white">
  <?php include 'navigation.php'; ?>
  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>
    <div class="container my-4">
      <?php
      // --- alerts ---
            $alert_message = '';
            $alert_type = '';

            if (isset($_GET['status'])) {
                switch ($_GET['status']) {
                    case '2':
                        $alert_message = 'The post has been removed.';
                        $alert_type = 'danger';
                        break;
                    case '1':
                        $alert_message = 'Certificate of Registration is successfully email.';
                        $alert_type = 'success';
                        break;
                }
            }

            if (!empty($alert_message)) {
                echo '<div class="alert alert-' . $alert_type . ' alert-dismissible mx-3 fade show rounded" role="alert">'
                    . $alert_message .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
      ?>
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-4 bg-white">

            <div class="row mt-4 align-items-center mb-4">
              <div class="col-md-4 mb-2">
                <h4 class="mb-0 d-print-none">Certificate of Registration</h4>
              </div>
              <div class="col-md-8 d-flex flex-wrap gap-2 justify-content-md-end d-print-none">
                <form id="sendCorForm" action="send_cor.php" method="POST">
                  <input type="hidden" name="cor_link" value="https://acadesys.site/view_cor.php?tuition_id=<?= htmlspecialchars($tuition['tuition_id'] ?? 'N/A') ?>">
                  <input type="hidden" name="email" value="<?= htmlspecialchars($tuition['email'] ?? 'N/A') ?>">

                  <button 
                    class="btn border text-muted rounded-4" 
                    id="sendEmailBtn" 
                    type="submit">
                    <i class="bi bi-envelope me-1"></i> Send Email
                  </button>
                </form>


                <button class="btn btn-sm border text-muted rounded-4" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print
                </button>
                <?php
                $create = isset($_GET['create']) ? $_GET['create'] : '';
                ?>

                <?php if ($create !== 'no'): ?>
                    <a href="create_students.php?tuition_id=<?php echo htmlspecialchars($tuition_id); ?>" 
                    class="btn btn-danger btn-sm rounded-4 d-flex align-items-center px-3 py-2" 
                    style="font-weight: 500;">
                        + Create Account
                    </a>
                <?php endif; ?>

                </div>
            </div>


            <div class="d-none d-print-flex justify-content-center">
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
               <h3>Certificate of Registration</h3>
              </div>


            <hr>
            <div class="row" style="font-size: 12px;">
                <div class="col-md-4">
                    <strong>Student Name:</strong> 
                    <?= htmlspecialchars($tuition['firstname'] . ' ' . $tuition['middlename'] . ' ' . $tuition['lastname']) ?>
                </div>
                <div class="col-md-4">
                    <strong>Student Number:</strong> 
                    <?= htmlspecialchars($tuition['student_number'] ?? 'N/A') ?>
                </div>
                <div class="col-md-4">
                    <strong>Account Number:</strong> 
                    <?= htmlspecialchars($tuition['account_number'] ?? 'N/A') ?>
                </div>
                <div class="col-md-4">
                    <strong>Adviser:</strong> 
                    <?php
                        // Display full teacher name, or 'N/A' if not available
                        $teacherFullName = trim(
                            ($tuition['teacher_firstname'] ?? '') . ' ' . ($tuition['teacher_lastname'] ?? '')
                        );

                        // If both names are missing, show placeholder
                        echo htmlspecialchars($teacherFullName !== '' ? $teacherFullName : 'N/A');
                    ?>

                </div>
                <div class="col-md-4">
                    <strong>Section:</strong> 
                    <?= htmlspecialchars($tuition['section_name'] ?? 'N/A') ?>
                </div>
                <div class="col-md-4">
                    <strong>Grade Level:</strong> 
                    <?= htmlspecialchars($tuition['section_grade_level'] ?? 'N/A') ?>
                </div>
                <div class="col-md-4">
                    <strong>School Year:</strong> 
                    <?= htmlspecialchars($tuition['school_year'] ?? 'N/A') ?>
                </div>
                <div class="col-md-4">
                    <strong>Room:</strong> 
                    <?= htmlspecialchars($tuition['room'] ?? 'N/A') ?>
                </div>
                <div class="col-md-4">
                    <strong>Strand:</strong> 
                    <?= htmlspecialchars($tuition['section_strand'] ?? 'N/A') ?>
                </div>
            </div>


            <hr>

            <div class="table-responsive">
             <table class="table table-sm table-striped align-middle">
                <thead class="text-start text-muted">
                  <tr>
                    <th>#</th>
                    <th>Subject&nbsp;Code</th>
                    <th>Description</th>
                    <th>Time</th>
                    <th>Teacher</th>
                    <th>Room</th>
                  </tr>
                </thead>
                <tbody style="font-size: 12px">
                <?php
                $section_id = htmlspecialchars($tuition['section_id'] ?? 'N/A');

                if ($section_id !== 'N/A') {
                    $stmt = $conn->prepare("SELECT id, subject_code, description, time, teacher, room 
                                            FROM class_schedule 
                                            WHERE section_id = ?");
                    $stmt->bind_param("i", $section_id); // section_id is integer
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $count = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr class="text-muted">';
                        echo '<td>'. $count++ .'</td>';
                        echo '<td>'. htmlspecialchars($row['subject_code']) .'</td>';
                        echo '<td>'. htmlspecialchars($row['description']) .'</td>';
                        echo '<td>'. htmlspecialchars($row['time']) .'</td>';
                        echo '<td>'. htmlspecialchars($row['teacher']) .'</td>';
                        echo '<td>'. htmlspecialchars($row['room']) .'</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6" class="text-center">No schedule found.</td></tr>';
                }
                ?>
                </tbody>

              </table>


            </div>

            <div class="row">
                <!-- LEFT COLUMN: School Expense -->
                <div class="col-12 col-md-6 mb-3" style="font-size: 12px !important;">
                    <div style="background-color: #b72029;" class="p-2 mb-3">
                        <h6 class="mb-1 fw-bolder text-light text-center" style="font-size:12px !important;">School Expense</h6>
                    </div>
                    <?php
                        $paymentPlan = $tuition['payment_plan'] ?? 'N/A';
                        $tuitionFee = $tuition['tuition_fee'] ?? 0;
                        $miscellaneous = $tuition['miscellaneous'] ?? 0;
                        $registrationFee = $tuition['registration_fee'] ?? 0;
                        $uniform = $tuition['uniform'] ?? 0;
                        $discount = $tuition['discount_amount'] ?? 0;
                        $downpayment = $tuition['downpayment'] ?? 0;

                        $tuitionTotal = ($tuitionFee + $miscellaneous) - $discount;
                        $remainingBalance = $tuitionTotal - $downpayment;

                        switch(strtolower($paymentPlan)) {
                            case 'semestiral':
                            case 'semestre':
                            case 'semester': $installments = 2; break;
                            case 'quarterly': $installments = 4; break;
                            case 'monthly': $installments = 9; break;
                            case 'annual': $installments = 1; break;
                            default: $installments = 1;
                        }

                        $perInstallment = $remainingBalance / $installments;
                        $paymentToday = $registrationFee + $uniform + $downpayment;
                    ?>
                    
                    <div class="row" style="font-size: 12px !important;">

                        <!-- Payments Overview -->
                        <div class="col-12 col-md-6 mb-3">
                            <h6 class="fw-bold mb-2" style="font-size:12px !important;">Payments Overview</h6>
                            <div class="d-flex justify-content-between" style="font-size:12px !important;">
                                <span>Registration Fee</span>
                                <span>₱<?= number_format($registrationFee, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between" style="font-size:12px !important;">
                                <span>Uniform Fee</span>
                                <span>₱<?= number_format($uniform, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between" style="font-size:12px !important;">
                                <span>Downpayment</span>
                                <span>₱<?= number_format($downpayment, 2) ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold" style="font-size:12px !important;">
                                <span>Total Payment Today</span>
                                <span>₱<?= number_format($paymentToday, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mt-2" style="font-size:12px !important;">
                                <span>Remaining Balance</span>
                                <span>₱<?= number_format($remainingBalance, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between" style="font-size:12px !important;">
                                <span>Payment Plan</span>
                                <span><?= htmlspecialchars($paymentPlan) ?></span>
                            </div>
                            <div class="d-flex justify-content-between text-muted" style="font-size:12px !important;">
                                <span>Per <?= $installments ?> Installment(s)</span>
                                <span>₱<?= number_format($perInstallment, 2) ?></span>
                            </div>
                        </div>
                        <!-- Fees Breakdown -->
                        <div class="col-12 col-md-6 mb-3">
                            <h6 class="fw-bold mb-2" style="font-size:12px !important;">Fees Breakdown</h6>
                            <div class="d-flex justify-content-between" style="font-size:12px !important;">
                                <span>Tuition Fee</span>
                                <span>₱<?= number_format($tuitionFee, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between" style="font-size:12px !important;">
                                <span>Miscellaneous</span>
                                <span>₱<?= number_format($miscellaneous, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between" style="font-size:12px !important;">
                                <span>Discount</span>
                                <span>-₱<?= number_format($discount, 2) ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold" style="font-size:12px !important;">
                                <span>Total Tuition</span>
                                <span>₱<?= number_format($tuitionTotal, 2) ?></span>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- RIGHT COLUMN: Approval Section -->
                <div class="col-12 col-md-6 mb-3 d-flex align-items-center justify-content-center" style="font-size: 12px;">
                    <div class="text-center w-100">
                        <p class="mb-0 mb-3 mt-3"><strong>Approved by:</strong></p>
                        <h6 class="mb-0 fw-bolder text-uppercase">MR. CJ A. Escalora</h6>
                        <p class="mb-0">______________________________________</p>
                        <p class="mb-0 fw-bolder">Head Registrar</p>
                    </div>
                </div>
            </div>




            <div class="d-flex justify-content-center" style="background-color: #b72029;">
              <div class="p-2 text-center text-light">
                <p class="mb-0">Keep this certificate. you will be required to present this on your class. thank you.</p>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
<style>
/* Force no margins when printing */
@media print {
    @page {
        margin: 0;
        size: auto; /* Optional: let browser auto-scale */
    }

    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center; /* horizontal center */
        align-items: center;     /* vertical center */
        min-height: 100vh;       /* full printable height */
    }

    .container, .content, .row, .col-12, .col-md-6 {
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Hide elements that are not for printing */
    .d-print-none {
        display: none !important;
    }

    /* Make sure everything else takes full width */
    .d-print-flex {
        display: flex !important;
    }
}
</style>
