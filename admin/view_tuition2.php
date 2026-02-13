<?php
include 'session_login.php';
include '../db_connection.php';

// ----------------------
// Helpers
// ----------------------
function h($val): string {
  return htmlspecialchars((string)($val ?? ''), ENT_QUOTES, 'UTF-8');
}
function money($n): string {
  return "₱" . number_format((float)$n, 2);
}
function safe_json_array($raw): array {
  if (!is_string($raw) || trim($raw) === '') return [];
  $decoded = json_decode($raw, true);
  return (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
}

// Retrieve tuition_id from URL and validate
$tuition_id = isset($_GET['tuition_id']) ? (int)$_GET['tuition_id'] : 0;
if ($tuition_id <= 0) {
  http_response_code(400);
  die("<div style='padding:16px;font-family:Arial'>Invalid tuition ID.</div>");
}

// ----------------------
// Fetch tuition + student + section + teacher
// NOTE: Use LEFT JOIN for section/user so page still works if missing
// ----------------------
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

  CONCAT(
    COALESCE(si.residential_address, ''), 
    CASE WHEN COALESCE(si.barangay,'') <> '' THEN CONCAT(', ', si.barangay) ELSE '' END,
    CASE WHEN COALESCE(si.municipal,'') <> '' THEN CONCAT(', ', si.municipal) ELSE '' END,
    CASE WHEN COALESCE(si.province,'') <> '' THEN CONCAT(', ', si.province) ELSE '' END
  ) AS residential_address,

  st.payment_plan,
  COALESCE(st.registration_fee,0) AS registration_fee,
  COALESCE(st.tuition_fee,0) AS tuition_fee,
  COALESCE(st.miscellaneous,0) AS miscellaneous,
  COALESCE(st.uniform,0) AS uniform,
  st.uniform_cart,
  st.discount_type,
  COALESCE(st.discount_value,0) AS discount_value,
  COALESCE(st.discount_amount,0) AS discount_amount, -- may be stale; we will recompute
  COALESCE(st.downpayment,0) AS downpayment,

  COALESCE(st.interest,0) AS interest,               -- required for base
  COALESCE(st.payment_total,0) AS payment_total,     -- may be stale; we will recompute

  st.enrolled_date,

  COALESCE(sec.section_id,0) AS section_id,
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
$stmt->execute();
$result = $stmt->get_result();

if (!$result || !($row = $result->fetch_assoc())) {
  http_response_code(404);
  die("<div style='padding:16px;font-family:Arial'>Tuition record not found.</div>");
}

// Build tuition array
$tuition = [
  "tuition_id"          => (int)$row['tuition_id'],
  "student_number"      => $row['student_number'],
  "account_number"      => $row['account_number'],
  "lrn"                 => $row['lrn'],
  "firstname"           => $row['firstname'],
  "middlename"          => $row['middlename'],
  "lastname"            => $row['lastname'],
  "student_grade_level" => $row['student_grade_level'],
  "status"              => $row['status'],
  "email"               => $row['email'],
  "gender"              => $row['gender'],
  "profile_picture"     => $row['profile_picture'],
  "birthday"            => $row['birthday'],
  "residential_address" => $row['residential_address'],

  "payment_plan"        => $row['payment_plan'],
  "registration_fee"    => (float)$row['registration_fee'],
  "tuition_fee"         => (float)$row['tuition_fee'],
  "miscellaneous"       => (float)$row['miscellaneous'],
  "uniform"             => (float)$row['uniform'],
  "uniform_cart"        => safe_json_array($row['uniform_cart'] ?? ''),

  "discount_type"       => (string)($row['discount_type'] ?? ''),
  "discount_value"      => (float)($row['discount_value'] ?? 0),
  "discount_amount_db"  => (float)($row['discount_amount'] ?? 0),  // stored, may be stale

  "downpayment"         => (float)$row['downpayment'],

  "interest"            => (float)$row['interest'],
  "payment_total_db"    => (float)($row['payment_total'] ?? 0),     // stored, may be stale

  "enrolled_date"       => $row['enrolled_date'],

  "section_id"          => (int)$row['section_id'],
  "section_name"        => $row['section_name'],
  "section_grade_level" => $row['section_grade_level'],
  "teacher_id"          => $row['teacher_id'],
  "room"                => $row['room'],
  "section_strand"      => $row['section_strand'],
  "capacity"            => $row['capacity'],
  "enrolled"            => $row['enrolled'],
  "school_year"         => $row['school_year'],
  "teacher_firstname"   => $row['teacher_firstname'],
  "teacher_lastname"    => $row['teacher_lastname'],
];

// ----------------------
// ✅ Total payments from payment table
// ----------------------
$stmt2 = $conn->prepare("SELECT COALESCE(SUM(payment), 0) AS total_payment FROM payment WHERE tuition_id = ?");
if (!$stmt2) {
  http_response_code(500);
  die("<div style='padding:16px;font-family:Arial'>Payment query prepare failed.</div>");
}
$stmt2->bind_param("i", $tuition_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
$payment_row = $result2 ? $result2->fetch_assoc() : null;
$total_payment = (float)($payment_row['total_payment'] ?? 0);

// ----------------------
// ✅ FOLLOW THE PREVIOUS LOGIC (discount base includes interest)
// Base = tuition + misc + interest
// Discount:
// - percent: base * discount_value/100 (cap 0..100)
// - fixed: min(discount_value, base)
// Payment Total (gross due) = base - discount
// Balance after downpayment = payment_total - downpayment
// Remaining after recorded payments = balance_after_down - total_payment
// ----------------------
$tuitionFee  = (float)$tuition['tuition_fee'];
$misc        = (float)$tuition['miscellaneous'];
$interest    = max(0, (float)$tuition['interest']);
$downpayment = max(0, (float)$tuition['downpayment']);

$base = max(0, $tuitionFee + $misc + $interest);

// compute discount from type/value (ignore stored discount_amount if stale)
$discountType  = strtolower(trim((string)$tuition['discount_type']));
$discountValue = (float)$tuition['discount_value'];

$discount = 0.0;
if ($discountType === 'percent') {
  if ($discountValue < 0) $discountValue = 0;
  if ($discountValue > 100) $discountValue = 100;
  $discount = ($base * $discountValue) / 100.0;
} elseif ($discountType === 'fixed') {
  if ($discountValue < 0) $discountValue = 0;
  $discount = min($discountValue, $base);
} else {
  $discount = 0.0;
}
$discount = max(0, min($discount, $base));

$payment_total = max(0, $base - $discount);

// balance after downpayment (this is the real tuition balance to be paid in installments)
$balance_after_down = max(0, $payment_total - $downpayment);

// remaining after recorded payments
$remaining_balance = max(0, $balance_after_down - max(0, $total_payment));

// ----------------------
// ✅ Installments
// - Annual: 1
// - Semestral: 2
// - Quarterly: 4
// - Monthly: 9 (or 4 for SHS 11/12)
// ----------------------
$paymentPlan = strtolower(trim((string)($tuition['payment_plan'] ?? 'annual')));
$gradeLabel  = (string)($tuition['section_grade_level'] ?? $tuition['student_grade_level'] ?? '');

$isSeniorHigh = false;
if (preg_match('/(\d+)/', $gradeLabel, $m)) {
  $n = (int)$m[1];
  if ($n >= 11) $isSeniorHigh = true;
}

if (in_array($paymentPlan, ['semestral', 'semester', 'semestre', 'semestiral'], true)) {
  $installments = 2;
} elseif ($paymentPlan === 'quarterly') {
  $installments = 4;
} elseif ($paymentPlan === 'monthly') {
  $installments = $isSeniorHigh ? 4 : 9;
} elseif ($paymentPlan === 'annual') {
  $installments = 1;
} else {
  $installments = 1;
}

// per installment based on balance AFTER downpayment (matches "pay the remaining")
$per_plan_payment = ($installments > 0) ? ($balance_after_down / $installments) : $balance_after_down;

// expose values to view
$tuition['total_payment']        = $total_payment;
$tuition['base']                 = $base;
$tuition['discount_amount']      = $discount;
$tuition['payment_total']        = $payment_total;
$tuition['balance_after_down']   = $balance_after_down;
$tuition['remaining_balance']    = $remaining_balance;

$stmt->close();
$stmt2->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AcadeSys – View</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-white">
  <?php include 'navigation.php'; ?>
  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container">

              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="row pb-3">
                    <div class="col-12 d-flex flex-column col-md-6">
                      <span class="me-3 text-muted">Account No: <?= h($tuition['account_number']) ?></span>
                      <span class="me-3 text-muted">Student: <?= h(trim($tuition['firstname'].' '.$tuition['middlename'].' '.$tuition['lastname'])) ?></span>
                      <span class="me-3 text-muted">Residential Address: <?= h($tuition['residential_address'] ?? 'N/A') ?></span>
                    </div>
                    <div class="col-12 d-flex flex-column col-md-6">
                      <span class="me-3 text-muted">Student No: <?= h($tuition['student_number'] ?? 'N/A') ?></span>
                      <span class="me-3 text-muted">Transaction Date: <?= h($tuition['enrolled_date']) ?></span>
                      <!-- ✅ show balance after downpayment (true "tuition balance") -->
                      <span class="me-3 text-muted">Tuition Balance: <?= money($balance_after_down) ?></span>
                    </div>
                  </div>
                </div>

                <hr>

                <div class="col-12 col-md-8">
                  <div class="rounded rounded-4">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                      <div>
                        <h6 class="mb-0 text-muted">
                          Recent Payments - <?= h($tuition['payment_plan']) ?>
                          <span class="text-muted small ms-2">
                            ( <?= money($per_plan_payment) ?> each)
                          </span>
                        </h6>
                        <!-- <div class="small text-muted mt-1">
                          Base: <?= money($base) ?> |
                          Discount: -<?= money($discount) ?> |
                          Payment Total: <?= money($payment_total) ?> |
                          Downpayment: -<?= money($downpayment) ?>
                        </div> -->
                      </div>

                      <button id="payment_btn"
                              class="btn btn-danger btn-sm border rounded-4 px-4"
                              data-bs-toggle="modal"
                              data-bs-target="#payModal">
                        <i class="bi bi-cash me-2"></i> Pay
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content rounded-4">
                            <div class="modal-header">
                              <h5 class="modal-title" id="payModalLabel">Enter Payment Details</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="pay_bill.php" method="POST" enctype="multipart/form-data">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 mb-2">
                                    <label for="reference" class="text-muted">Reference Number</label>
                                    <input type="number" disabled class="form-control" id="reference" name="reference">
                                    <input type="hidden" class="form-control" id="tuition_id" value="<?= (int)$tuition_id ?>" name="tuition_id">
                                  </div>
                                  <div class="col-md-6 mb-2">
                                    <label for="payment_type" class="text-muted">Payment Type</label>
                                    <select class="form-select" id="payment_type" name="payment_type" required>
                                      <option selected value="Cash">Cash</option>
                                      <option value="GCash">GCash</option>
                                      <option value="Bank Transfer">Bank Transfer</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="mb-2">
                                  <label for="payment" class="text-muted">Payment</label>
                                  <input placeholder="Note: please enter payment."
                                        type="text"
                                        inputmode="decimal"
                                        pattern="^\d*\.?\d{0,2}$"
                                        class="form-control"
                                        id="payment"
                                        name="payment"
                                        required
                                        maxlength="10">
                                  <small class="text-danger d-none" id="invalid-warning"></small>
                                </div>

                                <label class="text-muted">Transaction Fee</label>
                                <input type="number" id="transaction_fee_input" name="transaction_fee" readonly class="form-control" disabled value="0.00">

                                <div class="mt-3">
                                  <h5>Payment Summary</h5>

                                  <div class="d-flex justify-content-between">
                                    <span class="text-muted">Payment:</span>
                                    <span class="text-muted" id="payment_display">PHP 0.00</span>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                    <span class="text-muted">Transaction Fee:</span>
                                    <span class="text-muted" id="transaction_fee">PHP 0.00</span>
                                  </div>

                                  <hr>

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirm-check">
                                    <label class="form-check-label text-muted small" for="confirm-check">
                                      I review the reference and amount is correct
                                    </label>
                                  </div>
                                </div>
                              </div>

                              <div class="modal-footer">
                                <button type="submit" class="btn btn-danger text-light px-4" id="submit-btn" disabled>Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              </div>
                            </form>

                            <script>
                              document.getElementById('confirm-check').addEventListener('change', function () {
                                document.getElementById('submit-btn').disabled = !this.checked;
                              });

                              document.addEventListener("DOMContentLoaded", function () {
                                const paymentType = document.getElementById("payment_type");
                                const reference = document.getElementById("reference");
                                const transactionFeeInput = document.getElementById("transaction_fee_input");
                                const paymentInput = document.getElementById("payment");

                                const paymentSummaryEl = document.getElementById("payment_display");
                                const transactionFeeEl = document.getElementById("transaction_fee");

                                function updateSummary() {
                                  let paymentValue = parseFloat(paymentInput.value) || 0;
                                  let transactionFee = (paymentType.value === "GCash" || paymentType.value === "Bank Transfer")
                                    ? parseFloat(transactionFeeInput.value || "0")
                                    : 0;

                                  paymentSummaryEl.textContent = "PHP " + paymentValue.toFixed(2);
                                  transactionFeeEl.textContent = "PHP " + transactionFee.toFixed(2);
                                }

                                paymentType.addEventListener("change", function () {
                                  if (this.value === "Cash") {
                                    reference.disabled = true;
                                    reference.required = false;
                                    transactionFeeInput.disabled = true;
                                    transactionFeeInput.value = "0.00";
                                  } else {
                                    reference.disabled = false;
                                    reference.required = true;
                                    transactionFeeInput.disabled = false;
                                    transactionFeeInput.value = "15.00";
                                  }
                                  updateSummary();
                                });

                                paymentInput.addEventListener("input", updateSummary);
                                updateSummary();
                              });
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>

                    <table class="table table-hover table-sm table-striped pt-3 pb-3 text-muted" style="font-size: 12px; cursor: pointer">
                      <thead>
                        <tr>
                          <th>Invoice No.</th>
                          <th>Date</th>
                          <th>Payment</th>
                          <th>Fee</th>
                          <th>Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $student_id = $tuition_id;

                          $stmt3 = $conn->prepare("SELECT invoice_number, date, payment, transaction_fee, payment_type FROM payment WHERE tuition_id = ? ORDER BY date DESC");
                          $stmt3->bind_param("i", $student_id);
                          $stmt3->execute();
                          $paymentsRes = $stmt3->get_result();

                          if ($paymentsRes && $paymentsRes->num_rows > 0) {
                            while ($prow = $paymentsRes->fetch_assoc()) {
                              $formatted_invoice = 'INV-' . str_pad((string)$prow['invoice_number'], 4, '0', STR_PAD_LEFT);
                              echo "<tr class='clickable-row' data-id='".h($prow['invoice_number'])."' data-student='".h($student_id)."'>";
                              echo "<td class='py-3'>".h($formatted_invoice)."</td>";
                              echo "<td class='py-3'>".h($prow['date'])."</td>";
                              echo "<td class='py-3'>₱".number_format((float)$prow['payment'], 2)."</td>";
                              echo "<td class='py-3'>₱".number_format((float)$prow['transaction_fee'], 2)."</td>";
                              echo "<td class='py-3'>".h($prow['payment_type'])."</td>";
                              echo "</tr>";
                            }
                          } else {
                            echo "<tr><td colspan='5' class='text-center py-3 text-muted'>
                                  <img src='../static/artnotfound.svg' class='mt-3' style='width: 50%; opacity: 70%'>
                                  <p>No data found</p>
                                  </td></tr>";
                          }

                          $stmt3->close();
                        ?>
                      </tbody>
                    </table>

                    <script>
                      document.addEventListener('DOMContentLoaded', function () {
                        document.querySelectorAll('.clickable-row').forEach(function(row) {
                          row.addEventListener('click', function() {
                            const invoiceId = this.getAttribute('data-id');
                            const studentId = this.getAttribute('data-student');
                            window.location.href = 'view_invoice.php?invoice_id=' + encodeURIComponent(invoiceId) + '&tuition_id=' + encodeURIComponent(studentId);
                          });
                        });
                      });
                    </script>

                  </div>
                </div>

                <div class="col-12 col-md-4">
                  <div class="row">
                    <div class="col-12 mb-3">
                      <div class="p-3 rounded shadow rounded-4">
                        <p class="text-muted mb-1">Remaining Balance</p>
                        <h2 class="fw-bolder mb-0"><?= money($remaining_balance) ?></h2>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="p-3 shadow rounded rounded-4">
                        <h6 class="mb-3 text-muted">Payment Completion</h6>
                        <div id="radialChart"></div>
                      </div>
                    </div>
                  </div>
                </div>

              </div><!-- row -->
            </div><!-- container -->
          </div><!-- rounded -->
        </div><!-- col -->
      </div><!-- row -->
    </div><!-- container -->
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<input type="hidden" id="balance" value="<?= h($balance_after_down) ?>">
<input type="hidden" id="amount_pay" value="<?= h($remaining_balance) ?>">

<script>
  const balance = parseFloat(document.getElementById("balance").value) || 0;
  const amountPay = parseFloat(document.getElementById("amount_pay").value) || 0;

  let percentage = 0;
  if (balance === 0 && amountPay === 0) {
    percentage = 100;
  } else if (balance > 0) {
    percentage = 100 - (amountPay / balance) * 100;
    if (percentage > 100) percentage = 100;
    if (percentage < 0) percentage = 0;
  }

  let chartLabel = 'Progress';
  if (percentage >= 100) {
    chartLabel = 'Completed';
    const paymentBtn = document.getElementById("payment_btn");
    if (paymentBtn) {
      paymentBtn.innerHTML = '<i class="bi bi-cash me-2"></i> Paid';
      paymentBtn.disabled = true;
      paymentBtn.style.cursor = "not-allowed";
    }
  }

  var options = {
    chart: { type: 'radialBar', height: 250 },
    plotOptions: {
      radialBar: {
        hollow: { size: '60%' },
        dataLabels: {
          name: { show: true, fontSize: '16px' },
          value: {
            fontSize: '20px',
            formatter: function (val) { return val.toFixed(1) + "%"; }
          }
        }
      }
    },
    series: [percentage],
    labels: [chartLabel],
    colors: ['#b72029']
  };

  var chart = new ApexCharts(document.querySelector("#radialChart"), options);
  chart.render();
</script>
