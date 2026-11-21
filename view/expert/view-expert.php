<?php
include("../../model/db.php"); // Adjust path if needed

// DELETE EXPERT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM experts WHERE id='$id'");
    header("Location: view-expert.php?deleted=1");
    exit;
}

// FETCH ALL EXPERTS
$experts = $conn->query("SELECT * FROM experts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Experts</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: #f7f9fc;
        font-family: 'Poppins', sans-serif;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .btn-add {
        margin-bottom: 20px;
    }

    table th, table td {
        vertical-align: middle !important;
    }

    .profile-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">All Experts</h2>

    <!-- Success Message -->
    <?php if(isset($_GET['deleted'])): ?>
        <div class="alert alert-danger text-center">Expert deleted successfully.</div>
    <?php endif; ?>

    <!-- Add New Expert Button -->
    <div class="text-end">
        <a href="add-expert.php" class="btn btn-primary btn-add">+ Add New Expert</a>
    </div>

    <!-- Experts Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Full Name</th>
                    <th>Region</th>
                    <th>Specialization</th>
                    <th>Qualification</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($experts->num_rows > 0): ?>
                    <?php $count = 1; while($row = $experts->fetch_assoc()): ?>
                        <tr>
                            <td><?= $count++; ?></td>
                            <td>
                                <?php if (!empty($row['profile_image'])): ?>
                                    <img src="../../assets/images/experts/<?= $row['profile_image'] ?>" alt="<?= $row['full_name'] ?>" class="profile-img">
                                <?php else: ?>
                                    <img src="../../assets/images/default-profile.png" alt="No Photo" class="profile-img">
                                <?php endif; ?>
                            </td>
                            <td><?= $row['full_name'] ?></td>
                            <td><?= $row['region'] ?></td>
                            <td><?= $row['specialization'] ?></td>
                            <td><?= $row['qualification'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td>
                                <a href="edit-expert.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="view-expert.php?delete=<?= $row['id'] ?>" 
                                   onclick="return confirm('Are you sure you want to delete this expert?')" 
                                   class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No experts found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
