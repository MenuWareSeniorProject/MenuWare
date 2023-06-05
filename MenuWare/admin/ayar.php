<?php include('header.php');

?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Site Ayarları</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item active" aria-current="page">Site Ayarları</li>
  </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3 bg-gradient-warning p-2">
                    <label class="text-white">Logo</label><br>
                    <img style="height: 150px!important" class="img-fluid" src="../<?php echo $ayarData['ayar_logo']; ?>" alt="">
                </div>

                <div style="box-shadow: inset 0 0 10px #ccc;padding: 25px;margin-bottom: 35px;" class="col-md-12">

                    <form action="inc/islemler.php" method="POST" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-md-12 col-6">
                            <div class="form-group">
                                <label >Logo</label>
                                <input  type="file" class="form-control"  name="ayar_logo">
                            </div>

                        </div>


                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label >Site Adı</label>
                                <input type="text" class="form-control" name="ayar_title" value="<?php echo $ayarData['ayar_title']; ?>">
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label >Açıklama</label>
                                <input type="text" class="form-control" name="ayar_aciklama"  value="<?php echo $ayarData['ayar_aciklama']; ?>">
                            </div>
                        </div>


                        
                    </div>
                    <div class="col-md-12">
                        <button name="siteAyarGuncelle" type="submit" class="btn btn-success btn-block me-1 mb-1">Güncelle</button>
                    </div>
                </form>
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