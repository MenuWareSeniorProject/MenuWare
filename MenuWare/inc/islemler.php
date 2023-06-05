<?php 
include 'ayar.php';
ob_start();
session_start();


if (isset($_POST['girisYap'])) {
	$uye_email = $_POST['uye_email'];
	$uye_parola = $_POST['uye_parola'];
	if ($uye_email && $uye_parola) {
		$kullanicisor=$conn->prepare("SELECT * FROM uye WHERE uye_email = :uye_email AND uye_parola = :uye_parola");
		$kullanicisor->execute(array(
			'uye_email' => $uye_email,
			'uye_parola' => $uye_parola
		));
		$kullanici=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$say=$kullanicisor->rowCount();
		if ($say > 0) {
			$_SESSION['uye_giris'] = $kullanici['uye_id'];
			header("Location: ../profil.php?status=success");
		} else {
			header("Location: ../index.php?status=error");
		}
	}
}
/***************************** profilGuncelle ajax içerisinde ***********************/
if (isset($_POST['profilGuncelle'])) {
	$uye_id=$_POST['uye_id'];
	$uye_adi=$_POST['uye_adi'];
	$uye_tel=$_POST['uye_tel'];
	$menuquery = $conn->prepare("UPDATE uye SET
		uye_adi = :uye_adi,
		uye_tel = :uye_tel
		where uye_id=$uye_id
		");
	$insert = $menuquery->execute(array(
		"uye_adi" => $uye_adi,
		"uye_tel" => $uye_tel
	));
	if ( $insert ){
		header("Location: ../profil.php?status=success");
	}
	else
	{
		header("Location: ../profil.php?status=error");
	}
}

/***************************** sifre Guncelle ***********************/
if (isset($_POST['sifreGuncelle'])) {
	$user_kod=$_POST['uye_id'];
	$currentPass=$_POST['currentPass'];
	$sifre_1=$_POST['newPass1'];
	$sifre_2=$_POST['newPass2'];
	$kullanicisor=$conn->prepare("SELECT * FROM uye WHERE uye_id = :uye_id AND uye_parola = :uye_parola");
	$kullanicisor->execute(array(
		'uye_id' => $user_kod,
		'uye_parola' => $currentPass
	));
	$say=$kullanicisor->rowCount();
	if ($say > 0) {
		if ($sifre_1==$sifre_2) {
			$menuquery = $conn->prepare("UPDATE uye SET
				uye_parola = :uye_parola
				where uye_id=$user_kod
				");
			$insert = $menuquery->execute(array(
				"uye_parola" => $sifre_1
			));
			if ( $insert ){
				header("Location: ../profil.php?status=success");
			}
			else
				{ header("Location: ../profil.php?status=error"); }
		}
		else {header("Location: ../profil.php?status=1"); }
	}
	else {
		header("Location: ../profil.php?status=2");
	}
} 
/***************************** sifreGuncelle ***********************/

/**************************************************/
if (isset($_POST['uyeKayit'])) {

	$uyeSor=$conn->prepare("SELECT * FROM uye WHERE uye_email = :uye_email");
	$uyeSor->execute(array(
		'uye_email' => $_POST['uye_email']
	));
	$say=$uyeSor->rowCount();
	if ($say>0) {
		header("location: ../index.php?status=invalid");
	} else {

		$query = $conn->prepare("INSERT INTO uye SET		
			uye_email = :uye_email,
			uye_adi = :uye_adi,
			uye_parola = :uye_parola,
			uye_tel = :uye_tel
			");
		$insert = $query->execute(array(
			"uye_email" => $_POST['uye_email'],
			"uye_adi" => $_POST['uye_adi'],
			"uye_parola" => $_POST['uye_parola'],
			"uye_tel" => $_POST['uye_tel']
		));

		if ($insert) {
			$id=$conn->lastInsertId();
			header("Location: ../index.php?status=success");
		}else {

			header("Location: ../index.php?status=error");
		}
	}
}

/**********************************************************/



/**************************************************/
if (isset($_POST['rezerveYap'])) {
	$rest_id = $_POST['rest_id'];
	$rezerveSor=$conn->prepare("SELECT * FROM rezerveler WHERE
		rezerve_rest_id = :rezerve_rest_id and 
		rezerve_masa_id = :rezerve_masa_id and 
		rezerve_tarih = :rezerve_tarih and 
		rezerve_durum = :rezerve_durum 

		");
	$rezerveSor->execute(array(
		'rezerve_rest_id' => $_POST['rest_id'],
		'rezerve_masa_id' => $_POST['id'],
		'rezerve_tarih' => $_POST['tarih'],
		'rezerve_durum' => 0
	));
	$sayi=$rezerveSor->rowCount();
	if ($sayi>0) {
		header("location: ../restoran.php?id=$rest_id&status=rezerveVar");
	} else {

		$query = $conn->prepare("INSERT INTO rezerveler SET		
			rezerve_uye_id = :rezerve_uye_id,
			rezerve_rest_id = :rezerve_rest_id,
			rezerve_masa_id = :rezerve_masa_id,
			rezerve_tarih = :rezerve_tarih,
			rezerve_siparis = :rezerve_siparis,
			rezerve_durum = :rezerve_durum 
			");
		$insert = $query->execute(array(
			'rezerve_uye_id' => $_POST['uye_id'],
			'rezerve_rest_id' => $_POST['rest_id'],
			'rezerve_masa_id' => $_POST['masa_id'],
			'rezerve_tarih' => $_POST['tarih'],
			'rezerve_siparis' => $_POST['rezerve_siparis'],
			'rezerve_durum' => 0
		));

		if ($insert) {
			
			unset($_SESSION["sepetimdekiler"]);
			header("Location: ../index.php?status=success");
		}else {

			header("Location: ../index.php?status=error");
		}
	}
}


?>