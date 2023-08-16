<?php
session_start();
require("baglanti.php");
$uye = $_SESSION["uye_ID"];
if($baglanti){
    $sorgu = mysqli_query($baglanti, "SELECT klinik.klinik_AD, hayvan.hayvan_AD, CONCAT (veteriner.veteriner_AD, ' ', veteriner.veteriner_SOYAD) AS veteriner, randevu.randevu_ID, randevu.tarih, randevu.saat, randevu.nedeni
    FROM randevu 
    LEFT JOIN hayvan ON hayvan.hayvan_ID = randevu.hayvan_ID
    LEFT JOIN veteriner ON veteriner.veteriner_ID = randevu.veteriner_ID
    LEFT JOIN klinik ON veteriner.klinik_ID = klinik.klinik_ID
    WHERE randevu.uye_ID = $uye
    ORDER BY randevu.tarih DESC, randevu.saat DESC
    LIMIT 1");

}
?>



<!DOCTYPE html>
<html></html>

<head>
      <link href="index.css" type="text/css" rel="stylesheet">
      <title>Randevu Görüntüleme Sayfası</title>

</head>

<body background="arka.png">
      <div class="content">
            <div class="ustYazi">
                  <div class="sagaYasli">
                        <img class="notification" src="notification.png">
                        <img class="profile" src="profil.png">
                  </div>                  
                  <div class="solaYasli">
                        <span class="ust">Randevu Görüntüleme</span><hr>
                  </div>
            </div>
      </div>
      <div class="goster">
            <div class="script">Randevunuz Oluşturulmuştur!</div>
            <div>
                  <?php
                            if(mysqli_num_rows($sorgu)>0){
                              while($row = mysqli_fetch_assoc($sorgu)){
                                  echo "Randevu ID: ".$row["randevu_ID"]." <br> Klinik: ".$row["klinik_AD"]." <br> Veteriner: ".$row["veteriner"]." <br> Hayvan: ".$row["hayvan_AD"]." <br> Randevu Tarihi: ".$row["tarih"]." <br> Randevu Saati: ".$row["saat"]." <br> Randevu Nedeni: ".$row["nedeni"]."</";
                              }
                          }

                      else{
                          echo die("veritabanı bağlantısı sağlanamadı");
                        }
                  ?>
            </div>
      </div>





</body>