<?php
session_start();
include '../db_connection.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? 0;

if (!$user_id) {
    echo json_encode(['count' => 0, 'notifications' => []]);
    exit;
}

// ✅ Get notification count
$count_stmt = $conn->prepare("SELECT notification FROM users WHERE user_id = ?");
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_row = $count_stmt->get_result()->fetch_assoc();
$notif_count = intval($count_row['notification'] ?? 0);
$count_stmt->close(); // ✅ Close statement

// ✅ Get latest notifications
$notif_stmt = $conn->prepare("
    SELECT n.*, u.first_name, u.last_name 
    FROM notifications n
    LEFT JOIN users u ON n.user_id = u.user_id
    WHERE n.user_id = ?
    ORDER BY n.created_at DESC
    LIMIT 10
");
$notif_stmt->bind_param("i", $user_id);
$notif_stmt->execute();
$res = $notif_stmt->get_result();

$notifications = [];
while ($row = $res->fetch_assoc()) {
    $notifications[] = [
        'id' => $row['id'],
        'message' => mb_strimwidth($row['message'], 0, 100, "..."),
        'link' => $row['link'],
        'created_at' => date("M d, Y h:i A", strtotime($row['created_at']))
    ];
}
$notif_stmt->close(); // ✅ Close statement

// ✅ Close DB connection
$conn->close();

echo json_encode(['count' => $notif_count, 'notifications' => $notifications]);
?>
