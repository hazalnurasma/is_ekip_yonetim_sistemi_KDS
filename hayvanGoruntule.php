<?php
session_start();
require("baglanti.php");
$uye = $_SESSION['uye_ID'];

$query_h_isim = mysqli_query($baglanti, "SELECT hayvan.hayvan_AD
FROM hayvan LEFT JOIN uye ON hayvan.uye_ID = uye.uye_ID
WHERE uye.uye_ID = $uye ");
$array_h_isim = Array();
while($result = $query_h_isim -> fetch_assoc()){
    $array_h_isim [] = $result['hayvan_AD'];
}

$query_h_cins = mysqli_query($baglanti, "SELECT hayvan.hayvan_CINS
FROM hayvan LEFT JOIN uye ON hayvan.uye_ID = uye.uye_ID
WHERE uye.uye_ID = $uye ");
$array_h_cins = Array();
while($result = $query_h_cins -> fetch_assoc()){
    $array_h_cins [] = $result['hayvan_CINS'];
}

$query_h_tur = mysqli_query($baglanti, "SELECT hayvan.hayvan_TUR
FROM hayvan LEFT JOIN uye ON hayvan.uye_ID = uye.uye_ID
WHERE uye.uye_ID = $uye ");
$array_h_tur = Array();
while($result = $query_h_tur -> fetch_assoc()){
    $array_h_tur [] = $result['hayvan_TUR'];
}

$query_h_dt = mysqli_query($baglanti, "SELECT hayvan.hayvan_DT
FROM hayvan LEFT JOIN uye ON hayvan.uye_ID = uye.uye_ID
WHERE uye.uye_ID = $uye ");
$array_h_dt = Array();
while($result = $query_h_dt -> fetch_assoc()){
    $array_h_dt [] = $result['hayvan_DT'];
}

$query_h_alerji = mysqli_query($baglanti, "SELECT hayvan.h_Alerji
FROM hayvan LEFT JOIN uye ON hayvan.uye_ID = uye.uye_ID
WHERE uye.uye_ID = $uye ");
$array_h_alerji = Array();
while($result = $query_h_alerji -> fetch_assoc()){
    $array_h_alerji [] = $result['h_Alerji'];
}
?>

<!DOCTYPE html>
<html>

      <head>
            <link href="index.css" type="text/css" rel="stylesheet">
            <title>Hayvan Görüntüleme</title>
      
      </head>
      
      <body background="arka.png">
            <div class="content">
                  <div class="ustYazi">
                        <div class="sagaYasli">
                              <img class="notification" src="notification.png">
                              <img class="profile" src="profil.png">
                        </div>                  
                        <div class="solaYasli">
                              <span class="ust">Hayvan Görüntüleme Sayfası</span><hr>
                        </div>
      
                  </div>
            </div>
            <!--"yan" olarak adlandırılan yerde hayvan fotoğrafı olacak ama olmazsa oraya temsili img konulabilir.-->
            <div class="ne">
                  <div class="yan">
                        <img class="hayvanFotosu" src="">
                  </div>
                  <div class="topla">
                        <div class="liste">
                             <br><span class="adi">İsim:</span>
                             <span class="adiki"><?php echo $array_h_isim[0] ?></span><br>
                             <br><span class="cinsi">Cins:</span>
                             <span class="cinsiki"><?php echo $array_h_cins[0] ?></span><br>
                             <br><span class="turu">Tür:</span>
                             <span class="cinsiki"><?php echo $array_h_tur[0] ?></span><br>
                             <br><span class="yasi">Doğum Tarihi:</span>
                             <span class="yasiki"><?php echo $array_h_dt[0] ?></span><br>
                             <br><span class="kilo">Alerjisi:</span>
                             <span class="kiloki"><?php echo $array_h_alerji[0] ?></span><br>
                        </div>
                  </div>
                  <div class="rand">
                        <br><button style="background:#f36868"><a href="randevu.php" target="_blank" style=color:white>RANDEVU OLUŞTUR</a></button>
                  </div>
                  <div class="rand">
                        <br><button><a href="randevuGoruntule.php" target="_blank" style=color:rgb(247,55,77)>RANDEVU GÖRÜNTÜLE</a></button>
                  </div>
            </div>
            





      </body>

</html>