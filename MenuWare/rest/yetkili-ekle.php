<?php include('header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Yetkili Ekle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="yetkililer.php">Yetkililer</a></li>
      <li class="breadcrumb-item">Yetkili Ekle</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Yetkili Ekle</h6>
        </div>

        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-md-4">
                <label for="yetkili_adi">Yetkili Kullanıcı Adı</label>
                <input type="hidden" name="yetkili_rest_id" value="<?=$restoran_id; ?>">

                <input type="text" class="form-control" id="yetkili_adi" placeholder="Yetkili Kullanıcı Adı" name="yetkili_adi" required>
              </div>
              <div class="form-group col-md-4">
                <label for="yetkili_parola">Yetkili Parola</label>
                <input type="password" class="form-control" id="yetkili_parola" placeholder="Yetkili Parola" name="yetkili_parola" required>
              </div>
              
              <div class="form-group col-md-4">
                <label class="mb-1">Yetki Tipi Belirleyin</label>
                <div class="d-flex justify-content-start align-items-start p-3">
                  <div class="form-group" style="margin-right: 35px">
                    <input class="form-check-input" value="yonetici" checked type="radio" name="yetki_tipi" id="yonetici">
                    <label class="form-check-label" for="yonetici">
                      Yönetici
                    </label>
                  </div>
                  <div class="form-group">
                    <input class="form-check-input" value="sef" type="radio" name="yetki_tipi" id="sef">
                    <label class="form-check-label" for="sef">
                      Şef
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success btn-block" name="yetkiliEkle"><i class="fas fa-plus"></i> Ekle</button> 
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>
