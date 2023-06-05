<?php include('header.php'); ?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Üyeler</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item">Üyeler</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="table-responsive p-3">
          <a href="uye-ekle.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Üye Ekle</a>

          <table class="table align-items-center table-flush" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>Üye Adı Soyadı</th>
                <th>Tel</th>
                <th>Mail</th>
                <th>Parola</th>
                <th>Tarih</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $veriCek=$conn->prepare("SELECT * FROM uye ORDER BY uye_tarih DESC ");
              $veriCek->execute();
              while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                  <td>
                    <a href="uye-duzenle.php?id=<?=$var['uye_id']; ?>" class="badge bg-dark text-white p-2"><?=$var['uye_adi']; ?></a>
                  </td>

                  <td><?=$var['uye_tel']; ?></td>
                  <td><?=$var['uye_email']; ?></td>
                  <td><?=$var['uye_parola']; ?></td>

                  <td><?php echo date('d/m/Y H:s',strtotime($var['uye_tarih'])); ?></td>
                  <td>
                    <button value="<?php echo $var['uye_id']; ?>" islem="uyeSil"  class="btn btn-danger btn-sm btn-uye-sil"> <i class="fa fa-trash"></i></button>
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
  $(".btn-uye-sil").click(function(e) {
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
          url: "ajax/uye_sil.php",
          data: { 
            islem: $(this).attr("islem"),
            id: $(this).val(), 
          },
          success: function(result) {
           swal("Silme İşlemi Başarılı", {
            icon: "success",
          }).then((result) => {
           location.reload();
         });
        },
        error: function(result) {
          swal("Hata Silinmedi.", {
            icon: "danger",
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


