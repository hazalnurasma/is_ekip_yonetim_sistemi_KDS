<?php
session_start();
require("baglanti.php");
if($_POST){
    if($_POST["isim"]){
        $isim = $_POST["isim"];
        echo $isim;
    }
    if($_POST["tarih"]){
        $tarih = $_POST["tarih"];
        echo $tarih;
    }
    if($_POST["tur"]){
        $tur = $_POST["tur"];
        echo $tur;
    }
    if($_POST["cins"]){
        $cins = $_POST["cins"];
        echo $cins;
    }
    if($_POST["alerji"]){
        $alerji = $_POST["alerji"];
        echo $alerji;
    }
    $sorgu = mysqli_query($baglanti, "INSERT INTO hayvan (hayvan_AD, hayvan_DT, uye_ID, hayvan_TUR, hayvan_CINS, h_Alerji) 
    VALUES ('".$isim."','".$tarih."','".$_SESSION["uye_ID"]."','".$tur."','".$cins."','".$alerji."')");
    if($sorgu==TRUE){
        echo "başarılı";
    }
    else{
        echo "hata ".$baglan->error;
    }
}

?>