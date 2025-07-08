<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Billing</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container py-4">
      <form action="process_payment.php" method="POST">
        <div class="bg-white p-4 rounded-4 shadow-sm">
          <h2>Student Billing Statement</h2>
          <p class="text-muted">Review all billing information before submitting.</p>
          <hr>

          <!-- STUDENT INFO SECTION -->
          <h5 class="mt-3">Student Information</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="student_name" class="form-label">Full Name</label>
              <input type="text" name="student_name" id="student_name" class="form-control" value="<?= htmlspecialchars($data['full_name'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="student_id" class="form-label">Student ID</label>
              <input type="text" name="student_id" id="student_id" class="form-control" value="<?= htmlspecialchars($data['student_id'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="grade_level" class="form-label">Grade Level</label>
              <input type="text" name="grade_level" id="grade_level" class="form-control" value="<?= htmlspecialchars($data['grade_level'] ?? '') ?>">
            </div>

            <div class="col-md-6">
              <label for="billing_date" class="form-label">Billing Date</label>
              <input type="date" name="billing_date" id="billing_date" class="form-control" value="<?= date('Y-m-d') ?>">
            </div>
          </div>

          <!-- BILLING ITEMS SECTION -->
          <h5 class="mt-4">Billing Items</h5>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>Description</th>
                  <th class="text-end">Amount (₱)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tuition Fee</td>
                  <td class="text-end"><input type="number" name="tuition_fee" class="form-control text-end" value="0" required></td>
                </tr>
                <tr>
                  <td>Miscellaneous Fees</td>
                  <td class="text-end"><input type="number" name="misc_fee" class="form-control text-end" value="0" required></td>
                </tr>
                <tr>
                  <td>Books & Materials</td>
                  <td class="text-end"><input type="number" name="books_fee" class="form-control text-end" value="0" required></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th>Total</th>
                  <th class="text-end text-success">
                    <span id="total_amount">₱0.00</span>
                  </th>
                </tr>
              </tfoot>
            </table>
          </div>

          <!-- PAYMENT STATUS -->
          <div class="row g-3 mt-3">
            <div class="col-md-6">
              <label for="status" class="form-label">Payment Status</label>
              <select name="status" id="status" class="form-control" required>
                <option value="">Select status...</option>
                <option value="unpaid">Unpaid</option>
                <option value="partial">Partially Paid</option>
                <option value="paid">Fully Paid</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="remarks" class="form-label">Remarks</label>
              <textarea name="remarks" id="remarks" rows="2" class="form-control"></textarea>
            </div>
          </div>

          <!-- SUBMIT -->
          <div class="col-12 text-start pt-4">
            <button type="submit" class="btn bg-main text-light">Submit Payment</button>
            <a href="billing.php" class="btn btn-secondary ms-2">Back</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
  function updateTotal() {
    const tuition = parseFloat(document.querySelector('[name="tuition_fee"]').value) || 0;
    const misc = parseFloat(document.querySelector('[name="misc_fee"]').value) || 0;
    const books = parseFloat(document.querySelector('[name="books_fee"]').value) || 0;
    const total = tuition + misc + books;
    document.getElementById('total_amount').innerText = '₱' + total.toFixed(2);
  }

  document.querySelectorAll('[name="tuition_fee"], [name="misc_fee"], [name="books_fee"]').forEach(input => {
    input.addEventListener('input', updateTotal);
  });

  // Initialize total
  updateTotal();
</script>

</body>
</html>
