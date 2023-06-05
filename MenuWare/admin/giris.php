<?php
include('inc/ayar.php');
include('inc/functions.php');
$ayarData = $conn->query('SELECT * FROM ayarlar')->fetch(PDO::FETCH_ASSOC);

ob_start();
session_start();
sessionkontrol2();
?>

<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="<?=$ayarData['ayar_logo']; ?>" rel="icon">
  <title><?=$ayarData['ayar_title']; ?> | Yönetici Paneli</title>
  <meta name="description" content="<?=$ayarData['ayar_aciklama']; ?>, Yönetici Paneli">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <script src="js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="css/sweetalert2.min.css">

</head>

<body style="background-color: #8EC5FC;
background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
">
<!-- Login Content -->
<div class="container-login">
  <div class="row justify-content-center">
    <div class="col-xl-6 col-lg-12 col-md-9">
      <div class="card shadow-sm my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Yönetici Girişi</h1>
                </div>
                <form action="inc/islemler.php" method="POST">
                  <div class="form-group">
                    <input type="text" name="admin_kadi" class="form-control" placeholder="Kullanıcı Adınız" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="admin_parola"  class="form-control" placeholder="Parolanız" required>
                  </div>

                  <div class="form-group">
                   <button type="submit" class="btn btn-success btn-block" name="girisYap"><i class="fa fa-door-open"></i> Giriş Yap</button>
                 </div>
              </form>
              <div class="text-center">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Login Content -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
</body>

</html>


<script>
  const ToastTopEnd = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

</script>
<?php if (@$_GET['status'] == "success") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'success',
      title: 'İşlem Başarılı! '
    })
  </script>
<?php } ?>
<?php if (@$_GET['status'] == "error") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'error',
      title: 'Böyle Bir Kullanıcı Yok!'
    })
  </script>
<?php } ?>

