<?php

require 'file/php/Medoo.php';

// Using Medoo namespace
use Medoo\Medoo;

$database = new Medoo([
    // required
    'database_type' => 'mysql',
    'database_name' => 'php_final_itp',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '',

    // [optional]
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',
    'port' => 3306
]);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'file/mail/vendor/autoload.php';
$mail = new PHPMailer(true);
?>
<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifremi Unuttum</title>
    <link rel="stylesheet" href="file/css/sifremiunuttum.css">
</head>

<body>
    <div class="container">
        <div class="row">
        <form action="" method="post">
        <p>E-posta</p><input type="email" name="email"><br><br>
        <button type="submit">Şifremi Gönder</button>
        </form>
        <br><a href="index.php" class="button">Giriş İçin Tıklayın</a>
        </div>
    </div>
</body>

</html>

<?php 
$email="";

if(isset($_POST['email'])){
    $email=$_POST['email'];
    $sifre=$database->get('users','sifre',['eposta' => $email]);
    $ad=$database->get('users','ad',['eposta' => $email]);
    $soyad=$database->get('users','soyad',['eposta' => $email]);
 
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'itp.oguzcan@gmail.com';                     // SMTP username
        $mail->Password   = '123456ou';                               // SMTP password
        $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('itp.oguzcan@gmail.com', 'Mailer');
        $mail->addAddress($email, $ad." ".$soyad);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //ail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Sifre Hatirlatma';
        $mail->Body    = '<h3> Unutulan şifreniz : '.$sifre.' </h3>';
 
    
        $mail->send();
        echo '<script language="javascript">';
        echo 'alert("Şifreniz e-postanıza gönderildi. Lütfen kontrol ediniz.")';
        echo '</script>';
       // echo 'Message has been sent';
    } catch (Exception $e) {
       // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}

?>