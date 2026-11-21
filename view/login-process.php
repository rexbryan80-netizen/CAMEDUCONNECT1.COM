<?php
session_start();
include("../model/db.php"); // adjust path if needed
require '../vendor/autoload.php'; // PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Tables to check
    $tables = ["admins", "experts", "students"];
    $user = null;
    $user_table = "";

    foreach($tables as $table){
        $stmt = $conn->prepare("SELECT * FROM $table WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $user = $result->fetch_assoc();
            $user_table = $table;
            break;
        }
    }

    if(!$user){
        header("Location: login.php?error=Email not found");
        exit();
    }

    if(!password_verify($password, $user['password'])){
        header("Location: login.php?error=Wrong password");
        exit();
    }

    // -------------------- GENERATE VERIFICATION CODE --------------------
    $verification_code = rand(100000, 999999); // 6-digit code
    $_SESSION['verification_code'] = $verification_code;
    $_SESSION['verification_expires'] = time() + 300; // 5 minutes
    $_SESSION['temp_user'] = $user; 
    $_SESSION['temp_user_table'] = $user_table;

    // -------------------- SEND EMAIL USING YOUR APP PASSWORD --------------------
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rexbryan80@gmail.com'; // your Gmail
        $mail->Password   = 'mwlhzpodaoqdnlzb';      // your app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('rexbryan80@gmail.com','CAMEDUCONNECT');
        $mail->addReplyTo('rexbryan80@gmail.com','CAMEDUCONNECT');
        $mail->addAddress($email, $user['full_name']);

        $mail->isHTML(true);
        $mail->Subject = 'Your Login Verification Code - CAMEDUCONNECT';
        $mail->Body    = "
            <h3>CAMEDUCONNECT Login Verification</h3>
            <p>Hello <b>{$user['full_name']}</b>,</p>
            <p>Your verification code is: <b>{$verification_code}</b></p>
            <p>This code will expire in 5 minutes.</p>
        ";

        $mail->send();

        header("Location: verify_code.php");
        exit();

    } catch(Exception $e){
        header("Location: login.php?error=Could not send verification email. Mailer Error: {$mail->ErrorInfo}");
        exit();
    }
}
?>