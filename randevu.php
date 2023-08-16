<?php
session_start();
require ("baglanti.php");
$query_il = mysqli_query($baglanti, "SELECT il_AD FROM il");
$array_il = Array();
while($result = $query_il -> fetch_assoc()){
    $array_il [] = $result['il_AD'];
}
/*$query_kli = mysqli_query($baglanti, "SELECT klinik_AD FROM klinik");
$array_kli = Array();
while($result = $query_kli -> fetch_assoc()){
    $array_kli [] = $result['klinik_AD'];
}*/

/*$query_vet = mysqli_query($baglanti, "SELECT veteriner.veteriner_AD
FROM veteriner LEFT JOIN klinik ON veteriner.klinik_ID = klinik.klinik_ID
WHERE klinik_AD = 'Felix Veteriner Kliniği' ");
$array_vet = Array();
while($result = $query_vet -> fetch_assoc()){
    $array_vet [] = $result['veteriner_AD'];
}
*/
?>



<!DOCTYPE html>
<html></html>

<head>
      <link href="index.css" type="text/css" rel="stylesheet">
      <title>Randevu Oluşturma Sayfası</title>

</head>

<body background="arka.png">
      <div class="content">
            <div class="ustYazi">
                  <div class="sagaYasli">
                        <img class="notification" src="notification.png">
                        <img class="profile" src="profil.png">
                  </div>                  
                  <div class="solaYasli">
                        <span class="ust">Randevu Oluşturma Sayfası</span><hr>
                  </div>
            </div>
      </div>
      <div class="detay">
            <br><span class="det">Randevu Detaylarını Belirleyiniz</span><br>
           <br> <form method="POST">
                  <select name="il">
                  <option value="">-----------------</option>
                  <?php
                  foreach($array_il as $key => $value):
                  echo '<option value="'.$key.'">'.$value.'</option>';
                  endforeach;
                  ?>
           </select>
           <input type="submit"> </form> <br>
           <?php
if(isset($_POST["il"])){
    $secili_il = $_POST["il"] + 33;
    $query_ilce = mysqli_query($baglanti, "SELECT ilce.ilce_AD
    FROM ilce LEFT JOIN il ON ilce.il_ID = il.il_ID
    WHERE il.il_ID = $secili_il ");
    $array_ilce = Array();
    while($result = $query_ilce -> fetch_assoc()){
        $array_ilce [] = $result['ilce_AD'];
    }
}
?>
           <br> <form method="POST"> <select name="ilce">
           <option value="">-----------------</option>
                  <?php
                  foreach($array_ilce as $key => $value):
                  echo '<option value="'.$key.'">'.$value.'</option>';
                  endforeach;
                  ?>
           </select>
           <input type="submit"> </form> <br>
           <?php
if(isset($_POST["ilce"])){
      if($secili_il = 35){
    $secili_ilce = $_POST["ilce"] + 65;
      }
    elseif($secili_il=34){
      $secili_ilce = $_POST["ilce"] + 1;
    }
    $query_kli = mysqli_query($baglanti, "SELECT klinik.klinik_AD
    FROM klinik LEFT JOIN ilce ON klinik.ilce_ID = ilce.ilce_ID
    WHERE klinik.ilce_ID = $secili_ilce ");
    $array_kli = Array();
    while($result = $query_kli -> fetch_assoc()){
        $array_kli [] = $result['klinik_AD'];
    }
}
?>
           <br>  <form method="POST"> <select name="vetKlin">
           <option value="">-----------------</option>
                  <?php
                  foreach($array_kli as $key => $value):
                  echo '<option value="'.$key.'">'.$value.'</option>';
                  endforeach;
                  ?>
           </select>
           <input type="submit"> </form> <br>
           <?php
if(isset($_POST["vetKlin"])){
      $secili_kli = $_POST["vetKlin"] + 3;
      $query_vet = mysqli_query($baglanti, "SELECT CONCAT(veteriner.veteriner_AD, ' ', veteriner.veteriner_SOYAD) AS sonuc
      FROM veteriner LEFT JOIN klinik ON veteriner.klinik_ID = klinik.klinik_ID
      WHERE veteriner.klinik_ID = $secili_kli ");
      $array_vet = Array();
      while($result = $query_vet -> fetch_assoc()){
          $array_vet [] = $result['sonuc'];
      }
  }
?>
           <br><form action="randKaydet.php" method="POST"><select name="vet">
           <option value="">-----------------</option>
                  <?php 
                  foreach($array_vet as $key => $value):
                  echo '<option value="'.$value.'">'.$value.'</option>';
                  endforeach;
                  ?>
           </select><br>
           <?php 
           $aktif_uye = $_SESSION["uye_ID"];
    $query_hyvn = mysqli_query($baglanti, "SELECT hayvan.hayvan_AD
    FROM hayvan LEFT JOIN uye ON hayvan.uye_ID = uye.uye_ID
    WHERE hayvan.uye_ID = $aktif_uye ");
    $array_hyvn = Array();
    while($result = $query_hyvn -> fetch_assoc()){
        $array_hyvn [] = $result['hayvan_AD'];
    } 
?>
           <br><select name="hayvan">
           <option value="">-----------------</option>
                  <?php 
                  foreach($array_hyvn as $key => $value):
                  echo '<option value="'.$value.'">'.$value.'</option>';
                  endforeach;
                  ?>
            </select><br>
           <br><span class="kucu">Tarih Seçiniz</span><br>
           <br><input type="date" name="tarihi" required/><br>
           <br><span class="kucu">Saat Seçiniz Belirtiniz</span><br>
           <br><input type="time" name="saati" required/><br>
           <br><span class="kucu">Randevu Amacını Belirtiniz</span><br>
           <br><input type="text" name="sebebi" placeholder="Kırık, aşı vb.">
           <div class="but">
                 <br><button><a type="submit" target="_blank" style=color:rgb(247,55,77)>RANDEVU AL</a></button> </form>
            </div>
           
      </div>
</body>