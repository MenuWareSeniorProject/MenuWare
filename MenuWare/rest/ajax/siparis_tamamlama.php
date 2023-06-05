<?php include '../inc/ayar.php';
$id = $_POST['id'];


$sonuc = $conn->exec("UPDATE rezerveler SET rezerve_siparis_durum=0 WHERE rezerve_id = '$id'");

if ($sonuc > 0) {
	echo "ok";
} else {
	echo "hata";
}


?>