<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AcadeSys</title>
  <?php include 'header.php'; ?>
</head>

<?php include 'navigation.php'; ?>
<body>
    
  <div class="container p-3 text-muted">
  <div class="">
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>The Cardinal Academy - Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body class="bg-light">

  <div class="container">
    <form action="submit_registration.php" method="POST" enctype="multipart/form-data">
  <!-- Step 1 -->
  <div class="form-box">
  <h3>Student’s Profile</h3>
  <div class="row g-3">

    <div class="col-md-6">
      <label class="text-muted">Status</label>
      <select name="status" class="form-control">
        <option value="">Select student status</option>
        <option>Old Student</option>
        <option>New Student</option>
      </select>
    </div>


    <div class="col-md-6">
      <label class="text-muted">Learner Reference Number (LRN)</label>
      <input type="text" name="lrn" placeholder="Enter LRN" class="form-control">
    </div>

    <div class="col-md-6">
      <label class="text-muted">Grade Level</label>
      <select name="grade_level" class="form-control">
        <option value="">Select grade level</option>
        <option>Kinder Garten</option>
        <option>Grade 1</option>
        <option>Grade 2</option>
        <option>Grade 3</option>
        <option>Grade 4</option>
        <option>Grade 5</option>
        <option>Grade 6</option>
        <option>Grade 7</option>
        <option>Grade 8</option>
        <option>Grade 9</option>
        <option>Grade 10</option>
        <option>Grade 11</option>
        <option>Grade 12</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="text-muted">Gender</label>
      <select name="gender" class="form-control">
        <option value="">Select gender</option>
        <option>Male</option>
        <option>Female</option>
      </select>
    </div>
    <div class="col-md-12">
      <label class="text-muted">Attach Formal Photo</label>
      <input type="file" name="photo" class="form-control">
    </div>

    <div class="col-md-4">
      <label class="text-muted">Last Name</label>
      <input type="text" name="last_name" placeholder="Enter last name" class="form-control">
    </div>

    <div class="col-md-4">
      <label class="text-muted">First Name</label>
      <input type="text" name="first_name" placeholder="Enter first name" class="form-control">
    </div>

    <div class="col-md-4">
      <label class="text-muted">Middle Name</label>
      <input type="text" name="middle_name" placeholder="Enter middle name" class="form-control">
    </div>

    <div class="col-md-6">
      <label class="text-muted">Date of Birth</label>
      <input type="text" name="birth_date" placeholder="Enter date of birth" class="form-control">
    </div>

    <div class="col-md-6">
      <label class="text-muted">Place of Birth</label>
      <input type="text" name="birth_place" placeholder="Enter place of birth" class="form-control">
    </div>

    <div class="col-md-4">
      <label class="text-muted">Age</label>
      <input type="text" name="age" placeholder="Enter age" class="form-control">
    </div>

    <div class="col-md-4">
      <label class="text-muted">Religion</label>
      <input type="text" name="religion" placeholder="Enter religion" class="form-control">
    </div>

    <div class="col-md-4">
      <label class="text-muted">Facebook Account</label>
      <input type="text" name="facebook" placeholder="Enter Facebook account" class="form-control">
    </div>

    <div class="col-md-3">
      <label class="text-muted">Region</label>
      <select name="Region" class="form-control">
        <option value="">Select region</option>
        <option></option>
        <option></option>
      </select>
    </div>

    <div class="col-md-3">
      <label class="text-muted">Province</label>
      <select name="Province" class="form-control">
        <option value="">Select province</option>
        <option></option>
        <option></option>
      </select>
    </div>

    <div class="col-md-3">
      <label class="text-muted">City</label>
      <select name="City" class="form-control">
        <option value="">Select city</option>
        <option></option>
        <option></option>
      </select>
    </div>

    <div class="col-md-3">
      <label class="text-muted">Barangay</label>
      <select name="Barangay" class="form-control">
        <option value="">Select barangay</option>
        <option></option>
        <option></option>
      </select>
    </div>

    <div class="col-12 col-md-2">
      <button class="btn bg-main text-light mt-3 rounded rounded-4" type="button" onclick="validateStep1()">Next</button>
    </div>
    
  </div>
</div>

<!-- Step 2 -->
<div class="form-box mt-4">
  <h3>Guardian Profile</h3>
  <div class="row g-3">

    <!-- Father Info -->
    <div class="col-md-4">
      <label class="text-muted">Father’s Name</label>
      <input type="text" name="father_name" placeholder="Enter father's name" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="text-muted">Father’s Occupation</label>
      <input type="text" name="father_occupation" placeholder="Enter occupation" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="text-muted">Father’s Contact Number</label>
      <input type="text" name="father_contact" placeholder="Enter contact number" class="form-control">
    </div>

    <!-- Mother Info -->
    <div class="col-md-4">
      <label class="text-muted">Mother’s Name</label>
      <input type="text" name="mother_name" placeholder="Enter mother's name" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="text-muted">Mother’s Occupation</label>
      <input type="text" name="mother_occupation" placeholder="Enter occupation" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="text-muted">Mother’s Contact Number</label>
      <input type="text" name="mother_contact" placeholder="Enter contact number" class="form-control">
    </div>

    <!-- Guardian Info (optional) -->
    <div class="col-md-4">
      <label class="text-muted">Guardian’s Name (optional)</label>
      <input type="text" name="guardian_name" placeholder="Enter guardian's name" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="text-muted">Guardian’s Occupation</label>
      <input type="text" name="guardian_occupation" placeholder="Enter occupation" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="text-muted">Guardian’s Contact Number</label>
      <input type="text" name="guardian_contact" placeholder="Enter contact number" class="form-control">
    </div>

    <div class="col-12">
      <button class="btn bg-main text-light rounded-4 mt-3" type="button" onclick="validateStep2()">Next</button>
    </div>
  </div>
</div>

  <!-- Step 3 -->
  <!-- <div class="form-box tab-content">
    <h2>Step 3</h2>
    <h3>Declaration</h3>
    <p style="text-align:left; font-size: 15px; line-height: 1.6;">
      As a <strong>student of The Cardinal Academy</strong>, I hereby affirm my commitment to abide by all the rules...<br><br>
      As the <strong>parent/guardian of the above-named student</strong>, I acknowledge and support the rules...
    </p>
    <div class="checkbox-group">
      <label><input type="checkbox" id="chk1" name="declaration_1" required> We commit to respecting...</label><br>
      <label><input type="checkbox" id="chk2" name="declaration_2" required> We accept full responsibility...</label>
    </div>
    <button class="button" type="submit" onclick="return validateDeclaration()">Proceed</button>
  </div> -->
</form>

  </div>
</div>


  <?php include 'footer.php'; ?>
</body>
</html>
