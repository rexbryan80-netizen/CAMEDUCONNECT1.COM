<?php
include("../model/db.php");

// Fetch all institutes
$result = $conn->query("SELECT * FROM institutes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Institutes</title>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    min-height: 100vh;
    background: #f4f6f9;
}

/* Sidebar */
.sidebar {
    width: 240px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    background: linear-gradient(180deg,#4c6ef5,#15aabf);
    padding: 20px;
    color: #fff;
}

.sidebar h4 {
    margin-bottom: 20px;
}

.sidebar a {
    display: block;
    color: #fff;
    padding: 12px;
    margin-bottom: 6px;
    border-radius: 8px;
    text-decoration: none;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.2);
}

/* Main content */
.main-content {
    margin-left: 260px; /* Space for sidebar */
    flex: 1;
    padding: 25px;
}

/* Card styling */
.card {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.12);
}

.table img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #ddd;
}

.btn-sm {
    border-radius: 20px;
    padding: 5px 15px;
    font-weight: 500;
}

.top-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.top-buttons a {
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.top-buttons a:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

/* Responsive table scroll */
.table-responsive {
    overflow-x: auto;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="admindashboard.php">Dashboard</a>
    <a href="manage-student.php">Students</a>
    <a href="manage-expert.php">Experts</a>
    <a href="manage-institutes.php" class="fw-bold">Institutes</a>
    <a href="manage-programs.php">Programs</a>
    <a href="settings.php">Settings</a>
    <a href="../view/logout.php" class="text-danger">Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold">Manage Institutes</h2>
        <div class="top-buttons">
            <a href="../view/institute/add-institute.php" class="btn btn-primary btn-sm">➕ Add Institute</a>
            <a href="../view/institute/view_institute.php" class="btn btn-info btn-sm text-white">🌐 View Institutes</a>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Region</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td>
                            <?php if(!empty($row['image'])): ?>
                                <img src="../uploads/institutes/<?= htmlspecialchars($row['image']); ?>" alt="Logo">
                            <?php else: ?>
                                <span class="text-muted">No Logo</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['institute_name'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($row['region'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($row['email'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($row['created_at'] ?? '---'); ?></td>
                        <td>
                            <a href="../view/institute/institute-detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View</a>
                            <a href="../view/institute/edit-institute.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                            <a href="../view/institute/delete-institute.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this institute?');" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>