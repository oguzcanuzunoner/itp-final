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

?>
<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="file/css/kayitol.css">
</head>

<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <p>E-posta : </p> <input type="email" name="email"><br>
            <p>Şifre : </p> <input type="password" name="sifre" minlength="6" maxlength="10"><br>
            <p>Ad : </p> <input type="text" name="ad"><br>
            <p>Soyad : </p> <input type="text" name="soyad"><br>
            <p>Fotoğraf : </p><input type="file" name="fileToUpload" id="fileToUpload"><br><br>

            <button type="submit">Kayıt Ol</button>
        </form>
        <br><a href="index.php" class="button">Giriş İçin Tıklayın</a>
    </div>
</body>

</html>
<?php
$eposta = "";
$sifre = "";
$ad = "";
$soyad = "";
$fotograf = "";
if (isset($_POST["email"]) && isset($_POST["sifre"]) && isset($_POST["ad"]) && isset($_POST["soyad"])) {
    $sifre = $_POST["sifre"];
    $email = $_POST["email"];
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    include('file/php/upload.php');
    $fotograf = $hedef_dosya;
    if ($yuklemeyeUygunluk == 1) {
        $sorgu=($database->has("users", ["eposta[=]" =>$email]));
        if ($sorgu==1){
            echo '<script language="javascript">';
            echo 'alert("Bu E-posta adresi kayıtlı. Lütfen başka bir e-posta deneyiniz")';
            echo '</script>';
        }else{
        include('file/php/mail.php');
       
    }
    }
}
?>
