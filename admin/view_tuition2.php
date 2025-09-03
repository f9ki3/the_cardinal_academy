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
    CONCAT(
        COALESCE(si.residential_address, ''), ', ',
        COALESCE(si.barangay, ''), ', ',
        COALESCE(si.municipal, ''), ', ',
        COALESCE(si.province, '')
    ) AS residential_address,
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
            <div class="container ">

              <div class="row">
                    <div class="col-12 col-md-12">
                     <div class="row pb-3">
                      <div class="col-12 d-flex flex-column col-md-6">
                          <span class="me-3 text-muted">Account No: <?php echo $tuition['account_number']; ?></span>
                          <span class="me-3 text-muted">Student: <?= htmlspecialchars($tuition['firstname'] . ' ' . $tuition['middlename'] . ' ' . $tuition['lastname']) ?></span>
                          <span class="me-3 text-muted">Residential Address:  <?= htmlspecialchars($tuition['residential_address'] ?? 'N/A') ?></span>
                      </div>
                      <div class="col-12 d-flex flex-column col-md-6">
                          <span class="me-3 text-muted">Student No: <?= htmlspecialchars($tuition['student_number'] ?? 'N/A') ?></span>
                          <span class="me-3 text-muted">Transaction Date: <?php echo $tuition['account_number']; ?> </span>
                          </span><span class="me-3 text-muted">Tuition Fee: PHP <?php echo $tuition['tuition_fee']; ?></span>
                      </div>

                     </div>
                    </div>

                    <hr>
                    <div class="col-12 col-md-8">
                        <!-- Table Area -->
                        <div class=" rounded rounded-4">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-muted">Recent Payments - <?php echo $tuition['payment_plan']; ?></h6>
                        <!-- Button trigger modal -->
                         
                          <!-- <a href="#" class="btn btn-danger btn-sm rounded rounded-4 px-4 disabled">
                            <i class="bi bi-check-circle me-2"></i> Paid
                          </a> -->
                          <a href="#" class="btn btn-danger btn-sm border rounded rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#payModal">
                            <i class="bi bi-cash me-2"></i> Pay
                          </a>

                        <!-- Modal -->
                        <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 ">
                            <div class="modal-header">
                                <h5 class="modal-title" id="payModalLabel">Enter Payment Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="pay_bill.php" method="POST" enctype="multipart/form-data">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 mb-2">
                                    <label for="reference" class="text-muted">Reference Number</label>
                                    <input type="number" step="0.01" class="form-control" id="reference" name="reference" required>
                                  </div>
                                  <div class="col-md-6 mb-2">
                                    <label for="payment_type" class="text-muted">Payment Type</label>
                                    <select class="form-select" id="payment_type" name="payment_type" required>
                                      <option value="">Select Type</option>
                                      <option value="Cash">Cash</option>
                                      <option value="GCash">GCash</option>
                                      <option value="Bank Transfer">Bank Transfer</option>
                                    </select>
                                  </div>
                                  <input type="hidden" class="form-control" name="balance" value="<?php echo $amount_pay; ?>">
                                </div>

                                <div class="mb-2">
                                  <label for="payment" class="text-muted">Payment</label>
                                  <input placeholder="Note: must be greater than or equal to balance + fee." type="text" inputmode="decimal" pattern="^\d*\.?\d{0,2}$" class="form-control" id="payment" name="payment" required maxlength="10">
                                  <small class="text-danger d-none" id="limit-warning">Maximum payment is PHP 1,000,000</small>
                                  <small class="text-danger d-none" id="invalid-warning"></small>
                                </div>
                                
                                <!-- Transaction Fee Field -->
                                <input type="hidden" id="transaction_fee_input" name="transaction_fee" value="0">

                                <div class="mt-3">
                                  <h5>Payment Computation</h5>
                                  <input type="hidden" name="student_id" value="">
                                  
                                  <div class="d-flex justify-content-between">
                                    <span class="text-muted">Amount pay:</span>
                                    <span class='text-muted' id="balance-display">PHP </span>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                    <span class="text-muted">Amount Paid:</span>
                                    <span class="text-muted" id="amount-paid">PHP 0.00</span>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                    <span class="text-muted">Transaction Fee:</span>
                                    <span class="text-muted" id="transaction-fee">PHP 0.00</span>
                                  </div>

                                  <div class="d-flex justify-content-between">
                                    <span class="text-muted">Change:</span>
                                    <span class="text-muted" id="change">PHP 0.00</span>
                                  </div>

                                  <hr>

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirm-check">
                                    <label class="form-check-label text-muted small" for="confirm-check">
                                      I review the reference and amount is correct
                                    </label>
                                  </div>
                                </div>

                                <script>
                                  document.addEventListener("DOMContentLoaded", function () {
                                    const balance = <?php echo json_encode($amount_pay); ?>;
                                    const paymentInput = document.getElementById('payment');
                                    const amountPaidDisplay = document.getElementById('amount-paid');
                                    const changeDisplay = document.getElementById('change');
                                    const checkbox = document.getElementById('confirm-check');
                                    const submitBtn = document.querySelector('button[type="submit"]');
                                    const limitWarning = document.getElementById('limit-warning');
                                    const invalidWarning = document.getElementById('invalid-warning');
                                    const paymentType = document.getElementById('payment_type');
                                    const referenceInput = document.getElementById('reference');
                                    const transactionFeeDisplay = document.getElementById('transaction-fee');
                                    const transactionFeeInput = document.getElementById('transaction_fee_input');

                                    let transactionFee = 0;

                                    function updateTransactionFee() {
                                      const type = paymentType.value;
                                      transactionFee = (type === 'GCash' || type === 'Bank Transfer') ? 15 : 0;
                                      transactionFeeDisplay.textContent = 'PHP ' + formatCurrency(transactionFee);
                                      transactionFeeInput.value = transactionFee;
                                      validatePayment(); // revalidate whenever fee changes
                                    }

                                    function toggleReferenceField() {
                                      if (paymentType.value === 'Cash') {
                                        referenceInput.disabled = true;
                                        referenceInput.removeAttribute('required');
                                        referenceInput.value = '';
                                      } else {
                                        referenceInput.disabled = false;
                                        referenceInput.setAttribute('required', 'required');
                                      }
                                      updateTransactionFee();
                                    }

                                    function formatCurrency(amount) {
                                      return amount.toLocaleString('en-PH', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                      });
                                    }

                                    function validatePayment() {
                                      const rawValue = paymentInput.value.replace(/[^0-9.]/g, '');
                                      let payment = parseFloat(rawValue) || 0;

                                      if (payment > 1000000) {
                                        payment = 1000000;
                                        paymentInput.value = '1000000';
                                        limitWarning.classList.remove('d-none');
                                      } else {
                                        limitWarning.classList.add('d-none');
                                      }

                                      const totalDue = balance + transactionFee;
                                      const change = payment - totalDue;

                                      amountPaidDisplay.textContent = 'PHP ' + formatCurrency(payment);
                                      changeDisplay.textContent = 'PHP ' + (change >= 0 ? formatCurrency(change) : '0.00');

                                      if (payment < totalDue) {
                                        invalidWarning.classList.remove('d-none');
                                        submitBtn.disabled = true;
                                      } else {
                                        invalidWarning.classList.add('d-none');
                                        submitBtn.disabled = !checkbox.checked;
                                      }
                                    }

                                    paymentInput.addEventListener('input', validatePayment);
                                    paymentType.addEventListener('change', toggleReferenceField);
                                    checkbox.addEventListener('change', validatePayment);

                                    toggleReferenceField(); // initialize
                                    submitBtn.disabled = true;
                                  });
                                </script>
                              </div>

                              <div class="modal-footer">
                                <button type="submit" class="btn btn-danger text-light px-4">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              </div>
                            </form>



                            </div>
                        </div>
                        </div>

                    </div>
                       <table class="table table-hover table-sm table-striped pt-3 pb-3 text-muted" style="font-size: 12px; cursor: pointer">
                        <thead>
                            <tr>
                                <th>Invoice No.</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Fee</th>
                                <th>Change</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                       <tbody>
                        <?php
                        $student_id = $tuition_id; // or use from session

                        $stmt = $conn->prepare("SELECT invoice_number, date, amount, payment, `change`, transaction_fee, payment_type FROM payment WHERE tuition_id = ? ORDER BY date DESC");
                        $stmt->bind_param("i", $student_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $formatted_invoice = 'INV-' . str_pad($row['invoice_number'], 4, '0', STR_PAD_LEFT);
                                echo "<tr class='clickable-row' data-id='{$row['invoice_number']}' data-student='{$student_id}'>";
                                echo "<td class='py-3'>{$formatted_invoice}</td>";
                                echo "<td class='py-3'>" . $row['date'] . "</td>";
                                echo "<td class='py-3'>₱" . number_format($row['amount'], 2) . "</td>";
                                echo "<td class='py-3'>₱" . number_format($row['payment'], 2) . "</td>";
                                echo "<td class='py-3'>₱" . number_format($row['transaction_fee'], 2) . "</td>";
                                echo "<td class='py-3'>₱" . number_format($row['change'], 2) . "</td>";
                                echo "<td class='py-3'>" . htmlspecialchars($row['payment_type']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center py-3 text-muted'>
                            <img src='../static/artnotfound.svg'class='mt-3' style='width: 50%; opacity: 70%'>
                            <p>No data found</p>
                            </td></tr>";
                        }

                        $stmt->close();
                        $conn->close();
                        ?>
                        </tbody>
                        <script>
                          document.addEventListener('DOMContentLoaded', function () {
                              document.querySelectorAll('.clickable-row').forEach(function(row) {
                                  row.addEventListener('click', function() {
                                      const invoiceId = this.getAttribute('data-id');
                                      const studentId = this.getAttribute('data-student');
                                      window.location.href = 'view_invoice.php?invoice_id=' + encodeURIComponent(invoiceId) + '&student_id=' + encodeURIComponent(studentId);
                                  });
                              });
                          });
                          </script>


                    </table>
                    </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="row">
                        <div class="col-12 mb-3">
                            <div class=" p-3 rounded shadow rounded-4" style="background-color: accentgreen">
                            <p class="text-muted">Remaining Balance</p>
                            <h2 class="fw-bolder">PHP <?php echo $tuition['tuition_fee']; ?></h2>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Radial Percentage Donut -->
                            <div class="p-3 shadow rounded rounded-4">
                            <h6 class="mb-3 text-muted">Payment Completion</h6>
                            <div id="radialChart"></div>
                            </div>
                        </div>
                        </div>
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



<input type="hidden" id="balance" value="<?php echo $balance; ?>">
<input type="hidden" id="amount_pay" value="<?php echo $remaining_balance; ?>">

<script>
  // Get values from input fields
  const balance = parseFloat(document.getElementById("balance").value) || 0;
  const amountPay = parseFloat(document.getElementById("amount_pay").value) || 0;

  // Calculate percentage
  let percentage = 0;
  if (balance > 0) {
    percentage = (100-(amountPay / balance) * 100);
    if (percentage > 100) percentage = 100; // Cap at 100%
  }

  // Determine label based on percentage
  let chartLabel = 'Progress';
  if (percentage >= 100) {
    chartLabel = 'Completed';
  }

  // ApexCharts options
  var options = {
    chart: {
      type: 'radialBar',
      height: 250
    },
    plotOptions: {
      radialBar: {
        hollow: {
          size: '60%',
        },
        dataLabels: {
          name: {
            show: true,
            fontSize: '16px'
          },
          value: {
            fontSize: '20px',
            formatter: function (val) {
              return val.toFixed(1) + "%";
            }
          }
        }
      }
    },
    series: [percentage], // dynamic percentage
    labels: [chartLabel],
    colors: ['#b72029']
  };

  // Render chart
  var chart = new ApexCharts(document.querySelector("#radialChart"), options);
  chart.render();
</script>
