<?php

require 'file/php/Medoo.php';
session_start();
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
    <title>Anasayfa</title>
<link rel="stylesheet" href="file/css/anasayfa.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <p> Eposta : </p><input type="email" name="eposta"><br>
                <p> Şifre : </p><input type="password" name="sifre" minlength="6" maxlength="10"><br><br>
                <button type="submit">Giriş Yap</button>
            </form>
            <br><a href="kayitol.php" class="button">Kayıt İçin Tıklayın</a>
            <br><a href="sifremi_unuttum.php" class="button" style="height: 75px;">Şifrenizi Unuttuysanız Tıklayın</a>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST["eposta"]) && isset($_POST["sifre"])) {
    $eposta = $_POST["eposta"];
    $sifre = $_POST["sifre"];
    $user = $database->get("users", "id", ["AND" => ["eposta" => $eposta, "sifre" => $sifre, "aktif_mi" => 1]]);
    if ($user > 0) {
        $_SESSION["kullaniciID"]=$user[0];
        header("Location:panel.php");
        exit;
    } else {
        header("Location:index.php?kullanici_hata");

    }
}
if(isset($_GET['kullanici_hata'])){
    echo '<script language="javascript">';
    echo 'alert("Hesabınız henüz aktif değil. Lütfen e-postanıza gelen mail üzerinden aktif ediniz. / E-posta ya da şifreniz hatalı. Lütfen kontrol ediniz.")';
    echo '</script>';
}

if(isset($_GET['kod_hatali'])){
    echo '<script language="javascript">';
    echo 'alert("Aktifleştirme sorunu.")';
    echo '</script>';
}
?>