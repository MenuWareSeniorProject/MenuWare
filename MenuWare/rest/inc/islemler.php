<?php 
include 'ayar.php';
ob_start();
session_start();


if (isset($_POST['girisYap'])) {
	$yetkili_adi = $_POST['yetkili_adi'];
	$yetkili_parola = $_POST['yetkili_parola'];
	if ($yetkili_adi && $yetkili_parola) {
		$kullanicisor=$conn->prepare("SELECT * FROM yetkili WHERE yetkili_adi = :yetkili_adi AND yetkili_parola = :yetkili_parola");
		$kullanicisor->execute(array(
			'yetkili_adi' => $yetkili_adi,
			'yetkili_parola' => $yetkili_parola
		));
		$kullanici=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$say=$kullanicisor->rowCount();
		if ($say > 0) {
			$_SESSION['rest_giris'] = $kullanici['yetkili_id'];
			header("Location: ../index.php?status=success");
		} else {
			header("Location: ../giris.php?status=error");
		}
	}
}
/***************************** profilGuncelle ajax içerisinde ***********************/
if (isset($_POST['profilGuncelle'])) {
	$user_kod=$_POST['yetkili_id'];
	$yetkili_adi=$_POST['yetkili_adi'];
	$menuquery = $conn->prepare("UPDATE yetkili SET
		yetkili_adi = :yetkili_adi
		where yetkili_id=$user_kod
		");
	$insert = $menuquery->execute(array(
		"yetkili_adi" => $yetkili_adi
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
	$user_kod=$_POST['yetkili_id'];
	$currentPass=$_POST['currentPass'];
	$sifre_1=$_POST['newPass1'];
	$sifre_2=$_POST['newPass2'];
	$kullanicisor=$conn->prepare("SELECT * FROM yetkili WHERE yetkili_id = :yetkili_id AND yetkili_parola = :yetkili_parola");
	$kullanicisor->execute(array(
		'yetkili_id' => $user_kod,
		'yetkili_parola' => $currentPass
	));
	$say=$kullanicisor->rowCount();
	if ($say > 0) {
		if ($sifre_1==$sifre_2) {
			$menuquery = $conn->prepare("UPDATE yetkili SET
				yetkili_parola = :yetkili_parola
				where yetkili_id=$user_kod
				");
			$insert = $menuquery->execute(array(
				"yetkili_parola" => $sifre_1
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
if (isset($_POST['masaEkle'])) {

	$query = $conn->prepare("INSERT INTO masalar SET		
		masa_rest_id = :masa_rest_id,
		masa_no = :masa_no,
		masa_kisi = :masa_kisi
		");
	$insert = $query->execute(array(
		"masa_rest_id" => $_POST['masa_rest_id'],
		"masa_no" => $_POST['masa_no'],
		"masa_kisi" => $_POST['masa_kisi']
	));

	if ($insert) {
		$id=$conn->lastInsertId();
		header("Location: ../masalar.php?status=success");
	}else {

		header("Location: ../masalar.php?status=error");
	}
}

/**********************************************************/


/**************************************************/
if (isset($_POST['masaDuzenle'])) {
	$id=$_POST['masa_id'];

	$query = $conn->prepare("UPDATE masalar SET
		masa_no = :masa_no,
		masa_kisi = :masa_kisi
		where masa_id = " . $id);
	$insert = $query->execute(array(
		"masa_no" => $_POST['masa_no'],
		"masa_kisi" => $_POST['masa_kisi']
	));

	if ($insert) {
		header("Location: ../masa-duzenle.php?id=$id&status=success");
	}else {

		header("Location: ../masa-duzenle.php?id=$id&status=error");
	}
}



/**************************************************************/


/**************************** ÜST KATEGORİ Ekle ***************************/
if (isset($_POST['menuEkle'])) {


	$uploads_dir = '../../images';
	@$tmp_name = $_FILES['menu_img']["tmp_name"];
	$name = $_FILES['menu_img']["name"];
	$benzersizsayi1=date("d-m-Y");
	$imgYol=substr($uploads_dir, 6)."/".$benzersizsayi1.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi1$name");


	$query = $conn->prepare("INSERT INTO menuler SET
		menu_adi = :menu_adi,
		menu_fiyat = :menu_fiyat,
		menu_img = :menu_img,
		menu_rest_id = :menu_rest_id
		");
	$insert = $query->execute(array(
		"menu_adi" => $_POST['menu_adi'],
		"menu_fiyat" => $_POST['menu_fiyat'],
		"menu_img" => $imgYol,
		"menu_rest_id" => $_POST['menu_rest_id']
	));

	if ($insert) {
		header("Location: ../menuler.php?status=success");
	}else {

		header("Location: ../menuler.php?status=error");
	}
}
/**************************************************/
if (isset($_POST['menuDuzenle'])) {
	$id=$_POST['menu_id'];


	if ($_FILES['menu_img']["size"] > 0) {
		$uploads_dir = '../../images';
		@$tmp_name = $_FILES['menu_img']["tmp_name"];
		$name = $_FILES['menu_img']["name"];
		$benzersizsayi1=date("d-m-Y");
		$imgYol=substr($uploads_dir, 6)."/".$benzersizsayi1.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi1$name");

		$query = $conn->prepare("UPDATE menuler SET
			menu_img = :menu_img	where menu_id = " . $id);
		$update = $query->execute(array(
			"menu_img" =>$imgYol
		));
	}

	$query = $conn->prepare("UPDATE menuler SET
		menu_adi = :menu_adi,
		menu_fiyat = :menu_fiyat
		where menu_id = " . $id);
	$insert = $query->execute(array(
		"menu_adi" => $_POST['menu_adi'],
		"menu_fiyat" => $_POST['menu_fiyat']
	));

	if ($insert) {
		header("Location: ../menu-duzenle.php?id=$id&status=success");
	}else {

		header("Location: ../menu-duzenle.php?id=$id&status=error");
	}
}



/**************************************************************/
if (isset($_POST['restoranDuzenle'])) {
	$id=$_POST['rest_id'];

	if ($_FILES['rest_logo']["size"] > 0) {
		$uploads_dir = '../../images';
		@$tmp_name = $_FILES['rest_logo']["tmp_name"];
		$name = $_FILES['rest_logo']["name"];
		$benzersizsayi1=date("d-m-Y");
		$imgYol=substr($uploads_dir, 6)."/".$benzersizsayi1.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi1$name");

		$query = $conn->prepare("UPDATE restoran SET
			rest_logo = :rest_logo	where rest_id = " . $id);
		$update = $query->execute(array(
			"rest_logo" =>$imgYol
		));
	}

	if ($_FILES['rest_bg']["size"] > 0) {
		$uploads_dir = '../../images';
		@$tmp_name = $_FILES['rest_bg']["tmp_name"];
		$name = $_FILES['rest_bg']["name"];
		$benzersizsayi1=date("d-m-Y");
		$imgYol=substr($uploads_dir, 6)."/".$benzersizsayi1.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi1$name");

		$query = $conn->prepare("UPDATE restoran SET
			rest_bg = :rest_bg	where rest_id = " . $id);
		$update = $query->execute(array(
			"rest_bg" =>$imgYol
		));
	}



	$query = $conn->prepare("UPDATE restoran SET
		rest_adi = :rest_adi,
		rest_tel = :rest_tel,
		rest_adres = :rest_adres,
		rest_aciklama = :rest_aciklama,
		rest_iban = :rest_iban,
		rest_odeme = :rest_odeme

		where rest_id=".$id);
	$insert = $query->execute(array(
		"rest_adi" => $_POST['rest_adi'],
		"rest_tel" => $_POST['rest_tel'],
		"rest_adres" => $_POST['rest_adres'],
		"rest_aciklama" => $_POST['rest_aciklama'],
		"rest_iban" => $_POST['rest_iban'],
		"rest_odeme" => $_POST['rest_odeme']
	));

	if ($insert) {
		header("Location: ../ayar.php?status=success");
	}else {

		header("Location: ../ayar.php?status=error");
	}
}

/************/



/**************************************************/
if (isset($_POST['yetkiliEkle'])) {


	if(isset($_POST['yetki_tipi']) and $_POST['yetki_tipi']=='yonetici'){ $durum = 1; } else { $durum = 0;}

	$query = $conn->prepare("INSERT INTO yetkili SET		
		yetkili_rest_id = :yetkili_rest_id,
		yetkili_adi = :yetkili_adi,
		yetkili_parola = :yetkili_parola,
		yetkili_tip = :yetkili_tip
		");
	$insert = $query->execute(array(
		"yetkili_rest_id" => $_POST['yetkili_rest_id'],
		"yetkili_adi" => $_POST['yetkili_adi'],
		"yetkili_parola" => $_POST['yetkili_parola'],
		"yetkili_tip" => $durum
	));

	if ($insert) {
		$id=$conn->lastInsertId();
		header("Location: ../yetkili-duzenle.php?id=$id&status=success");
	}else {

		header("Location: ../yetkili-duzenle.php?id=$id&status=error");
	}
}

/**********************************************************/


/**************************************************/
if (isset($_POST['yetkiliDuzenle'])) {
	$id=$_POST['yetkili_id'];
	if(isset($_POST['yetkili_tip']) and $_POST['yetkili_tip']=='yonetici'){ $durum = 1; } else { $durum = 0;}

	$query = $conn->prepare("UPDATE yetkili SET		
		yetkili_rest_id = :yetkili_rest_id,
		yetkili_adi = :yetkili_adi,
		yetkili_parola = :yetkili_parola,
		yetkili_tip = :yetkili_tip
		where yetkili_id = " . $id);
	$insert = $query->execute(array(
		"yetkili_rest_id" => $_POST['yetkili_rest_id'],
		"yetkili_adi" => $_POST['yetkili_adi'],
		"yetkili_parola" => $_POST['yetkili_parola'],
		"yetkili_tip" => $durum
	));

	if ($insert) {
		header("Location: ../yetkili-duzenle.php?id=$id&status=success");
	}else {

		header("Location: ../yetkili-duzenle.php?id=$id&status=error");
	}
}








?>