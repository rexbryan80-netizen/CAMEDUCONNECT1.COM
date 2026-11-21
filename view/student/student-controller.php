<?php
include '../../model/db.php';
require '../../vendor/autoload.php'; // PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

// ----------------- HELPER FUNCTION FOR IMAGE UPLOAD -----------------
function uploadImage($file, $folder) {
    if (!empty($file['name'])) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $filename = time().'_'.uniqid().'.'.$ext;
            $uploadDir = $_SERVER['DOCUMENT_ROOT']."/CAMEDUCONNECT/uploads/$folder/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $path = $uploadDir.$filename;
            if (move_uploaded_file($file['tmp_name'], $path)) return $filename;
        }
    }
    return null;
}

// ----------------- HELPER FUNCTION FOR PASSWORD -----------------
function generatePassword($length = 8){
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

// ----------------- ADD STUDENT -----------------
if(isset($_POST['add_student'])){

    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $gender    = $_POST['gender'];
    $region    = $_POST['region'];

    // ----------------- CHECK FOR DUPLICATE EMAIL -----------------
    $check1 = $conn->prepare("SELECT id FROM students WHERE email=?");
    $check1->bind_param("s",$email);
    $check1->execute();
    $check1->store_result();

    $check2 = $conn->prepare("SELECT id FROM experts WHERE email=?");
    $check2->bind_param("s",$email);
    $check2->execute();
    $check2->store_result();

    if($check1->num_rows > 0 || $check2->num_rows > 0){
        $_SESSION['error'] = "Email already exists in the system!";
        header("Location:students.php");
        exit;
    }

    // ----------------- GENERATE PASSWORD -----------------
    $plain_password = generatePassword();
    $password = password_hash($plain_password, PASSWORD_DEFAULT);

    // ----------------- UPLOAD PROFILE IMAGE -----------------
    $image = uploadImage($_FILES['profile_image'], "students");

    // ----------------- INSERT STUDENT -----------------
    $stmt = $conn->prepare("INSERT INTO students (full_name,email,phone,password,gender,region,profile_image,created_at) VALUES (?,?,?,?,?,?,?,NOW())");
    $stmt->bind_param("sssssss", $full_name, $email, $phone, $password, $gender, $region, $image);

    if($stmt->execute()){
        $student_id = $stmt->insert_id;

        // ----------------- SEND EMAIL -----------------
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'rexbryan80@gmail.com';
            $mail->Password   = 'mwlhzpodaoqdnlzb'; // ✅ app password, no spaces
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('rexbryan80@gmail.com','CAMEDUCONNECT');
            $mail->addReplyTo('rexbryan80@gmail.com','CAMEDUCONNECT');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your Student Account - CAMEDUCONNECT';
            $mail->Body    = "
                <h3>Welcome to CAMEDUCONNECT</h3>
                <p>Hello <b>$full_name</b>,</p>
                <p>Your student account has been created successfully.</p>
                <p><b>Email:</b> $email</p>
                <p><b>Password:</b> $plain_password</p>
                <p>Please login and change your password immediately for security.</p>
            ";

            $mail->send();
        } catch(Exception $e){
            $_SESSION['error'] = "Student added but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location:students.php");
            exit;
        }

        $_SESSION['success'] = "Student added successfully! Email sent.";
    } else {
        $_SESSION['error'] = "Error adding student: ".$stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location:students.php");
    exit;
}