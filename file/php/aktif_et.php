<?php

require 'Medoo.php';

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


if (isset($_GET["mail"]) && isset($_GET["kod"])) {
    $mail = $_GET["mail"];
    $kod = $_GET["kod"];
    $user = $database->get("users", "id", ["AND" => ["eposta" => $mail, "aktivasyon" => $kod]]);
    if($user>0){
        $data = $database->update("users", ["aktif_mi" => 1], ["id" => $user]);
        header("Location:../../panel.php");
    }else{
        header("Location:../../index.php?m=kod_hatali");
    }
}
?>