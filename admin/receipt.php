<?php include 'session_login.php'; ?>
<?php
$student_name = $_POST['student_name'] ?? '';
$grade_level = $_POST['grade_level'] ?? '';
$tuition_fee = $_POST['tuition_fee'] ?? 0;
$miscellaneous = $_POST['miscellaneous'] ?? 0;
$total = $_POST['total'] ?? 0;
$discount_type = $_POST['discount_type'] ?? '';
$discount_value = $_POST['discount_value'] ?? 0;
$final_amount = $_POST['final_amount'] ?? 0;
$downpayment = $_POST['downpayment'] ?? 0;
$balance = $_POST['balance'] ?? 0;
$payment_plan = $_POST['payment_plan'] ?? '';

// Now display the receipt using these variables
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Tuition Fees</title>
  <?php include 'header.php' ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-8">
                  <!-- <h4>Receipt</h4> -->
                </div>
                
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="rounded">
                   <div class="d-flex align-items-center mb-4">
                      <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px; width: auto;" class="me-3">
                      <div>
                        <h5 class="mb-0 fw-bold">The Cardinal Academy</h5>
                        <small>Sullera Street in Pandayan, Meycauayan, Bulacan </small><br>
                        <small>Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
                      </div>
                    </div>

                    <hr>

                    <div class="mb-3 p-2">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <strong>Student Name:</strong> <?= htmlspecialchars($student_name) ?><br>
                          <strong>Grade Level:</strong> <?= htmlspecialchars($grade_level) ?><br>
                        </div>
                        <div class="col-12 col-md-6">
                          <strong>Payment Plan:</strong> <?= htmlspecialchars($payment_plan) ?><br>
                          <strong>Date:</strong> <?= date('F j, Y') ?>
                        </div>
                      </div>
                    </div>

                    <hr>
                    <h3 class="ps-2 fw-bolder">Summary of Payment</h3>

                    <table class="table" >
                      <thead>
                        <tr>
                          <th>Description</th>
                          <th class="text-end">Amount (₱)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Tuition Fee</td>
                          <td class="text-end"><?= number_format($tuition_fee, 2) ?></td>
                        </tr>
                        <tr>
                          <td>Miscellaneous</td>
                          <td class="text-end"><?= number_format($miscellaneous, 2) ?></td>
                        </tr>
                        <tr class="warning">
                          <td><strong>Discount (<?= htmlspecialchars($discount_type) ?>)</strong></td>
                          <td class="text-end">-<?= number_format($discount_value, 2) ?></td>
                        </tr>
                        <tr class="light">
                          <td><strong>Total After Discount</strong></td>
                          <td class="text-end"><strong><?= number_format($final_amount, 2) ?></strong></td>
                        </tr>
                        <tr class="success">
                          <td><strong>Downpayment</strong></td>
                          <td class="text-end"><?= number_format($downpayment, 2) ?></td>
                        </tr>
                        <tr class="danger">
                          <td><strong>Remaining Balance</strong></td>
                          <td class="text-end"><strong><?= number_format($final_amount, 2) ?></strong></td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="text-end mt-4 d-print-none">
                      <button onclick="window.print()" class="btn btn-primary">
                        <i class="bi bi-printer"></i> Print Receipt
                      </button>
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
