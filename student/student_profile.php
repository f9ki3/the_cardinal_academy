<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>

  <?php include 'header.php' ?>
</head>
<style>
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
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h1 class="h3 fw-bold">🎓 Student Profile</h1>
            <div>
                <button class="btn btn-outline-primary me-2">
                    <i class="bi bi-person-circle me-1"></i> Account
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-gear me-1"></i> Settings
                </button>
            </div>
        </div>

        
    </div>

             

            </div> <!-- end inner container -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>



  

   
