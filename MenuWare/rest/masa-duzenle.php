<?php include('header.php');
if (isset($_GET['id'])) {
  $id=$_GET['id'];

  $sorgu=$conn->prepare("SELECT * FROM masalar where masa_id= :masa_id");
  $sorgu->execute(array('masa_id' => $id));
  $masa=$sorgu->fetch(PDO::FETCH_ASSOC);
  $say=$sorgu->rowCount();

  if($say < 1){
    header("location:masalar.php");
  }
  $masa_id = $masa['masa_id'];
}else {
  header("location:masalar.php");
}

?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Masa Düzenle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="masalar.php">Masalar</a></li>
      <li class="breadcrumb-item">Masa Düzenle</li>
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


                  <div class="form-group col-md-3">
                    <input type="text" class="form-control" id="masa_no" placeholder="Masa No" name="masa_no" required  value="<?=$masa['masa_no']; ?>">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="hidden" name="masa_id" value="<?=$masa_id; ?>">
                    <select name="masa_kisi" class="form-control">
                      <option value="4" <?php if($masa['masa_kisi']==4) { echo 'selected';} ?> >4 Kişilik</option>
                      <option value="6" <?php if($masa['masa_kisi']==6) { echo 'selected';} ?> >6 Kişilik</option>
                      <option value="8" <?php if($masa['masa_kisi']==8) { echo 'selected';} ?> >8 Kişilik</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success btn-block" name="masaDuzenle"><i class="fas fa-edit"></i> Düzenle</button> 
                  </div>
                </div>
              </form>

            </div>

          </div>
          
        </div>
      </div>
    </div>
  </div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>
<script src="js/sweetalert.min.js"></script>




