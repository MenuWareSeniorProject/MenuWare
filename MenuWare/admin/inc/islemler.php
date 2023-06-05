<?php 
include 'ayar.php';
ob_start();
session_start();


if (isset($_POST['girisYap'])) {
	$admin_kadi = $_POST['admin_kadi'];
	$admin_parola = $_POST['admin_parola'];
	if ($admin_kadi && $admin_parola) {
		$kullanicisor=$conn->prepare("SELECT * FROM admin WHERE admin_kadi = :admin_kadi AND admin_parola = :admin_parola");
		$kullanicisor->execute(array(
			'admin_kadi' => $admin_kadi,
			'admin_parola' => $admin_parola
		));
		$kullanici=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$say=$kullanicisor->rowCount();
		if ($say > 0) {
			$_SESSION['admin_giris'] = $kullanici['admin_id'];
			header("Location: ../index.php?status=success");
		} else {
			header("Location: ../giris.php?status=error");
		}
	}
}
/***************************** profilGuncelle ajax içerisinde ***********************/
if (isset($_POST['profilGuncelle'])) {
	$user_kod=$_POST['admin_id'];
	$admin_kadi=$_POST['admin_kadi'];
	$menuquery = $conn->prepare("UPDATE admin SET
		admin_kadi = :admin_kadi
		where admin_id=$user_kod
		");
	$insert = $menuquery->execute(array(
		"admin_kadi" => $admin_kadi
	));
	if ( $insert ){
		$_SESSION['admin_giris'] = $user_kod;
		header("Location: ../profil.php?status=success");
	}
	else
	{
		header("Location: ../profil.php?status=error");
	}
}

/***************************** sifre Guncelle ***********************/
if (isset($_POST['sifreGuncelle'])) {
	$user_kod=$_POST['admin_id'];
	$currentPass=$_POST['currentPass'];
	$sifre_1=$_POST['newPass1'];
	$sifre_2=$_POST['newPass2'];
	$kullanicisor=$conn->prepare("SELECT * FROM admin WHERE admin_id = :admin_id AND admin_parola = :admin_parola");
	$kullanicisor->execute(array(
		'admin_id' => $user_kod,
		'admin_parola' => $currentPass
	));
	$say=$kullanicisor->rowCount();
	if ($say > 0) {
		if ($sifre_1==$sifre_2) {
			$menuquery = $conn->prepare("UPDATE admin SET
				admin_parola = :admin_parola
				where admin_id=$user_kod
				");
			$insert = $menuquery->execute(array(
				"admin_parola" => $sifre_1
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


if (isset($_POST['siteAyarGuncelle'])) {
  ##Logo Yüklenmişse
	if ($_FILES['ayar_logo']['size'] > 0 ) {
		$uploads_dir = '../../img';
		@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
		$name = $_FILES['ayar_logo']["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2;
		$imgYol =substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
		$query = $conn->prepare("UPDATE ayarlar SET
			ayar_logo = :ayar_logo
			");
		$update = $query->execute(array(
			"ayar_logo" => $imgYol
		));
	}

	$query = $conn->prepare("UPDATE ayarlar SET
		ayar_title = :ayar_title,
		ayar_aciklama = :ayar_aciklama
		");
	$update = $query->execute(array(
		"ayar_title" => $_POST['ayar_title'],
		"ayar_aciklama" => $_POST['ayar_aciklama']
	));
	if ($update) {
		header("location:../ayar.php?status=success");
	}else {

		header("location:../ayar.php?status=error");
	}

}
/*************************************************************/



/**************************************************/
if (isset($_POST['adminEkle'])) {

	$query = $conn->prepare("INSERT INTO admin SET		
		admin_kadi = :admin_kadi,
		admin_parola = :admin_parola
		");
	$insert = $query->execute(array(
		"admin_kadi" => $_POST['admin_kadi'],
		"admin_parola" => $_POST['admin_parola']
	));

	if ($insert) {
		$id=$conn->lastInsertId();
		header("Location: ../admin-duzenle.php?id=$id&status=success");
	}else {

		header("Location: ../admin-duzenle.php?id=$id&status=error");
	}
}

/**********************************************************/


/**************************************************/
if (isset($_POST['adminDuzenle'])) {
	$id=$_POST['admin_id'];

	$query = $conn->prepare("UPDATE admin SET		
		admin_kadi = :admin_kadi,
		admin_parola = :admin_parola
		where admin_id = " . $id);
	$insert = $query->execute(array(
		"admin_kadi" => $_POST['admin_kadi'],
		"admin_parola" => $_POST['admin_parola']
	));

	if ($insert) {
		header("Location: ../admin-duzenle.php?id=$id&status=success");
	}else {

		header("Location: ../admin-duzenle.php?id=$id&status=error");
	}
}



/**************************************************************/


/**************************** ÜST KATEGORİ Ekle ***************************/
if (isset($_POST['restoranEkle'])) {

	$uploads_dir = '../../images/';
	@$tmp_name = $_FILES['rest_logo']["tmp_name"];
	$name = $_FILES['rest_logo']["name"];
	$benzersizsayi1=date("d-m-Y");
	$imgYol=substr($uploads_dir, 6)."/".$benzersizsayi1.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi1$name");


	$uploads_dir = '../../images/';
	@$tmp_name = $_FILES['rest_bg']["tmp_name"];
	$name = $_FILES['rest_bg']["name"];
	$benzersizsayi1=date("d-m-Y");
	$imgYol2=substr($uploads_dir, 6)."/".$benzersizsayi1.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi1$name");

	$query = $conn->prepare("INSERT INTO restoran SET
		rest_logo = :rest_logo,
		rest_adi = :rest_adi,
		rest_bg = :rest_bg,
		rest_tel = :rest_tel,
		rest_adres = :rest_adres,
		rest_aciklama = :rest_aciklama
		");
	$insert = $query->execute(array(
		"rest_logo" =>$imgYol,
		"rest_adi" => $_POST['rest_adi'],
		"rest_bg" =>$imgYol2,
		"rest_tel" => $_POST['rest_tel'],
		"rest_adres" => $_POST['rest_adres'],

		"rest_aciklama" => $_POST['rest_aciklama']
	));

	if ($insert) {
		header("Location: ../restoranlar.php?status=success");
	}else {

		header("Location: ../restoranlar.php?status=error");
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
		rest_aciklama = :rest_aciklama

		where rest_id=".$id);
	$insert = $query->execute(array(
		"rest_adi" => $_POST['rest_adi'],
		"rest_tel" => $_POST['rest_tel'],
		"rest_adres" => $_POST['rest_adres'],

		"rest_aciklama" => $_POST['rest_aciklama']
	));

	if ($insert) {
		header("Location: ../restoran-duzenle.php?id=$id&status=success");
	}else {

		header("Location: ../restoran-duzenle.php?id=$id&status=error");
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



/**************************************************/
if (isset($_POST['uyeEkle'])) {

	$uyeSor=$conn->prepare("SELECT * FROM uye WHERE uye_email = :uye_email");
	$uyeSor->execute(array(
		'uye_email' => $_POST['uye_email']
	));
	$say=$uyeSor->rowCount();
	if ($say>0) {
		header("location: ../uye-ekle.php?status=invalid");
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
			header("Location: ../uye-duzenle.php?id=$id&status=success");
		}else {

			header("Location: ../uye-duzenle.php?id=$id&status=error");
		}
	}
}

/**********************************************************/


/**************************************************/
if (isset($_POST['uyeDuzenle'])) {
	$id=$_POST['uye_id'];

	$uyeSor=$conn->prepare("SELECT * FROM uye WHERE uye_email = :uye_email and uye_id != :uye_id");
	$uyeSor->execute(array(
		'uye_email' => $_POST['uye_email'],
		'uye_id' => $_POST['uye_id']
	));
	$say=$uyeSor->rowCount();
	if ($say>0) {
			header("Location: ../uye-duzenle.php?id=$id&status=invalid");
	} else {

		$query = $conn->prepare("UPDATE uye SET		
			uye_email = :uye_email,
			uye_adi = :uye_adi,
			uye_parola = :uye_parola,
			uye_tel = :uye_tel
			where uye_id = " . $id);
		$insert = $query->execute(array(
			"uye_email" => $_POST['uye_email'],
			"uye_adi" => $_POST['uye_adi'],
			"uye_parola" => $_POST['uye_parola'],
			"uye_tel" => $_POST['uye_tel']
		));

		if ($insert) {
			header("Location: ../uye-duzenle.php?id=$id&status=success");
		}else {

			header("Location: ../uye-duzenle.php?id=$id&status=error");
		}
	}
}







?>