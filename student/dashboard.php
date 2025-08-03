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
            <div class=" border-0 shadow-sm">
            <!-- START -->
             
              <div class="rounded bg-white p-4 shadow ">
                <style>    
                  .roww {
                  display: flex;
                  flex-wrap: wrap;
                  gap: 0.5rem;
                  justify-content: space-between;
                  }
                  .con {
                    flex: 1 1 calc(33.333% - 0.5rem);
                    max-width: calc(33.333% - 0.5rem);
                    position: relative;
                  }

                  .card-custom {
                    border-radius: 0.75rem;
                    box-shadow: 0 2px 10px rgb(0 0 0 / 0.05);
                    background: #fff;
                    padding: 1rem 1.5rem;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: all 0.3s ease;
                  }
                  .card-custom.cor {
                    justify-content: space-between;
                    background-color: #b72029;
                  }
                  .icon-class, .icon-book, .icon-absent, .icon-quiz, .icon-remain, .icon-assignment {
                    width: 38px;
                    height: 38px;
                    border-radius: 0.5rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 18px;
                  }

                  .icon-class { background: #e7f1ff; color: #1a73e8; }
                  .icon-book { background: #f3e8ff; color: #6f42c1; }
                  .icon-absent { background: #fef1f2; color: #e5534b; }
                  .icon-quiz { background: #fff4e5; color: #f59e0b; }
                  .icon-remain { background: #e6f4f1; color: #059669; }
                  .icon-assignment { background: #e0f7fa; color: #00acc1; }

                  .fw-semibold {
                    font-weight: 600;
                  }

                  .label-hover {
                    display: none;
                    position: absolute;
                    top: -1.5rem;
                    left: 50%;
                    transform: translateX(-50%);
                    background: #333;
                    color: #fff;
                    padding: 0.2rem 0.5rem;
                    border-radius: 0.3rem;
                    font-size: 0.75rem;
                    white-space: nowrap;
                    z-index: 10;
                  }

                  .con:hover .label-hover,
                  .con:focus-within .label-hover {
                    display: block;
                  }

                  @media (max-width: 500px) {
                  .card-custom {
                    padding: 0.6rem;
                    font-size: 0.75rem;
                    height: auto;
                    }

                  .fw-semibold {
                    display: none;
                  }

                  .icon-class, .icon-book, .icon-absent, .icon-quiz, .icon-remain, .icon-assignment {
                    width: 32px;
                    height: 32px;
                    font-size: 16px;
                  }

                  /* Remove justify-content: space-between for attended card on mobile */
                  .card-custom.cor {
                    justify-content: center;
                    gap: 0.5rem;
                  }
                  }
                </style>
                <div class="row px-3">
                  <div class="col">
                    <h4 class="m-0 fs-2 fw-bold pb-2">Performance Summary</h4>
                    
                  </div>
                  <hr class="text-dark py-1">
                </div>
                <div class="roww">

                  
                  <div class="con">
                      <div class="label-hover">Attendance</div>
                      <div class="card-custom cor" >
                      <div class="fw-semibold text-light fs-3 text">Attended</div>
                      <div class="icon-class"></div>
                      </div>
                  </div>

                  <div class="con">
                      <div class="label-hover">Assignment</div>
                      <div class="card-custom cor">
                      <div class="fw-semibold text-light fs-3 text">Assignment</div>
                      <div class="icon-absent"></div>
                      </div>
                  </div>

                  <div class="con">
                      <div class="label-hover" >Subject</div>
                      <div class="card-custom cor">
                      <div class="fw-semibold text-light fs-3 text">Subject</div>
                      <div class="icon-remain"></div>
                      </div>
                  </div>

                  <div class="con">
                      <div class="label-hover">Absent</div>
                      <div class="card-custom cor">
                      <div class="fw-semibold text-light fs-3 text">Absent</div>
                      <div class="icon-book"></div>
                      </div>
                  </div>

                  <div class="con">
                      <div class="label-hover">Quiz</div>
                      <div class="card-custom cor">
                      <div class="fw-semibold text-light fs-3 text">Quiz</div>
                      <div class="icon-quiz"></div>
                      </div>
                  </div>

                  <div class="con">
                      <div class="label-hover">Other task</div>
                      <div class="card-custom cor">
                      <div class="fw-semibold text-light fs-3 text">Other task</div>
                      <div class="icon-assignment"></div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="rounded bg-white p-4 my-3 shadow p-3 mb-5">
  <style>
    :root {
      --primary-color: #3498db;
      --secondary-color: #2c3e50;
      --light-color: #ecf0f1;
      --dark-color: #2c3e50;
      --success-color: #2ecc71;
      --warning-color: #f39c12;
      --danger-color: #da3030;
      --danger1-color: #b72029;
    }

    .day-header {
      background-color: var(--danger1-color);
      color: white;
      padding: 10px;

      border-radius: 5px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .time-slot {
      background-color: white;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;

      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      border-left: 4px solid var(--danger-color);
      min-height: 80px;
      font-size:10px;
    }
    .col-lg{

    } 
  </style>
              <div class="container-fluid ">
                <div class="row ">
                  <div class="col">
                    <h4 class="m-0 fs-2 fw-bold">Schedule</h4>
                    
                  </div>
                  <hr class="text-dark py-1">
                </div>

                <!-- Headers -->
                <div class="row text-center gap-1">
                  <div class="col-lg col-12 day-header">Monday</div>
                  <div class="col-lg col-12 day-header">Tuesday</div>
                  <div class="col-lg col-12 day-header">Wednesday</div>
                  <div class="col-lg col-12 day-header">Thursday</div>
                  <div class="col-lg col-12 day-header">Friday</div>
                  <div class="col-lg col-12 day-header">Saturday</div>

                </div>

                <!-- Events -->
                <div class="row ">
                  <!-- Monday -->
                  <div class="col-lg col-12">
                    <div class="time-slot ">
                      
                      <p class="my-0 fw-bold">Database Systems</p>
                      <p class="my-0 " style="font-weight:500;">10:00 AM - 11:30 AM</p>
                      <p class="my-0 " style="font-weight:500;">Prof. Stephany Gandula</p>
                      <span class="badge bg-primary ">Lecture</span>
                    </div>
                    <div class="time-slot ">
                      
                      <p class="my-0 fw-bold">Database Systems</p>
                      <p class="my-0 " style="font-weight:500;">10:00 AM - 11:30 AM</p>
                      <p class="my-0 " style="font-weight:500;">Prof. Stephany Gandula</p>
                      <span class="badge bg-primary ">Lecture</span>
                    </div>
                    <div class="time-slot ">
                      
                      <p class="my-0 fw-bold">Database Systems</p>
                      <p class="my-0 " style="font-weight:500;">10:00 AM - 11:30 AM</p>
                      <p class="my-0 " style="font-weight:500;">Prof. Stephany Gandula</p>
                      <span class="badge bg-primary ">Lecture</span>
                    </div>
                    <div class="time-slot ">
                      
                      <p class="my-0 fw-bold">Database Systems</p>
                      <p class="my-0 " style="font-weight:500;">10:00 AM - 11:30 AM</p>
                      <p class="my-0 " style="font-weight:500;">Prof. Stephany Gandula</p>
                      <span class="badge bg-primary ">Lecture</span>
                    </div>
                    <div class="time-slot ">
                      
                      <p class="my-0 fw-bold">Database Systems</p>
                      <p class="my-0 " style="font-weight:500;">10:00 AM - 11:30 AM</p>
                      <p class="my-0 " style="font-weight:500;">Prof. Stephany Gandula</p>
                      <span class="badge bg-primary ">Lecture</span>
                    </div>
                    
                    

                  </div>

                  <!-- Tuesday -->
                  <div class="col-lg col-12">
                    <div class="time-slot">
                      <p class="my-0 fw-bold">AI Fundamentals</p>
                      <p class="my-0" style="font-weight:500;">9:00 AM - 10:30 AM</p>
                      <p class="my-0" style="font-weight:500;">Dr. Lee</p>
                      <span class="badge bg-primary">Lecture</span>
                    </div>
                    
                  </div>

                  <!-- Wednesday -->
                  <div class="col-lg col-12">
                    <div class="time-slot">
                      <p class="my-0 fw-bold">Database Systems</p>
                      <p class="my-0" style="font-weight:500;">10:00 AM - 11:30 AM</p>
                      <p class="my-0" style="font-weight:500;">Prof. Smith</p>
                      <span class="badge bg-primary">Lecture</span>
                    </div>
              
                  </div>

                  <!-- Thursday -->
                  <div class="col-lg col-12">
                    <div class="time-slot">
                      <p class="my-0 fw-bold">AI Project Work</p>
                      <p class="my-0" style="font-weight:500;">11:00 AM - 1:00 PM</p>
                      <p class="my-0" style="font-weight:500;">Mr. Bergania</p>
                      <span class="badge bg-success">Lab</span>
                    </div>
                  </div>

                  <!-- Friday -->
                  <div class="col-lg col-12">
                    <div class="time-slot">
                      <p class="my-0 fw-bold">Web Development</p>
                      <p class="my-0" style="font-weight:500;">9:00 AM - 10:30 AM</p>
                      <p class="my-0" style="font-weight:500;">Prof. Brown </p>
                      <span class="badge bg-primary">Lecture</span>
                    </div>
                  </div>

                  <!-- Saturday -->
                  <div class="col-lg col-12">
                    <div class="time-slot">
                      <p class="my-0 fw-bold" >Web Development Lab</p>
                      <p class="my-0" style="font-weight:500;">2:00 PM - 4:00 PM</p>
                      <p class="my-0" style="font-weight:500;">TA Johnson</p>
                      <span class="badge bg-success">Lab</span>
                    </div>
                  </div>
                </div>
              </div>
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


