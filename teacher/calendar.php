<?php 
include 'session_login.php'; 
include '../db_connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Teaching Schedule</title>
<?php include 'header.php' ?>
<style>
    .calendar {
        display: grid;
        grid-template-columns: 80px repeat(7, 1fr);
        border: 1px solid #ddd;
    }
    .calendar div {
        border: 1px solid #ddd;
        padding: 5px;
        min-height: 60px;
        font-size: 14px;
        position: relative;
    }
    .calendar .header {
        background-color: #f8f9fa;
        font-weight: bold;
        text-align: center;
    }
    .course-block {
        color: white;
        border-radius: 6px;
        padding: 5px;
        font-size: 13px;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .course-block:hover {
        transform: scale(1.05);
    }
</style>
</head>
<body>
<div class="d-flex flex-row bg-light">
    <?php include 'navigation.php' ?>
    <div class="content flex-grow-1">
        <?php include 'nav_top.php' ?>

        <div class="container my-4">
            <h4>Weekly Teaching Schedule</h4>
            <div class="calendar mt-3">
                <!-- Empty top-left corner -->
                <div class="header"></div>

                <!-- Day Headers -->
                <?php
                $days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
                foreach ($days as $day) {
                    echo "<div class='header'>$day</div>";
                }

                // Time slots (7 AM to 8 PM)
                $start_hour = 4;
                $end_hour = 24;
                for ($hour = $start_hour; $hour <= $end_hour; $hour++) {
                    // Convert to 12-hour format
                    $ampm = $hour >= 12 ? 'PM' : 'AM';
                    $displayHour = $hour % 12;
                    if ($displayHour == 0) $displayHour = 12;
                    $time_label = $displayHour . ":00 " . $ampm;

                    // Time column
                    echo "<div class='header'>$time_label</div>";

                    // Empty slots for each day
                    foreach ($days as $day) {
                        echo "<div class='time-slot' data-day='$day' data-hour='$hour'></div>";
                    }
                }

                // Fetch active courses for this teacher
                $teacher_id = $_SESSION['user_id'];
                $stmt = $conn->prepare("SELECT * FROM courses WHERE teacher_id = ? AND status='active'");
                $stmt->bind_param("i", $teacher_id);
                $stmt->execute();
                $result = $stmt->get_result();

                $courses = [];
                while ($row = $result->fetch_assoc()) {
                    $courses[] = $row;
                }
                $stmt->close();
                ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const courses = <?php echo json_encode($courses); ?>;
    const days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];

    // Predefined colors
    const colors = ["#dc3545", "#198754", "#0d6efd", "#fd7e14", "#6f42c1", "#20c997", "#ffc107", "#0dcaf0"];
    
    // Assign a unique color per course
    const courseColors = {};
    let colorIndex = 0;

    courses.forEach(course => {
        const startHour = parseInt(course.start_time.split(':')[0]);
        const endHour = parseInt(course.end_time.split(':')[0]);

        // Determine which days to fill
        let courseDays = [];
        if (course.day.toLowerCase() === "everyday") {
            courseDays = days; // all days
        } else {
            courseDays = [course.day];
        }

        // Assign color if not already assigned
        if (!courseColors[course.course_name]) {
            courseColors[course.course_name] = colors[colorIndex % colors.length];
            colorIndex++;
        }

        // Fill the slots for each day
        courseDays.forEach(day => {
            for (let h = startHour; h < endHour; h++) {
                const slot = document.querySelector(`.time-slot[data-day='${day}'][data-hour='${h}']`);
                if (slot) {
                    const block = document.createElement('div');
                    block.className = 'course-block';
                    block.style.backgroundColor = courseColors[course.course_name];
                    block.innerHTML = `
                        <strong>${course.course_name}</strong><br>
                        ${course.subject}<br>
                        ${course.section}
                    `;
                    block.onclick = () => window.location.href = `course.php?id=${course.id}`;
                    slot.appendChild(block);
                }
            }
        });
    });
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>
