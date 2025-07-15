<?php include 'session_login.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php' ?>
  <style>
    .chat-icon {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #b72029;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      color: white;
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      cursor: pointer;
      z-index: 1000;
    }
    .chat-icon:hover {
      background-color: #da3030;
    }
  </style>
   <script src="https://cdn.tailwindcss.com"></script>
</head>

   
<body class="bg-light">

<div class="d-flex">
  <!-- Sidebar -->
  <?php include 'navigation.php' ?>

  <!-- Main Content -->
  <div class="flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container py-4">
      <!-- Welcome Section -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Dashboard with Custom Tabs</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-hover: #3a56c4;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fc;
            color: #333;
            padding: 20px;
        }
        
        /* Custom Tabs Styling */
        .custom-tabs .nav-tabs {
            border-bottom: none;
            background-color: var(--light-color);
        }
        
        .custom-tabs .nav-link {
            color: var(--secondary-color);
            border: none;
            border-radius: 8px 8px 0 0;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            margin-right: 5px;
            transition: all 0.3s ease;
        }
        
        .custom-tabs .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.1);
        }
        
        .custom-tabs .nav-link.active {
            color: white;
            background-color: var(--primary-color);
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
        }
        
        .custom-tabs .tab-icon {
            margin-right: 8px;
        }
        
        /* Card Styling */
        .dashboard-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        
        /* Performance Meter */
        .performance-meter {
            height: 10px;
            border-radius: 5px;
            background: #e9ecef;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .performance-meter-fill {
            height: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="custom-tabs">
            <!-- Custom Bootstrap Tabs -->
            <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="performance-tab" data-bs-toggle="tab" data-bs-target="#performance" type="button" role="tab">
                        <i class="fas fa-tachometer-alt tab-icon"></i>Gandula
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
                        <i class="bi bi-plus-lg tab-icon"></i>
                    </button>
                </li>
                
            </ul>
            
            <!-- Tab Content -->
            <div class="tab-content p-3 bg-white rounded-bottom">
                <!-- Performance Tab -->
                <div class="tab-pane fade show active" id="performance" role="tabpanel">
                    <div class="container my-4">
        <div class="row g-4">
            <!-- Profile Column -->
            <div class="col-md-4">
                <!-- Profile Card -->
                <div class="card">
                    <div class="card-body text-center pt-5">
                        <h5 class="card-title mb-1" id="student-name">Noah, Domingo</h5>
                        <p class="text-muted small mb-3" id="student-id">Student ID: S12345678</p>
                        <div class="mb-3">
                            <span class="badge-custom me-2">STEM</span>
                        </div>
                        <div class="row text-center border-top pt-3">
                            <div class="col">
                                <div class="text-muted small">GPA</div>
                                <strong>3.8</strong>
                            </div>
                            <div class="col">
                                <div class="text-muted small">Credits</div>
                                <strong>78</strong>
                            </div>
                            <div class="col">
                                <div class="text-muted small">Status</div>
                                <strong class="text-success">Active</strong>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary w-100">Edit Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-envelope me-2 text-primary"></i>Contact Info
                        </h5>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2">
                                <i class="bi bi-geo-alt me-2"></i>123 University Ave, Campus Town
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone me-2"></i>(555) 123-4567
                            </li>
                            <li>
                                <i class="bi bi-envelope-at me-2"></i>alex.johnson@university.edu
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Academic Column -->
            <div class="col-md-8">
                <!-- Academic Progress -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Academic Progress</h5>
                        <div class="row text-center mt-4">
                            <div class="col">
                                <svg width="100" height="100">
                                    <circle cx="50" cy="50" r="40" stroke="#e6e7eb" stroke-width="8" fill="none"/>
                                    <circle cx="50" cy="50" r="40" stroke="#10b981" stroke-width="8" fill="none" stroke-dasharray="251.2" stroke-dashoffset="50.24" transform="rotate(-90 50 50)"/>
                                    <text x="50" y="55" text-anchor="middle" font-size="16" font-weight="bold">80%</text>
                                </svg>
                                <div class="small text-muted mt-1">Degree Completion</div>
                            </div>
                            <div class="col">
                                <svg width="100" height="100">
                                    <circle cx="50" cy="50" r="40" stroke="#e6e7eb" stroke-width="8" fill="none"/>
                                    <circle cx="50" cy="50" r="40" stroke="#3b82f6" stroke-width="8" fill="none" stroke-dasharray="251.2" stroke-dashoffset="75.36" transform="rotate(-90 50 50)"/>
                                    <text x="50" y="55" text-anchor="middle" font-size="16" font-weight="bold">70%</text>
                                </svg>
                                <div class="small text-muted mt-1">Major Requirements</div>
                            </div>
                            <div class="col">
                                <svg width="100" height="100">
                                    <circle cx="50" cy="50" r="40" stroke="#e6e7eb" stroke-width="8" fill="none"/>
                                    <circle cx="50" cy="50" r="40" stroke="#f59e0b" stroke-width="8" fill="none" stroke-dasharray="251.2" stroke-dashoffset="125.6" transform="rotate(-90 50 50)"/>
                                    <text x="50" y="55" text-anchor="middle" font-size="16" font-weight="bold">50%</text>
                                </svg>
                                <div class="small text-muted mt-1">Minor Requirements</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Current Courses</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course</th>
                                        <th>Instructor</th>
                                        <th>Schedule</th>
                                        <th>Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="ms-3">
                                                    <div>CS 401</div>
                                                    <div class="text-muted small">Advanced Algorithms</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Dr. Smith</td>
                                        <td>MWF 9:00–10:15</td>
                                        <td><span class="badge bg-success">201</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3">
                                                    <div>MATH 310</div>
                                                    <div class="text-muted small">Probability Theory</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Prof. Johnson</td>
                                        <td>TTh 11:00–12:15</td>
                                        <td><span class="badge bg-success">201</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">                                               
                                                <div class="ms-3">
                                                    <div>PHYS 250</div>
                                                    <div class="text-muted small">Modern Physics</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Dr. Lee</td>
                                        <td>MW 2:00–3:15</td>
                                        <td><span class="badge bg-success">201</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                
                <!-- Settings Tab -->
                <div class="tab-pane fade" id="settings" role="tabpanel">
                    <div class="row">
                        <div class="container my-4">

        <div class="col-12">
          <div class="rounded p-3 ">
            <div class="container my-4">
              <div class="row mb-3">  
    <div class="container">
        <div class="row g-4">
            <!-- Profile Column -->
            <div class="col-md-4">
                <!-- Profile Card -->
                <div class="card">
                    <div class="card-body text-center pt-5">
                        <h5 class="card-title mb-1" id="student-name">Noah, Domingo</h5>
                        <p class="text-muted small mb-3" id="student-id">Student ID: S12345678</p>
                        <div class="mb-3">
                            <span class="badge-custom me-2">STEM</span>
                        </div>
                        <div class="row text-center border-top pt-3">
                            <div class="col">
                                <div class="text-muted small">GPA</div>
                                <strong>3.8</strong>
                            </div>
                            <div class="col">
                                <div class="text-muted small">Credits</div>
                                <strong>78</strong>
                            </div>
                            <div class="col">
                                <div class="text-muted small">Status</div>
                                <strong class="text-success">Active</strong>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary w-100">Edit Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-envelope me-2 text-primary"></i>Contact Info
                        </h5>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2">
                                <i class="bi bi-geo-alt me-2"></i>123 University Ave, Campus Town
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone me-2"></i>(555) 123-4567
                            </li>
                            <li>
                                <i class="bi bi-envelope-at me-2"></i>alex.johnson@university.edu
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Academic Column -->
            <div class="col-md-8">
                <!-- Academic Progress -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Academic Progress</h5>
                        <div class="row text-center mt-4">
                            <div class="col">
                                <svg width="100" height="100">
                                    <circle cx="50" cy="50" r="40" stroke="#e6e7eb" stroke-width="8" fill="none"/>
                                    <circle cx="50" cy="50" r="40" stroke="#10b981" stroke-width="8" fill="none" stroke-dasharray="251.2" stroke-dashoffset="50.24" transform="rotate(-90 50 50)"/>
                                    <text x="50" y="55" text-anchor="middle" font-size="16" font-weight="bold">80%</text>
                                </svg>
                                <div class="small text-muted mt-1">Degree Completion</div>
                            </div>
                            <div class="col">
                                <svg width="100" height="100">
                                    <circle cx="50" cy="50" r="40" stroke="#e6e7eb" stroke-width="8" fill="none"/>
                                    <circle cx="50" cy="50" r="40" stroke="#3b82f6" stroke-width="8" fill="none" stroke-dasharray="251.2" stroke-dashoffset="75.36" transform="rotate(-90 50 50)"/>
                                    <text x="50" y="55" text-anchor="middle" font-size="16" font-weight="bold">70%</text>
                                </svg>
                                <div class="small text-muted mt-1">Major Requirements</div>
                            </div>
                            <div class="col">
                                <svg width="100" height="100">
                                    <circle cx="50" cy="50" r="40" stroke="#e6e7eb" stroke-width="8" fill="none"/>
                                    <circle cx="50" cy="50" r="40" stroke="#f59e0b" stroke-width="8" fill="none" stroke-dasharray="251.2" stroke-dashoffset="125.6" transform="rotate(-90 50 50)"/>
                                    <text x="50" y="55" text-anchor="middle" font-size="16" font-weight="bold">50%</text>
                                </svg>
                                <div class="small text-muted mt-1">Minor Requirements</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Current Courses</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course</th>
                                        <th>Instructor</th>
                                        <th>Schedule</th>
                                        <th>Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="ms-3">
                                                    <div>CS 401</div>
                                                    <div class="text-muted small">Advanced Algorithms</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Dr. Smith</td>
                                        <td>MWF 9:00–10:15</td>
                                        <td><span class="badge bg-success">201</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3">
                                                    <div>MATH 310</div>
                                                    <div class="text-muted small">Probability Theory</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Prof. Johnson</td>
                                        <td>TTh 11:00–12:15</td>
                                        <td><span class="badge bg-success">201</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">                                               
                                                <div class="ms-3">
                                                    <div>PHYS 250</div>
                                                    <div class="text-muted small">Modern Physics</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Dr. Lee</td>
                                        <td>MW 2:00–3:15</td>
                                        <td><span class="badge bg-success">201</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        
                
            
    <?php include 'messenger.php';?>
            </div>
        </div>
    </div>



     

    </div>
  </div>
</div>

<!-- Chat Icon -->
<div >

</div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize performance chart
        function initPerformanceChart() {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00'],
                    datasets: [
                        {
                            label: 'CPU Usage (%)',
                            data: [32, 45, 28, 51, 62, 55, 47, 60],
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Memory Usage (%)',
                            data: [40, 38, 42, 45, 50, 48, 52, 55],
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    }
                }
            });
            return chart;
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the performance chart
            const performanceChart = initPerformanceChart();
            
            // Settings form submission
            document.getElementById('settingsForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const savedAlert = document.getElementById('settingsSaved');
                savedAlert.classList.remove('d-none');
                setTimeout(() => {
                    savedAlert.classList.add('d-none');
                }, 3000);
            });
            
            // Alert threshold slider
            document.getElementById('alertThreshold').addEventListener('input', function() {
                document.getElementById('thresholdValue').textContent = 
                    this.value + '% CPU usage';
            });
            
            // Refresh metrics button
            document.getElementById('refreshMetrics').addEventListener('click', function() {
                // Simulate refreshing metrics with random values
                const cpuValue = Math.floor(Math.random() * 30) + 30;
                const memoryValue = Math.floor(Math.random() * 30) + 30;
                const diskValue = Math.floor(Math.random() * 30) + 40;
                
                document.getElementById('cpuValue').textContent = cpuValue + '%';
                document.getElementById('memoryValue').textContent = memoryValue + '%';
                document.getElementById('diskValue').textContent = diskValue + '%';
                
                document.querySelector('#cpuMeter .performance-meter-fill').style.width = cpuValue + '%';
                document.querySelector('#memoryMeter .performance-meter-fill').style.width = memoryValue + '%';
                document.querySelector('#diskMeter .performance-meter-fill').style.width = diskValue + '%';
                
                // Update chart with new random data
                performanceChart.data.datasets[0].data = performanceChart.data.datasets[0].data.map(
                    () => Math.floor(Math.random() * 30) + 30
                );
                performanceChart.data.datasets[1].data = performanceChart.data.datasets[1].data.map(
                    () => Math.floor(Math.random() * 30) + 30
                );
                performanceChart.update();
            });
            
            // Generate report button
            document.getElementById('generateReport').addEventListener('click', function() {
                const reportStatus = document.getElementById('reportStatus');
                const reportPreview = document.getElementById('reportPreview');
                
                reportStatus.classList.remove('d-none');
                
                // Simulate report generation delay
                setTimeout(() => {
                    reportStatus.classList.add('d-none');
                    
                    // Add the new report to the table
                    const reportsTable = document.getElementById('reportsList');
                    const newRow = reportsTable.insertRow(0);
                    const reportName = document.getElementById('reportType').value.replace(/\s+/g, '_') + 
                                      '_' + new Date().toISOString().split('T')[0];
                    
                    newRow.innerHTML = `
                        <td>${reportName}</td>
                        <td>Just now</td>
                        <td>${document.getElementById('reportFormat').value}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">View</button>
                            <button class="btn btn-sm btn-outline-secondary">Download</button>
                        </td>
                    `;
                    
                    // Show a preview
                    reportPreview.querySelector('div').textContent = 
                        `Sample ${document.getElementById('reportType').value} report generated at ${new Date().toLocaleTimeString()}`;
                    reportPreview.classList.remove('d-none');
                }, 2000);
            });
        });
    </script>

<?php include 'footer.php' ?>
<div>
   
</div>
</body>
</html>
