<?php
// Get user info
$user_id = $_SESSION['user_id'];

$query = "SELECT 
            first_name,
            last_name,
            email, 
            gender, 
            phone_number, 
            profile,
            birthdate,
            address, 
            authentication
          FROM users 
          WHERE user_id = ?";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("SQL Error: " . $conn->error . " | Query: " . $query);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>
<?php include 'change_pass.php'?>