<?php include('header.php'); ?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Masalar</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item">Masalar</li>
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
                  <div class="col-lg-12">
                    <h4>Masa Ekle</h4>
                  </div>
                  <?php 
                  $masaSayi = $conn->query("SELECT count(*) AS toplam FROM masalar WHERE masa_rest_id = '{$restoran_id}'")->fetch(PDO::FETCH_ASSOC);
                  $sayi = $masaSayi['toplam'] + 1;
                  ?>

                  <div class="form-group col-md-3">
                    <input type="number" min="1"  value="<?=$sayi; ?>" class="form-control" id="masa_no" placeholder="Masa No" name="masa_no" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="hidden" name="masa_rest_id" value="<?=$restoran_id; ?>">
                    <select name="masa_kisi" class="form-control">
                      <option value="4">4 Kişilik</option>
                      <option value="6">6 Kişilik</option>
                      <option value="8">8 Kişilik</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success btn-block" name="masaEkle"><i class="fas fa-plus"></i> Ekle</button> 
                  </div>
                </div>
              </form>

            </div>

          </div>
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>Masa No</th>
                <th>Masa Kişi</th>
                <th>İşlem</th>
              </tr>
            </thead>
            
            <tbody>
             <?php 
             $veriCek=$conn->prepare("SELECT * FROM masalar WHERE masa_rest_id = '{$restoran_id}' ORDER BY masa_no ASC");
             $veriCek->execute();
             while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td><?=$var['masa_no']; ?></td>
                <td><?=$var['masa_kisi']; ?></td>
                <td>
                  <a href="masa-duzenle.php?id=<?=$var['masa_id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>


                  <button value="<?php echo $var['masa_id']; ?>" islem="masaSil"  class="btn btn-danger btn-sm btn-masa-sil"> <i class="fa fa-trash"></i></button>
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
  $(".btn-masa-sil").click(function(e) {
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
          url: "ajax/masa_sil.php",
          data: { 
            islem: $(this).attr("islem"),
            id: $(this).val(), 
          },
          success: function(result) {
           console.log(result);
           swal("Silme İşlemi Başarılı", {
            icon: "success",
          }).then((result) => {
           location.reload();
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


