<?php include('header.php'); ?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Restaurantlar</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item">Restaurantlar</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="table-responsive p-3">

          <a href="restoran-ekle.php" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Restaurant Ekle</a>
          <table class="table align-items-center table-flush" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>Logo</th>
                <th>Restaurant</th>
                <th>Tel</th>
                <th>Adres</th>
                <th>Tarih</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $veriCek=$conn->prepare("SELECT * FROM restoran ORDER BY rest_tarih DESC ");
              $veriCek->execute();
              while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                  <td><img src="../<?=$var['rest_logo']; ?>" class="border-radius border border-dark rounded-circle" style="max-width: 70px;height: 70px;object-fit: cover;"></td>
                  <td><a href="restoran-duzenle.php?id=<?=$var['rest_id']; ?>" class="badge bg-dark text-white"><?=$var['rest_adi']; ?></a></td>
                  
                  <td><?php echo  $var['rest_tel']; ?></td>
                  <td><?php echo  $var['rest_adres']; ?></td>
                  <td><?php echo date('d/m/Y H:s',strtotime($var['rest_tarih'])); ?></td>
                  <td>
                    <button value="<?php echo $var['rest_id']; ?>" islem="soforSil"  class="btn btn-danger btn-sm btn-sofor-sil"> <i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>
<script src="js/sweetalert.min.js"></script>

<script type="text/javascript">
  $(".btn-sofor-sil").click(function(e) {
    swal({
      title: "Silme İşlemi",
      text: "Silinen kayıtlar geri alınmaz silmek istediğinize emin misiniz?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      buttons: ["Hayır Silme", "Evet Sil!"],
    })
    .then((willDelete) => {
      if (willDelete) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "ajax/restoran_sil.php",
          data: { 
            islem: $(this).attr("islem"),
            id: $(this).val(), 
          },
          success: function(result) {
           swal("Silme İşlemi Başarılı", {
            icon: "success",
          }).then((result) => {
            window.location="restoranlar.php";
          });
        },
        error: function(result) {
          swal("Hata Silinmedi.", {
            icon: "success",
          });

        }

      });
      } else {
        swal("Silme İşlemi İptal Edildi.", {
          icon: "error",

        });
      }
    });
  });
</script>


