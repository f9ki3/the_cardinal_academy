<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php' ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<style>
        .grade-A { background-color: #10B981; }
        .grade-B { background-color: #3B82F6; }
        .grade-C { background-color: #F59E0B; }
        .grade-D { background-color: #EF4444; }
        .grade-F { background-color: #6B7280; }
        
        .grade-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            color: white;
            font-weight: bold;
            text-align: center;
            min-width: 32px;
            display: inline-block;
        }
        
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #E5E7EB;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
        }
        
        .grade-A-fill { background-color: #10B981; }
        .grade-B-fill { background-color: #3B82F6; }
        .grade-C-fill { background-color: #F59E0B; }
        .grade-D-fill { background-color: #EF4444; }
        .grade-F-fill { background-color: #6B7280; }
        
        @media (max-width: 768px) {
            .responsive-table td:nth-child(3), 
            .responsive-table td:nth-child(4),
            .responsive-table th:nth-child(3),
            .responsive-table th:nth-child(4) {
                display: none;
            }
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
                <div class="container mx-auto max-w-6xl">
                    <header class="mb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="text-3xl font-bold text-gray-800">Student Grade</h1>
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="searchInput" class="bg-white border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search students...">
                                </div>
                                <select id="gradeFilter" class="bg-white border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="all">All Grades</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-gray-500 text-sm font-medium mb-2">Total Students</h3>
                                <p class="text-3xl font-bold text-gray-800" id="totalStudents">24</p>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-gray-500 text-sm font-medium mb-2">Class Average</h3>
                                <p class="text-3xl font-bold text-gray-800" id="classAverage">83.4%</p>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-gray-500 text-sm font-medium mb-2">Highest Grade</h3>
                                <p class="text-3xl font-bold text-blue-600" id="highestGrade">98%</p>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-gray-500 text-sm font-medium mb-2">Lowest Grade</h3>
                                <p class="text-3xl font-bold text-red-600" id="lowestGrade">62%</p>
                            </div>
                        </div>            
                        
                    </header>
                    
                    <main>
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 responsive-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tests</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homework</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participation</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTable" class="bg-white divide-y divide-gray-200">
                                    <!-- Student rows will be inserted here by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>

                <script>
                    // Sample student data
                    const students = [
                        { id: 1, name: "Emily Johnson", grade: 98, tests: 98, homework: 100, participation: 98, status: "Excellent" },
                        { id: 2, name: "Michael Brown", grade: 92, tests: 93, homework: 90, participation: 95, status: "Good" },
                        { id: 3, name: "Jessica Williams", grade: 88, tests: 85, homework: 95, participation: 90, status: "Good" },
                        { id: 4, name: "Christopher Lee", grade: 85, tests: 82, homework: 90, participation: 88, status: "Good" },
                        { id: 5, name: "Sarah Davis", grade: 83, tests: 80, homework: 90, participation: 85, status: "Fair" },
                        { id: 6, name: "David Martinez", grade: 81, tests: 78, homework: 88, participation: 85, status: "Fair" },
                        { id: 7, name: "Amanda Garcia", grade: 79, tests: 75, homework: 85, participation: 83, status: "Fair" },
                        { id: 8, name: "Matthew Rodriguez", grade: 78, tests: 73, homework: 85, participation: 82, status: "Fair" },
                        { id: 9, name: "Jennifer Wilson", grade: 76, tests: 70, homework: 83, participation: 80, status: "Fair" },
                        { id: 10, name: "Daniel Anderson", grade: 74, tests: 68, homework: 82, participation: 78, status: "Fair" },
                        { id: 11, name: "Elizabeth Taylor", grade: 72, tests: 65, homework: 80, participation: 75, status: "Needs Improvement" },
                        { id: 12, name: "Robert Hernandez", grade: 70, tests: 63, homework: 78, participation: 73, status: "Needs Improvement" },
                        { id: 13, name: "Nicole Moore", grade: 68, tests: 60, homework: 75, participation: 70, status: "Needs Improvement" },
                        { id: 14, name: "Andrew Martin", grade: 65, tests: 58, homework: 73, participation: 68, status: "Needs Improvement" },
                        { id: 15, name: "Olivia White", grade: 62, tests: 55, homework: 70, participation: 65, status: "Needs Improvement" }
                    ];

                    // Function to calculate grade letter
                    function getGradeLetter(grade) {
                        if (grade >= 90) return 'A';
                        if (grade >= 80) return 'B';
                        if (grade >= 70) return 'C';
                        if (grade >= 60) return 'D';
                        return 'F';
                    }

                    // Function to get status color
                    function getStatusColor(status) {
                        switch(status.toLowerCase()) {
                            case 'excellent': return 'text-green-600 bg-green-100';
                            case 'good': return 'text-blue-600 bg-blue-100';
                            case 'fair': return 'text-yellow-600 bg-yellow-100';
                            case 'needs improvement': return 'text-red-600 bg-red-100';
                            default: return 'text-gray-600 bg-gray-100';
                        }
                    }

                    // Function to render student table
                    function renderStudentTable(data) {
                        const tableBody = document.getElementById('studentTable');
                        tableBody.innerHTML = '';
                        
                        data.forEach(student => {
                            const gradeLetter = getGradeLetter(student.grade);
                            const gradeClass = `grade-badge grade-${gradeLetter}`;
                            const statusClass = getStatusColor(student.status);
                            
                            const row = document.createElement('tr');
                            row.className = 'hover:bg-gray-50';
                            row.innerHTML = `
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://placehold.co/100x100" alt="Student ${student.name} profile picture">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">${student.name}</div>
                                            <div class="text-sm text-gray-500">ID: ${student.id}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="${gradeClass}">${gradeLetter}</span>
                                    <div class="text-sm text-gray-500">${student.grade}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${student.tests}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${student.homework}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${student.participation}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full ${statusClass}">
                                        ${student.status}
                                    </span>
                                </td>
                            `;
                            tableBody.appendChild(row);
                        });
                        
                        return data;
                    }                

                    // Initialize the page
                    document.addEventListener('DOMContentLoaded', () => {
                        renderStudentTable(students);
                        initChart();
                        setupFilters();
                    });
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
