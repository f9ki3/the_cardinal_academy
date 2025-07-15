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

                <div class="flex h-full">
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class=" shadow-md">
                <div class="flex justify-between items-center p-4">
                    <div class="hidden md:block">
                        <h1 class="text-2xl font-bold">Assignment </h1>
                    </div>
                </div>
            </header>

            <main class="p-6">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                        <div class="p-4 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                            <i class="fas fa-tasks text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Pending Assignments</p>
                            <p class="text-2xl font-bold">5</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                        <div class="p-4 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Completed</p>
                            <p class="text-2xl font-bold">12</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                        <div class="p-4 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <i class="fas fa-hourglass-half text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Upcoming Deadline</p>
                            <p class="text-2xl font-bold">2 days</p>
                        </div>
                    </div>
                </div>

                <!-- Assignment List -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Student Assignments</h2>
                    <button class="gradient-bg hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-full text-sm flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        New Assignment
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Assignment Card 1 -->
                    <div class="assignment-card bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                        <div class="relative">
                            <img src="https://placehold.co/600x300" alt="Open physics textbook with mechanical formulas and diagrams" class="w-full h-40 object-cover" />
                            <span class="absolute top-3 right-3 bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Physics</span>
                        </div>
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Mechanics Problem Set</h3>
                                <span class="text-xs font-medium px-2 py-1 rounded-full bg-red-100 text-red-800">Due Tomorrow</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Newton's Laws of Motion problems and solutions</p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex -space-x-3">
                                    <img src="https://placehold.co/32" alt="Classmate John Davis who is working on same assignment" class="w-8 h-8 rounded-full border-2 border-white" />
                                    <img src="https://placehold.co/32" alt="Classmate Sarah Wilson who is working on same assignment" class="w-8 h-8 rounded-full border-2 border-white" />
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-200 flex items-center justify-center text-xs">+2</div>
                                </div>
                                <div class="relative w-12 h-12">
                                    <svg class="w-full h-full" viewBox="0 0 36 36">
                                        <path
                                            d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none"
                                            stroke="#e6e6e6"
                                            stroke-width="3"
                                        />
                                        <path
                                            class="progress-ring__circle"
                                            d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none"
                                            stroke="#4f46e5"
                                            stroke-width="3"
                                            stroke-dasharray="70, 100"
                                        />
                                        <text x="18" y="20" text-anchor="middle" font-size="10" fill="#4f46e5" font-weight="bold">70%</text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Card 2 -->
                    <div class="assignment-card bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                        <div class="relative">
                            <img src="https://placehold.co/600x300" alt="Literary analysis book cover with classic literature works" class="w-full h-40 object-cover" />
                            <span class="absolute top-3 right-3 bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Literature</span>
                        </div>
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-gray-800">Shakespeare Analysis</h3>
                                <span class="text-xs font-medium px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">Due in 3 days</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Character study of Hamlet and themes in Act 3</p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex -space-x-3">
                                    <img src="https://placehold.co/32" alt="Study partner Michael Thompson" class="w-8 h-8 rounded-full border-2 border-white" />
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-200 flex items-center justify-center text-xs">+1</div>
                                </div>
                                <div class="relative w-12 h-12">
                                    <svg class="w-full h-full" viewBox="0 0 36 36">
                                        <path
                                            d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none"
                                            stroke="#e6e6e6"
                                            stroke-width="3"
                                        />
                                        <path
                                            class="progress-ring__circle"
                                            d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none"
                                            stroke="#4f46e5"
                                            stroke-width="3"
                                            stroke-dasharray="30, 100"
                                        />
                                        <text x="18" y="20" text-anchor="middle" font-size="10" fill="#4f46e5" font-weight="bold">30%</text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Card 3 -->
                    <div class="assignment-card bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                        <div class="relative">
                            <img src="https://placehold.co/600x300" alt="Microscopic cellular structure and scientific diagrams" class="w-full h-40 object-cover" />
                            <span class="absolute top-3 right-3 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Biology</span>
                        </div>
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-gray-800">Cell Biology Lab Report</h3>
                                <span class="text-xs font-medium px-2 py-1 rounded-full bg-blue-100 text-blue-800">Due next week</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Microscopic observations of plant and animal cells</p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex -space-x-3">
                                    <img src="https://placehold.co/32" alt="Lab partner Emma Rodriguez" class="w-8 h-8 rounded-full border-2 border-white" />
                                    <img src="https://placehold.co/32" alt="Lab assistant Professor Chen" class="w-8 h-8 rounded-full border-2 border-white" />
                                </div>
                                <div class="relative w-12 h-12">
                                    <svg class="w-full h-full" viewBox="0 0 36 36">
                                        <path
                                            d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none"
                                            stroke="#e6e6e6"
                                            stroke-width="3"
                                        />
                                        <path
                                            class="progress-ring__circle"
                                            d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none"
                                            stroke="#4f46e5"
                                            stroke-width="3"
                                            stroke-dasharray="90, 100"
                                        />
                                        <text x="18" y="20" text-anchor="middle" font-size="10" fill="#4f46e5" font-weight="bold">90%</text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Deadlines -->
                <div class="mt-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Upcoming Deadlines</h2>
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Mechanics Problem Set</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Physics</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tomorrow, 9:00 AM</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">High</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Shakespeare Analysis</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Literature</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Friday, 2:00 PM</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 30%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Medium</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Cell Biology Lab Report</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Biology</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Next Tuesday, 11:59 PM</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Low</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
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
