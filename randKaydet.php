<?php
session_start();
require("baglanti.php");
if(isset($_POST)){
    $isim = $_POST['vet'];
    $query_veti = mysqli_query($baglanti, "SELECT veteriner.veteriner_ID
    FROM veteriner
    WHERE CONCAT(veteriner.veteriner_AD, ' ', veteriner.veteriner_SOYAD) = '$isim' ");
    $array_veti = Array();
    while($result = $query_veti -> fetch_assoc()){
        $array_veti [] = $result['veteriner_ID'];
    }
    $son_vet = $array_veti[0];
    $tar = $_POST["tarihi"];
    $saat = $_POST["saati"];
    $sebep = $_POST["sebebi"];
    $uye = $_SESSION["uye_ID"];
    $h_isim= $_POST["hayvan"];
    $query_heti = mysqli_query($baglanti, "SELECT hayvan.hayvan_ID
    FROM hayvan
    WHERE hayvan.hayvan_AD = '$h_isim' ");
    $array_heti = Array();
    while($result = $query_heti -> fetch_assoc()){
        $array_heti [] = $result['hayvan_ID'];
    }
    $heyvan = $array_heti[0];

$sorgu = mysqli_query($baglanti, "INSERT INTO randevu (uye_ID, hayvan_ID, veteriner_ID, tarih, saat, nedeni) 
    VALUES ('".$uye."','".$heyvan."','".$son_vet."','".$tar."','".$saat."','".$sebep."')");
    if($sorgu==TRUE){
        header("location: randevuGoruntule.php");
    }
    else{
        echo "hata ".$baglanti->error;
    }
}

?>
