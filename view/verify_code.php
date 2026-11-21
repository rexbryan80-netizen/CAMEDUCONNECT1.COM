<?php
session_start();
require '../vendor/autoload.php'; // PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Redirect to login if no temp user
if(!isset($_SESSION['temp_user'])){
    header("Location: login.php?error=Please login first");
    exit();
}

// Role mapping (numeric ID => role name)
$role_map = [
    1 => 'admin',
    2 => 'expert',
    3 => 'student'
];

// ---------------- VERIFY CODE -----------------
if(isset($_POST['verify'])) {
    $code_input = trim($_POST['code']);

    if(!isset($_SESSION['verification_code']) || !isset($_SESSION['temp_user'])){
        header("Location: login.php?error=Session expired, login again");
        exit();
    }

    if(time() > $_SESSION['verification_expires']){
        $error = "Verification code expired. Please resend code.";
    } elseif($code_input == $_SESSION['verification_code']){
        $role_id = $_SESSION['temp_user']['role']; // numeric ID from DB
        if(isset($role_map[$role_id])){
            $_SESSION['user_role'] = $role_map[$role_id];
        } else {
            header("Location: login.php?error=Unknown role");
            exit();
        }

        $_SESSION['user_id'] = $_SESSION['temp_user']['id'];
        $_SESSION['user_name'] = $_SESSION['temp_user']['full_name'];
        $_SESSION['user_table'] = $_SESSION['temp_user_table'] ?? '';

        // Cleanup temporary session
        unset($_SESSION['verification_code'], $_SESSION['verification_expires'], $_SESSION['temp_user'], $_SESSION['temp_user_table']);

        // Redirect to dashboard
        switch($_SESSION['user_role']){
            case "admin":
                header("Location: ../admin/admindashboard.php"); break;
            case "expert":
                header("Location:expert/expert_dashboard.php"); break;
            case "student":
                header("Location: student/students-dashboard.php"); break;
        }
        exit();
    } else {
        $error = "Invalid verification code";
    }
}

// ---------------- RESEND CODE -----------------
if(isset($_POST['resend'])){
    $verification_code = rand(100000, 999999);
    $_SESSION['verification_code'] = $verification_code;
    $_SESSION['verification_expires'] = time() + 300; // 5 minutes
    $user = $_SESSION['temp_user'];
    $email = $user['email'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rexbryan80@gmail.com';
        $mail->Password   = 'mwlhzpodaoqdnlzb';
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
            <p>Your new verification code is: <b>{$verification_code}</b></p>
            <p>This code will expire in 5 minutes.</p>
        ";

        $mail->send();
        $success = "A new verification code has been sent to your email.";
    } catch(Exception $e){
        $error = "Could not resend verification code. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verify Code - CAMEDUCONNECT</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4f8;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.verification-card {
    background: #fff;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.verification-card h3 {
    margin-bottom: 25px;
    color: #333;
    font-size: 1.5rem;
}

.verification-card input[type="text"] {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
}

.verification-card button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #007bff;
    color: #fff;
    font-size: 1rem;
    cursor: pointer;
    transition: 0.3s;
}

.verification-card button:hover {
    background: #0056b3;
}

.resend-btn {
    margin-top: 15px;
    background: #6c757d;
}

.resend-btn:hover {
    background: #5a6268;
}

.message {
    margin-top: 15px;
    font-size: 0.95rem;
}

.error {
    color: #d9534f;
}

.success {
    color: #28a745;
}

@media(max-width: 480px){
    .verification-card {
        padding: 30px 20px;
    }
}
</style>
</head>
<body>

<div class="verification-card">
    <h3>Enter Verification Code</h3>
    <form method="POST">
        <input type="text" name="code" required placeholder="6-digit code">
        <button type="submit" name="verify">Verify</button>
    </form>

    <form method="POST">
        <button type="submit" name="resend" class="resend-btn">Resend Verification Code</button>
    </form>

    <?php
    if(isset($error)) echo "<div class='message error'>$error</div>";
    if(isset($success)) echo "<div class='message success'>$success</div>";
    ?>
</div>

</body>
</html>