<?php
session_start();

$batches = [
    "Batch A" => array_map(fn($i) => "A_Student_$i", range(1, 60)),
    "Batch B" => array_map(fn($i) => "B_Student_$i", range(1, 60)),
    "Batch C" => array_map(fn($i) => "C_Student_$i", range(1, 60)),
    "Batch D" => array_map(fn($i) => "D_Student_$i", range(1, 60)),
];

$selectedBatch = $_POST['batch'] ?? "";
$students = $selectedBatch ? $batches[$selectedBatch] : [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>AES Scrum Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page">

    <!-- RIGHT VERTICAL BAR -->
<div class="top-header">AES Scrum Management</div>


    <!-- MAIN CONTENT -->
    <div class="content">

        <h2>Select Batch</h2>

        <form method="post" class="batch-form">
            <select name="batch" required>
                <option value="">-- Select Batch --</option>
                <?php foreach ($batches as $b => $v): ?>
                    <option value="<?= $b ?>" <?= $b == $selectedBatch ? "selected" : "" ?>>
                        <?= $b ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Submit</button>
        </form>

        <?php if ($selectedBatch): ?>
            <h3>Students in <?= $selectedBatch ?></h3>

            <!-- STUDENT GRID -->
            <div class="student-grid">
            <?php
            $page = 1;
            $count = 0;

            foreach ($students as $student) {
                if ($count > 0 && $count % 20 == 0) {
                    $page++;
                }
                echo "<div class='student-box page-$page'>$student</div>";
                $count++;
            }
            ?>
            </div>


            <!-- PAGINATION -->
            <div class="pagination">
                <div class="pagination">
                <button type="button" onclick="showPage(1)">1</button>
                <button type="button" onclick="showPage(2)">2</button>
                <button type="button" onclick="showPage(3)">3</button>
                </div>
            </div>

            <!-- ASSIGN BUTTON -->
            <form action="assign_students.php" method="post">
                <input type="hidden" name="batch" value="<?= $selectedBatch ?>">
                <button class="assign-btn">Assign Students</button>
            </form>
        <?php endif; ?>

    </div>
</div>
<script>
    function showPage(page) {
        const allStudents = document.querySelectorAll('.student-box');
        allStudents.forEach(student => {
            student.style.display = 'none';
        });

        const visibleStudents = document.querySelectorAll('.page-' + page);
        visibleStudents.forEach(student => {
            student.style.display = 'flex';
        });
    }

    // Show first page by default
    document.addEventListener("DOMContentLoaded", function () {
        showPage(1);
    });
</script>

</body>
</html>
