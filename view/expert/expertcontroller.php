<?php
include("../../model/db.php");
require '../../vendor/autoload.php'; // PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['add_expert'])){

    $full_name       = trim($_POST['full_name']);
    $email           = trim($_POST['email']);
    $phone           = trim($_POST['phone']);
    $region          = trim($_POST['region']);
    $specialization  = trim($_POST['specialization']);
    $qualification   = trim($_POST['qualification']);
    $bio             = isset($_POST['bio']) ? trim($_POST['bio']) : "";
    $role            = 2;

    // ✅ 1. GENERATE PASSWORD
    function generatePassword($length = 8){
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
    }

    $plain_password = generatePassword();

    // ✅ 2. HASH PASSWORD
    $password = password_hash($plain_password, PASSWORD_DEFAULT);

    // ✅ 3. IMAGE UPLOAD
    $profile_image = null;
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0){
        $upload_dir = "../../assets/images/experts/";
        if(!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        $profile_image = time() . "_" . basename($_FILES["profile_image"]["name"]);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $upload_dir . $profile_image);
    }

    // ✅ 4. INSERT INTO DATABASE
    $stmt = $conn->prepare("INSERT INTO experts 
        (full_name, email, password, phone, region, specialization, qualification, bio, profile_image, role, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    $stmt->bind_param("sssssssssi", 
        $full_name, $email, $password, $phone, $region, 
        $specialization, $qualification, $bio, $profile_image, $role
    );

    if($stmt->execute()){

        // ✅ 5. SEND EMAIL
        $mail = new PHPMailer(true);

        try {
                    $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // 🔐 Your email and app password
        $mail->Username   = 'rexbryan80@gmail.com';
        $mail->Password   = 'mwlhzpodaoqdnlzb'; // ✅ remove spaces

        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender & Reply-To
        $mail->setFrom('rexbryan80@gmail.com', 'CAMEDUCONNECT');
        $mail->addReplyTo('rexbryan80@gmail.com', 'CAMEDUCONNECT');

        // Recipient
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your Expert Account - CAMEDUCONNECT';
        $mail->Body    = "
            <h3>Welcome to CAMEDUCONNECT</h3>
            <p>Hello <b>$full_name</b>,</p>
            <p>Your expert account has been created successfully.</p>
            <p><b>Email:</b> $email</p>
            <p><b>Password:</b> $plain_password</p>
            <p>Please login and change your password immediately for security.</p>
        ";

        $mail->send();
        } catch (Exception $e) {
            echo "Email Error: {$mail->ErrorInfo}";
        }


        header("Location: experts.php?added=1");
        exit;

    } else {
        echo "Database Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>