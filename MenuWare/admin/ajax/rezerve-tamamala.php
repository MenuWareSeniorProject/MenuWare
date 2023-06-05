<?php include '../inc/ayar.php';

$id = $_POST['id'];


$sonuc = $conn->exec("UPDATE  rezerveler SET rezerve_durum=1 WHERE rezerve_id = '$id'");
if ($sonuc > 0) {
	echo "ok";
} else {
	echo "hata";
}





?>