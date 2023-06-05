<?php include('header.php'); ?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Yetkililer</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item">Yetkililer</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">

        <div class="table-responsive p-3">
          <a href="yetkili-ekle.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Yetkili Ekle</a>

          <table class="table align-items-center table-flush" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>Kullanıcı Adı</th>
                <th>Parola</th>
                <th>Restoran</th>
                <th>Yetki</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $veriCek=$conn->prepare("SELECT * FROM yetkili,restoran WHERE restoran.rest_id=yetkili.yetkili_rest_id ORDER BY yetkili.yetkili_adi ASC ");
              $veriCek->execute();
              while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>

                  <td><a href="yetkili-duzenle.php?id=<?=$var['yetkili_id']; ?>" class="badge bg-dark text-white"><?=$var['yetkili_adi']; ?></a></td> 
                  <td><?=$var['yetkili_parola']; ?></td>   
                  <td><?=$var['rest_adi']; ?></td>      
                  <td><?php if($var['yetkili_tip']==1){ echo 'Yönetici';} else { echo 'Şef';} ?></td>         
                  <td>
                    <button value="<?php echo $var['yetkili_id']; ?>"  class="btn btn-danger btn-sm btn-yetkili-sil"> <i class="fa fa-trash"></i></button>
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
  $(".btn-yetkili-sil").click(function(e) {
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
          url: "ajax/yetkili_sil.php",
          data: { 
            islem: $(this).attr("islem"),
            id: $(this).val(), 
          },
          success: function(result) {
           swal("Silme İşlemi Başarılı", {
            icon: "success",
          }).then((result) => {
            window.location="yetkililer.php";
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


