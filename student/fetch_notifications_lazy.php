<?php
session_start();
require_once '../db_connection.php'; // use require_once for single inclusion

// Ensure connection exists and no overuse
if (!isset($conn) || $conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$user_id = $_SESSION['user_id'] ?? 0;
if ($user_id <= 0) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$offset = isset($_GET['offset']) ? max(0, intval($_GET['offset'])) : 0;
$limit = 10;

// Use SQL_CALC_FOUND_ROWS if you need to know total count (optional)
$query = "
    SELECT n.link, n.message, n.created_at, u.first_name, u.last_name
    FROM notifications n
    LEFT JOIN users u ON n.user_id = u.user_id
    WHERE n.user_id = ?
    ORDER BY n.created_at DESC
    LIMIT ?, ?
";

// ✅ MySQLi requires LIMIT parameters to be bound as integers explicitly
$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $user_id, $offset, $limit);
$stmt->execute();

$result = $stmt->get_result();
$notifications = [];

while ($row = $result->fetch_assoc()) {
    $notifications[] = [
        'link' => htmlspecialchars($row['link'] ?? '#'),
        'message' => htmlspecialchars(mb_strimwidth($row['message'] ?? '', 0, 100, "...")),
        'created_at' => date("M d, Y h:i A", strtotime($row['created_at'])),
        'teacher' => trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? '')),
    ];
}

// ✅ Return valid JSON with proper header
header('Content-Type: application/json; charset=utf-8');
echo json_encode($notifications);

// ✅ Always close statement and connection
$stmt->close();
$conn->close();
?>
