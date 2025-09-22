<?php
// submit_assignment.php
session_start();
require_once "../db_connection.php"; // DB connection file

// Example: student_id stored in session after login
$student_id = $_SESSION['user_id'] ?? null;

if (!$student_id) {
    die("Unauthorized access.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $assignment_id   = $_POST['assignment_id'] ?? null;
    $course_id   = $_POST['course_id'] ?? null;
    $submissionType  = $_POST['submissionType'] ?? "file";

    $file_path = null;
    $file_url  = null;

    // === Handle Multiple File Upload ===
    if ($submissionType === "file" && isset($_FILES['fileInput'])) {
        $uploadDir = __DIR__ . "/../static/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $uploadedFiles = [];

        foreach ($_FILES['fileInput']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['fileInput']['error'][$key] === UPLOAD_ERR_OK) {
                $fileName   = time() . "_" . basename($_FILES['fileInput']['name'][$key]);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $targetFile)) {
                    // Save relative path for display (without "../")
                    $uploadedFiles[] = $fileName;
                }
            }
        }

        if (!empty($uploadedFiles)) {
            // Store multiple file paths as JSON string
            $file_path = json_encode($uploadedFiles);
        }
    }

    // === Handle URL Submission ===
    if ($submissionType === "url" && !empty($_POST['urlInput'])) {
        $file_url = trim($_POST['urlInput']);
    }

    // === Prepare submission data ===
    $submissionData = [
        "submission_id"   => rand(1000, 9999), // dummy ID since DB insert is commented
        "student_id"      => $student_id,
        "assignment_id"   => $assignment_id,
        "submission_date" => date("Y-m-d H:i:s"),
        "file_path"       => $file_path,
        "file_url"        => $file_url,
        "grade"           => null,
        "feedback"        => null
    ];

    // // === Echo Data for Debugging ===
    // echo "<h3>Submission Data (PHP Array)</h3>";
    // echo "<pre>";
    // print_r($submissionData);
    // echo "</pre>";

    // echo "<h3>Submission Data (JSON Preview)</h3>";
    // echo "<pre>";
    // echo json_encode($submissionData, JSON_PRETTY_PRINT);
    // echo "</pre>";

    // === Insert into DB (commented for now) ===
    $sql = "INSERT INTO assignment_submissions 
            (student_id, assignment_id, submission_date, file_path, file_url, grade, feedback) 
            VALUES (?, ?, NOW(), ?, ?, NULL, NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $student_id, $assignment_id, $file_path, $file_url);

    if ($stmt->execute()) {
        header("Location: view_assignment.php?course_id=" . "$course_id . &id=" . $assignment_id . "&success=1");
        exit;
    } else {
        die("Database error: " . $stmt->error);
    }

}
?>
