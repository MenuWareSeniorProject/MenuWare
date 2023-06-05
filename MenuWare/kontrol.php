<?php
include('inc/ayar.php');


$tarih = $_POST['tarih'];



$saat='09:00';
$new = date('d-m-Y',strtotime($tarih));
?>
<select class="form-control" id="baslangic">

	<?php 
	for ($i=0; $i < 15  ; $i++) { $sure=$i*6; 

		$yeniTarih = date('H:i',strtotime('+'.$sure.'0 minutes',strtotime($saat)));

		$gelenTarih=date('Y-m-d',strtotime($new)).' '.$yeniTarih;

		echo ' <option value="'.$yeniTarih.'">'.$yeniTarih.'</option>';


	}

	?>

</select>



<script type="text/javascript">

	$(document).ready(function() {
		$("#baslangic").change(function(){
			var baslangic = $("#baslangic").val();
			var tarih = $("#tarih").val();
			var rest_id = $("#rest_id").val();
			$.ajax({
				type: 'post',
				url: 'saat-kontrol.php',
				data: {baslangic: baslangic,tarih: tarih,rest_id: rest_id},
				success: function(r) {
					$('.screenNameError2').html(r);
				}
			});
		});
	});
</script>
