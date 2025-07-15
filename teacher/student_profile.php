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

</head>
    <style>
        /* Custom styles */
        .section-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .section-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .student-card {
            transition: all 0.2s ease;
        }
        .student-card:hover {
            background-color: #f8fafc;
        }
        .back-button:hover {
            background-color: #e2e8f0;
        }
        .slide-in {
            animation: slideIn 0.3s forwards;
        }
        .slide-out {
            animation: slideOut 0.3s forwards;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(-100%); opacity: 0; }
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
        }
        .status-new {
            background-color: #dcfce7;
            color: #16a34a;
        }
        .status-old {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
    </style>
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

           

  

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Sections View -->
        <div id="sections-view">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Advisory and subject Class</h2>
                <div class="relative">
                    <input type="text" placeholder="Search sections..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Section Cards -->
                <div class="section-card bg-white p-6 rounded-xl shadow-md border border-gray-100" onclick="showStudents('Kindergarten', 'Room 101', 'K')">
                    <div class="flex items-start">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/c52975a8-fb09-42d2-82af-683ba20382fa.png" alt="Colorful kindergarten classroom with small tables, chairs, and educational toys" class="w-20 h-20 rounded-lg mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Kindergarten</h3>
                            <p class="text-gray-600">Room 101 • Level K</p>
                            <div class="mt-2 text-sm text-indigo-600">15 students</div>
                        </div>
                    </div>
                </div>
                
                <div class="section-card bg-white p-6 rounded-xl shadow-md border border-gray-100" onclick="showStudents('Grade 1', 'Room 201', 'G1')">
                    <div class="flex items-start">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/943982a9-099d-4ed3-a761-c26fb4ef12e7.png" alt="Elementary classroom with desks in rows, whiteboard at front, and alphabet posters" class="w-20 h-20 rounded-lg mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grade 1</h3>
                            <p class="text-gray-600">Room 201 • Level G1</p>
                            <div class="mt-2 text-sm text-indigo-600">22 students</div>
                        </div>
                    </div>
                </div>
                
                <div class="section-card bg-white p-6 rounded-xl shadow-md border border-gray-100" onclick="showStudents('Grade 2', 'Room 202', 'G2')">
                    <div class="flex items-start">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0b1f117c-d7a7-4da7-84d4-64a008e12904.png" alt="Second grade classroom with reading corner, colorful bulletin boards, and student artwork" class="w-20 h-20 rounded-lg mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grade 2</h3>
                            <p class="text-gray-600">Room 202 • Level G2</p>
                            <div class="mt-2 text-sm text-indigo-600">20 students</div>
                        </div>
                    </div>
                </div>
                
                <div class="section-card bg-white p-6 rounded-xl shadow-md border border-gray-100" onclick="showStudents('Grade 3', 'Room 301', 'G3')">
                    <div class="flex items-start">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/755b380e-a89d-4ef7-88ca-d04d7ecdb172.png" alt="Third grade classroom with group tables, science projects on display" class="w-20 h-20 rounded-lg mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grade 3</h3>
                            <p class="text-gray-600">Room 301 • Level G3</p>
                            <div class="mt-2 text-sm text-indigo-600">18 students</div>
                        </div>
                    </div>
                </div>
                
                <div class="section-card bg-white p-6 rounded-xl shadow-md border border-gray-100" onclick="showStudents('Grade 4', 'Room 302', 'G4')">
                    <div class="flex items-start">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/50f5a71e-0299-42ea-a50e-fbe511398ca5.png" alt="Fourth grade classroom with computers at each desk and math posters" class="w-20 h-20 rounded-lg mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grade 4</h3>
                            <p class="text-gray-600">Room 302 • Level G4</p>
                            <div class="mt-2 text-sm text-indigo-600">21 students</div>
                        </div>
                    </div>
                </div>
                
                <div class="section-card bg-white p-6 rounded-xl shadow-md border border-gray-100" onclick="showStudents('Grade 5', 'Room 303', 'G5')">
                    <div class="flex items-start">
                        <img src="https://placehold.co/80x80" alt="Fifth grade classroom with science lab equipment and world maps" class="w-20 h-20 rounded-lg mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grade 5</h3>
                            <p class="text-gray-600">Room 303 • Level G5</p>
                            <div class="mt-2 text-sm text-indigo-600">17 students</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Students View (hidden by default) -->
        <div id="students-view" class="hidden">
            <button onclick="hideStudents()" class="back-button mb-4 flex items-center text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Sections
            </button>
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 id="section-name" class="text-2xl font-semibold text-gray-800"></h2>
                    <p id="section-details" class="text-gray-600"></p>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Search by name or ID..." class="px-4 py-2 w-64 border-2 border-indigo-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" oninput="filterStudents()">
                </div>
            </div>
            
            <div id="students-container" class="bg-white rounded-xl shadow-md border border-gray-200 divide-y divide-gray-200">
                <!-- Student list will be populated here by JavaScript -->
            </div>
        </div>
    </div>

    <script>
        // Sample student data
        const studentsDatabase = {
            'Kindergarten': [
                { id: 'K-001', name: 'Emma Johnson', status: 'new', photo: 'https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/4be6c79e-0448-46cd-b027-afa52a303bcb.png', grade: 'K' },
                { id: 'K-002', name: 'Liam Smith', status: 'old', photo: 'https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/539ba66c-1473-40ea-ba8f-d98e7985e785.png' },
                { id: 'K-003', name: 'Olivia Brown', status: 'new', photo: 'https://placehold.co/100x100' },
                { id: 'K-004', name: 'Noah Williams', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'K-005', name: 'Ava Jones', status: 'new', photo: 'https://placehold.co/100x100' }
            ],
            'Grade 1': [
                { id: 'G1-001', name: 'William Garcia', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G1-002', name: 'Sophia Miller', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G1-003', name: 'Benjamin Davis', status: 'new', photo: 'https://placehold.co/100x100' },
                { id: 'G1-004', name: 'Isabella Rodriguez', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G1-005', name: 'Mason Wilson', status: 'new', photo: 'https://placehold.co/100x100' }
            ],
            'Grade 2': [
                { id: 'G2-001', name: 'Mia Martinez', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G2-002', name: 'Elijah Anderson', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G2-003', name: 'Charlotte Taylor', status: 'new', photo: 'https://placehold.co/100x100' },
                { id: 'G2-004', name: 'Logan Thomas', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G2-005', name: 'Amelia Hernandez', status: 'new', photo: 'https://placehold.co/100x100' }
            ],
            'Grade 3': [
                { id: 'G3-001', name: 'James Moore', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G3-002', name: 'Harper Martin', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G3-003', name: 'Alexander Jackson', status: 'new', photo: 'https://placehold.co/100x100' },
                { id: 'G3-004', name: 'Evelyn Thompson', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G3-005', name: 'Michael White', status: 'new', photo: 'https://placehold.co/100x100' }
            ],
            'Grade 4': [
                { id: 'G4-001', name: 'Abigail Lopez', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G4-002', name: 'Daniel Lee', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G4-003', name: 'Emily Gonzalez', status: 'new', photo: 'https://placehold.co/100x100' },
                { id: 'G4-004', name: 'Henry Harris', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G4-005', name: 'Elizabeth Clark', status: 'new', photo: 'https://placehold.co/100x100' }
            ],
            'Grade 5': [
                { id: 'G5-001', name: 'Jacob Lewis', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G5-002', name: 'Avery Robinson', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G5-003', name: 'Daniel Walker', status: 'new', photo: 'https://placehold.co/100x100' },
                { id: 'G5-004', name: 'Sofia Hall', status: 'old', photo: 'https://placehold.co/100x100' },
                { id: 'G5-005', name: 'Matthew Young', status: 'new', photo: 'https://placehold.co/100x100' }
            ]
        };

        let currentSection = '';
        
        // Show students for a specific section
        function showStudents(sectionName, roomNumber, level) {
            currentSection = sectionName;
            
            // Update the section header
            document.getElementById('section-name').textContent = sectionName;
            document.getElementById('section-details').textContent = roomNumber + ' • Level ' + level;
            
            // Populate students
            const studentsContainer = document.getElementById('students-container');
            studentsContainer.innerHTML = '';
            
            studentsDatabase[sectionName].forEach(student => {
                const studentCard = document.createElement('div');
                studentCard.className = 'student-card p-4 border-b border-gray-100 last:border-b-0 flex items-center hover:bg-gray-50 cursor-pointer';
                studentCard.innerHTML = `
                    <img src="${student.photo}" alt="Portrait of student ${student.name}" class="w-14 h-14 rounded-full mr-4 border-2 border-indigo-100">
                    <div class="flex-grow">
                        <div class="flex justify-between items-baseline">
                            <h3 class="font-semibold text-gray-800 text-lg">${student.name}</h3>
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">${student.id}</span>
                        </div>
                        <div class="flex items-center mt-2 space-x-2">
                            <span class="status-badge ${student.status === 'new' ? 'status-new' : 'status-old'}">
                                ${student.status === 'new' ? 'New' : 'Returning'}
                            </span>
                            <span class="text-sm text-gray-500"><span class="font-medium">Grade:</span> ${level}</span>
                            <span class="text-sm text-gray-500"><span class="font-medium">Room:</span> ${roomNumber}</span>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                `;
                studentsContainer.appendChild(studentCard);
            });
            
            // Show the students view with animation
            document.getElementById('sections-view').classList.add('slide-out');
            setTimeout(() => {
                document.getElementById('sections-view').classList.add('hidden');
                document.getElementById('sections-view').classList.remove('slide-out');
                document.getElementById('students-view').classList.remove('hidden');
                document.getElementById('students-view').classList.add('slide-in');
            }, 300);
        }
        
        // Hide students view and return to sections
        function hideStudents() {
            document.getElementById('students-view').classList.add('slide-out');
            setTimeout(() => {
                document.getElementById('students-view').classList.add('hidden');
                document.getElementById('students-view').classList.remove('slide-out');
                document.getElementById('sections-view').classList.remove('hidden');
                document.getElementById('sections-view').classList.add('slide-in');
            }, 300);
        }
        
        // Filter students based on search input
        function filterStudents() {
            const searchTerm = document.querySelector('#students-view input').value.toLowerCase();
            const studentCards = document.querySelectorAll('.student-card');
            
            studentCards.forEach(card => {
                const studentName = card.querySelector('h3').textContent.toLowerCase();
                const studentId = card.querySelector('.text-sm.text-gray-500').textContent.toLowerCase();
                
                if (studentName.includes(searchTerm) || studentId.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
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
