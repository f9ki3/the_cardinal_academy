<?php
include 'session_login.php';
include '../db_connection.php';

$id = (int) $_GET['id'];
$student_id = $id; // Define properly before using in queries

// ✅ Get total amount paid by student
$total_stmt = $conn->prepare("SELECT SUM(amount) AS total_amount FROM payment WHERE student_id = ?");
$total_stmt->bind_param("i", $student_id);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_amount = $total_row['total_amount'] ?? 0; // fallback to 0
$total_stmt->close();

// ✅ Get balance and enrollment info
$sql = "SELECT enroll_form.tuition_fee, enroll_form.miscellaneous, enroll_form.payment_plan , enroll_form.firstname, enroll_form.middlename, enroll_form.lastname,  enroll_form.residential_address,  enroll_form.admission_date
        FROM users 
        JOIN enroll_form ON users.enroll_id = enroll_form.id 
        WHERE users.acc_type = 'student' AND users.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result(); 

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $tuition_fee = (float) $data['tuition_fee'];
    $misc = (float) $data['miscellaneous'];
    $balance = $tuition_fee + $misc;
    $payment_plan = $data['payment_plan'];
    $fullname = $data['firstname'] . ' ' . $data['lastname'];
    $residential_address = $data['residential_address'];
    $admission_date = $data['admission_date'];


    $amount_pay = 0;

    if ($payment_plan == 'Semestral'){
      $amount_pay = $balance / 2;
    }else if ($payment_plan == 'Quarterly'){
      $amount_pay = $balance / 4;
    }else if ($payment_plan == 'Monthly'){
      $amount_pay = $balance / 9;
    }else{
      $amount_pay = $balance / 1;
    }

    // ✅ Calculate remaining balance
    $remaining_balance = $balance - $total_amount;
} else {
    echo "No matching student found.";
    exit;
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
                          <span class="me-3 text-muted">Student: <?php echo $fullname; ?></span>
                          <span class="me-3 text-muted">Residential_address: <?php echo $residential_address; ?></span>
                      </div>
                      <div class="col-12 d-flex flex-column col-md-6">
                          <span class="me-3 text-muted">Admission_date: <?php echo $admission_date; ?>
                          </span><span class="me-3 text-muted">Tuition Fee: PHP <?php echo number_format($balance, 2); ?></span>
                      </div>

                     </div>
                    </div>

                    <hr>
                    <div class="col-12 col-md-8">
                        <!-- Table Area -->
                        <div class=" rounded rounded-4">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-muted">Recent Payments - <?php echo $payment_plan?></h6>
                        <!-- Button trigger modal -->
                         <?php if (number_format($remaining_balance, 2) == 0): ?>
                          <a href="#" class="btn btn-danger btn-sm rounded rounded-4 px-4 disabled">
                            <i class="bi bi-check-circle me-2"></i> Paid
                          </a>
                        <?php else: ?>
                          <a href="#" class="btn btn-danger btn-sm border rounded rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#payModal">
                            <i class="bi bi-cash me-2"></i> Pay
                          </a>
                        <?php endif; ?>

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
                                  <input type="hidden" name="student_id" value="<?php echo $id;?>">
                                  
                                  <div class="d-flex justify-content-between">
                                    <span class="text-muted">Amount pay:</span>
                                    <span class='text-muted' id="balance-display">PHP <?php echo htmlspecialchars(number_format($amount_pay, 2)); ?></span>
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
                        $student_id = $id; // or use from session

                        $stmt = $conn->prepare("SELECT invoice_number, date, amount, payment, `change`, transaction_fee, payment_type FROM payment WHERE student_id = ? ORDER BY date DESC");
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
                            echo "<tr><td colspan='6' class='text-center py-3 text-muted'>
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
                            <h2 class="fw-bolder">PHP <?php echo number_format($remaining_balance, 2); ?></h2>
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
