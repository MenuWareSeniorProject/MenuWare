<?php 
include 'inc/ayar.php';
include ('inc/functions.php');

ob_start();
session_start();
sessionkontrol();

$ayarData = $conn->query('SELECT * FROM ayarlar')->fetch(PDO::FETCH_ASSOC);

$rest_sayi = $conn->query("SELECT count(*) AS toplam FROM restoran")->fetch(PDO::FETCH_ASSOC);
$rez_sayi = $conn->query("SELECT count(*) AS toplam FROM rezerveler")->fetch(PDO::FETCH_ASSOC);
$uye_sayi = $conn->query("SELECT count(*) AS toplam FROM uye")->fetch(PDO::FETCH_ASSOC);
$rezOnay_sayi = $conn->query("SELECT count(*) AS toplam FROM rezerveler WHERE rezerve_durum = 0")->fetch(PDO::FETCH_ASSOC);



$kullanicisor=$conn->prepare("SELECT * FROM admin WHERE admin_id = :user_id");
$kullanicisor->execute(array(
  'user_id' => $_SESSION['admin_giris']
));
$kullanici=$kullanicisor->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$ayarData['ayar_title']; ?> | Yönetici Paneli</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?=$ayarData['ayar_aciklama']; ?>">
  <link href="<?=$ayarData['ayar_logo']; ?>" rel="icon">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  
  <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" >
  <link href="vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet" >
  <link href="vendor/clock-picker/clockpicker.css" rel="stylesheet">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="css/sweetalert2.min.css">
  <link href="css/summernote.css" rel="stylesheet">

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="../<?=$ayarData['ayar_logo']; ?>">
        </div>
        
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Anasayfa</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Menü
        </div>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#firmalar" aria-expanded="false" aria-controls="firmalar">
            <i class="fa fa-building"></i>
            <span>Restaurant</span>
          </a>
          <div id="firmalar" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="restoranlar.php">Restaurantlar</a>
              <a class="collapse-item" href="restoran-ekle.php">Restaurant Ekle</a>
              <a class="collapse-item" href="yetkililer.php">Rest. Yetkilileri</a>
              <a class="collapse-item" href="yetkili-ekle.php">Rest. Yetkili Ekle</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#uyeler" aria-expanded="false" aria-controls="uyeler">
            <i class="fa fa-user-circle"></i>
            <span>Üyeler</span>
          </a>
          <div id="uyeler" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="uyeler.php">Üyeler</a>
              <a class="collapse-item" href="uye-ekle.php">Üye Ekle</a>
            </div>
          </div>
        </li>

      
        <li class="nav-item">
          <a class="nav-link" href="rezervasyonlar.php">
            <i class="fas fa-list"></i>
            <span>Rezervasyonlar</span>
          </a>
        </li>


        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Site Ayarları
        </div>

        
        <li class="nav-item">
          <a class="nav-link" href="ayar.php">
            <i class="fas fa-cog"></i>
            <span>Site Ayarları</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminler.php">
            <i class="fas fa-user-cog"></i>
            <span>Yöneticiler</span>
          </a>
        </li>




        <li class="nav-item">
          <a class="nav-link" href="profil.php">
            <i class="fas fa-id-card"></i>
            <span>Profil</span>
          </a>
        </li>



        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="fas fa-lock"></i>
            <span>Çıkış Yap</span>
          </a>
        </li>
      </ul>
      <!-- Sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <!-- TopBar -->


          <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">

             <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="../" aria-haspopup="true" target="_blank" aria-expanded="false">
                Siteye Git <i class="fas fa-arrow-right fa-fw"></i>
              </a>
            </li>




            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <img class="img-profile rounded-circle" src="../<?=$ayarData['ayar_logo']; ?>" style="max-width: 60px">
              <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $kullanici['admin_kadi']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="profil.php">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profil
              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Çıkış
              </a>
            </div>
          </li>
        </ul>
      </nav>
        <!-- Topbar -->