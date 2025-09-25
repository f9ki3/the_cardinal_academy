<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
  <?php include 'header.php' ?>
  <style>
    .rounded-circle:hover{
      background-color:rgb(240, 249, 255) !important;
    }
  </style>
    <style>
    .tabs {
    display: flex;
    gap: 30px;           
    padding: 5px;
    }

    .tab {
    padding: 8px 0;
    cursor: pointer;
    position: relative;
    }

    .tab p {
    margin: 0;
    font-weight: 500;
    color: #555;
    }

    /* underline only active tab */
    .tab.active p {
    color: #000; /* active text color */
    }

    .tab.active::after {
    content: "";
    position: absolute;
    bottom: -2px;  /* sits on base line */
    left: 0;
    width: 100%;
    height: 3px;
    background:rgb(218, 64, 64); /* your active color (green) */
    border-radius: 2px;
    }
    </style>

</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div>
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 border-bottom col-md-12">
                  <h4>Students List</h4>
                </div>

                
              </div>

              <!-- Courses Grid -->
              <div class="row g-3">
                <?php $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0; ?>
                <div class="tabs d-flex">
                    <div class="tab ">
                        <a href="course.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Stream</a>
                    </div>
                    <div class="tab">
                        <a href="attendance.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Attendance</a>
                    </div>
                    <div class="tab">
                        <a href="assignment.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Assignment</a>
                    </div>
                    <div class="tab active">
                        <a href="student.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Students</a>
                    </div>
                    <div class="tab ">
                        <a href="student.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Grade Sheet</a>
                    </div>
                    <div class="tab">
                        <a href="settings.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Settings</a>
                    </div>
                </div>


                <!-- Tabs Content -->
                <div class="p-0" >
                <?php include 'students_lists.php'?>
                
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