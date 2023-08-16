<?php

session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $_SESSION = array();
    session_destroy();
    session_start();
}
 
require_once "baglanti.php";
 
$tc = $password = "";
$tc_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["tc_no"]))){
        $tc_err = "Lütfen TC kimlik numarası giriniz";
    } else{
        $tc = trim($_POST["tc_no"]);
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Lütfen Parolanızı giriniz.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($tc_err) && empty($password_err)){
        $sql = "SELECT uye_ID, uye_TC, uye_SIFRE FROM uye WHERE uye_TC = ?";
        
        if($stmt = mysqli_prepare($baglanti, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_tc);
            
            $param_tc = $tc;
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){   
                                     
                    mysqli_stmt_bind_result($stmt, $id, $tc, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["uye_ID"] = $id;
                            $_SESSION["tc"] = $tc;                            
                            
                            header("location: hayvanSec.php");
                        } else{
                            $login_err = "Hatalı TC kimlik numarası veya şifre.";
                        }
                    }
                } else{
                    $login_err = "Hatalı TC kimlik numarası veya şifre.";
                }
            } else{
                echo "Bir şeyler yanlış gitti. Lütfen daha sonra tekrar deneyiniz.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($baglanti);
}
?>