<?php
include("../../model/db.php");

// Get institute ID from GET
$institute_id = $_GET['id'] ?? 0;

// Fetch institute info
$institute_query = $conn->query("SELECT * FROM institutes WHERE id='$institute_id'");
$institute = $institute_query->fetch_assoc();

// Fetch programs for this institute
$programs_query = $conn->query("SELECT * FROM programs WHERE institute_id='$institute_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($institute['name'] ?? 'Institute') ?> - Programs</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f0f4f8;
    font-family: 'Poppins', sans-serif;
}

.institute-header {
    text-align: center;
    margin-bottom: 40px;
}

.program-card {
    background: #007bff; /* Blue background */
    color: #fff;
    border-radius: 20px;
    padding: 20px;
    height: 100%; /* Make cards square in row */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.3s, box-shadow 0.3s;
}

.program-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
}

.program-card h5 {
    color: #fff;
    font-weight: 600;
    margin-bottom: 15px;
}

.program-card p {
    font-size: 0.95rem;
    margin-bottom: 10px;
    color: #f8f9fa;
}

.back-btn {
    display: inline-block;
    margin-top: 30px;
}

@media(min-width: 992px) {
    .program-col {
        flex: 0 0 33.3333%;
        max-width: 33.3333%;
    }
}
@media(max-width: 991px) {
    .program-col {
        flex: 0 0 50%;
        max-width: 50%;
    }
}
@media(max-width: 768px) {
    .program-col {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
</head>
<body>

<div class="container py-5">
    <div class="institute-header">
        <h2 class="fw-bold"><?= htmlspecialchars($institute['name'] ?? 'Institute Not Found') ?></h2>
        <p class="text-muted"><strong>Region:</strong> <?= htmlspecialchars($institute['region'] ?? 'N/A') ?></p>
        <p class="text-muted"><strong>Qualifications Offered:</strong> Diploma, HND</p>
    </div>

    <div class="row g-4">
        <?php if($programs_query->num_rows > 0): ?>
            <?php while($program = $programs_query->fetch_assoc()): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 program-col d-flex">
                    <div class="program-card shadow-lg flex-fill">
                        <h5><?= htmlspecialchars($program['name'] ?? 'N/A') ?></h5>
                        <p><?= htmlspecialchars($program['description'] ?? 'No description') ?></p>
                        <p><strong>Fees:</strong> <?= isset($program['fees']) ? number_format($program['fees']) . " FCFA" : "N/A" ?></p>
                        <p><strong>Duration:</strong> <?= isset($program['duration']) ? $program['duration'] . " year(s)" : "N/A" ?></p>
                        <p><strong>Qualification Required:</strong> <?= htmlspecialchars($program['qualification_required'] ?? 'N/A') ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No programs available for this institute.</p>
        <?php endif; ?>
    </div>

    <div class="text-center back-btn">
        <a href="institute.php" class="btn btn-secondary btn-lg">← Back to Institutes</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
