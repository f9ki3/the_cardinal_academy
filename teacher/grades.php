<?php
// ================================
// grades.php - Editable Grades (Excel style)
// ================================
include 'session_login.php';
include '../db_connection.php';

$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id'] ?? 0;

// Get logged-in teacher info
$full_name = 'User Name';
$email = 'user@example.com';
if ($user_id > 0) {
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE user_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result_user = $stmt->get_result();
        if ($result_user && $result_user->num_rows > 0) {
            $user = $result_user->fetch_assoc();
            $full_name = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
            $email = htmlspecialchars($user['email']);
        }
        $stmt->close();
    }
}

// Fetch students & grades
$students = [];
if ($course_id > 0) {
    $stmt = $conn->prepare("
        SELECT 
            u.user_id, u.student_number, u.first_name, u.last_name, u.profile,
            cs.q1, cs.q2, cs.q3, cs.q4
        FROM course_students cs
        INNER JOIN users u ON cs.student_id = u.user_id
        WHERE cs.course_id = ?
    ");
    if ($stmt) {
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result_students = $stmt->get_result();
        while ($row = $result_students->fetch_assoc()) {
            $students[] = $row;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Grades List</title>
<?php include 'header.php'; ?>
<style>
/* Tabs */
.tabs { display: flex; gap: 30px; padding: 5px; }
.tab { padding: 8px 0; cursor: pointer; position: relative; }
.tab p, .tab a { margin: 0; font-weight: 500; color: #555; text-decoration: none; }
.tab.active p, .tab.active a { color: #000; }
.tab.active::after {
    content: ""; position: absolute; bottom: -2px; left: 0;
    width: 100%; height: 3px; background: rgb(218, 64, 64); border-radius: 2px;
}

/* Excel-style table */
.table-excel {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.table-excel th, .table-excel td {
    border: 1px solid #ccc;
    padding: 8px 12px;
    text-align: center;
}
.table-excel th {
    background-color: #f4f4f4;
    font-weight: 600;
}
/* Stripe effect */
.table-excel tr:nth-child(odd) {
    background-color: #ffffff; /* white stripe */
}
.table-excel tr:nth-child(even) {
    background-color: #f9f9f9; /* light gray stripe */
}
.table-excel input.grade-input {
    width: 100%;
    border: none;
    text-align: center;
    font-size: 0.95rem;
    background-color: transparent;
    outline: none;
}

/* Highlighted row */
.table-excel tbody tr.highlighted {
    background-color: #dc3545; /* Bootstrap danger */
    color: #fff;
    font-weight: 700;
}
.table-excel tbody tr.highlighted input.grade-input {
    color: #fff;
    font-weight: 700;
    background-color: transparent;
}

/* Rounded profile */
.rounded-circle:hover { background-color: rgb(240, 249, 255) !important; }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    // =============================
    //  FUNCTION: Sanitize Empty Inputs
    // =============================
    function fixEmpty(input) {
        let v = input.val().trim();
        if (v === "" || isNaN(v)) {
            input.val("0");
        }
    }

    // =============================
    //  AJAX UPDATE GRADE
    // =============================
    $(".grade-input").on("change", function () {
        fixEmpty($(this));

        $.post("update_grade.php", {
            student_id: $(this).data("student"),
            field: $(this).data("field"),
            value: $(this).val(),
            course_id: <?= $course_id ?>
        });
    });

    // =============================
    //  ARROW KEY MOVEMENT (robust)
    // =============================
    $(document).on("keydown", ".grade-input", function (e) {
        const $input = $(this);
        const $td = $input.closest("td");
        const $tr = $td.closest("tr");

        // use tbody rows to compute indices (ignores thead)
        const $tbody = $tr.closest("tbody");
        const $rows = $tbody.children("tr");

        const colIndex = $td.index();
        const rowIndex = $rows.index($tr); // index within tbody

        let inputEl = $input[0];
        let caretPos = inputEl.selectionStart;
        let valLen = inputEl.value.length;

        // helper: focus target cell input (if exists)
        function focusCell($row, col) {
            if (!$row || $row.length === 0) return false;
            const $cell = $row.children().eq(col);
            if ($cell.length === 0) return false;
            const $nextInput = $cell.find(".grade-input");
            if ($nextInput.length) {
                $rows.removeClass("highlighted");
                $row.addClass("highlighted");
                $nextInput.focus();
                // place caret at end
                const el = $nextInput[0];
                el.setSelectionRange(el.value.length, el.value.length);
                return true;
            }
            return false;
        }

        // LEFT
        if (e.key === "ArrowLeft") {
            // allow normal caret movement unless caret at position 0 (start)
            if (caretPos > 0) return;
            // move left to previous td that contains an input
            for (let c = colIndex - 1; c >= 0; c--) {
                if (focusCell($tr, c)) { e.preventDefault(); return; }
            }
            e.preventDefault();
        }

        // RIGHT
        else if (e.key === "ArrowRight") {
            // allow caret movement unless at end
            if (caretPos < valLen) return;
            // move right to next td that contains an input
            const lastCol = $tr.children().length - 1;
            for (let c = colIndex + 1; c <= lastCol; c++) {
                if (focusCell($tr, c)) { e.preventDefault(); return; }
            }
            e.preventDefault();
        }

        // UP
        else if (e.key === "ArrowUp") {
            // find previous row with an input in same column (if missing skip)
            for (let r = rowIndex - 1; r >= 0; r--) {
                const $targetRow = $rows.eq(r);
                if (focusCell($targetRow, colIndex)) { e.preventDefault(); return; }
                // if not found in same col, optionally try searching nearby cols:
                // (commented out — your cells for grades are consistent so usually not needed)
                // for (let c = colIndex - 1; c >= 0; c--) if (focusCell($targetRow, c)) { e.preventDefault(); return; }
            }
            e.preventDefault();
        }

        // DOWN
        else if (e.key === "ArrowDown") {
            const rowCount = $rows.length;
            for (let r = rowIndex + 1; r < rowCount; r++) {
                const $targetRow = $rows.eq(r);
                if (focusCell($targetRow, colIndex)) { e.preventDefault(); return; }
            }
            e.preventDefault();
        }

    });

    // =============================
    // REAL-TIME GWA CALCULATION
    // =============================
    function calculateRow(row) {
        let grades = [];
        row.find("input.grade-input").each(function () {
            let v = parseFloat($(this).val());
            if (!isNaN(v)) grades.push(v);
        });

        let gwaCell = row.find(".gwa-cell");
        let statusCell = row.find(".status-cell");

        if (grades.length === 0) {
            gwaCell.html("<span class='text-muted'>N/A</span>");
            statusCell.text("-");
            statusCell.removeClass("pass-status fail-status");
            return;
        }

        let avg = grades.reduce((a,b)=>a+b,0) / grades.length;
        gwaCell.text(avg.toFixed(2));

        if (avg >= 75) {
            statusCell.text("PASS").removeClass("fail-status").addClass("pass-status");
        } else {
            statusCell.text("FAIL").removeClass("pass-status").addClass("fail-status");
        }
    }

    $(".grade-input").on("input", function () {
        calculateRow($(this).closest("tr"));
    });

    $("tbody tr").each(function () { calculateRow($(this)); });

    // =============================
    // ROW FOCUS ON CLICK
    // =============================
    $(".table-excel tbody tr td").click(function () {
        let row = $(this).closest("tr");

        $(".table-excel tbody tr").removeClass("highlighted");
        row.addClass("highlighted");

        let input = $(this).find("input.grade-input");
        if (input.length) {
            input.focus();
            input[0].setSelectionRange(input.val().length, input.val().length);
        }
    });

    // =============================
    // CLICK OUTSIDE → SET EMPTY TO 0
    // =============================
    $(document).mouseup(function (e) {
        let table = $(".table-excel");

        if (!table.is(e.target) && table.has(e.target).length === 0) {
            $(".grade-input").each(function () {
                fixEmpty($(this));
            });
            $(".table-excel tbody tr").removeClass("highlighted");
        }
    });

    // =============================
    // ESC KEY
    // =============================
    $(document).on("keydown", function (e) {
        if (e.key === "Escape") {
            $(".grade-input").each(function () {
                fixEmpty($(this));
            });

            $(".table-excel tbody tr").removeClass("highlighted");
            $(".grade-input").blur();
        }
    });

    // =============================
    // BLUR FIX EMPTY
    // =============================
    $(".grade-input").on("blur", function () {
        fixEmpty($(this));
    });

});
</script>
</head>
<body>
<div class="d-flex flex-row bg-light">
<?php include 'navigation.php'; ?>
<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container my-4">
    <div class="row mb-3 border-bottom">
        <div class="col-12"><h4>Students Grades</h4></div>
    </div>

    <!-- Tabs -->
    <div class="tabs mb-4">
        <?php
        $tabs = ['Stream'=>'course.php','Attendance'=>'attendance.php','Assignment'=>'assignment.php',
                 'Students'=>'student.php','Grades'=>'grades.php','Settings'=>'settings.php'];
        foreach($tabs as $name=>$url){
            $active = ($name==='Grades')?'active':'';
            echo "<div class='tab {$active}'><a href='{$url}?id={$course_id}'>{$name}</a></div>";
        }
        ?>
    </div>

    <div class="rounded-4 p-4 text-white mb-4" style="
        background-image: url('../static/images/Front gate.jpg'); background-size: cover;
        background-position: center; position: relative; min-height: 150px;">
        <div style="position: absolute; top:0; left:0; right:0; bottom:0; background-color: rgba(0,0,0,0.5); border-radius:1rem;"></div>
        <div class="row position-relative" style="z-index:1;">
            <div class="col-12 col-md-10">
                <h1 class="fw-bolder"><?= $full_name ?></h1>
                <p><?= $email ?></p>
            </div>
            <div class="col-12 col-md-2 d-flex align-items-center justify-content-md-end mt-2 mt-md-0">
                <!-- Print Button -->
                <a href="print_grades.php?id=<?= $course_id ?>" target="_blank" class="btn btn-danger rounded-4 d-flex align-items-center">
                    <i class="bi bi-printer-fill me-2"></i> Print Grades
                </a>
            </div>
        </div>
    </div>

    <!-- Grades Table -->
    <table class="table-excel mb-4">
        <thead>
            <tr>
                <th width="15%" class="text-start">Student Number</th>
                <th width="15%" class="text-start">Student</th>
                <th width="8%">Q1</th>
                <th width="8%">Q2</th>
                <th width="8%">Q3</th>
                <th width="8%">Q4</th>
                <th width="15%">Average</th>
                <th width="15%">Status</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td class="text-start"><?= $student['student_number'] ?></td>
                <td class="text-start"><?= $student['first_name'] . ' ' . $student['last_name'] ?></td>

                <?php for ($i=1; $i<=4; $i++): ?>
                <td>
                    <input type="text"
                           class="grade-input"
                           value="<?= $student['q'.$i] ?>"
                           data-student="<?= $student['user_id'] ?>"
                           data-field="q<?= $i ?>"
                           maxlength="3"
                           oninput="this.value=this.value.replace(/[^0-9]/g,''); if(this.value>100)this.value=100;">
                </td>
                <?php endfor; ?>

                <!-- GWA + STATUS (Live JS Updated) -->
                <td class="gwa-cell">0.00</td>
                <td class="status-cell fw-bold">-</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
