<?php include('header.php');
if (isset($_GET['id'])) {
  $id=$_GET['id'];

  $veriCek=$conn->prepare("SELECT * FROM admin where admin_id= :admin_id");
  $veriCek->execute(array('admin_id' => $id));
  $admin=$veriCek->fetch(PDO::FETCH_ASSOC);
  $say=$veriCek->rowCount();

  if($say < 1){
    header("location:adminler.php");
  }
  $admin_id = $admin['admin_id'];
}else {
  header("location:adminler.php");
}

?>



<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Admin Bilgileri</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="adminler.php">Adminler</a></li>
      <li class="breadcrumb-item active" aria-current="page">Admin Bilgileri</li>
    </ol>
  </div>

  <div class="row">


    <div class="col-lg-12">
      <!-- General Element -->
      <div class="card mb-4">

        <div class="card-body">
          <form method="POST" action="inc/islemler.php" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="admin_kadi">Admin Kullanıcı Adı</label>
                <input type="hidden" class="form-control" value="<?=$admin['admin_id']; ?>" name="admin_id">
                <input type="text" class="form-control" id="admin_kkadi"
                placeholder="Admin Kullanıcı Adı" value="<?=$admin['admin_kadi']; ?>" name="admin_kadi">
              </div>
              <div class="form-group col-md-6">
                <label for="admin_parola">Parola</label>
                <input type="password" class="form-control" id="admin_parola"
                placeholder="Parola" value="<?=$admin['admin_parola']; ?>" name="admin_parola">
              </div>

            </div>
            <button type="submit" class="btn btn-primary btn-block" name="adminDuzenle"><i class="fas fa-edit"></i> Güncelle</button> 
          </form>
        </div>
      </div>
      <!-- Input Group -->

    </div>
  </div>
  

</div>

<!---Container Fluid-->
</div>
<!-- Footer -->


<?php include('footer.php'); ?>



