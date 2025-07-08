<?php
include 'session_login.php';
include '../db_connection.php';
$id = (int) $_GET['id'];
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
                    <div class="col-12 col-md-5">
                        <div class="row">
                        <div class="col-12 mb-3">
                            <div class="border shadow p-3 rounded rounded-4" style="background-color: accentgreen">
                            <p class="text-muted">Balance</p>
                            <h1 class="fw-bolder">PHP 56,000.00</h1>
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

                    <div class="col-12 col-md-7">
                        <!-- Table Area -->
                        <div class="border p-3 rounded shadow rounded-4">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-muted">Recent Payments</h6>
                        <a href="#" class="btn btn-sm border rounded rounded-4 px-4">
                            <i class="bi bi-cash me-2"></i> Pay
                        </a>
                    </div>

                       <table class="table table-sm table-striped pt-3 pb-3 text-muted" style="font-size: 12px">
                            <thead>
                                <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="py-3">2025-07-01</td>
                                <td class="py-3">Initial Payment</td>
                                <td class="py-3">₱20,000.00</td>
                                </tr>
                                <tr>
                                <td class="py-3">2025-07-15</td>
                                <td class="py-3">Mid-Term Payment</td>
                                <td class="py-3">₱10,000.00</td>
                                </tr>
                                <tr>
                                <td class="py-3">2025-08-01</td>
                                <td class="py-3">Final Payment</td>
                                <td class="py-3">₱26,000.00</td>
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

