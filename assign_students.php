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
                <style>
                    body{
                        font-family: Arial, sans-serif;
                        background:#f5f5f5;
                        padding:20px;
                    }
                    table{
                        width:100%;
                        border-collapse:collapse;
                        background:white;
                    }
                    th, td{
                        border:1px solid #000;
                        padding:8px;
                        vertical-align:top;
                        font-size:14px;
                    }
                    th{
                        text-align:center;
                        background:#eaeaea;
                    }
                </style>

                <table>
                    <tr>
                        <th>Week / Month</th>
                        <th>Work to be Done & Daily Progress</th>
                        <th>Report Submission Status / Remarks</th>
                        <th>Submittion</th>
                    </tr>

                    <tr>
                        <td>Week 1<br>DD MM YYYY</td>
                        <td>Topic discussion, proposal submission, topic approval by Scrum Master, abstract</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 2<br>DD MM YYYY</td>
                        <td>Topic verification by Project Assessment Board</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 3<br>DD MM YYYY</td>
                        <td>System study (requirement gathering, feasibility analysis), geotagged photos, consent letter</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 4<br>DD MM YYYY</td>
                        <td>Identifying modules, IDE & Git familiarisation, Git collaboration</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 5<br>DD MM YYYY</td>
                        <td>Project synopsis / proposal evaluation</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 5<br>DD MM YYYY</td>
                        <td>Module identification, UML diagrams, user stories, Figma design</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 6<br>DD MM YYYY</td>
                        <td>Table design, normalization, template customization</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 6<br>DD MM YYYY</td>
                        <td>UI design – login & registration pages</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 7<br>DD MM YYYY</td>
                        <td><b>Scrum Review 1</b><br>UI design completion, literature review</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 7<br>DD MM YYYY</td>
                        <td>Coding progress, meeting with Scrum Master – 20% completion</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 8<br>DD MM YYYY</td>
                        <td>Coding progress – 30% completion, review paper preparation</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>Week 9<br>DD MM YYYY</td>
                        <td><b>Scrum Review 2</b><br>Coding progress – 45% completion, review paper</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td>Coding progress – 55% completion, tool implementation, review paper</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>18–DD MM YYYY</td>
                        <td><b>Interim Project Evaluation</b><br>Literature review, implementation, Git verification, 60% completion</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td>Coding progress – 70% completion, testing, project report (soft copy)</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td><b>Scrum Review 3</b><br>75% completion, testing, report preparation</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td>85% completion, project hosting, testing</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td><b>Scrum Review 4</b><br>90% completion</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td>95% completion, hosting verification, hard copy report preparation</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td><b>Scrum Review 5</b><br>100% completion, final testing & report</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td>Guide evaluation & project presentation</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td>Final committee evaluation & presentation</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                    <tr>
                        <td>DD MM YYYY</td>
                        <td>Review paper publishing</td>
                        <td><input type="description"></td>
                        <td><button type="submit">apply</button></td>
                    </tr>

                </table>
            </p>
            <div style="text-align:center; margin-top:15px;">
                <button type="submit">Submit</button>
            </div>
        </details>
    <?php endforeach; ?>

    <br>
    <a href="index.php">Assign Next Staff</a>
</div>

</body>
</html>
