<?php
include 'session_login.php';
include '../db_connection.php';

$id = (int) $_GET['id'];

// SQL query joining users and enroll_form
$sql = "SELECT enroll_form.tuition_fee, enroll_form.miscellaneous, enroll_form.payment_plan 
        FROM users 
        JOIN enroll_form ON users.enroll_id = enroll_form.id 
        WHERE users.acc_type = 'student' AND users.user_id = ?";

// Prepare and execute
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result(); 

// Fetch and calculate balance
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $tuition_fee = (float) $data['tuition_fee'];
    $misc = (float) $data['miscellaneous'];
    $balance = $tuition_fee + $misc;
    $payment_plan = $data['payment_plan'];

    // Output or use the variables as needed
    // echo "Balance: ₱" . number_format($balance, 2) . "<br>";
    echo "Payment Plan: " . htmlspecialchars($payment_plan);
} else {
    echo "No matching student found.";
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
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-10">
                  <h4>Tuition Transaction</h4>
                </div>

              </div>

              <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="row">
                        <div class="col-12 mb-3">
                            <div class="border shadow p-3 rounded rounded-4" style="background-color: accentgreen">
                            <p class="text-muted">Balance</p>
                            <h2 class="fw-bolder">PHP <?php echo htmlspecialchars(number_format($balance, 2)); ?></h2>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Radial Percentage Donut -->
                            <div class="border p-3 shadow rounded rounded-4">
                            <h6 class="mb-3 text-muted">Payment Completion</h6>
                            <div id="radialChart"></div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <!-- Table Area -->
                        <div class="border p-3 rounded shadow rounded-4">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-muted">Recent Payments</h6>
                        <!-- Button trigger modal -->
                        <a href="#" class="btn btn-sm border rounded rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#payModal">
                        <i class="bi bi-cash me-2"></i> Pay
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 shadow">
                            <div class="modal-header">
                                <h5 class="modal-title" id="payModalLabel">Enter Payment Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="pay_bill.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                               <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="reference" class="form-label">Reference Number</label>
                                    <input type="number" step="0.01" class="form-control" id="reference" name="reference" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="payment_type" class="form-label">Payment Type</label>
                                    <select class="form-select" id="payment_type" name="payment_type" required>
                                    <option value="">Select Type</option>
                                    <option value="Cash">Cash</option>
                                    <option value="GCash">GCash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    </select>
                                </div>
                                </div>


                                <div class="mb-2">
                                    <label for="payment" class="form-label">Payment</label>
                                    <input type="number" step="0.01" class="form-control" id="payment" name="payment" required>
                                </div>

                                </div>

                                <div class="modal-footer">
                                <button type="submit" class="btn bg-main text-light px-4">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>

                            </div>
                        </div>
                        </div>

                    </div>
                       <table class="table table-sm table-striped pt-3 pb-3 text-muted" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Change</th>
                                    <th>Payment Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3">INV-0001</td>
                                    <td class="py-3">₱20,000.00</td>
                                    <td class="py-3">₱20,000.00</td>
                                    <td class="py-3">₱0.00</td>
                                    <td class="py-3">Cash</td>
                                </tr>
                                <tr>
                                    <td class="py-3">INV-0002</td>
                                    <td class="py-3">₱10,000.00</td>
                                    <td class="py-3">₱10,000.00</td>
                                    <td class="py-3">₱0.00</td>
                                    <td class="py-3">Gcash</td>
                                </tr>
                                <tr>
                                    <td class="py-3">INV-0003</td>
                                    <td class="py-3">₱26,000.00</td>
                                    <td class="py-3">₱26,000.00</td>
                                    <td class="py-3">₱0.00</td>
                                    <td class="py-3">Bank Transfer</td>
                                </tr>
                            </tbody>
                        </table>

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

<script>
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
              return val + "%";
            }
          }
        }
      }
    },
    series: [80], // percentage
    labels: ['Progress'],
    colors: ['#b72029'] // 🔴 Red color
  };

  var chart = new ApexCharts(document.querySelector("#radialChart"), options);
  chart.render();
</script>

