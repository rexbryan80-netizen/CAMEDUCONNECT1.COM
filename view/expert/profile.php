<?php
session_start();
include '../../model/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'expert'){
    header("Location: ../login.php?error=Please login first");
    exit();
}

$expert_id = $_SESSION['user_id'];
$expert = $conn->query("SELECT * FROM experts WHERE id='$expert_id'")->fetch_assoc();

// Handle form submission
$success = $error = '';
if(isset($_POST['updateProfile'])){
    
    $full_name = $conn->real_escape_string($_POST['full_name']);
    
    // Handle profile image
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error']==0){
        $uploadDir = "../../uploads/profiles/";
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true); // auto-create folder
        $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $newFile = $expert_id.'.'.$ext;
        if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir.$newFile)){
            $profile_image = $conn->real_escape_string($newFile);
            $conn->query("UPDATE experts SET profile_image='$profile_image' WHERE id='$expert_id'");
        } else {
            $error .= "Failed to upload image. ";
        }
    }

    // Update name
    if($conn->query("UPDATE experts SET full_name='$full_name' WHERE id='$expert_id'")){
        $_SESSION['user_name'] = $full_name; // update session
        $success = "Profile updated successfully.";
        // Refresh expert info
        $expert = $conn->query("SELECT * FROM experts WHERE id='$expert_id'")->fetch_assoc();
    } else {
        $error .= "Failed to update profile.";
    }
}

// Profile image fallback
$profile_image_path = (!empty($expert['profile_image']) && file_exists("../../uploads/profiles/".$expert['profile_image']))
    ? "../../uploads/profiles/".$expert['profile_image']
    : "../../assets/profile-icon.png";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Settings</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{font-family:'Segoe UI',sans-serif; background:#f4f6f9; padding:30px;}
.card{max-width:500px;margin:auto;padding:20px;border-radius:15px;box-shadow:0 5px 20px rgba(0,0,0,0.1);}
.profile-img{width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:15px;}
</style>
</head>
<body>

<div class="card text-center">
    
    <?php if($success) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <img src="<?= $profile_image_path ?>" class="profile-img" alt="Profile Image">

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3 text-start">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($expert['full_name']) ?>" required>
        </div>
        <div class="mb-3 text-start">
            <label>Profile Picture</label>
            <input type="file" name="profile_image" class="form-control">
        </div>
        <button type="submit" name="updateProfile" class="btn btn-primary w-100">Update Profile</button>
    </form>
</div>

</body>
</html>