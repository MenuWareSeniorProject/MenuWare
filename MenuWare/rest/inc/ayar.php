<?php
/* Veritabanına Bağlanma Kodu */
$host="localhost";  // Host Adresi
$db_name="pariltisoft_restoran";  // Veritabanı Adı
$db_user="pariltisoft_restoran";    // Veritabanına Yetkisi Olan Kullanıcı Adı
$pass="pariltisoft_restoran";    // Şifre

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $pass);
    //echo 'İşlem Başarılı' . '<br>';
}

catch (PDOExpception $e) {
    echo $e->getMessage();
}

/* Veritabanına Bağlanma Kodu Bitiş */

?>