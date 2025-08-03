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
    /* Container card styling to mimic the design */
    .card-custom {
      width: 320px;
      border-radius: 0.5rem;
      box-shadow: 0 0.25rem 0.75rem rgb(0 0 0 / 0.1);
      cursor: pointer;
      user-select: none;
      overflow: hidden;
    }
    .card-header-custom {
      background: linear-gradient(135deg, #da3030 30%, #b72029 100%);
      color: white;
      padding: 1rem 1.25rem;
      position: relative;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card-header-custom h5 {
      margin: 0;
      font-weight: 700;
      font-size: 1.25rem;
    }
    .card-header-custom small {
      display: block;
      color: #aeb8bf;
      font-weight: 500;
    }
    /* Letter avatar circle with initial */
    .avatar-circle {
      border-radius: 50%;   
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      right: 1rem;
      bottom: -55px;
      box-shadow: 0 0 7px rgb(0 0 0 / 0.15);
      user-select: none;
      pointer-events: none; /* So it doesn't interfere with click */
    }
    /* Images top right (rotated tablet-like shapes) */
    .header-images {
      position: absolute;
      right: 1rem;
      top: 1rem;
      width: 90px;
      height: 90px;
      pointer-events: none;
    }
    .header-images svg {
      position: absolute;
      width: 50px;
      height: 70px;
      border-radius: 8px;
      border: 2px solid rgba(255 255 255 / 0.1);
      background: linear-gradient(145deg, #303a42, #213139);
      box-shadow: inset 1px 1px 2px rgba(255 255 255 / 0.15),
          inset -1px -1px 4px rgba(0 0 0 / 0.7);
      transform-origin: center center;
    }
    .header-images svg:first-child {
      right: 0;
      top: 10px;
      transform: rotate(15deg);
    }
    .header-images svg:last-child {
      right: 26px;
      top: 28px;
      transform: rotate(40deg);
    }
    /* Card body blank space */
    .card-body-custom {
      min-height: 100px;
    }
    /* Card footer with icons spaced on right */
    .card-footer-custom {
      border-top: 1px solid #e9ecef;
      background-color: white;
      padding: 0.5rem 1rem;
      display: flex;
      justify-content: flex-end;
      gap: 1.2rem;
    }
    .card-footer-custom button {
      background: none;
      border: none;
      color: #6c757d;
      font-size: 1.25rem;
      user-select: none;
      transition: color 0.2s ease;
      cursor: pointer;
      outline-offset: 2px;
    }
    .card-footer-custom button:focus,
    .card-footer-custom button:hover {
      color: #0d6efd;
    }
    /* Shadow and highlight on hover for entire card */
    .card-custom:hover {
      box-shadow: 0 0.5rem 1rem rgb(13 110 253 / 0.25);
    }
     .profile-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        border-radius: 50px;
    }
    .frame-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    .frame-container {
        position: relative;
        width: 70px;
        height: 70px;
        overflow: hidden;
 
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
            <div class="bg-white p-4 rounded-0 border-0 shadow-sm  " >
                <div class="row gap-2">
                    <!-- start  -->
             <div class="col">
              <h4 class="m-0 fs-2 fw-bold">Classes</h4>
            </div>
            <hr class="text-dark py-0">
            <div class="card card-custom px-0" href="sub_classes.php" >
                <a class="text-decoration-none " href="sub_classes.php">
                  <div class="card-header  card-header-custom position-relative">
                    <h5>Intro to Programming</h5>
                    <small class="text-light">IT32A</small>
                    <small class="text-light">Ms. Stephanie Candado</small>     
                    <div class=" avatar-circle profile-pic" aria-hidden="true">
                      <div class="frame-container">
                        <img src="student.png" class="profile-photo" alt="User photo">
                        <img src="tca_frame.png" class="frame-overlay" alt="Frame overlay">
                      </div>
                    </div>
                  </div> 
                </a>
                <div class="card-body card-body-custom"></div>
                <div class="card-footer card-footer-custom">
                  <button type="button" class="btn-icon" aria-label="Open camera" onclick="alert('Camera icon clicked!'); event.stopPropagation();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                      <path d="M9.5 2a.5.5 0 0 1 .5.5V3h2.11A1.5 1.5 0 0 1 13.5 4.5v6A1.5 1.5 0 0 1 12 12h-8A1.5 1.5 0 0 1 2.5 10.5v-6A1.5 1.5 0 0 1 4 3h2v-.5a.5.5 0 0 1 .5-.5h3zM10 3v-.5h-3V3h3z"/>
                      <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                    </svg>
                  </button>
                  <button type="button" class="btn-icon" aria-label="Open folder" onclick="alert('Folder icon clicked!'); event.stopPropagation();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                      <path d="M9.828 4a.5.5 0 0 1 .354.146L11 5.293 10.207 6H13.5A1.5 1.5 0 0 1 15 7.5v5A1.5 1.5 0 0 1 13.5 14h-11A1.5 1.5 0 0 1 1 12.5v-7A1.5 1.5 0 0 1 2.5 4H9.828z"/>
                      <path d="M7.646 6.646a.5.5 0 0 1 .708 0L9 7.293 8.207 8H5.5a.5.5 0 0 1 0-1h2.146z"/>
                    </svg>
                  </button>
                </div>
            </div>
            <!--End  -->
            
            <!-- start  -->
             
            <div class="card card-custom px-0" href="sub_classes.php" >
                <a class="text-decoration-none" href="sub_classes.php">
                  <div class="card-header card-header-custom position-relative">
                    <h5>Basic Networking</h5>
                    <small class="text-light">IT32A</small>
                    <small class="text-light">Ms. Stephany Gandula</small>     
                    <div class=" avatar-circle profile-pic" aria-hidden="true">
                      <div class="frame-container">
                        <img src="teacher1.jpg" class="profile-photo" alt="User photo">
                        <img src="tca_frame.png" class="frame-overlay" alt="Frame overlay">
                      </div>
                    </div>
                  </div> 
                </a>
                <div class="card-body card-body-custom"></div>
                <div class="card-footer card-footer-custom">
                  <button type="button" class="btn-icon" aria-label="Open camera" onclick="alert('Camera icon clicked!'); event.stopPropagation();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                      <path d="M9.5 2a.5.5 0 0 1 .5.5V3h2.11A1.5 1.5 0 0 1 13.5 4.5v6A1.5 1.5 0 0 1 12 12h-8A1.5 1.5 0 0 1 2.5 10.5v-6A1.5 1.5 0 0 1 4 3h2v-.5a.5.5 0 0 1 .5-.5h3zM10 3v-.5h-3V3h3z"/>
                      <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                    </svg>
                  </button>
                  <button type="button" class="btn-icon" aria-label="Open folder" onclick="alert('Folder icon clicked!'); event.stopPropagation();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                      <path d="M9.828 4a.5.5 0 0 1 .354.146L11 5.293 10.207 6H13.5A1.5 1.5 0 0 1 15 7.5v5A1.5 1.5 0 0 1 13.5 14h-11A1.5 1.5 0 0 1 1 12.5v-7A1.5 1.5 0 0 1 2.5 4H9.828z"/>
                      <path d="M7.646 6.646a.5.5 0 0 1 .708 0L9 7.293 8.207 8H5.5a.5.5 0 0 1 0-1h2.146z"/>
                    </svg>
                  </button>
                </div>
            </div>
            <!--End  -->
        </div>
        <!--End  -->
      

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>
