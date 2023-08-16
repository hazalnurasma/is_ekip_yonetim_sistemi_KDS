<?php
require_once "baglanti.php";
 
$tc = $password = $confirm_password = "";
$tc_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["tc"]))){
        $tc_err = "Please enter a tc.";
    } elseif(!preg_match('/^[0-9]+$/', trim($_POST["tc"]))){
        $tc_err = "TC Kimlik numarası sadece numaralardan oluşabilir";
    } else{
        $sql = "SELECT uye_ID FROM uye WHERE uye_TC = ?";

        if($stmt = mysqli_prepare($baglanti, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_tc);
            
            $param_tc = trim($_POST["tc"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $tc_err = "Bu TC kimlik numarası ile bir kayıt bulunmakta.";
                } else{
                    $tc = trim($_POST["tc"]);
                }
            } else{
                echo "Bir şeyler yanlış gitti. Lütfen daha sonra tekrar deneyiniz.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["parola"]))){
        $password_err = "Lütfen şifre giriniz.";     
    } elseif(strlen(trim($_POST["parola"])) < 6){
        $password_err = "Şifre en az 6.";
    } else{
        $password = trim($_POST["parola"]);
    }

    if($_POST["adiniz"]){
        $adi = $_POST["adiniz"];
    }
    if($_POST["soyad"]){
        $soyadi = $_POST["soyad"];
    }
    if($_POST["eposta"]){
        $eposta = $_POST["eposta"];
    }
    if($_POST["tel"]){
        $tel = $_POST["tel"];
    }
    if($_POST["dogumTarihi"]){
        $dogumTarihi = $_POST["dogumTarihi"];
    }
    
    if(empty($tc_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO uye (uye_TC, uye_SIFRE, uye_AD, uye_SOYAD, uye_DT, uye_TEL, uye_MAIL) VALUES (?, ?, '".$adi."', '".$soyadi."', '".$dogumTarihi."', '".$tel."', '".$eposta."')";
         
        if($stmt = mysqli_prepare($baglanti, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_tc, $param_password);
            
            $param_tc = $tc;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: kullaniciGirisi.html");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($baglanti);
}
?>