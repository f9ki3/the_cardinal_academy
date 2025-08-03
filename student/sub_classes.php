<?php 
include 'session_login.php';
include '../db_connection.php'; 

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
  <?php include 'header.php'; ?>
  <style>
    /* Remove default side padding from container-fluid */
    .no-side-padding {
      padding-left: 10px !important;
      padding-right: 0 !important;
      padding-top: 10px;
    }

    /* Optional: remove margin if needed */
    .no-margin {
      margin: 0 !important;
    }
  </style>
  <style>
    :root {
      --danger-color: #e74a3b;
      --light-color: #f8f9fc;
      --secondary-color: #858796;
      --primary-color: #4e73df;
    }

    .custom-tabs .nav-tabs {
      border-bottom: none;
      background-color:white;
      margin-left: -24px;
      margin-top: -20px;
    }

    .custom-tabs .nav-link {
      border: none;
      border-radius: 8px 8px 0 0;
      padding: 0.75rem 1.25rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .custom-tabs .nav-link:hover {
      color: white !important;
      background-color: #da1030;
    }

    .custom-tabs .nav-link.active {
      color: white !important;
      background-color:  #da3030;
      border: none;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
    }

    .custom-tabs .tab-icon {
      margin-right: 8px;
    }

    .dashboard-card {
      background-color: white;
      padding: 1rem;
      border-radius: 0.5rem;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
      margin-top: 1rem;
    }
  </style>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div class="d-flex flex-row bg-light">
    
    <!-- Sidebar -->
    <?php include 'navigation.php'; ?>

    <!-- Main Content -->
    <div class="content flex-grow-1">
      
      <!-- Top Navigation -->
      <?php include 'nav_top.php'; ?>

      <!-- Page Content (No Side Padding) -->
      <div class="container-fluid no-side-padding my-0">
        <div class="row g-0"> <!-- g-0 removes gutter spacing -->
          <div class="col-12">
            <div class="bg-white p-4 rounded-0 border-0 shadow-sm">
            <!-- START -->
                <!-- Banner -->
  

  <div class="custom-tabs">
        
      <!-- Tab Navigation -->
      <ul class="nav nav-tabs  " id="dashboardTabs" role="tablist" >
        <li class="nav-item " role="presentation">
          <button class="nav-link active" id="performance-tab" data-bs-toggle="tab" data-bs-target="#performance" type="button" role="tab" style="color:black; ">
            <i class="fas fa-tachometer-alt tab-icon"></i>Academic Task
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" style="color:black;">
            <i class="fas fa-cog tab-icon"></i>Task Done 
          </button>
        </li>
      </ul>

      

      <!-- Tab Content -->
      <div class="tab-content  rounded-bottom">
        <div class="tab-pane fade show active" id="performance" role="tabpanel">
          <div class="row">
            <div class="col">
              <div class=" text-white rounded p-4 mb-4 my-4" style="background: linear-gradient(135deg, #b72029 30%, #da3030 100%);">
    <h2 class="mb-1 fw-bold fs-3 text">Introduction to Programming</h2>
    <h5 class="text-white">BSIT32A</h5>
  </div>

                
              <div class="">
                
  <div class="bg-white rounded-xl shadow-sm overflow-hidden ">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
        
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>

          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr class="hover:bg-gray-100 cursor-pointer" data-href="assignment-details.html?id=1">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mechanics Problem Set</td>
            
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tomorrow, 9:00 AM</td>
            
           
           
          </tr>

          <tr class="hover:bg-gray-100 cursor-pointer" data-href="assignment-details.html?id=2">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Shakespeare Analysis</td>
            
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Friday, 2:00 PM</td>
           

          </tr>

          <tr class="hover:bg-gray-100 cursor-pointer" data-href="assignment-details.html?id=3">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Cell Biology Lab Report</td>
           
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Next Tuesday, 11:59 PM</td>
            
           
           
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  // Make rows clickable
  document.querySelectorAll("tr[data-href]").forEach(row => {
    row.addEventListener("click", () => {
      window.location.href = row.dataset.href;
    });
  });
</script>


    

            <!-- END -->

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
