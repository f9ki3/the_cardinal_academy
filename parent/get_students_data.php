<?php
include 'session_login.php';
include '../db_connection.php';

header('Content-Type: application/json');

$parent_id = $_SESSION['user_id'] ?? 0;
$response = [];

if ($parent_id) {
    // 🧠 Get all linked students for this parent
    $query = "
        SELECT 
            pl.*, 
            u.student_number,
            u.first_name,
            u.last_name,
            u.birthdate,
            u.gender,
            u.phone_number,
            u.email
        FROM parent_link AS pl
        INNER JOIN users AS u ON pl.student_id = u.user_id
        WHERE pl.parent_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
        $row['full_name'] = $row['first_name'] . ' ' . $row['last_name'];

        // 🧠 Fetch courses and count posts, assignments, submitted assignments
        $courseQuery = "
            SELECT 
                c.id AS course_id,
                c.course_name,
                COUNT(DISTINCT p.id) AS post_count,
                COUNT(DISTINCT asg.assignment_id) AS assignment_count,
                COUNT(DISTINCT sub.submission_id) AS submitted_assignment_count
            FROM course_students cs
            INNER JOIN courses c ON cs.course_id = c.id
            LEFT JOIN posts p 
                ON p.course_id = c.id
            LEFT JOIN assignments asg
                ON asg.course_id = c.id
            LEFT JOIN assignment_submissions sub
                ON sub.assignment_id = asg.assignment_id AND sub.student_id = cs.student_id
            WHERE cs.student_id = ?
            GROUP BY c.id, c.course_name
        ";

        $courseStmt = $conn->prepare($courseQuery);
        $courseStmt->bind_param("i", $student_id);
        $courseStmt->execute();
        $courseResult = $courseStmt->get_result();

        $courses = [];
        while ($courseRow = $courseResult->fetch_assoc()) {
            $courses[] = [
                'course_id' => $courseRow['course_id'],
                'course_name' => $courseRow['course_name'],
                'post_count' => (int)$courseRow['post_count'],
                'assignment_count' => (int)$courseRow['assignment_count'],
                'submitted_assignment_count' => (int)$courseRow['submitted_assignment_count']
            ];
        }

        $row['courses'] = $courses;
        $data[] = $row;

        $courseStmt->close();
    }

    if (!empty($data)) {
        $response = [
            'status' => 'success',
            'count' => count($data),
            'data' => $data
        ];
    } else {
        $response = [
            'status' => 'empty',
            'message' => 'No linked students found for this parent.'
        ];
    }

    $stmt->close();
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid or missing parent ID.'
    ];
}

$conn->close();

echo json_encode($response, JSON_PRETTY_PRINT);
?>
