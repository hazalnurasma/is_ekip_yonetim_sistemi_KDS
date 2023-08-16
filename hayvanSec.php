<?php
session_start();
require("baglanti.php");
$uye = $_SESSION['uye_ID'];
$query_user = mysqli_query($baglanti, "SELECT uye.uye_AD
FROM uye
WHERE uye.uye_ID = $uye ");
$array_user = Array();
while($result = $query_user -> fetch_assoc()){
    $array_user [] = $result['uye_AD'];
}

$query_heyvan = mysqli_query($baglanti, "SELECT hayvan.hayvan_AD
FROM hayvan LEFT JOIN uye ON hayvan.uye_ID = uye.uye_ID
WHERE uye.uye_ID = $uye ");
$array_heyvan = Array();
while($result = $query_heyvan -> fetch_assoc()){
    $array_heyvan [] = $result['hayvan_AD'];
}
?>


<!DOCTYPE html>
<html>

<head>
      <link href="index.css" type="text/css" rel="stylesheet">
      <title>Seçim Sayfası</title>

</head>

<body background="arka.png">
      <div class="content">
            <div class="ustYazi">
                  <div class="sagaYasli">
                        <img class="notification" src="notification.png">
                        <img class="profile" src="profil.png">
                  </div>                  
                  <div class="solaYasli">
                        <span class="ust">Hayvan Seçimi</span><hr>
                  </div>

            </div>
      </div>
      <div class="icerik">
            <div class="karsilama">Hoşgeldin <?php echo $array_user[0] ?>!</div><br>
            <div class="dost">Hangi evcil dostun ile devam etmek istersin?</div><br>
            <div class="daire">
                  <div class="deneme">
                        <img class="circ" src="daire.png">
                        <span class="yok"><a href=hayvanGoruntule.php target="_blank" style=color:indianred><?php echo $array_heyvan[0] ?></a></span>
                  </div>
            </div>
            <div class="siluet">
                  <img class="hayv" src="artı.png">
                  <span class="ekle"><a href=hayvanEkle.html target="_blank" style=color:indianred>Yeni bir evcil dost ekle!</a></span>
            </div>
      </div>
</body>


</html>

