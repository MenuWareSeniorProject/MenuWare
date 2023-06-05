<?php include '../inc/ayar.php';

$id = $_POST['id'];


$sonuc = $conn->exec("DELETE FROM vatandas WHERE v_id = '$id'");
if ($sonuc > 0) {
	$sonuc = $conn->exec("DELETE FROM kayitlar WHERE k_v_id = '$id'");
	echo "ok";
} else {
	echo "hata";
}





?>