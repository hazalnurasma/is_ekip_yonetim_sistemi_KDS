<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bsat');
 
$baglanti = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($baglanti === false){
    die("ERROR: Bağlantı Gerçekleştirilemedi. " . mysqli_connect_error());
}
?>