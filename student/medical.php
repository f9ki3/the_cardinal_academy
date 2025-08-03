<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
  <?php include 'header.php' ?>

    <style>
        .medical-tab {
            transition: all 0.3s ease;
        }
        .medical-tab.active {
            border-bottom: 3px solid #3b82f6;
            color: #3b82f6;
        }
        .vital-card {
            transition: transform 0.2s ease;
        }
        .vital-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

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
                 <div class="container mx-auto px-4  max-w-6xl">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Student Medical Report</h1>
            <p class="text-gray-600">Comprehensive health overview and records</p>
        </header>

        <!-- Student Profile Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="md:flex">
                <div class="md:w-1/4 p-6">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/25f1e606-1fd7-45c5-9edc-2d4631df2c90.png" alt="Student photo - smiling high school student wearing school uniform against blue background" class="w-full h-auto rounded-lg object-cover">
                </div>
                <div class="md:w-3/4 p-6">
                    <div class="uppercase tracking-wide text-sm text-blue-600 font-semibold">Student Profile</div>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1"><?= htmlspecialchars($full_name)?></h2>
                    <p class="text-gray-600 mt-1">Grade 10, Section B</p>
                    
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Student ID</p>
                            <p class="font-medium">ST2023-1042</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date of Birth</p>
                            <p class="font-medium">March 15, 2008</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Blood Group</p>
                            <p class="font-medium">A+</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Guardian</p>
                            <p class="font-medium">Sarah Johnson</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Contact</p>
                            <p class="font-medium">(555) 123-4567</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Last Checkup</p>
                            <p class="font-medium">October 12, 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="flex border-b border-gray-200 mb-6 overflow-x-auto">
            <button onclick="openTab('summary')" class="medical-tab active px-4 py-3 font-medium text-sm md:text-base" id="defaultOpen">Summary</button>
            <button onclick="openTab('vitals')" class="medical-tab px-4 py-3 font-medium text-sm md:text-base">Vitals</button>
            <button onclick="openTab('immunizations')" class="medical-tab px-4 py-3 font-medium text-sm md:text-base">Immunizations</button>
            <button onclick="openTab('allergies')" class="medical-tab px-4 py-3 font-medium text-sm md:text-base">Allergies</button>
            <button onclick="openTab('notes')" class="medical-tab px-4 py-3 font-medium text-sm md:text-base">Clinical Notes</button>
        </div>

        <!-- Tab Content -->
        <!-- Summary Tab -->
        <div id="summary" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Health Summary Card -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Health Summary</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Overall Health Status</p>
                            <p class="font-medium text-green-600">Excellent</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">BMI</p>
                            <p class="font-medium">20.3 (Normal)</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Chronic Conditions</p>
                            <p class="font-medium">None</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Last Dental Check</p>
                            <p class="font-medium">August 5, 2023</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Last Vision Test</p>
                            <p class="font-medium">March 20, 2023</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Vitals Card -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Vitals</h3>
                    <canvas id="vitalsChart" height="200"></canvas>
                </div>

                <!-- Medications Card -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Current Medications</h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <p class="font-medium">Antihistamine</p>
                            <p class="text-sm text-gray-600">Seasonal allergies - Take as needed</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <p class="font-medium">Multivitamin</p>
                            <p class="text-sm text-gray-600">Daily supplement</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">No prescription medications currently</p>
                </div>
            </div>

            <!-- Health Notifications -->
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Health Reminders</h3>
                <div class="space-y-3">
                    <div class="flex items-start p-3 border border-yellow-200 bg-yellow-50 rounded-lg">
                        <div class="flex-grow">
                            <p class="font-medium">Vision Exam Due</p>
                            <p class="text-sm text-gray-600">Annual vision screening recommended by March 2024</p>
                        </div>
                        <button class="text-yellow-600 hover:text-yellow-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-start p-3 border border-blue-200 bg-blue-50 rounded-lg">
                        <div class="flex-grow">
                            <p class="font-medium">Sports Physical</p>
                            <p class="text-sm text-gray-600">Required for spring sports participation</p>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vitals Tab -->
        <div id="vitals" class="tab-content hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <!-- Heart Rate Card -->
                <div class="vital-card bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Heart Rate</h3>
                    <div class="flex items-end justify-between">
                        <div>
                            <p class="text-3xl font-bold text-blue-600">78</p>
                            <p class="text-sm text-gray-500">bpm</p>
                        </div>
                        <div class="text-green-500 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Normal</span>
                        </div>
                    </div>
                    <canvas id="heartRateChart" class="mt-4" height="100"></canvas>
                </div>

                <!-- Blood Pressure Card -->
                <div class="vital-card bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Blood Pressure</h3>
                    <div class="flex items-end justify-between">
                        <div>
                            <p class="text-3xl font-bold text-blue-600">118/76</p>
                            <p class="text-sm text-gray-500">mmHg</p>
                        </div>
                        <div class="text-green-500 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Normal</span>
                        </div>
                    </div>
                    <canvas id="bloodPressureChart" class="mt-4" height="100"></canvas>
                </div>

                <!-- BMI Card -->
                <div class="vital-card bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">BMI</h3>
                    <div class="flex items-end justify-between">
                        <div>
                            <p class="text-3xl font-bold text-blue-600">20.3</p>
                            <p class="text-sm text-gray-500">kg/m²</p>
                        </div>
                        <div class="text-green-500 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Normal</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div class="text-right">
                                    <span class="text-xs font-semibold inline-block text-blue-600">
                                        20.3 BMI
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                                <div style="width: 40%;" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Underweight</span>
                                <span>Normal</span>
                                <span>Overweight</span>
                                <span>Obese</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Growth Chart -->
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Growth Chart</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">Height Progress</p>
                        <canvas id="heightChart" height="200"></canvas>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">Weight Progress</p>
                        <canvas id="weightChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Immunizations Tab -->
        <div id="immunizations" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Immunization Records</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-6 flex justify-between items-center">
                        <div>
                            <p class="font-medium">Tetanus, Diphtheria, Pertussis (Tdap)</p>
                            <p class="text-sm text-gray-500">Last dose: August 15, 2023</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Up to date</span>
                    </div>
                    <div class="p-6 flex justify-between items-center">
                        <div>
                            <p class="font-medium">Meningococcal (MenACWY)</p>
                            <p class="text-sm text-gray-500">Last dose: March 10, 2023</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Up to date</span>
                    </div>
                    <div class="p-6 flex justify-between items-center">
                        <div>
                            <p class="font-medium">Influenza (Flu)</p>
                            <p class="text-sm text-gray-500">Last dose: September 30, 2023</p>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">Due 2024</span>
                    </div>
                    <div class="p-6 flex justify-between items-center">
                        <div>
                            <p class="font-medium">COVID-19</p>
                            <p class="text-sm text-gray-500">Last dose: January 5, 2023</p>
                        </div>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Booster needed</span>
                    </div>
                    <div class="p-6 flex justify-between items-center">
                        <div>
                            <p class="font-medium">Human Papillomavirus (HPV)</p>
                            <p class="text-sm text-gray-500">Completed: March 2, 2022</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Complete</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Expected Vaccinations</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-medium text-gray-800">Meningococcal B (MenB)</h4>
                                <p class="mt-1 text-sm text-gray-500">Recommended between ages 16-18</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Allergies Tab -->
        <div id="allergies" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Known Allergies</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-medium text-gray-800">Peanuts</h4>
                                <p class="mt-1 text-sm text-gray-500">Severe allergic reaction causes anaphylaxis</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        High risk
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-medium text-gray-800">Pollen (Seasonal)</h4>
                                <p class="mt-1 text-sm text-gray-500">Causes allergic rhinitis and mild asthma symptoms</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Moderate
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Allergy Action Plan</h3>
                </div>
                <div class="p-6">
                    <div class="prose prose-blue max-w-none">
                        <h4 class="text-gray-800">For Peanut Allergy:</h4>
                        <ul>
                            <li>Strict avoidance of peanuts and peanut products</li>
                            <li>Carry epinephrine auto-injector (EpiPen) at all times</li>
                            <li>Emergency contacts: School nurse, guardian, 911</li>
                            <li>Recognize symptoms of anaphylaxis (difficulty breathing, swelling, hives)</li>
                            <li>In case of exposure, administer epinephrine immediately and call 911</li>
                        </ul>

                        <h4 class="text-gray-800 mt-4">For Seasonal Allergies:</h4>
                        <ul>
                            <li>Antihistamines as needed (prescribed by Dr. Smith)</li>
                            <li>Nasal saline rinses during high pollen seasons</li>
                            <li>Avoid outdoor activities during high pollen counts</li>
                            <li>Keep windows closed during allergy season</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clinical Notes Tab -->
        <div id="notes" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Clinical Notes</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/724a05ab-776a-4aba-96f7-115ecdc6804a.png" alt="Dr. Sarah Chen, pediatrician at Lakeside Medical Clinic" class="h-10 w-10 rounded-full">
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <p class="text-sm font-medium text-gray-900">Dr. Sarah Chen</p>
                                    <span class="ml-2 text-xs text-gray-500">October 12, 2023</span>
                                </div>
                                <div class="mt-2 text-sm text-gray-700 space-y-2">
                                    <p>Annual checkup completed. Emily is in excellent health with no concerning issues.</p>
                                    <p>Height and weight tracking appropriately on growth curves. Vitals within normal limits.</p>
                                    <p>Review of systems negative except for mild seasonal allergy symptoms which are well-controlled with antihistamines.</p>
                                    <p>Vision and hearing screenings normal. Immunizations up to date.</p>
                                    <p>Continue current management. Return in one year for annual checkup or sooner if any concerns arise.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/318975f7-1e26-4d48-9ac2-2f5613a68341.png" alt="Dr. Mark Williams, allergist at City Allergy Specialists" class="h-10 w-10 rounded-full">
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <p class="text-sm font-medium text-gray-900">Dr. Mark Williams</p>
                                    <span class="ml-2 text-xs text-gray-500">July 18, 2023</span>
                                </div>
                                <div class="mt-2 text-sm text-gray-700 space-y-2">
                                    <p>Follow-up allergy evaluation for peanut allergy and seasonal allergies.</p>
                                    <p>Peanut allergy remains severe. Reinforced avoidance strategies and emergency action plan. Provided new epinephrine auto-injector prescription. No accidental exposures since last visit.</p>
                                    <p>Seasonal allergy symptoms well-controlled with current regimen. Advised start antihistamine 2 weeks before typical allergy season onset.</p>
                                    <p>No need for allergy shots at this time. Return in one year for re-evaluation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/2ad15e84-9019-4d85-b20a-470eb1e46f46.png" alt="Dr. Lisa Garcia, school physician at Lincoln High School" class="h-10 w-10 rounded-full">
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <p class="text-sm font-medium text-gray-900">Dr. Lisa Garcia</p>
                                    <span class="ml-2 text-xs text-gray-500">March 5, 2023</span>
                                </div>
                                <div class="mt-2 text-sm text-gray-700 space-y-2">
                                    <p>School sports physical evaluation for track team participation.</p>
                                    <p>No cardiac or pulmonary symptoms. No limitations to physical activity.</p>
                                    <p>Reviewed allergy action plan with student and coach. Additional epinephrine auto-injector provided for sports first aid kit.</p>
                                    <p>Clearance granted for all school sports activities for 2023-2024 school year.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab functionality
        function openTab(tabName) {
            const tabContents = document.getElementsByClassName('tab-content');
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.add('hidden');
            }

            const tabButtons = document.getElementsByClassName('medical-tab');
            for (let i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove('active');
            }

            document.getElementById(tabName).classList.remove('hidden');
            event.currentTarget.classList.add('active');
        }

        // Set default tab
        document.getElementById('defaultOpen').click();

        // Charts
        document.addEventListener('DOMContentLoaded', function() {
            // Vitals Overview Chart
            const vitalsCtx = document.getElementById('vitalsChart').getContext('2d');
            new Chart(vitalsCtx, {
                type: 'bar',
                data: {
                    labels: ['Heart Rate', 'BP (Sys)', 'BP (Dia)', 'Temp', 'Resp Rate', 'O2 Sat'],
                    datasets: [{
                        label: 'Last Checkup',
                        data: [78, 118, 76, 98.4, 16, 98],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(59, 130, 246, 0.7)'
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(59, 130, 246, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });

            // Heart Rate Chart
            const heartRateCtx = document.getElementById('heartRateChart').getContext('2d');
            new Chart(heartRateCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Mar', 'May', 'Jul', 'Sep', 'Nov'],
                    datasets: [{
                        label: 'Heart Rate (bpm)',
                        data: [82, 80, 79, 76, 78, 77],
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            min: 70,
                            max: 90
                        }
                    }
                }
            });

            // Blood Pressure Chart
            const bpCtx = document.getElementById('bloodPressureChart').getContext('2d');
            new Chart(bpCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Mar', 'May', 'Jul', 'Sep', 'Nov'],
                    datasets: [
                        {
                            label: 'Systolic',
                            data: [122, 120, 119, 118, 118, 117],
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: false
                        },
                        {
                            label: 'Diastolic',
                            data: [80, 78, 77, 76, 76, 76],
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Height Chart
            const heightCtx = document.getElementById('heightChart').getContext('2d');
            new Chart(heightCtx, {
                type: 'line',
                data: {
                    labels: ['2018', '2019', '2020', '2021', '2022', '2023'],
                    datasets: [{
                        label: 'Height (in)',
                        data: [58, 60, 62, 63.5, 65, 66],
                        backgroundColor: 'rgba(124, 58, 237, 0.1)',
                        borderColor: 'rgba(124, 58, 237, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Weight Chart
            const weightCtx = document.getElementById('weightChart').getContext('2d');
            new Chart(weightCtx, {
                type: 'line',
                data: {
                    labels: ['2018', '2019', '2020', '2021', '2022', '2023'],
                    datasets: [{
                        label: 'Weight (lbs)',
                        data: [95, 102, 110, 115, 122, 125],
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
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
