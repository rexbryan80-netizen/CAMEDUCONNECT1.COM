<?php 
include '../../model/db.php';
session_start();

$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Students</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body { background: #f4f6f9; }
    .table img {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
    }
    .card { border-radius: 15px; }
    th { background: #0d6efd; color: white; }
</style>
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Student Records</h3>
        <div>
            <a href="add-student.php" class="btn btn-success">➕ Add Student</a>
        </div>
    </div>

    <!-- SUCCESS MESSAGE -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Profile</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Region</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): 
                        $imgFile = $row['profile_image'];
                        $imgPath = ($imgFile && file_exists('../../uploads/students/'.$imgFile)) 
                                   ? '../../uploads/students/'.$imgFile 
                                   : 'https://via.placeholder.com/55?text=No+Image';
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($imgPath); ?>" alt="<?= htmlspecialchars($row['full_name']); ?>"></td>
                        <td><?= htmlspecialchars($row['full_name']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['phone']); ?></td>
                        <td><?= htmlspecialchars($row['gender']); ?></td>
                        <td><?= htmlspecialchars($row['region']); ?></td>
                        <td>
                            <!-- EDIT -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id']; ?>">✏ Edit</button>
                            <!-- DELETE -->
                            <a href="student-controller.php?delete_student=<?= $row['id']; ?>" onclick="return confirm('Delete this student?');" class="btn btn-danger btn-sm">🗑 Delete</a>
                        </td>
                    </tr>

                    <!-- EDIT MODAL -->
                    <div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header bg-warning">
                            <h5 class="modal-title text-white">Edit Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <form action="student-controller.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Full Name</label>
                                        <input type="text" name="full_name" value="<?= htmlspecialchars($row['full_name']); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?= htmlspecialchars($row['email']); ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="<?= htmlspecialchars($row['phone']); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Gender</label>
                                        <select name="gender" class="form-select" required>
                                            <option value="Male" <?= $row['gender']=="Male"?"selected":"" ?>>Male</option>
                                            <option value="Female" <?= $row['gender']=="Female"?"selected":"" ?>>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Region</label>
                                    <input type="text" name="region" value="<?= htmlspecialchars($row['region']); ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Profile Image</label><br>
                                    <img src="<?= htmlspecialchars($imgPath); ?>" width="70" class="rounded mb-2">
                                    <input type="file" name="profile_image" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="update_student" class="btn btn-primary">Save Changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- END MODAL -->

                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-danger">No students found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
