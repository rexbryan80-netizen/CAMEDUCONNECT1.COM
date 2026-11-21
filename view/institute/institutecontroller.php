<?php
include("../../model/db.php");

if(isset($_POST['add_institute'])) {
    $name = $_POST['name'];
    $region = $_POST['region'];
    $description = $_POST['description'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target = "../uploads/".basename($image);

    $sql = "INSERT INTO institutes (name, region, description, image) VALUES ('$name', '$region', '$description', '$image')";

    if($conn->query($sql)){
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        header("Location:institute.php?msg=added");
    } else {
        echo "Error: " . $conn->error;
    }
}
// Notify Students
$students = $conn->query("SELECT id FROM students");

while($row = $students->fetch_assoc()){
    $student_id = $row['id'];

    $conn->query("INSERT INTO notifications 
        (title, message, receiver_type, receiver_id) 
        VALUES 
        (
        'New School Added',
        'New institute $name has been added in $region region.',
        'student',
        '$student_id'
        )
    ");
}

// Notify Experts
$experts = $conn->query("SELECT id FROM experts");

while($row = $experts->fetch_assoc()){
    $expert_id = $row['id'];

    $conn->query("INSERT INTO notifications 
        (title, message, receiver_type, receiver_id) 
        VALUES 
        (
        'New School Added',
        'New institute $name has been added.',
        'expert',
        '$expert_id'
        )
    ");
}
// Delete Institute
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM institutes WHERE id=$id";
    if($conn->query($sql)){
        header("Location:institute.php?msg=deleted");
    } else {
        echo "Error: " . $conn->error;
    }
}

// Update Institute
if(isset($_POST['update_institute'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $region = $_POST['region'];
    $description = $_POST['description'];

    $sql = "UPDATE institutes SET name='$name', region='$region', description='$description' WHERE id=$id";
    if($conn->query($sql)){
        header("Location:institute.php?msg=updated");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
