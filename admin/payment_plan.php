<?php
include 'session_login.php';
include '../db_connection.php';

$admission_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$grade_level = isset($_GET['grade']) ? $_GET['grade'] : '';

$tuition_fee = 0.00;
$miscellaneous = 0.00;
$total = 0.00;

if (!empty($grade_level)) {
    $query = "SELECT tuition_fee, miscellaneous FROM tuition_fees WHERE grade_level = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $grade_level);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $tuition_fee = floatval($row['tuition_fee']);
        $miscellaneous = floatval($row['miscellaneous']);
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
     <form action="enroll_form.php" method="POST">
        <div class="bg-white p-4 rounded-4 shadow-sm">
        <fieldset>
          <h4><strong>Payment Plan</strong></h4>
          <div class="row g-3">
            <input type="hidden" name="id" value="<?= htmlspecialchars($admission_id) ?>">
            <input type="hidden" name="tuition_fee" value="<?= htmlspecialchars($tuition_fee) ?>">
            <input type="hidden" name="miscellaneous" value="<?= htmlspecialchars($miscellaneous) ?>">

            <div class="col-md-6">
              <label class="form-label text-muted">Select Payment Plan</label>
              <select name="payment_plan" id="payment_plan" class="form-control" required>
                <option value="">-- Select Payment Plan --</option>
                <option value="Annual">Annual (1 Year)</option>
                <option value="Semestral">Semestral (2 Semesters)</option>
                <option value="Quarterly">Quarterly (4 Quarters)</option>
                <option value="Monthly">Monthly (9 Months)</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Downpayment (Registration Fee)</label>
              <input type="text" name="downpayment" class="form-control" value="₱2,500.00" readonly>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Tuition Fee</label>
              <input type="text" class="form-control" value="₱<?= number_format($tuition_fee, 2) ?>" readonly>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Miscellaneous</label>
              <input type="text" class="form-control" value="₱<?= number_format($miscellaneous, 2) ?>" readonly>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Discount Type</label>
              <select name="discount_type" id="discount_type" class="form-control">
                <option value="">None</option>
                <option value="percent">Percent (%)</option>
                <option value="fixed">Fixed Amount (₱)</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted">Discount Value</label>
              <input type="number" name="discount_value" id="discount_value" class="form-control" value="0" min="0" step="0.01">
            </div>

            <div class="col-md-12">
              <div class="border mt-3 rounded-4 p-3" id="payment_breakdown">
                <p>Payment Plan Breakdown</p>
                <p class="text-muted">Note: please select payment plan.</p>
              </div>
            </div>

            <div class="col-12 col-md-2">
              <button id="enroll-btn" type="submit" name="action" value="enroll" class="btn btn-danger text-light rounded-4 mt-3 w-100" disabled>
                <span class="btn-text">Enroll</span>
                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
              </button>
            </div>

            <div class="col-12 col-md-2">
              <a href="view_enrollment.php" class="btn btn-outline-danger text-danger border-2 rounded-4 mt-3 w-100">Back</a>
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
    const discountTypeSelect = document.getElementById("discount_type");
    const discountValueInput = document.getElementById("discount_value");
    const breakdownContainer = document.getElementById("payment_breakdown");
    const enrollBtn = document.getElementById("enroll-btn");

    const tuition = parseFloat(<?= json_encode($tuition_fee) ?>);
    const misc = parseFloat(<?= json_encode($miscellaneous) ?>);
    const downpayment = 2500;

    function updateBreakdown() {
        const plan = paymentPlanSelect.value;
        const discountType = discountTypeSelect.value;
        const discountValue = parseFloat(discountValueInput.value) || 0;

        let installmentCount = 1;
        let label = '';

        switch (plan) {
            case 'Annual':    installmentCount = 1; label = 'Full Payment'; break;
            case 'Semestral': installmentCount = 2; label = 'per Semester'; break;
            case 'Quarterly': installmentCount = 4; label = 'per Quarter'; break;
            case 'Monthly':   installmentCount = 9; label = 'per Month'; break;
            default:
                breakdownContainer.innerHTML = '<p>Payment Plan Breakdown</p><p class="text-muted">Note: please select payment plan.</p>';
                enrollBtn.disabled = true;
                return;
        }

        const total = tuition + misc;
        let discount = 0;

        if (discountType === 'percent') {
            discount = total * (discountValue / 100);
        } else if (discountType === 'fixed') {
            discount = discountValue;
        }

        discount = Math.min(discount, total);
        const discountedTotal = total - discount;
        const balance = discountedTotal;
        const installmentAmount = balance / installmentCount;

        breakdownContainer.innerHTML = `
            <p><strong>Tuition + Misc:</strong> ₱${total.toLocaleString(undefined, { minimumFractionDigits: 2 })}</p>
            <p><strong>Discount (${discountType === 'percent' ? discountValue + '%' : '₱' + discountValue}):</strong> -₱${discount.toLocaleString(undefined, { minimumFractionDigits: 2 })}</p>
            <hr>
            <p><strong>Total after Discount:</strong> ₱${discountedTotal.toLocaleString(undefined, { minimumFractionDigits: 2 })}</p>
            <p><strong>Downpayment:</strong> ₱${downpayment.toLocaleString(undefined, { minimumFractionDigits: 2 })}</p>
            <p><strong>Remaining Balance:</strong> ₱${balance.toLocaleString(undefined, { minimumFractionDigits: 2 })}</p>
            <hr>
            <p><strong>${installmentCount} ${label} Payment${installmentCount > 1 ? 's' : ''}:</strong> ₱${installmentAmount.toLocaleString(undefined, { minimumFractionDigits: 2 })}</p>
        `;

        enrollBtn.disabled = plan === '';
    }

    paymentPlanSelect.addEventListener("change", updateBreakdown);
    discountTypeSelect.addEventListener("change", updateBreakdown);
    discountValueInput.addEventListener("input", updateBreakdown);

    enrollBtn.addEventListener('click', function () {
        enrollBtn.querySelector('.spinner-border').classList.remove('d-none');
    });

    updateBreakdown();
});
</script>
