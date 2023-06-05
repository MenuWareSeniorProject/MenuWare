<?php include('header.php');
if (isset($_GET['id'])) {
  $id=$_GET['id'];

  $uyeSor=$conn->prepare("SELECT * FROM uye where uye_id= :uye_id");
  $uyeSor->execute(array('uye_id' => $id));
  $uye=$uyeSor->fetch(PDO::FETCH_ASSOC);
  $say=$uyeSor->rowCount();

  if($say < 1){
    header("location:uyeler.php");
  }
  $uye_id = $uye['uye_id'];
}else {
  header("location:uyeler.php");
}

?>

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Üye Düzenle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="uyeler.php">Üyeler</a></li>
      <li class="breadcrumb-item">Üye Düzenle</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Üye Düzenle</h6>
        </div>

        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">

              <div class="form-group col-md-6">
                <label for="uye_email">Üye E-posta</label>
                <input type="email" class="form-control" id="uye_email" value="<?=$uye['uye_email']; ?>" placeholder="Üye E-posta" name="uye_email" required>
              </div>

              <div class="form-group col-md-6">
                <label for="uye_parola">Üye Parola</label>
                <input type="text" class="form-control" id="uye_parola" value="<?=$uye['uye_parola']; ?>" placeholder="Üye Parola" name="uye_parola" required>
              </div>
              <div class="form-group col-md-6">
                <label for="uye_adi">Üye Adı</label>
                <input type="hidden" name="uye_id" value="<?=$uye_id; ?>">
                <input type="text" class="form-control" id="uye_adi" value="<?=$uye['uye_adi']; ?>" placeholder="Üye Adı" name="uye_adi" required>
              </div>


              <div class="form-group col-md-6">
                <label for="uye_tel">Üye Tel</label>
                <input type="number" class="form-control" id="uye_tel" value="<?=$uye['uye_tel']; ?>" placeholder="Üye Tel" name="uye_tel" required>
              </div>



            </div>
            <button type="submit" class="btn btn-primary btn-block" name="uyeDuzenle"><i class="fas fa-edit"></i> Güncelle</button> 
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header">
          <h3>Üye Rezervasyonları</h3>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>Restoran</th>
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
                rezerveler.rezerve_uye_id = uye.uye_id and
                rezerveler.rezerve_masa_id = masalar.masa_id and rezerveler.rezerve_uye_id = '{$id}'

                ORDER BY rezerveler.rezerve_tarih DESC ");
              $veriCek->execute();
              while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>

                  <td>
                    <a href="restoran-duzenle.php?id=<?=$var['rest_id']; ?>" class="badge bg-warning text-white p-2"><?=$var['rest_adi']; ?></a>
                  </td>
                  <td><?=$var['masa_no']; ?></td>
                  <td><?php if($var['rezerve_durum']==1){ echo "<span class='text-danger'>Tamamlanmadı</span>";} else { echo "<span class='text-success'>Tamamlandı</span>"; } ?></td>


                  <td><?php echo date('d/m/Y H:s',strtotime($var['rezerve_tarih'])); ?></td>
                  <td>
                    <a href="rezerve-gor.php?id=<?=$var['rezerve_id']; ?>" class="badge bg-primary text-white p-2"> <i class="fa fa-eye"></i></a>
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
