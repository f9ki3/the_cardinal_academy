<?php
include 'session_login.php';
include '../db_connection.php';

$id = (int) $_GET['invoice_id'];
$student_id = (int) $_GET['student_id'];

// Fetch payment details
$stmt = $conn->prepare("SELECT *
FROM payment
JOIN users ON payment.student_id = users.user_id
JOIN enroll_form ON users.enroll_id = enroll_form.id
WHERE payment.invoice_number = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

$fullname = $data['first_name'] . ' ' . $data['last_name'];
$address = $data['address'];
$invoice = 'INV-' . str_pad($data['invoice_number'], 4, '0', STR_PAD_LEFT);
$date = date("F j, Y", strtotime($data['date']));
$amount = number_format($data['amount'], 2);
$payment = number_format($data['payment'], 2);
$change = number_format($data['change'], 2);
$fee = number_format($data['transaction_fee'], 2);
$plan = $data['payment_plan'];
$type = $data['payment_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys – Receipt</title>
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
          <div class="rounded p-4 bg-white">

            <!-- Top Header (Web Only) -->
            <div class="row mt-4 align-items-center mb-4">
              <div class="col-md-4 mb-2">
                <h4 class="mb-0 d-print-none">Official Receipt</h4>
              </div>
              <div class="col-md-8 d-flex justify-content-md-end gap-2 d-print-none">
                <button class="btn btn-sm border text-muted rounded-4" onclick="window.print()">
                  <i class="bi bi-printer me-1"></i> Print
                </button>
                <a href="view_tuition.php?id=<?php echo urlencode($student_id); ?>" class="btn btn-sm border text-muted rounded-4">
                  <i class="bi bi-arrow-left me-1"></i> Go Back
                </a>

              </div>
            </div>

            <!-- Header Branding (Print Only) -->
            <div class="d-none d-print-block text-center mb-3">
              <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px;">
              <h5 class="fw-bold mt-2 mb-0">The Cardinal Academy, Inc.</h5>
              <small>Sullera Street, Pandayan, Meycauayan, Bulacan</small><br>
              <small>Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
              <hr>
              <h4 class="mt-3">Official Receipt</h4>
            </div>

            <!-- Transaction Details -->
            <div class="receipt-info text-muted mb-4">
              <h5 class="fw-bold mb-3 d-print-block">Transaction Details</h5>
              <div class="row mb-3">
                <div class="col-12 col-md-6">
                  <p class="mb-1"><strong>Student Name:</strong> <?php echo $fullname; ?></p>
                  <p class="mb-1"><strong>Residential Address:</strong> <?php echo $address; ?></p>
                </div>
                <div class="col-12 col-md-6">
                  <p class="mb-1"><strong>Invoice Number:</strong> <?php echo $invoice; ?></p>
                  <p class="mb-1"><strong>Date:</strong> <?php echo $date; ?></p>
                </div>
              </div>

              <hr class="my-3">
              <h5 class="fw-bold mb-3 d-print-block">Transaction Computation</h5>
              <div class="row">
                <div class="col-12 col-md-6">
                  <p class="mb-1"><strong>Amount:</strong> ₱<?php echo $amount; ?></p>
                  <p class="mb-1"><strong>Payment:</strong> ₱<?php echo $payment; ?></p>
                  <p class="mb-1"><strong>Change:</strong> ₱<?php echo $change; ?></p>
                </div>
                <div class="col-12 col-md-6">
                  <p class="mb-1"><strong>Payment Plan:</strong> <?php echo $plan; ?></p>
                  <p class="mb-1"><strong>Payment Type:</strong> <?php echo $type; ?></p>
                  <p class="mb-1"><strong>Transaction Fee:</strong> ₱<?php echo $fee; ?></p>
                </div>
              </div>
            </div>

            <!-- Footer Note -->
            <div class="d-flex justify-content-center" style="background-color: #b72029;">
              <div class="p-2 text-center text-light">
                <p class="mb-0">Kindly retain this receipt for future reference. Thank you.</p>
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
