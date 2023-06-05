<?php include('header.php'); 
sessionkontrol();

if(isset($_GET['rezerveİptal'])){
	$id = $_GET['rezerveİptal'];
	
	
$sonuc = $conn->exec("DELETE FROM rezerveler WHERE rezerve_id = '$id'");

	if ( $sonuc ){
		header('location:rezervasyonlarim.php?status=success');
	}
	else
	{
		header('location:rezervasyonlarim.php?status=error');
	}
}


$uyeSorgu=$conn->prepare("SELECT * FROM uye where uye_id= :uye_id");
$uyeSorgu->execute(array('uye_id' => $_SESSION['uye_giris']));
$uye=$uyeSorgu->fetch(PDO::FETCH_ASSOC);
$say=$uyeSorgu->rowCount();
$uye_id = $uye['uye_id'];
if($say < 1){
	header("location:index.php");
}?>






<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Rezervasyonlarım</h2>
				<nav id="breadcrumbs">
					<ul>
						<li><a href="./">Anasayfa</a></li>
						<li>Rezervasyonlarım</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<section class="fullwidth_block margin-top-0 padding-top-0 padding-bottom-75" data-background-color="#fff"> 
	<div class="container"> 
		
		<div class="row">
			<div class="col-md-8">			  
				<div class="style-2">
					<div class="accordion">
						<?php 
						$veriCek=$conn->prepare("SELECT * FROM rezerveler WHERE rezerve_uye_id = '{$uye_id}' ORDER BY rezerve_tarih DESC ");
						$veriCek->execute();
						while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) {
							$masa_id = $var['rezerve_masa_id'];
							$rest_id = $var['rezerve_rest_id'];
							$masaDetay = $conn->query("SELECT * FROM masalar WHERE masa_id = '{$masa_id}'")->fetch(PDO::FETCH_ASSOC);
							$restDetay = $conn->query("SELECT * FROM restoran WHERE rest_id = '{$rest_id}'")->fetch(PDO::FETCH_ASSOC);
							?>



							<h3>
								<span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> <?=date('d.m.Y H:i',strtotime($var['rezerve_tarih'])); ?>  - <?=$restDetay['rest_adi']; ?></h3>
								<div>
									<p> Masa: <?=$masaDetay['masa_no']; ?> </p>
									<p> Sipariş Detayı: <?=$var['rezerve_siparis']; ?> </p>
									
									<?php if($var['rezerve_durum']==0){ ?>
										<p> <a href="?rezerveİptal=<?=$var['rezerve_id']; ?>" class="button border with-icon"> Rezervasyonu İptal Et</a></p>
									<?php } else { ?>
										<p>Rezervasyon Tamamlandı</p>
									<?php } ?>
								</div>

							<?php } ?>


						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="utf_box_widget margin-bottom-70">
						<h3><i class="sl sl-icon-user"></i> Bağlantılar</h3>
						<div class="utf_sidebar_textbox">
							<ul class="utf_contact_detail">

								<li><a href="profil.php">Hesabım</a></li>
								<li><a href="cikis.php">Çıkış Yap</a></li>
							</ul>
						</div>  
					</div>
				</div>
			</div>	
		</div>
	</div>

	<?php include('footer.php'); ?>