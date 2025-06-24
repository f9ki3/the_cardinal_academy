<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
// Pagination and Search
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

// Count total sections
$count_query = "SELECT COUNT(*) as total FROM sections 
                WHERE section_name LIKE '%$search%' 
                OR grade_level LIKE '%$search%' 
                OR room LIKE '%$search%' 
                OR school_year LIKE '%$search%'";

$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}

$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);


$query = "SELECT 
            sections.section_id,
            sections.section_name,
            sections.grade_level,
            sections.room,
            sections.capacity,
            sections.school_year,
            CONCAT(users.first_name, ' ', users.last_name) AS teacher_name
          FROM sections
          LEFT JOIN users ON sections.teacher_id = users.user_id
          WHERE section_name LIKE '%$search%' 
             OR grade_level LIKE '%$search%' 
             OR room LIKE '%$search%' 
             OR school_year LIKE '%$search%' 
          ORDER BY grade_level ASC
          LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("<p style='color:red;'>Data Query Failed: " . mysqli_error($conn) . "</p>");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Manage Sections</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-5">
                  <h4>Class Sections</h4>
                </div>
                <div class="col-12 col-md-7 d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <!-- Search Form -->
                  <form method="GET" action="" class="flex-grow-1">
                    <input type="hidden" name="nav_drop" value="true">
                    <div class="input-group">
                        <input 
                        class="form-control rounded rounded-4" 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($search ?? '') ?>" 
                        placeholder="Search by Section, Grade, Room, or Year"
                        >
                        <button class="btn border ms-2 rounded rounded-4" type="submit">Search</button>
                    </div>
                   </form>


                  <!-- Create Button -->
                  <a href="create_sections.php?nav_drop=true" class="btn bg-main text-light rounded rounded-4 px-4">
                    + Create
                </a>

                </div>


                <div class="col-12 pt-3">
                  <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'created'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Created sections successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'updated'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅  Updated sections successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'deleted'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ⚠️ Remove sections successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-striped" style="cursor: pointer">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Section Name</th>
                        <th>Grade Level</th>
                        <th>Teacher</th>
                        <th>Room</th>
                        <th>Capacity</th>
                        <th>School Year</th>
                        <th>Action</th>
                    </tr>
                  </thead>

                    <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-id="<?= $row['section_id'] ?>">
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['section_id']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['section_name']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['grade_level']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['teacher_name'] ?? 'Unassigned') ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['room']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['capacity']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['school_year']) ?></p></td>
                          <td>
                            <a href="edit_section.php?id=<?= urlencode($row['section_id']) ?>&nav_drop=true" class="btn border rounded rounded-4">Edit</a>
                            <a href="delete_section.php?id=<?= urlencode($row['section_id']) ?>&nav_drop=true"
                              class="btn border rounded rounded-4"
                              onclick="return confirm('Are you sure you want to delete this section?');">
                              Remove
                            </a>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="8"><p class="text-muted text-center pt-3 pb-3 mb-0">No section data available</p></td>
                      </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
              </div>

              <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-start pagination-sm">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                        <a class="page-link text-muted" href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>&nav_drop=true">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php
                        $max_links = 5;
                        $start = max(1, $page - floor($max_links / 2));
                        $end = min($total_pages, $start + $max_links - 1);
                        if ($end - $start < $max_links - 1) {
                        $start = max(1, $end - $max_links + 1);
                        }
                    ?>

                    <?php for ($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item">
                        <a class="page-link text-muted <?= $i == $page ? 'fw-bold' : '' ?>" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>&nav_drop=true"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                        <a class="page-link text-muted" href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>&nav_drop=true">Next</a>
                        </li>
                    <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>


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

