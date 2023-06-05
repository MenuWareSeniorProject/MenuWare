<?php include('header.php');
if (isset($_GET['id'])) {
  $id=$_GET['id'];

  $yetkiSor=$conn->prepare("SELECT * FROM yetkili where yetkili_id= :yetkili_id");
  $yetkiSor->execute(array('yetkili_id' => $id));
  $yetkili=$yetkiSor->fetch(PDO::FETCH_ASSOC);
  $say=$yetkiSor->rowCount();

  if($say < 1){
    header("location:yetkililer.php");
  }
  $yetkili_id = $yetkili['yetkili_id'];
}else {
  header("location:yetkililer.php");
}

?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Yetkili Düzenle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="yetkililer.php">Yetkililer</a></li>
      <li class="breadcrumb-item">Yetkili Düzenle</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Yetkili Düzenle</h6>
        </div>

        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">


              <div class="form-group col-md-4">
                <label for="sofor_parola">Restoran</label><br>
                <select class="form-control select2-single" name="yetkili_rest_id" id="yetkili_rest_id" required>
                  <option value="">Seçiniz</option>
                  <?php 
                  $veriCek=$conn->prepare("SELECT * FROM restoran ORDER BY rest_adi ASC");
                  $veriCek->execute();
                  while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?=$var['rest_id']; ?>" <?php if($yetkili['yetkili_rest_id']==$var['rest_id']){echo 'selected';} ?> ><?=$var['rest_adi']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="yetkili_adi">Yetkili Adı</label>
                <input type="hidden" name="yetkili_id" value="<?=$yetkili['yetkili_id']; ?>">
                <input type="text" class="form-control" id="yetkili_adi" placeholder="Yetkili Adı" name="yetkili_adi" required value="<?=$yetkili['yetkili_adi']; ?>">
              </div>

              <div class="form-group col-md-4">
                <label for="yetkili_parola">Yetkili Parola</label>
                <input type="text" class="form-control" id="yetkili_parola" placeholder="Yetkili Parola" name="yetkili_parola" required  value="<?=$yetkili['yetkili_parola']; ?>">
              </div>




              <div class="form-group col-md-6">
                <label class="mb-1">Yetki Tipi Belirleyin</label>
                <div class="d-flex justify-content-start align-items-start p-3">
                  <div class="form-group" style="margin-right: 35px">
                    <input class="form-check-input" value="yonetici" <?php if($yetkili['yetkili_tip']==1){echo 'checked';} ?> type="radio" name="yetkili_tip" id="yonetici">
                    <label class="form-check-label" for="yonetici">
                      Yönetici
                    </label>
                  </div>
                  <div class="form-group">
                    <input class="form-check-input" value="sef" <?php if($yetkili['yetkili_tip']==0){echo 'checked';} ?> type="radio" name="yetkili_tip" id="sef">
                    <label class="form-check-label" for="sef">
                     Şef
                   </label>
                 </div>
               </div>
             </div>

           </div>
           <button type="submit" class="btn btn-primary btn-block" name="yetkiliDuzenle"><i class="fas fa-edit"></i> Düzenle</button> 
         </form>
       </div>
     </div>
   </div>

</div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>
