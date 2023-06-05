<?php include('header.php');

?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Restaurant Ayarları</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item active" aria-current="page">Restaurant Ayarları</li>
  </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3 bg-gradient-warning p-2">
                    <label class="text-white">Logo</label><br>
                    <img style="height: 150px!important" class="img-fluid" src="../<?php echo $restoranAyar['rest_logo']; ?>" alt="">
                </div>
                <div class="col-md-6 mb-3 bg-gradient-warning p-2">
                    <label class="text-white">Arkaplan Görsel</label><br>
                    <img style="height: 150px!important" class="img-fluid" src="../<?php echo $restoranAyar['rest_bg']; ?>" alt="">
                </div>

                <div style="box-shadow: inset 0 0 10px #ccc;padding: 25px;margin-bottom: 35px;" class="col-md-12">

                    <form action="inc/islemler.php" method="POST" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label >Logo</label>
                                <input  type="file" class="form-control"  name="rest_logo">
                            </div>

                        </div>
                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label >Arkaplan Görsel</label>
                                <input  type="file" class="form-control"  name="rest_bg">
                            </div>

                        </div>


                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label >Restaurant Adı</label>
                                <input type="hidden" name="rest_id" value="<?php echo $restoranAyar['rest_id']; ?>">
                                <input type="text" class="form-control" name="rest_adi" value="<?php echo $restoranAyar['rest_adi']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label >Restaurant Adres</label>
                                <input type="text" class="form-control" name="rest_adres" value="<?php echo $restoranAyar['rest_adres']; ?>">
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label >Restaurant Tel</label>
                                <input type="text" class="form-control" name="rest_tel" value="<?php echo $restoranAyar['rest_tel']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label >Restorant Açıklama</label>
                                <textarea id="rest_aciklama" class="form-control" name="rest_aciklama"><?php echo $restoranAyar['rest_aciklama']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label >Restoran IBAN Adresi</label>
                                <input type="text" class="form-control" name="rest_iban"  value="<?php echo $restoranAyar['rest_iban']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label >Restoran Ödeme Mesajı</label>
                                <input type="text" class="form-control" name="rest_odeme"  value="<?php echo $restoranAyar['rest_odeme']; ?>">
                            </div>
                        </div>


                        
                    </div>
                    <div class="col-md-12">
                        <button name="restoranDuzenle" type="submit" class="btn btn-success btn-block me-1 mb-1">Güncelle</button>
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



<script>
  $(document).ready(function () {
    $('.select2-single').select2();

    $('#rest_aciklama').summernote({
      placeholder: 'Hadi yazmaya başla',
    lang: 'tr-TR', // default: 'en-US'
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture']],
      ['view', ['codeview']]
      ]
  });
  

    
    $('#dataTableHover').DataTable( {
      "pageLength": 10,
      "aaSorting": []
    } );
  });
</script>

</body>

</html>
