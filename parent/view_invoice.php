<?php
include 'session_login.php';
include '../db_connection.php';

$id = (int) $_GET['invoice_id']; // invoice_number
$tuition_id = (int) $_GET['tuition_id'];

// Fetch payment with student and tuition details + balance
$sql = "
SELECT 
    p.invoice_number,
    p.reference_number,
    p.date,
    p.payment,
    p.payment_type,
    p.reference_number,
    p.transaction_fee,
    st.account_number,
    st.tuition_fee,
    st.payment_plan,
    st.registration_fee,
    st.miscellaneous,
    st.uniform,
    st.discount_type,
    st.discount_value,
    st.discount_amount,
    st.downpayment,
    si.firstname,
    si.middlename,
    si.lastname,
    CONCAT_WS(', ', si.residential_address, si.barangay, si.municipal, si.province) AS full_address,
    -- compute balance
    (st.tuition_fee - IFNULL((SELECT SUM(pp.payment) 
                              FROM payment pp 
                              WHERE pp.tuition_id = st.id), 0)) AS balance
FROM payment p
JOIN student_tuition st ON p.tuition_id = st.id
JOIN student_information si ON st.student_number = si.student_number
WHERE p.invoice_number = ?
  AND p.tuition_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $tuition_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    die("No record found.");
}

// Format values
$fullname = $data['firstname'] . ' ' . ($data['middlename'] ? $data['middlename'] . ' ' : '') . $data['lastname'];
$full_address = $data['full_address'];
$reference_number = $data['reference_number'];
$invoice = 'INV-' . str_pad($data['invoice_number'], 4, '0', STR_PAD_LEFT);
$date = date("F j, Y", strtotime($data['date']));
$payment = number_format($data['payment'], 2);
$fee = number_format($data['transaction_fee'], 2);
$type = $data['payment_type'];
$account_no = $data['account_number'];
$plan = $data['payment_plan'];
$registration_fee = number_format($data['registration_fee'], 2);
$tuition_fee = number_format($data['tuition_fee'], 2);
$misc = number_format($data['miscellaneous'], 2);
$uniform = number_format($data['uniform'], 2);
$discount = number_format($data['discount_amount'], 2);
$downpayment = number_format($data['downpayment'], 2);
$balance = number_format($data['balance'], 2);
$total = number_format((float)$data['balance'] + (float)$data['payment'], 2);

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
                <a href="view_tuition2.php?tuition_id=<?php echo $tuition_id; ?>" 
                  class="btn btn-sm border text-muted rounded-4">
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
                  <p class="mb-1"><strong>Date:</strong> <?php echo $date; ?></p>
                  <p class="mb-1"><strong>Student Name:</strong> <?php echo $fullname; ?></p>
                  <p class="mb-1"><strong>Residential Address:</strong> <?php echo $full_address; ?></p>
                </div>
                <div class="col-12 col-md-6">
                  <p class="mb-1"><strong>Invoice Number:</strong> <?php echo $invoice; ?></p>
                  <p class="mb-1"><strong>Reference Number:</strong> <?php echo $reference_number; ?></p>
                  <p class="mb-1"><strong>Account Number:</strong> <?php echo $account_no; ?></p>
                </div>
              </div>

              <hr class="my-3">
              <h5 class="fw-bold mb-3 d-print-block">Summary</h5>
              <div class="row">
                <div class="col-12 col-md-6">
                   <p class="mb-1"><strong>Tuition Fee:</strong> ₱<?php echo $tuition_fee; ?></p>
                  <p class="mb-1"><strong>Payment Plan:</strong> <?php echo $plan; ?></p>
                  <p class="mb-1"><strong>Payment Type:</strong> <?php echo $type; ?></p>
                  <p class="mb-1"><strong>Transaction Fee:</strong> ₱<?php echo $fee; ?></p>
                 
                </div>
                <div class="col-12 col-md-6">
                   <p class="mb-1"><strong>Balance:</strong> ₱<?php echo $total; ?></p>
                   <p class="mb-1"><strong>Payment:</strong> ₱<?php echo $payment; ?></p>
                   <p class="mb-1"><strong>Remaining:</strong> ₱<?php echo $balance; ?></p>
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
