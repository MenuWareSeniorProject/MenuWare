<?php
include('inc/ayar.php');


$baslangic = date('H:i',strtotime('+30 minutes',strtotime($_POST['baslangic'])));
$tarih = $_POST['tarih'];
$rest_id = $_POST['rest_id'];

$kontrol_tarihi = $tarih.' '.$_POST['baslangic'].':00';

$rest_bilgi = $conn->query("SELECT * FROM restoran WHERE rest_id = '{$rest_id}' ")->fetch(PDO::FETCH_ASSOC);

?>


<div class="utf_pricing_list_section">
	<div class="row" style="background:url('<?php echo $rest_bilgi["rest_bg"]; ?>');padding: 15px;border-radius: 15px;">
		<?php 
		$veriCek=$conn->prepare("SELECT * FROM masalar WHERE masa_rest_id = '{$rest_id}' ORDER BY masa_no ASC");
		$veriCek->execute();
		while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) {
			$masa_id = $var['masa_id'];

			$masaBosmu=$conn->prepare("SELECT * FROM rezerveler WHERE rezerve_durum = 1 and rezerve_masa_id =:masa_id and rezerve_tarih = :rezerve_tarih");
			$masaBosmu->execute(array(
				'rezerve_tarih' => $kontrol_tarihi,
				'masa_id' => $masa_id
			));
			$rezerveBilgileri=$masaBosmu->fetch(PDO::FETCH_ASSOC);
			$masaDoluMu=$masaBosmu->rowCount();



			if ($masaDoluMu > 0) { ?>



				<div class="col-md-2" style="    background: #f3f3f3c2;border-radius: 10px;padding: 10px;margin:5px">
					<div class="d-flex justify-content-start">
						<img src="images/<?=$var['masa_kisi'].'-masa-dolu.png'; ?>" style="width: 100%;max-height: 150px;"></a>
						<label class="align-middle" style="background: #ffffff75;color: black;padding: 0px 5px;font-size: 12px;border-radius: 5px;"><?=$var['masa_no'];?> Nolu Masa</label>
					</div>
				</div>




			<?php }
			else { ?>


				<div class="col-md-2" style="    background: #f3f3f3c2;border-radius: 10px;padding: 10px;margin:5px">
					<div class="d-flex justify-content-start">
						<a href="rezervasyon.php?rest_id=<?=$rest_id; ?>&id=<?=$masa_id; ?>&tarih=<?=$kontrol_tarihi ?>">
							<img src="images/<?=$var['masa_kisi'].'-masa-bos.png'; ?>" style="width: 100%;max-height: 150px;"></a>
							<label class="align-middle" style="background: #ffffff75;color: black;padding: 0px 5px;font-size: 12px;border-radius: 5px;"><?=$var['masa_no'];?> Nolu Masa</label>
						</div>
					</div>
				<?php }

				?>
			<?php } ?>
		</div>
	</div>
