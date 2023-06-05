<?php include('header.php');
if (isset($_GET['id'])) {
  $id=$_GET['id'];

  $veriCek=$conn->prepare("SELECT * FROM rezerveler where rezerve_id= :rezerve_id");
  $veriCek->execute(array('rezerve_id' => $id));
  $bilgi=$veriCek->fetch(PDO::FETCH_ASSOC);
  $say=$veriCek->rowCount();

  if($say < 1){
    header("location:rezervasyonlar.php");
  }
  $uye_id = $bilgi['rezerve_uye_id'];
  $rest_id = $bilgi['rezerve_rest_id'];
  $masa_id = $bilgi['rezerve_masa_id'];

  $uye = $conn->query('SELECT * FROM uye WHERE uye_id ='.$uye_id)->fetch(PDO::FETCH_ASSOC);
  $restoran = $conn->query('SELECT * FROM restoran WHERE rest_id ='.$rest_id)->fetch(PDO::FETCH_ASSOC);
  $masa = $conn->query('SELECT * FROM masalar WHERE masa_id ='.$masa_id)->fetch(PDO::FETCH_ASSOC);

}else {
  header("location:rezervasyonlar.php");
}

?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rezervasyon Detay</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="rezervasyonlar.php">Rezervasyonlar</a></li>
      <li class="breadcrumb-item active" aria-current="page">Rezervasyon Detay</li>
    </ol>
  </div>

  <div class="row">


    <div class="col-lg-12">
      <!-- General Element -->
      <div class="card mb-4 ">
        <div class="card-header py-3">
          <div class="row">
            <div class="col-md-4 mb-2">
              <b> <span>Üye Adı Soyadı:</span> </b>
              <h6 class="m-0"><?=$uye['uye_adi']; ?></h6>
            </div>
            <div class="col-md-4 mb-2">
              <b> <span>Üye Tel:</span> </b>
              <h6 class="m-0"><?=$uye['uye_tel']; ?></h6>
            </div>
            <div class="col-md-4 mb-2">
              <b> <span>Rezerve Tarihi:</span> </b>
              <h6 class="m-0"><?=date('d-m-Y H:i',strtotime($bilgi['rezerve_tarih'])); ?></h6>
            </div>
            <hr>
            <div class="col-md-4 mb-2">
              <b> <span>Restoran :</span> </b>
              <h6 class="m-0"><?=$restoran['rest_adi']; ?></h6>
            </div>
            <div class="col-md-4 mb-2">
              <b> <span>Masa No:</span> </b>
              <h6 class="m-0"><?=$masa['masa_no']; ?></h6>
            </div>
            
            <hr>
            <div class="col-md-4 mb-2">
              <b> <span class="">Sipariş Detayı:</span> </b>
              <h6 class="mt-2 font-weight-bold"><?=$bilgi['rezerve_siparis']; ?></h6>
            </div>
          </div>
        </div>
        <div class="card-body">

          <?php if($bilgi['rezerve_durum']==0){  ?>
            <button value="<?php echo $bilgi['rezerve_id']; ?>" islem="rezerveTamamla"  class="btn btn-success btn-block btn-rezerve-tamamla"> <i class="fa fa-check"></i> Rezervasyon Tamamla</button>
          <?php } else { ?>
            <button value="<?php echo $bilgi['rezerve_id']; ?>" islem="rezerveTamamla"  class="btn btn-danger btn-block btn-rezerve-tamamlama"> <i class="fa fa-times"></i> Rezervasyon Tamamlama</button>
          <?php } ?>

        </div>
      </div>
      <!-- Input Group -->

    </div>
  </div>


  <!-- Modal Logout -->


</div>
<!---Container Fluid-->
</div>
<!-- Footer -->


<?php include('footer.php'); ?>

<script type="text/javascript">
  $(".btn-rezerve-tamamla").click(function(e) {
    swal({
      title: "Tamamlama İşlemi",
      text: "İşlemi yapmak istediğinize emin misiniz?",
      icon: "success",
      buttons: true,
      dangerMode: true,
      buttons: ["Hayır", "Evet!"],
    })
    .then((willDelete) => {
      if (willDelete) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "ajax/rezerve_tamamla.php",
          data: { 
            id: $(this).val(), 
          },
          success: function(result) {
           swal("İşlem Başarılı", {
            icon: "success",
          }).then((result) => {
           location.reload();
         });
        },
        error: function(result) {
          swal("Hata.", {
            icon: "error",
          });

        }

      });
      } else {
        swal("İşlem İptal Edildi.", {
          icon: "error",

        });
      }
    });
  });






  $(".btn-rezerve-tamamlama").click(function(e) {
    swal({
      title: "Tamamlamama İşlemi",
      text: "İşlemi yapmak istediğinize emin misiniz?",
      icon: "error",
      buttons: true,
      dangerMode: true,
      buttons: ["Hayır", "Evet!"],
    })
    .then((willDelete) => {
      if (willDelete) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "ajax/rezerve_tamamlama.php",
          data: { 
            id: $(this).val(), 
          },
          success: function(result) {
           swal("İşlem Başarılı", {
            icon: "success",
          }).then((result) => {
           location.reload();
         });
        },
        error: function(result) {
          swal("Hata.", {
            icon: "error",
          });

        }

      });
      } else {
        swal("İşlem İptal Edildi.", {
          icon: "error",

        });
      }
    });
  });
</script>


