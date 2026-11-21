<?php
include '../../model/db.php';
session_start();

// Get institute ID
if (!isset($_GET['id'])) {
    die("Institute ID not provided.");
}

$id = $_GET['id'];

// Fetch current institute data
$sql  = "SELECT * FROM institutes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$institute = $result->fetch_assoc();

if (!$institute) {
    die("Institute not found.");
}

// Handle Update Form
if (isset($_POST['update_institute'])) {
    $name        = $_POST['name'];
    $email       = $_POST['email'];
    $phone       = $_POST['phone'];
    $description = $_POST['description'];
    $address     = $_POST['address'];

    // Handle image upload
    $image = $institute['image']; // default existing image

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];
        $uploadPath = "../../uploads/institutes/" . $imageName;

        // Move file to folder
        if (move_uploaded_file($imageTmp, $uploadPath)) {
            $image = $imageName;
        }
    }

    // Update database
    $update = "UPDATE institutes SET name=?, email=?, phone=?, description=?, address=?, image=? WHERE id=?";
    $stmt2 = $conn->prepare($update);
    $stmt2->bind_param("ssssssi", $name, $email, $phone, $description, $address, $image, $id);

    if ($stmt2->execute()) {
        echo "<script>alert('Institute updated successfully!'); 
        window.location.href='view_institutes.php';
        </script>";
    } else {
        echo "<script>alert('Failed to update institute');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Institute</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
        background:#f1f2f6;
    }
    .form-container{
        background:#fff;
        padding:30px;
        border-radius:15px;
        box-shadow:0 4px 15px rgba(0,0,0,0.1);
        margin-top:40px;
    }
    .profile-img{
        width:150px;
        height:150px;
        border-radius:10px;
        object-fit:cover;
        border:3px solid #ddd;
    }
</style>

</head>
<body>

<div class="container col-md-7 form-container">

    <h3 class="text-center mb-4 fw-bold">Edit Institute</h3>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label fw-bold">Institute Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $institute['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $institute['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Phone</label>
            <input type="text" class="form-control" name="phone" value="<?php echo $institute['phone']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $institute['address']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea class="form-control" name="description" rows="4"><?php echo $institute['description']; ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold d-block">Current Image</label>
            <img src="../../uploads/institutes/<?php echo $institute['image']; ?>" class="profile-img mb-2">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Change Image (optional)</label>
            <input type="file" class="form-control" name="image">
        </div>

        <button type="submit" name="update_institute" class="btn btn-primary w-100 py-2 fw-bold">
            Update Institute
        </button>

    </form>

</div>

</body>
</html>
