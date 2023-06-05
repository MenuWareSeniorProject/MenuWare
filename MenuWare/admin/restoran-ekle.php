<?php include('header.php'); ?>


<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Restaurant Ekle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="firmalar.php">Restaurantlar</a></li>
      <li class="breadcrumb-item">Restaurant Ekle</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Restaurant Ekle</h6>
        </div>

        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">

                         

              <div class="form-group col-md-4">
                <label for="rest_logo">Restaurant Logo</label>
                <input type="file" class="form-control" id="rest_logo" name="rest_logo" required>
              </div>


              <div class="form-group col-md-4">
                <label for="rest_bg">Restaurant Arkaplan</label>
                <input type="file" class="form-control" id="rest_bg" name="rest_bg" required>
              </div>
              <div class="form-group col-md-4">
                <label for="rest_adi">Restaurant Adı</label>
                <input type="text" class="form-control" id="rest_adi" placeholder="Restaurant Adı" name="rest_adi" required>
              </div>

              <div class="form-group col-md-8">
                <label for="rest_adres">Restaurant Adres</label>
                <input type="text" class="form-control" id="rest_adres" placeholder="Restaurant Adres" name="rest_adres" required>
              </div>
              


              <div class="form-group col-md-4">
                <label for="rest_tel">Restaurant Tel</label>
                <input type="number" min="0" class="form-control" id="rest_tel" placeholder="Restaurant Tel" name="rest_tel" required>
              </div>

              <div class="form-group col-md-12">
                <label for="rest_aciklama">Restaurant Hakkında</label>
                <textarea id="rest_aciklama"  name="rest_aciklama"></textarea>
              </div>


            </div>
            <button type="submit" class="btn btn-success btn-block" name="restoranEkle"><i class="fas fa-plus"></i> Ekle</button> 
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>
