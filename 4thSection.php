<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Organizational Chart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }

    .org-chart {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 20px auto;
      width: 100%;
      /* max-width: 1300px; */
      background-color:violet;
    }

    .level {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin: 20px 0;
      width: 100%;
      background-color:pink;
    }
    .l_asp {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      background-color:pink;
      margin-right:30px;
    }
    .label {
      display: flex;
      flex-wrap: wrap;
      /* justify-content: center; */
      gap: 20px;
      margin: 20px 0;
      width: 100%;
      background-color:pink;
    }

    .box {
      background-color: #fff;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 160px;
      min-height: 70px;
    }

    .connector {
      width: 2px;
      height: 20px;
      background-color: #333;
      margin: 0 auto;
    }
    .connector1 {
      width: 2px;
      height: 20px;
      gap:100px;
      display: flex;

    }
  

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .box {
        width: 90%;
      }

      .connector {
        display: none;
      }

      .level {
        margin: 10px 0;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="org-chart">
    <!-- Founder -->
    <div class="level">
      <div class="box">Founder</div>
    </div>

    <div class="connector"></div>

    <!-- CEO -->
    <div class="level">
      <div class="box">CEO</div>
    </div>

    <div class="connector"></div>
    

    <!-- Principal -->
    <div class="level">
      <div class="box">Principal</div>
    </div>

    <div class="connector"></div>
    

    <!-- Assistant Principal & Staff -->
    <div class="level">
      <div class="l_asp">
        <div class="box">Assistant Principal</div>
      <div class="box">Assistant Principal</div>
      </div>
      <div class="box">Registrar</div>
      <div class="box">Accounting</div>
      <div class="box">Administrator</div>
      <div class="box">Liaison Officer</div>
      <div class="box">Multimedia Artist</div>
      <div class="box">School Nurse</div>
      <div class="box">Guard</div>
     </div>

<div class="connector1">
   <div class="connector">|</div>
   <div class="connector">|</div>
</div>

    <!-- Coordinators & Support Staff -->
    <div class="label ">
      <div class="box">Academic Coordinator</div>
      <div class="box">Activity Coordinator</div>
      <div class="box">Guidance Office</div>
      <div class="box">Cashier</div>
    </div>

    <div class="connector"></div>
    

    <!-- Teachers -->
    <div class="level">
      <div class="box">Teacher 1</div>
      <div class="box">Teacher 2</div>
      <div class="box">Teacher 3</div>
      <div class="box">Teacher 4</div>
      <div class="box">Teacher 5</div>
      <!-- Add more teachers as needed -->
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
