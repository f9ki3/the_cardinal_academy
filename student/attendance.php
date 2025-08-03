<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; 

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

    <style>
        .student-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .attendance-toggle {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-3">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container my-2">
              <div class="row mb-3">

    <div class="container mx-auto  max-w-6xl">
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-center ">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-gray-800">Attendance Record</h1>
            </div>
            
        </header>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Present</p>
                        <p class="text-xl font-semibold text-gray-800"><span id="present-count">0</span></p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Absent</p>
                        <p class="text-xl font-semibold text-gray-800"><span id="absent-count">0</span></p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Late</p>
                        <p class="text-xl font-semibold text-gray-800"><span id="late-count">0</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student List -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            
            <div class="divide-y divide-gray-200">
                <!-- Student Item 1 -->
                <div class="student-card p-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                           
                            <div>
                                <h3 class="font-medium text-gray-800">Alex Johnson</h3>
                                <p class="text-sm text-gray-500">English | 2:20 - 4:20</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="attendance-toggle present-btn px-3 py-1 rounded-full text-sm bg-green-100 text-green-800 border border-green-200 hover:bg-green-200">
                                Present
                            </button>                           
                        </div>
                    </div>
                </div>
                
                <!-- Student Item 2 -->
                <div class="student-card p-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                           
                            <div>
                                <h3 class="font-medium text-gray-800">Brianna Williams</h3>
                                <p class="text-sm text-gray-500">Math | 9:20 - 10:20</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="attendance-toggle absent-btn px-3 py-1 rounded-full text-sm bg-red-100 text-red-800 border border-red-200 hover:bg-red-200">
                                Absent
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Student Item 3 -->
                <div class="student-card p-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                         
                            <div>
                                <h3 class="font-medium text-gray-800">Chris Miller</h3>
                                <p class="text-sm text-gray-500">PE | 10:30 - 12:30</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="attendance-toggle late-btn px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800 border border-yellow-200 hover:bg-yellow-200">
                                Late
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- More student items would go here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set today's date as default
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = today;
            
            // Attendance toggle functionality
            const attendanceToggles = document.querySelectorAll('.attendance-toggle');
            let presentCount = 0, absentCount = 0, lateCount = 0;
            
            attendanceToggles.forEach(button => {
                button.addEventListener('click', function() {
                    const studentCard = this.closest('.student-card');
                    
                    // Remove all active classes from sibling buttons
                    const siblingButtons = studentCard.querySelectorAll('.attendance-toggle');
                    siblingButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-green-500', 'text-white', 'border-transparent', 
                                            'bg-red-500', 'bg-yellow-500');
                    });
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    if (this.classList.contains('present-btn')) {
                        this.classList.add('bg-green-500', 'text-white', 'border-transparent');
                        updateCount('present');
                    } else if (this.classList.contains('absent-btn')) {
                        this.classList.add('bg-red-500', 'text-white', 'border-transparent');
                        updateCount('absent');
                    } else if (this.classList.contains('late-btn')) {
                        this.classList.add('bg-yellow-500', 'text-white', 'border-transparent');
                        updateCount('late');
                    }
                });
            });
            
            function updateCount(type) {
                // Implementation would adjust counts based on changes
                // For demo purposes, we're just setting random counts
                presentCount = Math.floor(Math.random() * 20);
                absentCount = Math.floor(Math.random() * 5);
                lateCount = Math.floor(Math.random() * 3);
                
                document.getElementById('present-count').textContent = presentCount;
                document.getElementById('absent-count').textContent = absentCount;
                document.getElementById('late-count').textContent = lateCount;
            }
            
            // Submit button functionality
            document.getElementById('submit-btn').addEventListener('click', function() {
                alert('Attendance submitted successfully!');
                // In a real app, would send data to server
            });
        });
    </script>
</body>
</html>


                               
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
