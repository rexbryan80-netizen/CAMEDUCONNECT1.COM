<?php
include("../model/db.php");
session_start();

// Image upload helper
function uploadImage($file, $folder) {
    if (!empty($file['name'])) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $filename = time() . '_' . uniqid() . '.' . $ext;
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/CAMEDUCONNECT/uploads/$folder/";

            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            $path = $uploadDir . $filename;
            if (move_uploaded_file($file['tmp_name'], $path)) return $filename;
        }
    }
    return "assets/images/default-student.png";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['fullname']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $gender    = $_POST['gender'];
    $region    = trim($_POST['region']);
    $password_raw = trim($_POST['password']);
    $role = 3; // numeric student role

    if(strlen($password_raw) < 8){
        header("Location: register.php?error=Password must be at least 8 characters");
        exit();
    }

    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // Check duplicate email
    $emailCheck = $conn->real_escape_string($email);
    $result = $conn->query("SELECT id FROM students WHERE email='$emailCheck'");
    if($result->num_rows > 0){
        header("Location: register.php?error=Email already registered");
        exit();
    }

    // Profile image
    $image = uploadImage($_FILES['profile_image'], "students");

    // Insert using direct query (safe because we escaped)
    $full_name = $conn->real_escape_string($full_name);
    $phone     = $conn->real_escape_string($phone);
    $gender    = $conn->real_escape_string($gender);
    $region    = $conn->real_escape_string($region);
    $image     = $conn->real_escape_string($image);

    $sql = "INSERT INTO students (full_name,email,phone,password,role,gender,region,profile_image,created_at)
            VALUES ('$full_name','$email','$phone','$password',$role,'$gender','$region','$image',NOW())";
    

    if($conn->query($sql)){
        header("Location: login.php?success=Account created successfully");
        exit();
    } else {
        header("Location: register.php?error=Registration failed: " . $conn->error);
        exit();
    }
}
?>
