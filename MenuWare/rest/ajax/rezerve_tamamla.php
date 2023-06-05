<?php include '../inc/ayar.php';

$id = $_POST['id'];


$bilgi = $conn->query('SELECT * FROM rezerveler WHERE rezerve_id ='.$id)->fetch(PDO::FETCH_ASSOC);
$masa_id = $bilgi['rezerve_masa_id'];

$sonuc = $conn->exec("UPDATE rezerveler SET rezerve_durum=1 WHERE rezerve_id = '$id'");
$masa = $conn->exec("UPDATE masalar SET masa_durum = 1 WHERE masa_id = '$masa_id'");


if ($sonuc > 0) {
	echo "ok";
} else {
	echo "hata";
}





?>