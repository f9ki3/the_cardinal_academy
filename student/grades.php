<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
  <?php include 'header.php' ?>
      <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .grade-A {
            background-color: #10b981;
        }
        .grade-B {
            background-color: #3b82f6;
        }
        .grade-C {
            background-color: #f59e0b;
        }
        .grade-D {
            background-color: #ef4444;
        }
        
        .shadow-soft {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }
        
        .subject-card:hover {
            transform: translateY(-2px);
        }
        
        .progress-ring-circle {
            stroke-dasharray: 251.2;
            stroke-dashoffset: 251.2;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
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
                <!-- start -->
                 <h2 class="text-2xl font-bold text-gray-800 mb-4">Subjects</h2>
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="subject-card bg-white rounded-xl shadow-soft p-6 transition-all duration-200">
                          <div class="flex justify-between items-start mb-4">
                              <div>
                                  <h3 class="font-bold text-gray-800">Mathematics</h3>
                                  <p class="text-sm text-gray-500">Mr. Smith</p>
                              </div>
                              <span class="px-2 py-1 rounded-full text-xs font-semibold grade-A text-white">A</span>
                          </div>
                          <div class="mb-4">
                              <div class="flex justify-between text-sm mb-1">
                                  <span class="text-gray-500">Overall Grade</span>
                                  <span class="font-medium">92%</span>
                              </div>
                              <div class="w-full bg-gray-200 rounded-full h-2">
                                  <div class="bg-green-500 h-2 rounded-full" style="width: 92%"></div>
                              </div>
                          </div>
                          <div class="grid grid-cols-3 gap-2 mb-4">
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Homework</p>
                                  <p class="font-medium">95%</p>
                              </div>
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Tests</p>
                                  <p class="font-medium">90%</p>
                              </div>
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Projects</p>
                                  <p class="font-medium">88%</p>
                              </div>
                          </div>
                          <button class="w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                              View Details
                          </button>
                      </div>
                      
                      <div class="subject-card bg-white rounded-xl shadow-soft p-6 transition-all duration-200">
                          <div class="flex justify-between items-start mb-4">
                              <div>
                                  <h3 class="font-bold text-gray-800">English Literature</h3>
                                  <p class="text-sm text-gray-500">Ms. Johnson</p>
                              </div>
                              <span class="px-2 py-1 rounded-full text-xs font-semibold grade-A text-white">A</span>
                          </div>
                          <div class="mb-4">
                              <div class="flex justify-between text-sm mb-1">
                                  <span class="text-gray-500">Overall Grade</span>
                                  <span class="font-medium">88%</span>
                              </div>
                              <div class="w-full bg-gray-200 rounded-full h-2">
                                  <div class="bg-green-500 h-2 rounded-full" style="width: 88%"></div>
                              </div>
                          </div>
                          <div class="grid grid-cols-3 gap-2 mb-4">
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Essays</p>
                                  <p class="font-medium">85%</p>
                              </div>
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Tests</p>
                                  <p class="font-medium">90%</p>
                              </div>
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Presentations</p>
                                  <p class="font-medium">92%</p>
                              </div>
                          </div>
                          <button class="w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                              View Details
                          </button>
                      </div>
                      
                      <div class="subject-card bg-white rounded-xl shadow-soft p-6 transition-all duration-200">
                          <div class="flex justify-between items-start mb-4">
                              <div>
                                  <h3 class="font-bold text-gray-800">Physics</h3>
                                  <p class="text-sm text-gray-500">Dr. Thompson</p>
                              </div>
                              <span class="px-2 py-1 rounded-full text-xs font-semibold grade-B text-white">B+</span>
                          </div>
                          <div class="mb-4">
                              <div class="flex justify-between text-sm mb-1">
                                  <span class="text-gray-500">Overall Grade</span>
                                  <span class="font-medium">83%</span>
                              </div>
                              <div class="w-full bg-gray-200 rounded-full h-2">
                                  <div class="bg-blue-500 h-2 rounded-full" style="width: 83%"></div>
                              </div>
                          </div>
                          <div class="grid grid-cols-3 gap-2 mb-4">
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Labs</p>
                                  <p class="font-medium">85%</p>
                              </div>
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Tests</p>
                                  <p class="font-medium">80%</p>
                              </div>
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Projects</p>
                                  <p class="font-medium">88%</p>
                              </div>
                          </div>
                          <button class="w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                              View Details
                          </button>
                      </div>
                      
                      <div class="subject-card bg-white rounded-xl shadow-soft p-6 transition-all duration-200">
                          <div class="flex justify-between items-start mb-4">
                              <div>
                                  <h3 class="font-bold text-gray-800">Chemistry</h3>
                                  <p class="text-sm text-gray-500">Dr. Wilson</p>
                              </div>
                              <span class="px-2 py-1 rounded-full text-xs font-semibold grade-A text-white">A-</span>
                          </div>
                          <div class="mb-4">
                              <div class="flex justify-between text-sm mb-1">
                                  <span class="text-gray-500">Overall Grade</span>
                                  <span class="font-medium">89%</span>
                              </div>
                              <div class="w-full bg-gray-200 rounded-full h-2">
                                  <div class="bg-green-500 h-2 rounded-full" style="width: 89%"></div>
                              </div>
                          </div>
                          <div class="grid grid-cols-3 gap-2 mb-4">
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Labs</p>
                                  <p class="font-medium">92%</p>
                              </div>
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Tests</p>
                                  <p class="font-medium">85%</p>
                              </div>
                              <div class="text-center">
                                  <p class="text-xs text-gray-500">Quizzes</p>
                                  <p class="font-medium">90%</p>
                              </div>
                          </div>
                          <button class="w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                              View Details
                          </button>
                      </div>
            

                <!-- end -->
                               
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
