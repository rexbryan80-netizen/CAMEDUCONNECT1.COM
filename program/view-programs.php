<?php
include("../model/db.php");

// DELETE PROGRAM
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM programs WHERE id='$id'");
    header("location: view-programs.php?deleted=1");
    exit;
}

// UPDATE PROGRAM
if (isset($_POST['update_program'])) {
    $id = intval($_POST['edit_id']);
    $name = $conn->real_escape_string($_POST['edit_name']);
    $description = $conn->real_escape_string($_POST['edit_description']);
    $fees = floatval($_POST['edit_fees']);
    $duration = intval($_POST['edit_duration']);
    $qualification = $conn->real_escape_string($_POST['edit_qualification']);

    $conn->query("UPDATE programs SET
                    name='$name',
                    description='$description',
                    fees='$fees',
                    duration='$duration',
                    qualification_required='$qualification'
                WHERE id='$id'");

    header("location: view-programs.php?updated=1");
    exit;
}

// FETCH ALL PROGRAMS
$programs = $conn->query("SELECT * FROM programs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Programs</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.card-program {
    border-radius: 14px;
    transition: 0.3s;
}
.card-program:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}
</style>
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Programs</h2>
        <a href="manage-programs.php" class="btn btn-primary">Add New Program</a>
    </div>

    <!-- Success Messages -->
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-danger">Program deleted successfully.</div>
    <?php endif; ?>
    <?php if (isset($_GET['updated'])): ?>
        <div class="alert alert-success">Program updated successfully.</div>
    <?php endif; ?>

    <div class="row g-4">
        <?php while ($row = $programs->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card card-program h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?= htmlspecialchars($row['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                        <ul class="list-unstyled mb-2">
                            <li><strong>Fees:</strong> <?= number_format($row['fees'], 2) ?> FCFA</li>
                            <li><strong>Duration:</strong> <?= $row['duration'] ?> year(s)</li>
                            <li><strong>Qualification:</strong> <?= htmlspecialchars($row['qualification_required']) ?></li>
                        </ul>
                        <div class="d-flex gap-2">
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm text-white flex-fill"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal<?= $row['id'] ?>">
                                Edit
                            </button>
                            <!-- Delete Button -->
                            <a href="view-programs.php?delete=<?= $row['id'] ?>"
                               onclick="return confirm('Delete this program?')"
                               class="btn btn-danger btn-sm flex-fill">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="text-white">Edit Program</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="edit_id" value="<?= $row['id'] ?>">
                            <div class="mb-2">
                                <label>Name</label>
                                <input type="text" name="edit_name" class="form-control" required value="<?= $row['name'] ?>">
                            </div>
                            <div class="mb-2">
                                <label>Description</label>
                                <textarea name="edit_description" class="form-control" required><?= $row['description'] ?></textarea>
                            </div>
                            <div class="mb-2">
                                <label>Fees (FCFA)</label>
                                <input type="number" name="edit_fees" class="form-control" required value="<?= $row['fees'] ?>">
                            </div>
                            <div class="mb-2">
                                <label>Duration (years)</label>
                                <input type="number" name="edit_duration" class="form-control" required value="<?= $row['duration'] ?>">
                            </div>
                            <div class="mb-2">
                                <label>Qualification Required</label>
                                <input type="text" name="edit_qualification" class="form-control" required value="<?= $row['qualification_required'] ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" name="update_program">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
