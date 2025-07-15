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
  <title>Attendance Records</title>
  <?php include 'header.php' ?>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    .progress-ring__circle {
      transition: stroke-dashoffset 0.5s;
      transform: rotate(-90deg);
      transform-origin: 50% 50%;
    }
    .sidebar-item:hover .sidebar-tooltip {
      opacity: 1;
      visibility: visible;
    }
    .scrollbar-thin::-webkit-scrollbar {
      width: 5px;
      height: 5px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }
  </style>
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
      z-index: 1000;
    }
    .chat-icon:hover {
      background-color: #da3030;
    }
  </style>

<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <?php include 'navigation.php'; ?>

    <div class="flex-grow">
      <?php include 'nav_top.php'; ?>

      <div class="p-6 space-y-6">
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
          <div class="col">
                <!-- Profile Card -->
                <div class="card">
                    <div class="card-body text-center pt-3">
                        <h2 class="mt-4 text-2xl font-bold text-gray-800"><?= htmlspecialchars($full_name)?></h2>
                        <p class="text-indigo-600 pb-3">Professor of Computer Science</p>
                        <div class="row text-center border-top pt-3">
                            <div class="col">
                                <div class="text-muted small">Specialization</div>
                                <strong>Machine Learning</strong>
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
                        <h5 class="card-title mb-2">
                            <i class="bi bi-envelope me-2 text-primary"></i>Contact Info
                        </h5>
                        <hr class="my-4 w-full border-gray-200">
              <div class="space-y-4 w-full">
                <div class="flex items-center">
                  <i class="fas fa-university text-gray-500 w-6"></i>
                  <p class="text-gray-700 ml-2">Stanford University</p>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-envelope text-gray-500 w-6"></i>
                  <p class="text-gray-700 ml-2">sarah.johnson@university.edu</p>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-phone-alt text-gray-500 w-6"></i>
                  <p class="text-gray-700 ml-2">(650) 123-4567</p>
                </div>
              </div>
                    </div>
                </div>
            </div>

          <!-- Stats & Courses Section -->
          <div class="lg:col-span-2 space-y-6">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <?php
              $stats = [
                ['label' => 'Classes Teaching', 'value' => 5, 'icon' => 'chalkboard-teacher', 'bg' => 'indigo'],
                ['label' => 'Students', 'value' => 124, 'icon' => 'users', 'bg' => 'green'],
                ['label' => 'Years Experience', 'value' => 12, 'icon' => 'award', 'bg' => 'amber']
              ];
              foreach ($stats as $s): ?>
              <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-gray-500 text-sm"><?= $s['label'] ?></p>
                    <h3 class="text-2xl font-bold"><?= $s['value'] ?></h3>
                  </div>
                  <div class="p-3 rounded-full bg-<?= $s['bg'] ?>-100 text-<?= $s['bg'] ?>-600">
                    <i class="fas fa-<?= $s['icon'] ?> text-xl"></i>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>

            <!-- Courses -->
            <div class="bg-white rounded-xl shadow-sm p-6">
              <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Current Courses</h3>
              </div>
              <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                  <thead class="text-gray-500 border-b">
                    <tr>
                      <th class="pb-2">Subject Code</th>
                      <th class="pb-2">Subject Name</th>
                      <th class="pb-2">Students</th>
                      <th class="pb-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $courses = [
                      ['code' => 'CS229', 'name' => 'Machine Learning',  'students' => 29],
                      ['code' => 'CS231N', 'name' => 'Computer Vision',  'students' => 24],
                      ['code' => 'CS224N', 'name' => 'NLP with Deep Learning',  'students' => 23],
                      ['code' => 'CS330', 'name' => 'Multitask & Meta Learning',  'students' => 18],
                    ];

                    foreach ($courses as $c):
                     
                    ?>
                    <tr class="border-b hover:bg-gray-50">
                      <td class="py-4"><?= $c['code'] ?></td>
                      <td>
                        <p class="font-medium text-gray-800"><?= $c['name'] ?></p>
                        
                      <td><?= $c['students'] ?></td>
                      
                      <td>
                        <button class="p-1 rounded-full hover:bg-gray-100">
                          <i class="fas fa-ellipsis-v text-gray-500"></i>
                        </button>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div> <!-- End Right Column -->

        </div> <!-- End Grid -->
      </div>
    </div>
  </div>
  <!-- Chat Icon -->
<div >
    <?php include 'messenger.php'; ?>
</div>

  <?php include 'footer.php'; ?>
</body>
</html>
