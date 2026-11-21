<?php
echo password_hash("1234", PASSWORD_DEFAULT);
<?php
ini_set('session.cookie_path','/');
session_start();

include("../model/db.php");
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $tables = ["admins","experts","students"];
    $user = null;
    $table_found = "";

    foreach($tables as $table){
        $stmt = $conn->prepare("SELECT * FROM $table WHERE email=? LIMIT 1");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $res = $stmt->get_result();

        if($res->num_rows == 1){
            $user = $res->fetch_assoc();
            $table_found = $table;
            break;
        }
    }

    if(!$user){
        header("Location: login.php?error=Email not found");
        exit();
    }

    if(!password_verify($password,$user['password'])){
        header("Location: login.php?error=Wrong password");
        exit();
    }

    // ✅ OTP
    $otp = rand(100000,999999);

    $_SESSION['otp'] = $otp;
    $_SESSION['otp_expire'] = time()+300;

    $_SESSION['temp_user_id'] = $user['id'];
    $_SESSION['temp_user_name'] = $user['full_name'];
    $_SESSION['temp_table'] = $table_found;

    // SEND EMAIL
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rexbryan80@gmail.com';
    $mail->Password = 'mwlhzpodaoqdnlzb';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('rexbryan80@gmail.com','CAMEDUCONNECT');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "OTP Code";
    $mail->Body = "Your OTP is: <b>$otp</b>";

    $mail->send();

    header("Location: verify.php");
    exit();
}
?>