<?php
include 'session_login.php';
include '../db_connection.php';

header('Content-Type: text/html; charset=utf-8');
mysqli_set_charset($conn, "utf8mb4");

// ✅ Validate tuition_id
$tuition_id = isset($_GET['tuition_id']) ? (int)$_GET['tuition_id'] : 0;
if ($tuition_id <= 0) {
    http_response_code(400);
    die("<div style='padding:16px;font-family:Arial'>Invalid tuition ID.</div>");
}

// ✅ Fetch tuition + student + section + teacher (✅ added st.program_type)
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
    st.program_type,
    st.downpayment,

    st.payment_total,
    st.interest,

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
LEFT JOIN sections sec ON st.enrolled_section = sec.section_id
LEFT JOIN users u ON sec.teacher_id = u.user_id
WHERE st.id = ?
LIMIT 1
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    die("<div style='padding:16px;font-family:Arial'>SQL prepare failed.</div>");
}

$stmt->bind_param("i", $tuition_id);

if (!$stmt->execute()) {
    http_response_code(500);
    die("<div style='padding:16px;font-family:Arial'>Failed to execute query.</div>");
}

$result = $stmt->get_result();
$row = $result ? $result->fetch_assoc() : null;
$stmt->close();

if (!$row) {
    http_response_code(404);
    die("<div style='padding:16px;font-family:Arial'>Tuition record not found.</div>");
}

// ✅ Decode uniform_cart safely
$uniform_cart = [];
if (!empty($row['uniform_cart'])) {
    $decoded = json_decode($row['uniform_cart'], true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $uniform_cart = $decoded;
    }
}

// ✅ Build data array
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
    "email"                => $row['email'],
    "gender"               => $row['gender'],
    "profile_picture"      => $row['profile_picture'],
    "birthday"             => $row['birthday'],
    "residential_address"  => $row['residential_address'],

    "payment_plan"         => $row['payment_plan'],

    "registration_fee"     => (float)($row['registration_fee'] ?? 0),
    "tuition_fee"          => (float)($row['tuition_fee'] ?? 0),
    "miscellaneous"        => (float)($row['miscellaneous'] ?? 0),
    "uniform"              => (float)($row['uniform'] ?? 0),

    "uniform_cart"         => $uniform_cart,

    "discount_type"        => (string)($row['discount_type'] ?? ''),
    "discount_value"       => (float)($row['discount_value'] ?? 0),
    "discount_amount_db"   => (float)($row['discount_amount'] ?? 0),

    "program_type"         => (string)($row['program_type'] ?? ''),

    "downpayment"          => (float)($row['downpayment'] ?? 0),

    "payment_total_db"     => (float)($row['payment_total'] ?? 0),
    "interest"             => (float)($row['interest'] ?? 0),

    "enrolled_date"        => $row['enrolled_date'],

    "section_id"           => isset($row['section_id']) ? (int)$row['section_id'] : 0,
    "section_name"         => $row['section_name'] ?? null,
    "section_grade_level"  => $row['section_grade_level'] ?? null,
    "teacher_id"           => $row['teacher_id'] ?? null,
    "room"                 => $row['room'] ?? null,
    "section_strand"       => $row['section_strand'] ?? null,
    "capacity"             => $row['capacity'] ?? null,
    "enrolled"             => $row['enrolled'] ?? null,
    "school_year"          => $row['school_year'] ?? null,

    "teacher_firstname"    => $row['teacher_firstname'] ?? null,
    "teacher_lastname"     => $row['teacher_lastname'] ?? null
];

// =======================================
// ✅ FIXED DISCOUNT FORMULA (matches enrollment page)
// Discount base: Tuition + Misc + Interest
// Payment Total: base - discount
// =======================================
$tuitionFee    = (float)$tuition['tuition_fee'];
$miscellaneous = (float)$tuition['miscellaneous'];
$interest      = max(0, (float)$tuition['interest']);

$baseForDiscount = max(0, $tuitionFee + $miscellaneous + $interest);

$discountType  = strtolower(trim((string)$tuition['discount_type']));
$discountValue = (float)$tuition['discount_value'];

$computedDiscount = 0.0;
if ($discountType === 'percent') {
    if ($discountValue < 0) $discountValue = 0;
    if ($discountValue > 100) $discountValue = 100;
    $computedDiscount = ($baseForDiscount * $discountValue) / 100.0;
} elseif ($discountType === 'fixed') {
    if ($discountValue < 0) $discountValue = 0;
    $computedDiscount = min($discountValue, $baseForDiscount);
} else {
    $computedDiscount = 0.0;
}
$computedDiscount = max(0, min($computedDiscount, $baseForDiscount));

$computedPaymentTotal = max(0, $baseForDiscount - $computedDiscount);

$downpayment = max(0, (float)$tuition['downpayment']);
$remainingBalance = max(0, $computedPaymentTotal - $downpayment);

// ✅ Only show program_type if discount exists (computedDiscount > 0)
$showProgramType = ($computedDiscount > 0.00001) && trim((string)$tuition['program_type']) !== '';

// ✅ Installments logic
$paymentPlan     = $tuition['payment_plan'] ?? 'Annual';
$gradeLevelLabel = $tuition['section_grade_level'] ?? ($tuition['student_grade_level'] ?? '');

$isSeniorHigh = false;
if (preg_match('/(\d+)/', (string)$gradeLevelLabel, $m)) {
    $n = (int)$m[1];
    if ($n >= 11) $isSeniorHigh = true;
}

$planKey = strtolower(trim((string)$paymentPlan));
if (in_array($planKey, ['semestral', 'semester', 'semestre', 'semestiral'], true)) {
    $installments = 2;
} elseif ($planKey === 'quarterly') {
    $installments = $isSeniorHigh ? 2 : 4;
} elseif ($planKey === 'monthly') {
    $installments = $isSeniorHigh ? 4 : 9;
} elseif ($planKey === 'annual') {
    $installments = 1;
} else {
    $installments = 1;
}

$perInstallment = ($installments > 0) ? ($remainingBalance / $installments) : $remainingBalance;

$registrationFee = max(0, (float)$tuition['registration_fee']);
$uniform         = max(0, (float)$tuition['uniform']);
$paymentToday    = $registrationFee + $uniform + $downpayment;
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
        $alert_message = '';
        $alert_type = '';

        if (isset($_GET['status'])) {
            if ($_GET['status'] === '2') {
                $alert_message = 'The post has been removed.';
                $alert_type = 'danger';
            } elseif ($_GET['status'] === '1') {
                $alert_message = 'Certificate of Registration was emailed successfully.';
                $alert_type = 'success';
            }
        }

        if (!empty($alert_message)) {
            echo '<div class="alert alert-' . htmlspecialchars($alert_type) . ' alert-dismissible mx-3 fade show rounded" role="alert">'
                . htmlspecialchars($alert_message) .
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
                  <input type="hidden" name="cor_link" value="https://acadesys.site/view_cor.php?tuition_id=<?= htmlspecialchars((string)$tuition['tuition_id']) ?>">
                  <input type="hidden" name="email" value="<?= htmlspecialchars((string)($tuition['email'] ?? '')) ?>">
                  <button class="btn border text-muted rounded-4" id="sendEmailBtn" type="submit">
                    <i class="bi bi-envelope me-1"></i> Send Email
                  </button>
                </form>

                <button class="btn btn-sm border text-muted rounded-4" onclick="window.print()">
                  <i class="bi bi-printer me-1"></i> Print
                </button>

                <?php $create = isset($_GET['create']) ? $_GET['create'] : ''; ?>
                <?php if ($create !== 'no'): ?>
                  <a href="create_students.php?tuition_id=<?= htmlspecialchars((string)$tuition_id) ?>"
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
                  <small class="d-block text-center">Sullera Street in Pandayan, Meycauayan, Bulacan</small>
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
                <?= htmlspecialchars(trim(($tuition['firstname'] ?? '') . ' ' . ($tuition['middlename'] ?? '') . ' ' . ($tuition['lastname'] ?? ''))) ?>
              </div>
              <div class="col-md-4">
                <strong>Student Number:</strong>
                <?= htmlspecialchars((string)($tuition['student_number'] ?? 'N/A')) ?>
              </div>
              <div class="col-md-4">
                <strong>Account Number:</strong>
                <?= htmlspecialchars((string)($tuition['account_number'] ?? 'N/A')) ?>
              </div>
              <div class="col-md-4">
                <strong>Adviser:</strong>
                <?php
                  $teacherFullName = trim(($tuition['teacher_firstname'] ?? '') . ' ' . ($tuition['teacher_lastname'] ?? ''));
                  echo htmlspecialchars($teacherFullName !== '' ? $teacherFullName : 'N/A');
                ?>
              </div>
              <div class="col-md-4">
                <strong>Section:</strong>
                <?= htmlspecialchars((string)($tuition['section_name'] ?? 'N/A')) ?>
              </div>
              <div class="col-md-4">
                <strong>Grade Level:</strong>
                <?= htmlspecialchars((string)($tuition['section_grade_level'] ?? ($tuition['student_grade_level'] ?? 'N/A'))) ?>
              </div>
              <div class="col-md-4">
                <strong>School Year:</strong>
                <?= htmlspecialchars((string)($tuition['school_year'] ?? 'N/A')) ?>
              </div>
              <div class="col-md-4">
                <strong>Room:</strong>
                <?= htmlspecialchars((string)($tuition['room'] ?? 'N/A')) ?>
              </div>
              <div class="col-md-4">
                <strong>Strand:</strong>
                <?= htmlspecialchars((string)($tuition['section_strand'] ?? 'N/A')) ?>
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
                  $section_id = (int)($tuition['section_id'] ?? 0);

                  if ($section_id > 0) {
                      $stmt2 = $conn->prepare("
                        SELECT id, subject_code, description, time, teacher, room
                        FROM class_schedule
                        WHERE section_id = ?
                        ORDER BY id ASC
                      ");
                      if ($stmt2) {
                          $stmt2->bind_param("i", $section_id);
                          $stmt2->execute();
                          $res2 = $stmt2->get_result();

                          $count = 1;
                          $hasRows = false;

                          while ($r2 = $res2->fetch_assoc()) {
                              $hasRows = true;
                              echo '<tr class="text-muted">';
                              echo '<td>' . $count++ . '</td>';
                              echo '<td>' . htmlspecialchars((string)$r2['subject_code']) . '</td>';
                              echo '<td>' . htmlspecialchars((string)$r2['description']) . '</td>';
                              echo '<td>' . htmlspecialchars((string)$r2['time']) . '</td>';
                              echo '<td>' . htmlspecialchars((string)$r2['teacher']) . '</td>';
                              echo '<td>' . htmlspecialchars((string)$r2['room']) . '</td>';
                              echo '</tr>';
                          }

                          if (!$hasRows) {
                              echo '<tr><td colspan="6" class="text-center text-muted">No schedule found.</td></tr>';
                          }

                          $stmt2->close();
                      } else {
                          echo '<tr><td colspan="6" class="text-center text-muted">Schedule query failed.</td></tr>';
                      }
                  } else {
                      echo '<tr><td colspan="6" class="text-center text-muted">No schedule found.</td></tr>';
                  }
                ?>
                </tbody>
              </table>
            </div>

            <div class="row">
              <div class="col-12 col-md-6 mb-3" style="font-size: 12px !important;">
                <div style="background-color: #b72029;" class="p-2 mb-3">
                  <h6 class="mb-1 fw-bolder text-light text-center" style="font-size:12px !important;">School Expense</h6>
                </div>

                <div class="row" style="font-size: 12px !important;">
                  <div class="col-12 col-md-6 mb-3">
                    <h6 class="fw-bold mb-2" style="font-size:12px !important;">Payments Overview</h6>

                    <div class="d-flex justify-content-between">
                      <span>Registration Fee</span>
                      <span>₱<?= number_format($registrationFee, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span>Uniform Fee</span>
                      <span>₱<?= number_format($uniform, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span>Downpayment</span>
                      <span>₱<?= number_format($downpayment, 2) ?></span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold">
                      <span>Total Payment Today</span>
                      <span>₱<?= number_format($paymentToday, 2) ?></span>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                      <span>Remaining Balance</span>
                      <span>₱<?= number_format($remainingBalance, 2) ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                      <span>Payment Plan</span>
                      <span><?= htmlspecialchars((string)$paymentPlan) ?></span>
                    </div>

                    <div class="d-flex justify-content-between text-muted">
                      <span>Per <?= (int)$installments ?> Installment(s)</span>
                      <span>₱<?= number_format($perInstallment, 2) ?></span>
                    </div>
                  </div>

                  <div class="col-12 col-md-6 mb-3">
                    <h6 class="fw-bold mb-2" style="font-size:12px !important;">Fees Breakdown</h6>

                    <div class="d-flex justify-content-between">
                      <span>Tuition Fee</span>
                      <span>₱<?= number_format($tuitionFee, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span>Miscellaneous</span>
                      <span>₱<?= number_format($miscellaneous, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span>Interest</span>
                      <span>₱<?= number_format($interest, 2) ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                      <span>Discount</span>
                      <span>-₱<?= number_format($computedDiscount, 2) ?></span>
                    </div>

                    <!-- ✅ show program_type BELOW discount, ONLY IF has discount -->
                    <?php if ($computedDiscount > 0.00001): ?>
                      <?php
                        $programLabel = trim((string)($tuition['program_type'] ?? ''));
                        if ($programLabel === '') $programLabel = '—';
                      ?>
                      <div class="d-flex justify-content-between">
                        <span class="text-muted">Program Type</span>
                        <span class="text-muted"><?= htmlspecialchars($programLabel) ?></span>
                      </div>
                    <?php endif; ?>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold">
                      <span>Payment Total</span>
                      <span>₱<?= number_format($computedPaymentTotal, 2) ?></span>
                    </div>
                  </div>
                </div>
              </div>

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
                <p class="mb-0">Keep this certificate. You will be required to present this in your class. Thank you.</p>
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
@media print {
  @page { margin: 0; size: auto; }
  body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  .d-print-none { display: none !important; }
  .d-print-flex { display: flex !important; }
}
</style>
