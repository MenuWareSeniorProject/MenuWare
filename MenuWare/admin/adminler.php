<?php include('header.php'); ?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Adminler</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item">Adminler</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">

        <div class="table-responsive p-3">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">



            <div class="col-lg-12">
              <!-- General Element -->

              <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="admin_adi">Admin Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="admin_kadi" placeholder="Admin Kullanıcı Adı" name="admin_kadi">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="admin_parola">Admin Parola</label>
                    <input type="password" class="form-control" id="admin_parola" placeholder="Admin Parola" name="admin_parola">
                  </div>
                </div>
                <button type="submit" class="btn btn-success btn-block" name="adminEkle"><i class="fas fa-plus"></i> Ekle</button> 
              </form>

            </div>

          </div>
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>Admin Adı</th>
                <th>Kayıt Trh:</th>
                <th>İşlem</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Admin Adı</th>
                <th>Kayıt Trh:</th>
                <th>İşlem</th>
              </tr>
            </tfoot>
            <tbody>
             <?php 
             $veriCek=$conn->prepare("SELECT * FROM admin ORDER BY admin_kadi ASC");
             $veriCek->execute();
             while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td><a href="admin-duzenle.php?id=<?=$var['admin_id']; ?>" class="badge bg-dark text-white"><?=$var['admin_kadi']; ?></a></td>
                <td><?=date('d/m/Y H:i',strtotime($var['admin_tarih'])); ?></td>
                <td>
                  <button value="<?php echo $var['admin_id']; ?>" islem="soforSil"  class="btn btn-danger btn-sm btn-admin-sil"> <i class="fa fa-trash"></i></button>
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
  $(".btn-admin-sil").click(function(e) {
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
          url: "ajax/admin_sil.php",
          data: { 
            islem: $(this).attr("islem"),
            id: $(this).val(), 
          },
          success: function(result) {
           console.log(result);
           swal("Silme İşlemi Başarılı", {
            icon: "success",
          }).then((result) => {
            window.location="adminler.php";
            console.log(result);
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


