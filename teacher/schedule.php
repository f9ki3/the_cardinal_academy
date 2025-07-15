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
    <style>
    
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(135deg, #3a7bd5, #00d2ff);
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        h1 {
            margin: 0;
            font-size: 24px;
        }
        
        .teacher-info {
            margin-top: 10px;
            font-size: 16px;
            opacity: 0.9;
        }
        
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .schedule-table th {
   
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #4a5568;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .schedule-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        
        .schedule-table tr:last-child td {
            border-bottom: none;
        }
        
        .schedule-table tr:hover {
            background-color: #f8fafc;
        }
        
        .class-info {
            display: flex;
            flex-direction: column;
        }
        
        .subject {
            font-weight: 600;
            font-size: 16px;
            color: #2d3748;
            margin-bottom: 5px;
        }
        
        .class-room {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #4a5568;
        }
        
        .time-range {
            font-weight: 500;
            color: #3a7bd5;
        }
        
        .day-header {
            font-weight: 600;
            color: #2d3748;
        }
        
        footer {
            text-align: center;
            padding: 20px;
            color: #718096;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .schedule-table th, 
            .schedule-table td {
                padding: 12px 10px;
            }
            
            .class-room {
                flex-direction: column;
                gap: 3px;
            }
        }
    </style>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container ">
      <div class="row g-4">
        <div class="col bg-gray">
          <div class="rounded ">
            <div class="container my-4">
              <div class="row mb-3">
                <!-- start -->
                 <div class="container">
        <header>
            <h1>Class Schedule</h1>
        </header>
        
        <table class="schedule-table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Class Details</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="day-header">Monday</td>
                    <td class="time-range">8:00 - 9:00 AM</td>
                    <td>
                        <div class="class-info">
                            <span class="subject">Introduction to programming </span>
                            <div class="class-room">
                                <span>Grade 10-A</span>
                            </div>
                        </div>
                    </td>
                    <td>Room 203</td>
                </tr>
                <tr>
                    <td class="day-header">Tuesday</td>
                    <td class="time-range">8:00 - 9:00 AM</td>
                    <td>
                        <div class="class-info">
                            <span class="subject">Introduction to data structures and algorithms</span>
                            <div class="class-room">
                                <span>Grade 10-A</span>
                            </div>
                        </div>
                    </td>
                    <td>Room 203</td>
                </tr>
                <tr>
                    <td class="day-header">Wednesday</td>
                    <td class="time-range">8:00 - 9:00 AM</td>
                    <td>
                        <div class="class-info">
                            <span class="subject">Introduction to computer architecture</span>
                            <div class="class-room">
                                <span>Grade 10-A</span>
                            </div>
                        </div>
                    </td>
                    <td>Room 203</td>
                </tr>
                <tr>
                    <td class="day-header">Thursday</td>
                    <td class="time-range">8:00 - 9:00 AM</td>
                    <td>
                        <div class="class-info">
                            <span class="subject">Introduction to operating systems</span>
                            <div class="class-room">
                                <span>Grade 10-A</span>
                            </div>
                        </div>
                    </td>
                    <td>Room 203</td>
                </tr>
                <tr>
                    <td class="day-header">Friday</td>
                    <td class="time-range">8:00 - 9:00 AM</td>
                    <td>
                        <div class="class-info">
                            <span class="subject">Introduction to databases</span>
                            <div class="class-room">
                                <span>Grade 10-A</span>
                            </div>
                        </div>
                    </td>
                    <td>Room 203</td>
                </tr>
            </tbody>
        </table>
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
