<?php include('header.php'); ?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">Hesap Ayarları</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item">Hesap Ayarları</li>
  </ol>
</div>

<div class="row">


    <div class="col-lg-12">

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                         <h5 class="card-title">Hesap Ayarları</h5>
                         <form class="forms-layouts" action="inc/islemler.php" method="POST">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="kullanıcıAd" class="">  Kullanıcı Adı</label>
                                        <input name="yetkili_id" type="hidden" class="form-control" required=""  value="<?=$kullanici['yetkili_id']; ?>">
                                        <input name="yetkili_adi" type="text" class="form-control" required=""  value="<?=$kullanici['yetkili_adi']; ?>">
                                    </div>
                                </div>
                            </div>
                            <button  class="mt-2 btn btn-success btn-block" name="profilGuncelle" id="guncelleBtn" ><i class="fas fa-edit"></i> Kaydet</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-card card">
                    <div class="card-body">
                        <h5 class="">Parola Ayarları</h5>
                        <form class="forms-layouts" action="inc/islemler.php" method="POST">

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleAddress" class="">  Şimdiki Parola</label>
                                        <input name="yetkili_id" type="hidden" class="form-control" value="<?=$kullanici['yetkili_id']; ?>">
                                        <input name="currentPass" type="password" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleAddress" class="">  Yeni Parola</label>
                                        <input name="newPass1" type="password" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleAddress" class="">  Parola Tekrar</label>
                                        <input name="newPass2" type="password" class="form-control" required="">
                                    </div>
                                </div>

                            </div>
                            <button class="mt-2 btn btn-primary btn-block" name="sifreGuncelle" id="guncelle" ><i class="fas fa-lock"></i> Kaydet</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Input Group -->

</div>
</div>


<!-- Modal Logout -->


</div>
<!---Container Fluid-->
</div>
<!-- Footer -->
<?php include('footer.php'); ?>