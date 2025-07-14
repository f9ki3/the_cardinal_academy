<?php
include 'session_login.php';
include '../db_connection.php';

// Get Admissions Count (Pending only)
$admission_count = 0;
$admission_query = "SELECT COUNT(*) AS total FROM admission_form WHERE admission_status = 'pending'";
if ($result = mysqli_query($conn, $admission_query)) {
    $row = mysqli_fetch_assoc($result);
    $admission_count = $row['total'];
}

// Get Enrollees Count
$enrollment_count = 0;
$enroll_query = "SELECT COUNT(*) AS total FROM enroll_form";
if ($result = mysqli_query($conn, $enroll_query)) {
    $row = mysqli_fetch_assoc($result);
    $enrollment_count = $row['total'];
}

// ✅ Get Student Count
$student_count = 0;
$student_query = "SELECT COUNT(*) AS total FROM users WHERE acc_type = 'student'";
if ($result = mysqli_query($conn, $student_query)) {
    $row = mysqli_fetch_assoc($result);
    $student_count = $row['total'];
}

// ✅ Get Teacher Count
$teacher_count = 0;
$teacher_query = "SELECT COUNT(*) AS total FROM users WHERE acc_type = 'teacher'";
if ($result = mysqli_query($conn, $teacher_query)) {
    $row = mysqli_fetch_assoc($result);
    $teacher_count = $row['total'];
}

// Get Daily Payment Data
$months = [];
$totals = [];
$payment_query = "
    SELECT DATE_FORMAT(date, '%Y-%m-%d') AS day, SUM(amount) AS total
    FROM payment
    GROUP BY day
    ORDER BY day ASC
";

if ($result = mysqli_query($conn, $payment_query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $months[] = $row['day'];
        $totals[] = number_format((float) $row['total'], 2, '.', '');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <!-- Welcome Message -->
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded rounded-4 p-3 bg-white">
            <h2 class="fw-bold">Welcome to AcadeSys</h2>
            <p class="text-muted">—let's have an awesome year!</p>
          </div>
        </div>
      </div>

      <!-- Counters and Chart -->
      <div class="row g-4 mt-2">
        <!-- Admissions Counter -->
        <div class="col-md-3">
          <div class="card border-0 rounded-4 p-3 bg-white">
            <h6 class="text-muted">Total Admissions</h6>
            <h2 class="fw-bold text-primary mb-0"><?= $admission_count ?></h2>
          </div>
        </div>

        <!-- Enrollees Counter -->
        <div class="col-md-3">
          <div class="card  border-0 rounded-4 p-3 bg-white">
            <h6 class="text-muted">Total Enrollees</h6>
            <h2 class="fw-bold text-primary mb-0"><?= $enrollment_count ?></h2>
          </div>
        </div>


        <div class="col-md-3">
          <div class="card  border-0 rounded-4 p-3 bg-white">
            <h6 class="text-muted">Total Students</h6>
            <h2 class="fw-bold text-primary mb-0"><?= $student_count ?></h2>
          </div>
        </div>


        <div class="col-md-3">
          <div class="card  border-0 rounded-4 p-3 bg-white">
            <h6 class="text-muted">Total teachers</h6>
            <h2 class="fw-bold text-primary mb-0"><?= $teacher_count ?></h2>
          </div>
        </div>

       <!-- Payment Analytics Chart -->
        <div class="col-12">
          <div class="card border-0 rounded-4 p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="mb-0">Daily Payment Transactions</h5>
              <select id="chartType" class="form-select w-auto">
                <option value="line" selected>Line</option>
                <option value="bar">Bar</option>
              </select>
            </div>
            <div id="paymentChart"></div>
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
document.addEventListener('DOMContentLoaded', function () {
  const dates = <?= json_encode($months) ?>;
  const totals = <?= json_encode($totals) ?>.map(val => parseFloat(val));

  let chartType = 'line';

  const chartOptions = {
    chart: {
      type: chartType,
      height: 350,
      toolbar: { show: false }
    },
    series: [{
      name: 'Total Payments',
      data: totals
    }],
    xaxis: {
      categories: dates,
      title: { text: 'Date' }
    },
    yaxis: {
      title: { text: 'Amount (₱)' },
      labels: {
        formatter: val => "₱" + val.toFixed(2)
      }
    },
    tooltip: {
      y: {
        formatter: val => "₱" + val.toFixed(2)
      }
    },
    stroke: {
      curve: 'smooth',
      width: 3
    },
    markers: {
      size: 5
    },
    colors: ['#0d6efd']
  };

  let chart = new ApexCharts(document.querySelector("#paymentChart"), chartOptions);
  chart.render();

  // Listen for select change
  document.getElementById('chartType').addEventListener('change', function () {
    const selectedType = this.value;
    chart.updateOptions({
      chart: {
        type: selectedType
      }
    }, true, true);
  });
});
</script>
