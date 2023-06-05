<?php include('header.php');
if (isset($_GET['id'])) {
  $id=$_GET['id'];

  $menuSor=$conn->prepare("SELECT * FROM menuler where menu_id= :menu_id");
  $menuSor->execute(array('menu_id' => $id));
  $menu=$menuSor->fetch(PDO::FETCH_ASSOC);
  $say=$menuSor->rowCount();

  if($say < 1){
    header("location:menuler.php");
  }
  $menu_id = $menu['menu_id'];
}else {
  header("location:menuler.php");
}

?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menü Düzenle</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="menuler.php">Menüler</a></li>
      <li class="breadcrumb-item">Menü Düzenle</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Menü Düzenle</h6>
        </div>
        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">

              <div class="form-group col-md-4">
                <label for="menu_adi">Menü Adı</label>
                <input type="hidden" name="menu_id" value="<?=$menu_id; ?>">

                <input type="text" class="form-control" id="menu_adi" placeholder="Menü Adı" name="menu_adi" required  value="<?=$menu['menu_adi']; ?>">
              </div>
              <div class="form-group col-md-4">
                <label for="menu_fiyat">Menü Fiyat</label>
                <input type="number" class="form-control" id="menu_fiyat" placeholder="Menü Fiyat" name="menu_fiyat" required   value="<?=$menu['menu_fiyat']; ?>">
              </div>
              <div class="form-group col-md-4">
                <label for="menu_img">Menü Görsel</label>
                <input type="file" class="form-control" id="menu_img" placeholder="Menü Görsel" name="menu_img" >
              </div>

            </div>
            <button type="submit" class="btn btn-primary btn-block" name="menuDuzenle"><i class="fas fa-edit"></i> Düzenle</button> 
          </form>


          <div class="col-md-12 text-left mt-3">
            <img src="../<?=$menu['menu_img']; ?>" style="width:200px;height: 150px;object-fit: cover;">
          </div>
        </div>
      </div>
    </div>

  </div>


</div>
<!---Container Fluid-->
</div>


<?php include('footer.php'); ?>