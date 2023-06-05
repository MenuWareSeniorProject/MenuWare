<?php include('header.php'); ?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menüler</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item">Menüler</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">

        <div class="table-responsive p-3">
          <a href="menu-ekle.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Menü Ekle</a>

          <table class="table align-items-center table-flush" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>Menü Görsel</th>
                <th>Menü Adı</th>
                <th>Menü Fiyat</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $veriCek=$conn->prepare("SELECT * FROM menuler,restoran WHERE restoran.rest_id=menuler.menu_rest_id and menuler.menu_rest_id = '{$restoran_id}' ORDER BY menuler.menu_adi ASC ");
              $veriCek->execute();
              while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>

                  <td><a href="menu-duzenle.php?id=<?=$var['menu_id']; ?>" class="badge bg-dark text-white">
                    <img src="../<?=$var['menu_img']; ?>" width="50px">
                  </a></td> 
                  <td><a href="menu-duzenle.php?id=<?=$var['menu_id']; ?>" class="badge bg-dark text-white"><?=$var['menu_adi']; ?></a></td> 
                  <td><?=$var['menu_fiyat']; ?></td>                 
                  <td>
                    <button value="<?php echo $var['menu_id']; ?>"  class="btn btn-danger btn-sm btn-menu-sil"> <i class="fa fa-trash"></i></button>
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
  $(".btn-menu-sil").click(function(e) {
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
          url: "ajax/menu_sil.php",
          data: { 
            islem: $(this).attr("islem"),
            id: $(this).val(), 
          },
          success: function(result) {
           swal("Silme İşlemi Başarılı", {
            icon: "success",
          }).then((result) => {
            window.location="menuler.php";
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


