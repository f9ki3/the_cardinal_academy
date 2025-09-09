<?php
include '../db_connection.php';

header('Content-Type: application/json');

$q = $_GET['q'] ?? '';
$q = "%$q%";

// Search students
$stmt = $conn->prepare("SELECT user_id, first_name, last_name, email 
                        FROM users 
                        WHERE acc_type='student' AND 
                        (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)
                        ORDER BY first_name ASC");
$stmt->bind_param("sss", $q, $q, $q);
$stmt->execute();
$result = $stmt->get_result();

$students = [];
while($row = $result->fetch_assoc()){
    $students[] = $row;
}

echo json_encode($students);
