
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
             <div class="col-lg-9 col-md-8 p-4 settings-content">
       
                <form>
                 
                    
                    
   
                     <div class="col-lg-9 col-md-8 p-4 settings-content">
                <div class="settings-header">
                    <h2><i class="bi bi-lock-fill me-2"></i> Password & Security</h2>
                </div>
                
                <!-- Password Change Section -->
                <h5 class="mb-3"><i class="bi bi-shield-lock me-2"></i> Change Password</h5>
                <form>
                    <div class="mb-3">
                        <label for="current-password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current-password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new-password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new-password" required>
                        <div class="form-text">Must be at least 8 characters</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm-password" required>
                    </div>
                    
           
                </form>
       
                    
                    <div class="divider"></div>
                    
                    <!-- Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-primary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>


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
