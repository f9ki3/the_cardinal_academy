<?php
include 'session_login.php';
include '../db_connection.php';

// Function to generate a random password
function generateRandomPassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
    return substr(str_shuffle($chars), 0, $length);
}

// Function to generate a unique username
function generateUniqueUsername($conn, $first_name, $last_name) {
    $base_username = strtolower($first_name . '.' . $last_name . '.student');
    $username = $base_username;
    $i = 1;

    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    while (true) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        if ($count == 0) {
            break;
        }
        $username = $base_username . $i;
        $i++;
    }
    $stmt->close();
    return $username;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acc_type     = 'student';
    $email        = $_POST['email'];
    $rfid         = $_POST['rfid'];
    $first_name   = trim($_POST['first_name']);
    $last_name    = trim($_POST['last_name']);
    $gender       = $_POST['gender'] ?? '';
    $birthdate    = $_POST['birthdate'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $address      = $_POST['address'] ?? '';

    // Check if RFID already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE rfid = ?");
    $stmt->bind_param("s", $rfid);
    $stmt->execute();
    $stmt->bind_result($rfid_count);
    $stmt->fetch();
    $stmt->close();

    if ($rfid_count > 0) {
        echo "<div class='alert alert-danger text-center mt-5'>Error: RFID already exists!</div>";
        exit;
    }

    // Generate unique username
    $username = generateUniqueUsername($conn, $first_name, $last_name);
    $password = generateRandomPassword();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle profile picture
    $profile_path = "uploads/dummy.jpg"; // default
    if (!empty($_FILES['profile']['name'])) {
        $target_dir = "../static/uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $filename = uniqid() . "_" . basename($_FILES['profile']['name']);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types) && move_uploaded_file($_FILES['profile']['tmp_name'], $target_file)) {
            $profile_path = "uploads/" . $filename;
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users 
        (acc_type, email, username, password, first_name, last_name, gender, birthdate, phone_number, address, rfid, profile) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssssssssss",
        $acc_type,
        $email,
        $username,
        $hashed_password,
        $first_name,
        $last_name,
        $gender,
        $birthdate,
        $phone_number,
        $address,
        $rfid,
        $profile_path
    );

    if ($stmt->execute()) {
        // Confirmation page (your previous layout)
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Student Account Created</title>
            <?php include 'header.php'; ?>
        </head>
        <body class="bg-light">
        <div class="d-flex flex-row">
            <?php include 'navigation.php'; ?>
            <div class="content flex-grow-1">
                <?php include 'nav_top.php'; ?>
                <div class="container py-4">
                    <div class="card mt-5 shadow-sm border-0 rounded-3 mx-auto" style="max-width: 500px;">
                        <div class="card-body text-center p-4">
                            <h3 class="card-title text-success mb-3">
                                <i class="bi bi-check-circle-fill"></i> Student Account Created!
                            </h3>
                            <p class="text-muted mb-4">
                                The student account has been successfully created. You can copy the credentials below:
                            </p>

                            <div class="mb-3 text-start">
                                <label class="form-label fw-bold text-muted">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control text-muted" id="emailField" value="<?= htmlspecialchars($email) ?>" readonly>
                                    <button class="btn border" type="button" onclick="copyToClipboard('emailField')">
                                        <i class="bi bi-clipboard"></i> Copy
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3 text-start">
                                <label class="form-label fw-bold text-muted">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control text-muted" id="usernameField" value="<?= htmlspecialchars($username) ?>" readonly>
                                    <button class="btn border" type="button" onclick="copyToClipboard('usernameField')">
                                        <i class="bi bi-clipboard"></i> Copy
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4 text-start">
                                <label class="form-label fw-bold text-muted">Password</label>
                                <div class="input-group">
                                    <input type="text" class="form-control text-muted" id="passwordField" value="<?= htmlspecialchars($password) ?>" readonly>
                                    <button class="btn border" type="button" onclick="copyToClipboard('passwordField')">
                                        <i class="bi bi-clipboard"></i> Copy
                                    </button>
                                </div>
                            </div>

                            <a href="students.php" class="btn btn-danger btn-lg w-100">
                                <i class="bi bi-arrow-left-circle"></i> Back to Student List
                            </a>
                        </div>
                    </div>

                    <script>
                    function copyToClipboard(fieldId) {
                        const copyText = document.getElementById(fieldId);
                        copyText.select();
                        copyText.setSelectionRange(0, 99999);
                        navigator.clipboard.writeText(copyText.value).then(() => {
                            const label = fieldId === 'emailField' ? 'Email' : fieldId === 'usernameField' ? 'Username' : 'Password';
                            alert(label + ' copied to clipboard!');
                        });
                    }
                    </script>

                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
        </body>
        </html>
        <?php
    } else {
        echo "<div class='alert alert-danger text-center mt-5'>Error: " . htmlspecialchars($stmt->error) . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
