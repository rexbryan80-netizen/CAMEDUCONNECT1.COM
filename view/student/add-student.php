<?php
session_start();
include '../../model/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Student</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f0f2f5;
    font-family: 'Segoe UI', sans-serif;
}

/* Card */
.card {
    max-width: 500px;
    margin: 60px auto;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    background: #fff;
    padding: 20px;
}

/* Card header */
.card h4 {
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
    color: #007bff;
}

/* Form labels */
.form-label {
    font-weight: 500;
}

/* Smaller inputs */
.form-control, .form-select {
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.95rem;
}

/* Submit button */
.btn-submit {
    border-radius: 6px;
    font-size: 1rem;
    padding: 10px;
}

/* Responsive two-column layout */
@media(min-width: 576px){
    .row-cols-2 {
        display: flex;
        gap: 15px;
    }
    .row-cols-2 > .col {
        flex: 1;
    }
}
</style>
</head>
<body>

<div class="card">
    <h4>Add New Student</h4>

    <!-- Success message -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="student-controller.php" method="POST" enctype="multipart/form-data">

        <!-- Full Name -->
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" placeholder="John Doe" required>
        </div>

        <!-- Email & Phone in one row -->
        <div class="row row-cols-2 mb-3">
            <div class="col">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
            </div>
            <div class="col">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="+237 6XXXXXXXX" required>
            </div>
        </div>

        <!-- Gender & Region in one row -->
        <div class="row row-cols-2 mb-3">
            <div class="col">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="col">
                <label class="form-label">Region</label>
                <select name="region" class="form-select" required>
                    <option value="" disabled selected>Select Region</option>
                    <option>North West</option>
                    <option>South West</option>
                    <option>Centre</option>
                    <option>Littoral</option>
                    <option>East</option>
                    <option>West</option>
                    <option>North</option>
                    <option>Far North</option>
                    <option>Adamawa</option>
                    <option>South</option>
                </select>
            </div>
        </div>

        <!-- Profile Image -->
        <div class="mb-3">
            <label class="form-label">Profile Image</label>
            <input type="file" name="profile_image" class="form-control" accept="image/*">
        </div>

        <button type="submit" name="add_student" class="btn btn-primary w-100 btn-submit">Add Student</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>