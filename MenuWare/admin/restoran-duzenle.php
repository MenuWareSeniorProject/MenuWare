<?php include('header.php');
if (isset($_GET['id'])) {
  $id=$_GET['id'];

  $restSor=$conn->prepare("SELECT * FROM restoran where rest_id= :rest_id");
  $restSor->execute(array('rest_id' => $id));
  $rest=$restSor->fetch(PDO::FETCH_ASSOC);
  $say=$restSor->rowCount();

  if($say < 1){
    header("location:restoranlar.php");
  }
  $rest_id = $rest['rest_id'];
}else {
  header("location:restoranlar.php");
}

?>

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Restaurant Düzenle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="restoranlar.php">Restaurantlar</a></li>
      <li class="breadcrumb-item">Restaurant Düzenle</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Restaurant Düzenle</h6>
        </div>

        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">

              <div class="col-lg-6 mb-3">
                <img src="../<?=$rest['rest_logo']; ?>" style="max-width: 100%;max-height: 100px;object-fit: cover;">
                <hr>
              </div>
              <div class="col-lg-6 mb-3">
                <img src="../<?=$rest['rest_bg']; ?>" style="max-width: 100%;max-height: 100px;object-fit: cover;">
                <hr>
              </div>

              <div class="form-group col-md-4">
                <label for="rest_logo">Restaurant Logo</label>
                <input type="file" class="form-control" id="rest_logo" name="rest_logo">
              </div>


              <div class="form-group col-md-4">
                <label for="rest_bg">Restaurant Arkaplan</label>
                <input type="file" class="form-control" id="rest_bg" name="rest_bg">
              </div>
              <div class="form-group col-md-4">
                <label for="rest_adi">Restaurant Adı</label>
                <input type="hidden"  name="rest_id" value="<?=$rest['rest_id']; ?>">
                <input type="text" class="form-control" id="rest_adi" placeholder="Restaurant Adı" name="rest_adi" value="<?=$rest['rest_adi']; ?>">
              </div>

              <div class="form-group col-md-8">
                <label for="rest_adres">Restaurant Adres</label>
                <input type="text" class="form-control" id="rest_adres" placeholder="Restaurant Adres" name="rest_adres" value="<?=$rest['rest_adres']; ?>">
              </div>



              <div class="form-group col-md-4">
                <label for="rest_tel">Restaurant Tel</label>
                <input type="number" min="0" class="form-control" id="rest_tel" placeholder="Restaurant Tel" name="rest_tel" value="<?=$rest['rest_tel']; ?>">
              </div>

              <div class="form-group col-md-12">
                <label for="rest_aciklama">Restaurant Hakkında</label>
                <textarea id="rest_aciklama"  name="rest_aciklama"><?=$rest['rest_aciklama']; ?></textarea>
              </div>


            </div>
            <button type="submit" class="btn btn-success btn-block" name="restoranDuzenle"><i class="fas fa-edit"></i> Düzenle</button> 
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>