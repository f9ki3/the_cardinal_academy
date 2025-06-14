<?php include 'session_login.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Admission</title>
  <?php include 'header.php'?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <!-- Sidebar -->
  <?php include 'navigation.php'?>

  <!-- Main Content -->
  <div class="content flex-grow-1">
    <?php include 'nav_top.php'?>

    <div class="container my-4">
      <!-- Main content goes here -->
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded rouned-4 p-3" style="background: white">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <div class="container my-4">
                <h4 class="mb-3">Student Admissions</h4>
                <?php
               
                $query = "SELECT 
                    que_code, 
                    lrn, 
                    CONCAT(firstname, ' ', lastname) AS fullname, 
                    CONCAT(barangay, ', ', city, ', ', province) AS address, 
                    grade_level,
                    status 
                    FROM admission_form";

                $result = mysqli_query($conn, $query);
                ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">LRN</th>
                                <th scope="col">CODE</th>
                                <th scope="col">Fullname</th>
                                <th scope="col">Address</th>
                                <th scope="col">Grade Level</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['lrn']) ?></p></td>
                                        <td><p class="text-muted pt-3 pb-3 mb-0"><?= isset($row['que_code']) ? htmlspecialchars($row['que_code']) : '-' ?></p></td>
                                        <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                                        <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['address']) ?></p></td>
                                        <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['grade_level']) ?></p></td>
                                        <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['status']) ?></p></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6"><p class="text-muted text-center pt-3 pb-3 mb-0">No data available</p></td>
                                </tr>
                            <?php endif; ?>
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

<?php include'footer.php'?>
</body>
</html>
