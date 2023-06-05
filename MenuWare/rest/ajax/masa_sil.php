<?php include '../inc/ayar.php';

$id = $_POST['id'];

$sonuc = $conn->exec("DELETE FROM masalar WHERE masa_id = '$id'");
if ($sonuc > 0) {
	echo "ok";
} else {
	echo "hata";
}



?>