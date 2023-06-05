<?php include('header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menü Ekle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="menuler.php">Menüler</a></li>
      <li class="breadcrumb-item">Menü Ekle</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Menü Ekle</h6>
        </div>

        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-md-4">
                <label for="menu_adi">Menü Adı</label>
                <input type="hidden" name="menu_rest_id" value="<?=$restoran_id; ?>">

                <input type="text" class="form-control" id="menu_adi" placeholder="Menü Adı" name="menu_adi" required>
              </div>
              <div class="form-group col-md-4">
                <label for="menu_fiyat">Menü Fiyat</label>
                <input type="number" class="form-control" id="menu_fiyat" placeholder="Menü Fiyat" name="menu_fiyat" required>
              </div>
              <div class="form-group col-md-4">
                <label for="menu_img">Menü Görsel</label>
                <input type="file" class="form-control" id="menu_img" placeholder="Menü Görsel" name="menu_img" required>
              </div>

            </div>
            <button type="submit" class="btn btn-success btn-block" name="menuEkle"><i class="fas fa-plus"></i> Ekle</button> 
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>
