<?php

$hedef_klasor="file/yuklenenler/";
$hedef_dosya=$hedef_klasor.basename($_FILES["fileToUpload"]["name"]);
$yuklemeyeUygunluk = 1;
$durum="";




$maxsize=10485760;
if($_FILES["fileToUpload"]["size"]>=$maxsize){
    $yuklemeyeUygunluk=0;
    $durum.="Dosya boyutu 10MB üstünde.";
}


$resimKontrol=mime_content_type($_FILES["fileToUpload"]["tmp_name"]);

if(strpos($resimKontrol,"image")!=false){
    $yuklemeyeUygunluk=0;
    $durum.="Fotoğraf dosyası değil.";
}


$resimDosyaTur = strtolower(pathinfo($hedef_dosya,PATHINFO_EXTENSION));
if($resimDosyaTur!="jpg" && $resimDosyaTur!="jpeg" && $resimDosyaTur!="png" && $resimDosyaTur!="gif"){
    $yuklemeyeUygunluk=0;
    $durum.="png, jpg, jpeg ve gif uzantılı olmalı.";
}

if($yuklemeyeUygunluk==1){
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $hedef_dosya);

}else{
    echo '<script language="javascript">';
    echo 'alert("'.$durum.'")';
    echo '</script>';
    
}







?>