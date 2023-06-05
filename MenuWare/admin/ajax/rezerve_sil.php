<?php include '../inc/ayar.php';

$id = $_POST['id'];

$bilgi = $conn->query('SELECT * FROM rezerveler WHERE rezerve_id ='.$id)->fetch(PDO::FETCH_ASSOC);
$siparis_id = $bilgi['rezerve_siparis_id'];
$masa_id = $bilgi['rezerve_masa_id'];

$rezerveSil = $conn->exec("DELETE FROM rezerveler WHERE rezerve_id = '$id'");
$siparisSil = $conn->exec("DELETE FROM siparisler WHERE siparis_id = '$siparis_id'");
if ($rezerveSil > 0) {
	$masa = $conn->exec("UPDATE masalar SET masa_durum = 1 WHERE masa_id = '$masa_id'");
	echo "ok";
} else {
	echo "hata";
}



?>