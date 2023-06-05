<?php 
include 'inc/ayar.php';
include ('inc/functions.php');

ob_start();
session_start();

function sepeteEkle($urun_id) {
	if (isset($_SESSION['sepetimdekiler'])) {
		$sepetimdekiler = $_SESSION['sepetimdekiler'];
		$urunler = $sepetimdekiler["urunler"];
	}
	else {
		$urunler = array();

	}

	if(array_key_exists($urun_id->menu_id, $urunler)){
		$urunler[$urun_id->menu_id]->count++;
	}
	else {
			$urunler[$urun_id->menu_id] = $urun_id;
	}

	// hesaplama
	$total_price = 0.0;
	$total_count = 0;
	foreach ($urunler as $urun) {
		$urun->total_price = $urun->count * $urun->menu_fiyat;
		$total_price = $total_price + $urun->total_price;
		$total_count += $urun->count;
	}

	$toplam["total_price"] = $total_price;
	$toplam["total_count"] = $total_count;
	$_SESSION['sepetimdekiler']['urunler'] = $urunler;
	$_SESSION['sepetimdekiler']['toplam'] = $toplam;

	return $total_count;
}


if(isset($_POST['menu_id'])){ 

	$id=$_POST['menu_id'];
	// echo $id;

	$menuler = $conn->query("SELECT * FROM menuler WHERE menu_id = {$id}",PDO::FETCH_OBJ)->fetch();
	$menuler->count=1;
	echo sepeteEkle($menuler);

} 


?>