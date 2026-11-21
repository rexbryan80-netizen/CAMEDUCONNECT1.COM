<?php
include '../model/db.php';

if (!isset($_GET['institute_id'])) {
    echo "<p class='text-danger text-center mt-5'>No institute selected.</p>";
    exit;
}

$institute_id = intval($_GET['institute_id']);

// Fetch institute details
$inst_sql = "SELECT * FROM institutes WHERE id=$institute_id";
$inst_res = $conn->query($inst_sql);
$institute = $inst_res->fetch_assoc();

if (!$institute) {
    echo "<p class='text-danger text-center mt-5'>Institute not found.</p>";
    exit;
}

// Fetch programs for this institute
$sql = "SELECT * FROM programs WHERE institute_id=$institute_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($institute['name']); ?> - Programs</title>
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
        border-radius: 20px;
        background: #007bff; /* Blue card */
        color: #fff;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%; /* Full height for consistent square shape */
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
        <h2 class="fw-bold"><?= htmlspecialchars($institute['name']); ?></h2>
        <p class="text-muted"><strong>Region:</strong> <?= htmlspecialchars($institute['region']); ?></p>
    </div>

    <div class="row g-4">
        <?php
        if ($result->num_rows > 0) {
            while($prog = $result->fetch_assoc()) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 program-col d-flex">
                    <div class="card program-card shadow-lg flex-fill">
                        <h5 class="card-title"><?= htmlspecialchars($prog['name']); ?></h5>
                        <p><strong>Fees:</strong> <?= number_format($prog['fees']); ?> FCFA</p>
                        <p><strong>Duration:</strong> <?= htmlspecialchars($prog['duration']); ?> year(s)</p>
                        <p><strong>Qualification Required:</strong> <?= htmlspecialchars($prog['qualification_required']); ?></p>
                        <p class="text-light"><?= htmlspecialchars($prog['description']); ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p class="text-center text-muted">No programs available for this institute.</p>';
        }
        ?>
    </div>

    <div class="text-center back-btn">
        <a href="../institute/institute.php" class="btn btn-secondary btn-lg">← Back to Institutes</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
