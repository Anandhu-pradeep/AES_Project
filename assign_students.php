<?php
session_start();

/* ---------- STUDENT LIST ---------- */
$batches = [
    "Batch A" => array_map(fn($i) => "A_Student_$i", range(1, 60)),
    "Batch B" => array_map(fn($i) => "B_Student_$i", range(1, 60)),
    "Batch C" => array_map(fn($i) => "C_Student_$i", range(1, 60)),
    "Batch D" => array_map(fn($i) => "D_Student_$i", range(1, 60)),
];

/* ---------- BLOCK DIRECT ACCESS ---------- */
if (!isset($_POST['batch'])) {
    header("Location: select_batch.php");
    exit;
}

$batch = $_POST['batch'];

/* ---------- SESSION INIT ---------- */
if (!isset($_SESSION['used'])) {
    $_SESSION['used'] = [];
}

if (!isset($_SESSION['used'][$batch])) {
    $_SESSION['used'][$batch] = [];
}

/* ---------- AVAILABLE STUDENTS ---------- */
$available = array_diff($batches[$batch], $_SESSION['used'][$batch]);

if (count($available) < 3) {
    die("❌ Not enough students remaining in $batch");
}

/* ---------- RANDOM PICK ---------- */
shuffle($available);
$selectedStudents = array_slice($available, 0, 3);

/* ---------- SAVE USED STUDENTS ---------- */
$_SESSION['used'][$batch] = array_merge(
    $_SESSION['used'][$batch],
    $selectedStudents
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assigned Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="top-header">AES Scrum Management</div>


<div class="container">
    <h2>Batch: <?= htmlspecialchars($batch) ?></h2>
    <h3>Assigned Students</h3>

    <?php foreach ($selectedStudents as $student): ?>
        <details>
            <summary><?= htmlspecialchars($student) ?></summary>
            <p>
                🔹 <b>Yesterday Work:</b><br>
                🔹 <b>Today Plan:</b><br>
                🔹 <b>Blockers:</b>
            </p>
        </details>
    <?php endforeach; ?>

    <br>
    <a href="index.php">Assign Next Staff</a>
</div>

</body>
</html>
