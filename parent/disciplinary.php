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
        :root {
            --primary: #3b82f6;
            --secondary: #6366f1;
            --warning: #f59e0b;
            --danger: #ef4444;
            --success: #10b981;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 2rem;
        }
        
        .timeline-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--primary);
            border: 2px solid white;
            z-index: 2;
        }
        
        .timeline-item:after {
            content: '';
            position: absolute;
            left: 5px;
            top: 12px;
            width: 2px;
            height: calc(100% + 1rem);
            background-color: #e5e7eb;
        }
        
        .timeline-item:last-child:after {
            display: none;
        }
        
        .status-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }
        
        .status-active {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border-left: 3px solid var(--danger);
        }
        
        .status-closed {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-left: 3px solid var(--success);
        }
        
        .status-review {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
            border-left: 3px solid var(--warning);
        }
        
        .offense-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .print-only {
            display: none;
        }
        
        @media print {
            .no-print {
                display: none;
            }
            .print-only {
                display: block;
            }
            body {
                padding: 0;
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
                <div class=" p-4">
                  <h2 class="fw-bold">Child Disciplinary Record</h2>
                </div>
                <!-- start -->
                 <div class="container mx-auto ">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left Column - Record Overview -->
                        <div class="lg:col-span-2">
                            <!-- Status Overview -->
                            <div class="bg-white rounded-lg shadow mb-6">
                                <div class="border-b border-gray-200 px-6 py-4">
                                    <h3 class="text-lg font-medium text-gray-800">Incident Overview</h3>
                                </div>
                                <div class="px-6 py-4">
                                    <div class="grid grid-cols-3 gap-4 text-center">
                                        <div class="p-3 rounded-lg border-2 border-red-100">
                                            <div class="text-red-500 font-bold text-2xl">3</div>
                                            <div class="text-xs text-gray-600 mt-1">Active Cases</div>
                                        </div>
                                        <div class="p-3 rounded-lg border-2 border-yellow-100">
                                            <div class="text-yellow-500 font-bold text-2xl">1</div>
                                            <div class="text-xs text-gray-600 mt-1">Pending Review</div>
                                        </div>
                                        <div class="p-3 rounded-lg border-2 border-green-100">
                                            <div class="text-green-500 font-bold text-2xl">5</div>
                                            <div class="text-xs text-gray-600 mt-1">Resolved Cases</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Most Serious Offenses -->
                            <div class="bg-white rounded-lg shadow mb-6">
                                <div class="border-b border-gray-200 px-6 py-4">
                                    <h3 class="text-lg font-medium text-gray-800">Previous Incidents</h3>
                                </div>
                                <div class="p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="offense-card transition-all duration-200 cursor-pointer bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded mb-2">Major</span>
                                                    <h4 class="text-md font-medium text-gray-800 mb-1">Physical Altercation</h4>
                                                </div>
                                                <span class="text-xs text-gray-500">Oct 15, 2023</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">Involved in a cafeteria fight with another student...</p>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                Suspension (3 days)
                                            </div>
                                        </div>
                                        
                                        <div class="offense-card transition-all duration-200 cursor-pointer bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mb-2">Moderate</span>
                                                    <h4 class="text-md font-medium text-gray-800 mb-1">Disrespect to Teacher</h4>
                                                </div>
                                                <span class="text-xs text-gray-500">Sep 28, 2023</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">Used inappropriate language when addressed by instructor...</p>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Detention (2 hours)
                                            </div>
                                        </div>
                                        
                                        <div class="offense-card transition-all duration-200 cursor-pointer bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mb-2">Moderate</span>
                                                    <h4 class="text-md font-medium text-gray-800 mb-1">Tardiness (Repeated)</h4>
                                                </div>
                                                <span class="text-xs text-gray-500">Sep 5, 2023</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">Late to class 5 times in semester...</p>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                Parent Conference
                                            </div>
                                        </div>
                                        
                                        <div class="offense-card transition-all duration-200 cursor-pointer bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mb-2">Minor</span>
                                                    <h4 class="text-md font-medium text-gray-800 mb-1">Unprepared for Class</h4>
                                                </div>
                                                <span class="text-xs text-gray-500">Aug 22, 2023</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">Repeatedly forgetting materials...</p>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Verbal Warning
                                            </div>
                                        </div>
                                    </div>
                                    <button class="w-full mt-4 py-2 text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        View All Incidents →
                                    </button>
                                </div>
                            </div>

                            <!-- Current Disciplinary Action -->
                            
                        </div>

                        <!-- Right Column - Timeline and Notes -->
                        <div>
                            <!-- Timeline -->
                            <div class="bg-white rounded-lg shadow mb-6">
                                <div class="border-b border-gray-200 px-6 py-4">
                                    <h3 class="text-lg font-medium text-gray-800">Disciplinary Timeline</h3>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        <div class="timeline-item">
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <div class="flex justify-between items-center mb-1">
                                                    <span class="text-sm font-medium text-gray-800">Initial Report Filed</span>
                                                    <span class="text-xs text-gray-500">Today, 10:15 AM</span>
                                                </div>
                                                <p class="text-xs text-gray-600">Incident reported by Mr. Johnson (Math teacher)</p>
                                            </div>
                                        </div>
                                        
                                        <div class="timeline-item">
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <div class="flex justify-between items-center mb-1">
                                                    <span class="text-sm font-medium text-gray-800">Administration Review</span>
                                                    <span class="text-xs text-gray-500">Today, 11:30 AM</span>
                                                </div>
                                                <p class="text-xs text-gray-600">Reviewed security footage, spoke with witnesses</p>
                                            </div>
                                        </div>
                                        
                                        <div class="timeline-item">
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <div class="flex justify-between items-center mb-1">
                                                    <span class="text-sm font-medium text-gray-800">Parent Contacted</span>
                                                    <span class="text-xs text-gray-500">Today, 2:45 PM</span>
                                                </div>
                                                <p class="text-xs text-gray-600">Spoke with parent/guardian (Mrs. Doe) about incident</p>
                                            </div>
                                        </div>
                                        
                                        <div class="timeline-item">
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <div class="flex justify-between items-center mb-1">
                                                    <span class="text-sm font-medium text-gray-800">Suspension Issued</span>
                                                    <span class="text-xs text-gray-500">Today, 3:15 PM</span>
                                                </div>
                                                <p class="text-xs text-gray-600">3-day suspension approved by Principal Smith</p>
                                                <div class="mt-1">
                                                    <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Official Notice Sent</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
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
