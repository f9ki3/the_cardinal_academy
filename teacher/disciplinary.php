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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
        .gradient-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .assignment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .progress-ring__circle {
            transition: stroke-dashoffset 0.5s ease;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container ">
      <div class="row g-4">
        <div class="col">
          <div class="rounded bg-white">
            <div class="container my-4">
              <div class="row mb-3">
                <!-- start -->
                 
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        
        
        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden">
            <!-- Mobile Header -->
            <div class="bg-blue-800 text-white p-4 flex items-center justify-between md:hidden">
                <button id="mobileMenuBtn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-lg font-bold">Disciplinary Portal</h1>
                <div class="w-6"></div>
            </div>
            
            <!-- Content Area -->
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Advisory Class Discipline</h2>
                        <p class="text-gray-600">Manage and track student behavior incidents</p>
                    </div>
                </div>
                
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">Total Students</p>
                                <p class="text-2xl font-bold">24</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">Active Cases</p>
                                <p class="text-2xl font-bold">5</p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">This Month</p>
                                <p class="text-2xl font-bold">7</p>
                            </div>
                            <div class="bg-amber-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">Improving</p>
                                <p class="text-2xl font-bold">12</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="font-semibold text-lg">Student Status Overview</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Incidents</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Incident</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Student 1 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="https://placehold.co/40x40" alt="Student profile picture" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Michael Johnson</div>
                                                <div class="text-sm text-gray-500">michael.j@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10th</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Active Case</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Mar 15, 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900">Edit</a>
                                    </td>
                                </tr>
                                
                                <!-- Student 2 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="https://placehold.co/40x40" alt="Student profile picture" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Sarah Williams</div>
                                                <div class="text-sm text-gray-500">sarah.w@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10th</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Warning</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Feb 28, 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900">Edit</a>
                                    </td>
                                </tr>
                                
                                <!-- Student 3 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="https://placehold.co/40x40" alt="Student profile picture" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">David Lee</div>
                                                <div class="text-sm text-gray-500">david.l@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10th</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Good</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900">Edit</a>
                                    </td>
                                </tr>
                                
                                <!-- Student 4 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img src="https://placehold.co/40x40" alt="Student profile picture" class="h-10 w-10 rounded-full">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Jessica Chen</div>
                                                <div class="text-sm text-gray-500">jessica.c@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10th</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Good</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Incident Records -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold text-lg">Recent Incidents</h3>
                            <button class="text-sm text-blue-600 hover:text-blue-800">View All</button>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <!-- Incident 1 -->
                        <div class="behavior-card p-4 hover:bg-gray-50 cursor-pointer status-active">
                            <div class="flex justify-between">
                                <div>
                                    <div class="flex items-center mb-1">
                                        <p class="font-medium mr-2">Michael Johnson</p>
                                        <span class="text-xs bg-gray-100 px-2 py-1 rounded">10th Grade</span>
                                    </div>
                                    <p class="text-gray-600">Class disruption - Refused to follow instruction</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Mar 15, 2023</p>
                                    <span class="inline-block mt-1 px-2 py-1 text-xs rounded bg-red-100 text-red-800">Severe</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Incident 2 -->
                        <div class="behavior-card p-4 hover:bg-gray-50 cursor-pointer status-warning">
                            <div class="flex justify-between">
                                <div>
                                    <div class="flex items-center mb-1">
                                        <p class="font-medium mr-2">Sarah Williams</p>
                                        <span class="text-xs bg-gray-100 px-2 py-1 rounded">10th Grade</span>
                                    </div>
                                    <p class="text-gray-600">Late submission - 3 assignments overdue</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Feb 28, 2023</p>
                                    <span class="inline-block mt-1 px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">Moderate</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Incident 3 -->
                        <div class="behavior-card p-4 hover:bg-gray-50 cursor-pointer status-warning">
                            <div class="flex justify-between">
                                <div>
                                    <div class="flex items-center mb-1">
                                        <p class="font-medium mr-2">Ethan Moore</p>
                                        <span class="text-xs bg-gray-100 px-2 py-1 rounded">10th Grade</span>
                                    </div>
                                    <p class="text-gray-600">Inappropriate language - Warned, parent notified</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Feb 15, 2023</p>
                                    <span class="inline-block mt-1 px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">Moderate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('block');
            sidebar.classList.toggle('absolute');
            sidebar.classList.toggle('z-50');
        });
        
        // Close sidebar on small screens
        document.getElementById('sidebarClose').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.add('hidden');
        });
        
        // Sample data for demonstration
        const students = [
            {
                name: "Michael Johnson",
                grade: "10th",
                status: "Active Case",
                incidents: 3,
                lastIncident: "Mar 15, 2023",
                statusClass: "bg-red-100 text-red-800"
            },
            {
                name: "Sarah Williams",
                grade: "10th",
                status: "Warning",
                incidents: 1,
                lastIncident: "Feb 28, 2023",
                statusClass: "bg-yellow-100 text-yellow-800"
            },
            {
                name: "David Lee",
                grade: "10th",
                status: "Good",
                incidents: 0,
                lastIncident: "-",
                statusClass: "bg-green-100 text-green-800"
            }
        ];
        
        // You would typically fetch this data from an API in a real application
        console.log("Student disciplinary data loaded:", students);
    </script>



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
