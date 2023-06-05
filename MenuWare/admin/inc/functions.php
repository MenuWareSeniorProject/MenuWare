<?php



function sessionkontrol() {

	if (empty($_SESSION['admin_giris'])) {

		header("Location: giris.php");

		exit();

	}

}

function sessionkontrol2() {

	if (isset($_SESSION['admin_giris'])) {

		header("Location: index.php");

		exit();

	}

}


function zamanonce($tarih) {
	date_default_timezone_set('Asia/Istanbul');
	$cevrilenzaman = strtotime($tarih);	
	   //Zamanı strtotime fonksiyonu ile unix zaman damgasını alıyoruz. Yani Zamanı sayısal olarak alıyoruz.
	
	$zamanismi= array("Saniye", "Dakika", "Saat", "Gün", "Ay", "Yıl");
	$sure= array("60","60","24","30","12","10");

	$simdikizaman = time();
	   //zamanı unix zaman damgası olarak alıyoruz.
	
	if($simdikizaman >= $cevrilenzaman) 
	{
		$fark     = time()- $cevrilenzaman;
		for($i = 0; $fark >= $sure[$i] && $i < count($sure)-1; $i++) 
		{
			$fark = $fark / $sure[$i];
		}

		$fark = round($fark);
			//fark değişkenini yuvarlıyor
		
		return $fark . " " . $zamanismi[$i] . " Önce";
	}
}


function mkgunBul($birinci,$ikinci)
{ 
	$fark=(strtotime($birinci)-strtotime($ikinci))/(60*60*24);
	$gunBul = round($fark);
	if($gunBul<=0) {
		return 0;
	}
	else {
		return $gunBul;
	}

} 

function tarih_farkbul ($baslangic,$bitis){
	$fark=mkgunBul(date('d-m-Y H:s:i',strtotime($bitis)),date('Y-m-d H:s:i',strtotime($baslangic)));
	return $fark;
}

?>