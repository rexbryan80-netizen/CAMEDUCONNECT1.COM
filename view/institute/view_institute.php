<?php
include '../../model/db.php';

// Handle delete action
if(isset($_GET['delete_id'])){
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM institutes WHERE id = $delete_id");
    header("Location: ".$_SERVER['PHP_SELF']); // Refresh page after deletion
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Institute List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .table-container {
        margin: 50px auto;
    }
</style>
</head>
<body>

<div class="container table-container">
    <h2 class="text-center mb-4">Institute List</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Region</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM institutes ORDER BY id DESC";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $count = 1;
            while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?= $count++; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['region']); ?></td>
                    <td><?= strlen($row['description']) > 50 ? substr($row['description'],0,50).'...' : $row['description']; ?></td>
                    <td>
                        <a href="edit-institute.php?institute_id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="?delete_id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this institute?')">Delete</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="5" class="text-center text-danger">No institutes found.</td></tr>';
        }
        ?>
        </tbody>
    </table>
    <a href="add-institute.php" class="btn btn-success">Add New Institute</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
