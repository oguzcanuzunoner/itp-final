<?php

require 'file/php/Medoo.php';
session_start();
if (!isset($_SESSION["kullaniciID"]) || $_SESSION["kullaniciID"] == "") {
    header("Location:index.php");
    exit;
}

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

$kullaniciId=$_SESSION["kullaniciID"];
?>
<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" href="file/css/panel.css">
</head>

<body>
    <div class="container">
        <a href="file/php/cikis.php" class="button"> Çıkış yap</a>
        <br>
        <?php 
        $foto=$database->select("users", 'fotograf',['id'=>$kullaniciId]);
        $k_adi=$database->select("users", 'ad',['id'=>$kullaniciId]);
        $k_soyadi=$database->select("users", 'soyad',['id'=>$kullaniciId]);
        echo "
        
        <img
        style='width:25%; height='25%'
        src='$foto[0]'
        alt='profile_picture'
      />";
      echo "
      <h5 class='yazirenk'>Kullanıcının adı-soyadı :".$k_adi[0]." ".$k_soyadi[0]."</h5>
      "
      ?><br>
      
        
        <div class="row1"> 
        <h4 class="yazirenk">Favori sanatçınızı ve favori şarkılarını eşleştiriniz.</h4>
            <form action="" method="post">
                <p class="yazirenk">Favori sanatçınızı giriniz.</p>
                <input type="text" name="sanatci"><br>
                <button type="submit">Kaydet</button>
            </form>
            <?php
            $sanatci = "";
            if (isset($_POST['sanatci'])) {
                if ($_POST['sanatci'] != "") {
                    $sanatci = $_POST['sanatci'];
                    $database->insert("sanatci", ["sanatci" => $sanatci]);
                }
            }
            ?>
            <div class="row2">
                <form action="" method="post">
                    <label for="sanatcisec" class="yazirenk">Sanatçınızı seçiniz: </label>
                    <select name="sanatcisec" id="sanatcisec">
                        <?php
                        $sanatcilar_ = $database->select("sanatci", '*');
                        foreach ($sanatcilar_  as $sanatci_) {
                            echo '<option value="' . $sanatci_['id'] . '">' . $sanatci_['sanatci'] . '</option>';
                        }
                        ?>
                    </select>
                    <p class="yazirenk">Favori şarkınızı yazınız : </p>
                    <input type="text" name='favorisarki'>
                    <br><br>
                    <input type="submit" value="Kaydet">
                </form>
                <?php
                $sanatsecilen = "";
                $favoriyazilan = "";
                if (isset($_POST['sanatcisec']) && isset($_POST['favorisarki'])) {
                    if ($_POST['sanatcisec'] != "" && $_POST['favorisarki'] != "") {
                        $sanatsecilen = $_POST['sanatcisec'];
                        $favoriyazilan = $_POST['favorisarki'];
                        $database->insert("sarki", ["sanatciId" => $sanatsecilen, 'sarki' => $favoriyazilan]);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container2">
        <div class="row3">
            <form action="" method="post">
                <label for="sanatciarama" style="color: #ffff;">Aramak istediğiniz sanatçıyı seçin.</label>
                <select name="sanatciarama" id="sanatciarama">
                <?php
                        $sanatcisecimi = $database->select("sanatci", '*');
                        foreach ($sanatcisecimi  as $sanatcisecim) {
                            echo '<option value="' . $sanatcisecim['sanatci'] . '">' . $sanatcisecim['sanatci'] . '</option>';
                        }
                        ?>
                </select>
                <button type="submit">ARA</button>
            </form><br>
            <table class="blueTable">

                <thead>
                    <tr>
                        <th>Sanatçı Adı</th>
                        <th>Eşleşen Şarkı</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $aramasonuc = "";
                    if (isset($_POST["sanatciarama"])) {
                        $aramasonuc = $_POST["sanatciarama"];
                        $sanatciarama_ = $database->query("select sanatci,sarki from sanatci, sarki where sanatci.id=sarki.sanatciId and sanatci.sanatci='" . $aramasonuc . "'")->fetchAll();
                        foreach ($sanatciarama_ as $sanatciaramasi) {
                            echo 
                            "<tr>
                            <td>" . $sanatciaramasi["sanatci"] . "</td>
                            <td>" . $sanatciaramasi["sarki"] . "</td>";
                        }
                    } else {
                        $kayitlar = $database->query("select sanatci,sarki from sanatci inner join sarki on sanatci.id=sarki.sanatciId")->fetchAll();
                        foreach ($kayitlar as $kayit) {
                            echo 
                            "<tr>
                            <td>" . $kayit["sanatci"] . "</td>
                            <td>" . $kayit["sarki"] . "</td>";
                        }
                    }

                    ?>

        </div>
    </div>

    <div class="container3">
        <div class="row4">
            <form action="" method="post">
                <br>
                <label for="degiseceksanatci" class="yazirenk">İsmini değişecek sanatçınızı seçiniz: </label>
                <select name="degiseceksanatci" id="degiseceksanatci">
                    <?php
                    $sanatcilar2_ = $database->select("sanatci", '*');
                    foreach ($sanatcilar2_  as $sanatci2_) {
                        echo '<option value="' . $sanatci2_['sanatci'] . '">' . $sanatci2_['sanatci'] . '</option>';
                    }
                    ?>
                </select>
                <br><br><br>
                <label for="degisensim" class="yazirenk">Yeni ismi yazınız :</label>
                <input type="text" name="degisenisim">
                <button type="submit">Kaydet</button>
            </form>
            <?php
            $degiseceksanatci_ = "";
            $degisenisim_ = "";
            if (isset($_POST['degiseceksanatci']) && isset($_POST['degisenisim'])) {
                if ($_POST['degiseceksanatci'] != "" && $_POST['degisenisim'] != "") {
                    $degiseceksanatci_ = $_POST['degiseceksanatci'];
                    $degisenisim_ = $_POST['degisenisim'];
                    $database->update("sanatci", ['sanatci' => $degisenisim_], ['sanatci' => $degiseceksanatci_]);
                    echo '<script language="javascript">';
                    echo 'alert("İsim değişti. Değişiklik için sayfayı yeniden açınız.")';
                    echo '</script>';
                }
            }
            ?>
        </div>
        <br>
        <div class="row5">
            <form action="" method="post">
                <br>
                <label for="silmeicin" class="yazirenk">Silmek istediğiniz sanatçıyı yazın</label>
                <input type="text" name="silmekicin" id="silmekicin">
                <button type="submit">Gönder</button><br>
            </form>
            <?php
            $silinecekisim_ = "";
            if (isset($_POST['silmekicin'])) {
                if ($_POST['silmekicin'] != "") {
                    $silinecekisim_ = $_POST['silmekicin'];
                    $database->delete("sanatci", ['sanatci' => $silinecekisim_]);
                    echo '<script language="javascript">';
                    echo 'alert("İsim silindi. Değişiklik için sayfayı yeniden açınız.")';
                    echo '</script>';
                }
            }
            ?>
        </div>
        <div class="row6">
            <form action="" method="post">
                <br><br>
                <label for="degisicin" class="yazirenk">Değiştirmek istediğiniz şarkı ismini yazın</label>
                <input type="text" name="degisicin" id="degisicin">
                <br>
                <label for="yenisarkiismi" class="yazirenk">Şarkının yeni ismini yazın</label>
                <input type="text" name="yenisarkiismi" id="yenisarkiismi">

                <button type="submit">Gönder</button>
            </form>
            <?php
            $degiseceksarki_ = "";
            $yenisarkiismi_ = "";
            if (isset($_POST['degisicin']) && isset($_POST['yenisarkiismi'])) {
                if ($_POST['degisicin'] != "" && $_POST['yenisarkiismi'] != "") {
                    $degiseceksarki_ = $_POST['degisicin'];
                    $yenisarkiismi_ = $_POST['yenisarkiismi'];
                    $database->update("sarki", ['sarki' => $yenisarkiismi_], ['sarki' => $degiseceksarki_]);
                    echo '<script language="javascript">';
                    echo 'alert("Şarkı ismi değişti. Değişiklik için sayfayı yeniden açınız.")';
                    echo '</script>';
                }
            }
            ?>
        </div>
        <div class="row7">
        <form action="" method="post">
                <br>
                <label for="silmekicinsarki" class="yazirenk">Silmek istediğiniz şarkıyı yazın</label>
                <input type="text" name="silmekicinsarki" id="silmekicinsarki">
                <button type="submit">Gönder</button><br>
            </form>
            <?php
            $silineceksarki_ = "";
            if (isset($_POST['silmekicinsarki'])) {
                if ($_POST['silmekicinsarki'] != "") {
                    $silineceksarki_ = $_POST['silmekicinsarki'];
                    $database->delete("sarki", ['sarki' => $silineceksarki_]);
                    echo '<script language="javascript">';
                    echo 'alert("Şarkı silindi. Değişiklik için sayfayı yeniden açınız.")';
                    echo '</script>';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>