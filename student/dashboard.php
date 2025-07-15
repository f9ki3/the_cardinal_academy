<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; 

$user_id = $_SESSION['user_id'];

$sql = "SELECT first_name, last_name, profile FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$full_name = htmlspecialchars($user['first_name'] . ', ' . $user['last_name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php' ?>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
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
    }
    .chat-icon:hover {
      background-color: #da3030;
    }
    :root {
            --primary: #4f46e5;
            --background: #f9fafb;
            --accent: #10b981;
            --text-muted: #6b7280;
        }
        body {
            background-color: var(--background);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        .badge-custom {
            background-color: var(--accent);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.4rem 0.75rem;
            border-radius: 9999px;
        }
        .card-header.bg-primary {
            background-color: var(--primary) !important;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .rounded-circle {
            font-weight: 600;
        }
        h5.card-title {
            font-weight: 600;
        }
</style>
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
    <div class="container">
        <div class="row g-4">
            <!-- Profile Column -->
            <div class="col-md-4">
                <!-- Profile Card -->
                <div class="card">
                    <div class="card-body text-center pt-5">
                        <h5 class="card-title mb-1" id="student-name"><?= htmlspecialchars($full_name)?></h5>
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
    </div>
</body>
</html>


            </div> <!-- end inner container -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div >
    <?php include 'messenger.php'; ?>
  </div>

<?php include 'footer.php'; ?>
</body>
</html>
