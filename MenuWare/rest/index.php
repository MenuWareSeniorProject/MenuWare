<?php include('header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Anasayfa</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
    </ol>
  </div>

  <div class="row mb-3">

    <div class="col-xl-4 col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Rezervasyonlar</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $rez_sayi['toplam']; ?></div>
              
            </div>
            <div class="col-auto">
              <i class="fas fa-tags fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    
    <div class="col-xl-4 col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Onaylanan <br> Rezervasyonlar</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $rezOnay_sayi['toplam']; ?></div>
              
            </div>
            <div class="col-auto">
              <i class="fas fa-check fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Onaylanmayan <br> Rezervasyonlar</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $rezOnaysiz_sayi['toplam']; ?></div>
              
            </div>
            <div class="col-auto">
              <i class="fas fa-check fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-12 col-lg-12 mb-4" style="border-radius: 10px;">
      <div class="card"  style="background: #3d4f57 !important;color:white !important;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"  style="background: #3d4f57 !important;color: white !important;">
          <h6 class="m-0 font-weight-bold text-white">Rezervasyonlar</h6>
          <a class="m-0 float-right btn btn-info btn-sm" href="rezervasyonlar.php">Tümü <i
            class="fas fa-chevron-right"></i></a>
          </div>
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                  <th>Müşteri Adı Soyadı</th>
                  <th>Tel</th>
                  <th>Masa</th>
                  <th>Rezerve Durum</th>
                  <th>Tarih</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $veriCek=$conn->prepare("SELECT * FROM rezerveler,uye,masalar,restoran WHERE
                  rezerveler.rezerve_rest_id = restoran.rest_id and
                  rezerveler.rezerve_rest_id = '{$restoran_id}' and
                  rezerveler.rezerve_uye_id = uye.uye_id and
                  rezerveler.rezerve_masa_id = masalar.masa_id

                  ORDER BY rezerveler.rezerve_tarih DESC ");
                $veriCek->execute();
                while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr class="text-white">
                    <td>
                      <?php if($kullanici['yetkili_tip']==0){ ?>
                        <?=$var['uye_adi']; ?>
                      <?php } else {
                        echo $var['uye_adi'];
                      } ?>
                    </td>

                    <td><?=$var['uye_tel']; ?></td>

                    <td><?=$var['masa_no']; ?></td>
                    <td><?php if($var['rezerve_durum']==0){ echo "<span class='text-danger'>Onaylanmadı</span>";} else { echo "<span class='text-success'>Onaylandı</span>"; } ?></td>


                    <td><?php echo date('d/m/Y H:s',strtotime($var['rezerve_tarih'])); ?></td>
                    <td>
                      <a href="rezerve-gor.php?id=<?=$var['rezerve_id']; ?>" class="badge bg-primary text-white p-2"> <i class="fa fa-eye"></i></a>

                      <?php if($kullanici['yetkili_tip']==0){ ?>
                        <button value="<?php echo $var['rezerve_id']; ?>" islem="rezerveSil"  class="btn btn-danger btn-sm btn-rezerve-sil"> <i class="fa fa-trash"></i></button>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
    <!--Row-->


  </div>
  <!---Container Fluid-->
</div>
<!-- Footer -->
<?php include('footer.php'); ?>

<script type="text/javascript">
  $(".btn-rezerve-sil").click(function(e) {
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
          url: "ajax/rezerve_sil.php",
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


