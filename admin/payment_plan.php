<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$admission_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$grade_level = isset($_GET['grade']) ? $_GET['grade'] : '';

$tuition_fee = 0;
$miscellaneous = 0;
$total = 0;

if (!empty($grade_level)) {
    $query = "SELECT tuition_fee, miscellaneous  FROM tuition_fees WHERE grade_level = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $grade_level);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $tuition_fee = $row['tuition_fee'];
        $miscellaneous = $row['miscellaneous'];
        $total = $tuition_fee + $miscellaneous;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container py-4">
     <form action="approved_admission.php" method="POST">
        <div class="bg-white p-4 rounded-4 shadow-sm">
        <fieldset>
          <h4><strong>Payment Plan</strong></h4>
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label text-muted">Select Payment Plan</label>
              <select name="payment_plan" id="payment_plan" class="form-control" required>
                <option value="">-- Select Payment Plan --</option>
                <option value="Annual">Annual (1 Year)</option>
                <option value="Semestral">Semestral (2 months)</option>
                <option value="Quarterly">Quarterly (4 months)</option>
                <option value="Monthly">Monthly (9 months)</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Downpayment (Registration Fee)</label>
              <input type="text" class="form-control" value="₱2,500" readonly>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Tuition Fee</label>
              <input type="text" class="form-control" value="₱<?= number_format($tuition_fee, 2) ?>" readonly>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Miscellaneous</label>
              <input type="text" class="form-control" value="₱<?= number_format($miscellaneous, 2) ?>" readonly>
            </div>

            <div class="col-md-12">
                <div class="border rounded-4 p-3" id="payment_breakdown">
                    <p>Payment Plan Breakdown</p>
                </div>
            </div>

            <div class="col-12 col-md-2">
              <button type="submit" name="action" value="enroll" class="btn btn-danger text-light rounded-4 mt-3 w-100">Enroll</button>
            </div>
            <div class="col-12 col-md-2">
              <button type="submit" name="action" value="for_review" class="btn btn-outline-danger text-danger border-2 rounded-4 mt-3 w-100">Back</button>
            </div>
          </div>
        </fieldset>
      </div>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const paymentPlanSelect = document.getElementById("payment_plan");
    const breakdownContainer = document.getElementById("payment_breakdown");

    // PHP values passed to JS
    const tuition = <?= $tuition_fee ?>;
    const misc = <?= $miscellaneous ?>;
    const downpayment = 2500;
    const total = tuition + misc;
    const balance = total + downpayment;

    paymentPlanSelect.addEventListener("change", function () {
        const plan = this.value;
        let installmentCount = 1;
        let label = '';

        switch (plan) {
            case 'Annual':
                installmentCount = 1;
                label = 'Full Payment';
                break;
            case 'Semestral':
                installmentCount = 2;
                label = 'per Semester';
                break;
            case 'Quarterly':
                installmentCount = 4;
                label = 'per Quarter';
                break;
            case 'Monthly':
                installmentCount = 9;
                label = 'per Month';
                break;
            default:
                breakdownContainer.innerHTML = '<p>Payment Plan Breakdown</p>';
                return;
        }

        const installmentAmount = balance / installmentCount;
        breakdownContainer.innerHTML = `
            <p><strong>Downpayment:</strong> ₱${downpayment.toLocaleString(undefined, {minimumFractionDigits: 2})}</p>
            <hr>
            <p><strong>Total Tuition + Misc:</strong> ₱${total.toLocaleString(undefined, {minimumFractionDigits: 2})}</p>
            <hr>
            <p><strong>Remaining Balance:</strong> ₱${balance.toLocaleString(undefined, {minimumFractionDigits: 2})}</p>
            <hr>
            <p><strong>${installmentCount} ${label} Payment${installmentCount > 1 ? 's' : ''}:</strong> ₱${installmentAmount.toLocaleString(undefined, {minimumFractionDigits: 2})}</p>
        `;
    });
});
</script>
