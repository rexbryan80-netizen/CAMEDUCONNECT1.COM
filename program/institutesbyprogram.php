<?php
// institutes_by_program.php
include("../model/db.php");

// Get the program name from URL
$program = isset($_GET['program']) ? $_GET['program'] : '';

// Protect against empty program
if (empty($program)) {
    die("No program selected.");
}

// Fetch institutes offering this program
$stmt = $conn->prepare("SELECT * FROM institutes WHERE programs_offered LIKE ?");
$like = "%$program%";
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institutes Offering <?= htmlspecialchars($program) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            background: linear-gradient(90deg, #4e73df, #1cc88a);
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Institutes Offering: <?= htmlspecialchars($program) ?></h1>
    <a href="programs.php" class="btn btn-light mt-2">Back to Programs</a>
</div>

<div class="container">
    <?php if ($result->num_rows > 0): ?>
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4>List of Institutes</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Institute Name</th>
                            <th>Region</th>
                            <th>Address</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['region']) ?></td>
                                <td><?= htmlspecialchars($row['address']) ?></td>
                                <td><?= htmlspecialchars($row['contact']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No institutes found offering <?= htmlspecialchars($program) ?>.</div>
    <?php endif; ?>
</div>

</body>
</html>
