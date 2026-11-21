<?php
session_start();
include("../model/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin'){
    header("Location: ../view/login.php?error=Please login first");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle profile update
if(isset($_POST['update_profile'])){
    $full_name = $_POST['full_name'];

    $profile_image = null;
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != ''){
        $filename = time() . '_' . basename($_FILES['profile_image']['name']);
        $targetDir = "../uploads/profiles/";

        // Auto-create folder if it doesn't exist
        if(!file_exists($targetDir)){
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . $filename;
        if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)){
            $profile_image = $filename;
        }
    }

    // Update database
    if($profile_image){
        $conn->query("UPDATE admins SET full_name='$full_name', profile_image='$profile_image' WHERE id='$user_id'");
    } else {
        $conn->query("UPDATE admins SET full_name='$full_name' WHERE id='$user_id'");
    }

    $success = "Profile updated successfully!";
}

// Fetch admin info
$result = $conn->query("SELECT full_name, profile_image FROM admins WHERE id='$user_id'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f4f6f9;font-family:'Segoe UI', sans-serif;}
.profile-card{
    max-width:600px;margin:50px auto;padding:30px;background:#fff;border-radius:15px;box-shadow:0 10px 30px rgba(0,0,0,0.1);
}
.profile-image{
    width:120px;height:120px;border-radius:50%;object-fit:cover;margin-bottom:20px;border:3px solid #0072ff;
}
.btn-gradient{
    background:linear-gradient(90deg,#0072ff,#00c6ff);
    color:#fff;border:none;
    transition:0.3s;
}
.btn-gradient:hover{
    background:linear-gradient(90deg,#00c6ff,#0072ff);
}
</style>
</head>
<body>

<div class="profile-card text-center">
    <h3 class="mb-4">Your Profile</h3>

    <!-- Display profile image or default avatar -->
    <img src="<?php 
        echo (!empty($user['profile_image'])) 
             ? '../uploads/profiles/' . $user['profile_image'] 
             : 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';
    ?>" class="profile-image" alt="Profile">

    <?php if(isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="text-start mt-4">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Profile Image</label>
            <input type="file" name="profile_image" class="form-control">
            <small class="text-muted">Leave empty to keep current image</small>
        </div>
        <div class="d-grid">
            <button type="submit" name="update_profile" class="btn btn-gradient">Update Profile</button>
        </div>
    </form>
</div>

</body>
</html>