<?php
include("../model/db.php");

// Fetch all institutes for dropdown
$institutes = $conn->query("SELECT id, name FROM institutes ORDER BY name ASC");

// Handle form submission
if (isset($_POST['add_program'])) {
    $institute_id = $_POST['institute_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $fees = $_POST['fees'] ?? 0;
    $duration = $_POST['duration'] ?? 0;
    $qualification_required = $_POST['qualification_required'] ?? '';

    // Validate required fields
    if ($institute_id && $name && $description) {
        $stmt = $conn->prepare("INSERT INTO programs (institute_id, name, description, fees, duration, qualification_required) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdis", $institute_id, $name, $description, $fees, $duration, $qualification_required);
        $stmt->execute();
        $stmt->close();

        $success = "Program added successfully!";
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Program</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Add New Program</h4>
        </div>
        <div class="card-body">

            <!-- Success/Error Messages -->
            <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
            <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <!-- Program Form -->
            <form method="POST" class="row g-3">
                
                <div class="col-md-6">
                    <label class="form-label">Institute <span class="text-danger">*</span></label>
                    <select name="institute_id" class="form-select" required>
                        <option value="">Select Institute</option>
                        <?php while($row = $institutes->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Program Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Enter program name" required>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Describe the program" required></textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Fees (FCFA)</label>
                    <input type="number" name="fees" class="form-control" placeholder="e.g., 50000">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Duration (Years)</label>
                    <input type="number" name="duration" class="form-control" placeholder="e.g., 3">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Qualification Required</label>
                    <input type="text" name="qualification_required" class="form-control" placeholder="e.g., High School Diploma">
                </div>

                <div class="col-md-12">
                    <button type="submit" name="add_program" class="btn btn-success">Add Program</button>
                    <a href="view-programs.php" class="btn btn-secondary">View Programs</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
