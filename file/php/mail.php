<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'file/mail/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$kod_icin1=date('d.m.Y H:i:s');
$kod_icin2=rand(0,20000);
$uretilen=hash('sha256',$kod_icin1.$kod_icin2);

$database->insert("users", ["eposta" => $email, "sifre" => $sifre, "ad" => $ad, "soyad" => $soyad, "fotograf" => $fotograf, "aktivasyon" => $uretilen]);
echo '<script language="javascript">';
echo 'alert("Üyeliğiniz Başarıyla Oluşturuldu. Lütfen e-postanıza gelen mail üzerinden hesabınızı aktif hale getirin.")';
echo '</script>';

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = '';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = "";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = ;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('', ''); //ilk alan mailiniz, ikinci alan Konu başlığı
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
    $mail->Subject = 'Aktivasyon Maili';
    $mail->Body    = 'Kayıt için teşekkürler. <br> Hesabınızı aktif etmek için <a href="http://localhost/itp_final/file/php/aktif_et.php?mail='.$email.'&kod='.$uretilen.'">Tıklayınız</a>';

    $mail->send();
   // echo 'Message has been sent';
} catch (Exception $e) {
   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>