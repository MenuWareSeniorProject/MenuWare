<?php include('header.php'); ?>


<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Üye Ekle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="uyeler.php">Üyeler</a></li>
      <li class="breadcrumb-item">Üye Ekle</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Üye Ekle</h6>
        </div>

        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">


              <div class="form-group col-md-6">
                <label for="uye_email">Üye E-posta</label>
                <input type="email" class="form-control" id="uye_email" placeholder="Üye E-posta" name="uye_email" required>
              </div>

              <div class="form-group col-md-6">
                <label for="uye_parola">Üye Parola</label>
                <input type="password" class="form-control" id="uye_parola" placeholder="Üye Parola" name="uye_parola" required>
              </div>
              <div class="form-group col-md-6">
                <label for="v_adi">Üye Adı</label>
                <input type="text" class="form-control" id="uye_adi" placeholder="Üye Adı" name="uye_adi" required>
              </div>


              <div class="form-group col-md-6">
                <label for="uye_tel">Üye Tel</label>
                <input type="number" class="form-control" id="uye_tel" placeholder="Üye Tel" name="uye_tel" required>
              </div>

            </div>
            <button type="submit" class="btn btn-success btn-block" name="uyeEkle"><i class="fas fa-plus"></i> Ekle</button> 
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>
