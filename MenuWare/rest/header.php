<?php 
include 'inc/ayar.php';
include ('inc/functions.php');

ob_start();
session_start();
sessionkontrol();


$kullanicisor=$conn->prepare("SELECT * FROM yetkili WHERE yetkili_id = :user_id");
$kullanicisor->execute(array(
  'user_id' => $_SESSION['rest_giris']
));
$kullanici=$kullanicisor->fetch(PDO::FETCH_ASSOC);
$restoran_id = $kullanici['yetkili_rest_id'];


$ayarData = $conn->query('SELECT * FROM ayarlar')->fetch(PDO::FETCH_ASSOC);
$restoranAyar = $conn->query("SELECT * FROM restoran WHERE rest_id = '{$restoran_id}'")->fetch(PDO::FETCH_ASSOC);

$rez_sayi = $conn->query("SELECT count(*) AS toplam FROM rezerveler WHERE rezerve_rest_id = '{$restoran_id}'")->fetch(PDO::FETCH_ASSOC);
$rezOnaysiz_sayi = $conn->query("SELECT count(*) AS toplam FROM rezerveler WHERE rezerve_durum = 0 and rezerve_rest_id = '{$restoran_id}'")->fetch(PDO::FETCH_ASSOC);
$rezOnay_sayi = $conn->query("SELECT count(*) AS toplam FROM rezerveler WHERE rezerve_durum = 1 and rezerve_rest_id = '{$restoran_id}'")->fetch(PDO::FETCH_ASSOC);



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
          <span><?=$restoranAyar['rest_adi']; ?></span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Menü
        </div>

        <?php if($kullanici['yetkili_tip']==1){ ?>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masalar" aria-expanded="false" aria-controls="masalar">
              <i class="fa fa-building"></i>
              <span>Masalar</span>
            </a>
            <div id="masalar" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="masalar.php">Masalar</a>
                <a class="collapse-item" href="masa-ekle.php">Masa Ekle</a>
              </div>
            </div>
          </li>
    <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu" aria-expanded="false" aria-controls="masalar">
              <i class="fa fa-list"></i>
              <span>Menüler</span>
            </a>
            <div id="menu" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="menuler.php">Menüler</a>
                <a class="collapse-item" href="menu-ekle.php">Menü Ekle</a>
              </div>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#yetkililer" aria-expanded="false" aria-controls="yetkililer">
              <i class="fa fa-users"></i>
              <span>Yetkililer</span>
            </a>
            <div id="yetkililer" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="yetkililer.php">Yetkililer</a>
                <a class="collapse-item" href="yetkili-ekle.php">Yetkili Ekle</a>
              </div>
            </div>
          </li>




          <li class="nav-item">
            <a class="nav-link" href="ayar.php">
              <i class="fas fa-cog"></i>
              <span>Restoran Ayarları</span>
            </a>
          </li>

        <?php } ?>



        <li class="nav-item">
          <a class="nav-link" href="rezervasyonlar.php">
            <i class="fas fa-list"></i>
            <span>Rezervasyonlar</span>
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

             <li class="nav-item dropdown no-arrow mx-1 d-">
              <?php if($kullanici['yetkili_tip']==1){ echo '<span class="text-white">Yönetici</span>'; } else { echo '<span class="text-white">Şef</span>';} ?>
            </li>




            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <img class="img-profile rounded-circle" src="../<?=$ayarData['ayar_logo']; ?>" style="max-width: 60px">
              <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $kullanici['yetkili_adi']; ?></span>
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