<?php 
include 'inc/ayar.php';
include ('inc/functions.php');

ob_start();
session_start();

$ayarData = $conn->query('SELECT * FROM ayarlar')->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta name="description" content="<?=$ayarData['ayar_aciklama']; ?>">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?=$ayarData['ayar_logo']; ?>" rel="shortcut icon">
  <title><?=$ayarData['ayar_title']; ?></title>

  <link rel="stylesheet" href="css/stylesheet.css">
  <link rel="stylesheet" href="css/mmenu.css">
  <link rel="stylesheet" href="css/style.css" id="colors">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&amp;display=swap&amp;subset=latin-ext,vietnamese" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet" type="text/css">
  <script src="scripts/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>
<body>

  <!-- Preloader Start -->
  <div class="preloader">
    <div class="utf-preloader">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <!-- Preloader End -->

  <!-- Wrapper -->
  <div id="main_wrapper">
    <header id="header_part" class="fullwidth">
      <div id="header">
        <div class="container"> 
          <div class="utf_left_side"> 
            <div id="logo"> <a href="./"><img src="<?=$ayarData['ayar_logo']; ?>" alt=""></a> </div>
            <div class="mmenu-trigger">
              <button class="hamburger utfbutton_collapse" type="button">
                <span class="utf_inner_button_box">
                  <span class="utf_inner_section"></span>
                </span>
              </button>
            </div>
            <nav id="navigation" class="style_one">
              <ul id="responsive">
                <li><a class="current" href="./">Anasayfa</a></li>             
              </ul>
            </nav>
            <div class="clearfix"></div>
          </div>
          <div class="utf_right_side">
            <div class="header_widget">
              <?php if(isset($_SESSION['uye_giris']) and $_SESSION['uye_giris']!='') { ?> 

                <a href="profil.php" class="button border sign-in">
                  <i class="sl sl-icon-user"></i> Profil

                </a>
                <a href="cikis.php" class="button border with-icon" style="background:white;color:red;"><i class="fa fa-sign-out"></i> Çıkış Yap</a>

                <a href="sepet.php" class="p-5"><i class="fa fa-shopping-cart"></i>
                  <sup id="sepet"><?php if(isset($_SESSION['sepetimdekiler'])){
                    echo $_SESSION['sepetimdekiler']['toplam']['total_count'];
                  } ?>
                </sup></a>

              </div>


            <?php  } else { ?>

              <a href="#dialog_signin_part" class="button border sign-in popup-with-zoom-anim">
                <i class="sl sl-icon-user"></i> Üye Girişi
              </a>
              <a href="rest" class="button border with-icon"><i class="fa fa-sign-in"></i> Restoran Girişi</a>
              <a href="sepet.php" class="p-5"><i class="fa fa-shopping-cart"></i>
                <sup id="sepet"><?php if(isset($_SESSION['sepetimdekiler'])){
                  echo $_SESSION['sepetimdekiler']['toplam']['total_count'];
                } ?>
              </sup></a>

            </div>


          <?php } ?>

        </div>

        <div id="dialog_signin_part" class="zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Giriş Yap</h3>
          </div>
          <div class="utf_signin_form style_one">
            <ul class="utf_tabs_nav">
              <li class=""><a href="#tab1">Giriş Yap</a></li>
              <li><a href="#tab2">Kayıt Ol</a></li>
            </ul>
            <div class="tab_container alt"> 
              <div class="tab_content" id="tab1" style="display:none;">
                <form method="post" class="login" action="inc/islemler.php">
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="email">
                      <input type="email" class="input-text" name="uye_email" id="email" value="" placeholder="E-posta Adresiniz" />
                    </label>
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="password">
                      <input class="input-text" type="password" name="uye_parola" id="password" placeholder="Parola"/>
                    </label>
                  </p>
                  <input type="submit" class="button border fw margin-top-10" name="girisYap" value="Giriş Yap" />

                </form>
              </div>

              <div class="tab_content" id="tab2" style="display:none;">
                <form method="post" class="register" action="inc/islemler.php">
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="uye_adi">
                      <input type="text" class="input-text" name="uye_adi" id="uye_adi" value="" placeholder="Ad Soyad" />
                    </label>
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="uye_tel">
                      <input type="number" class="input-text" name="uye_tel" id="uye_tel" value="" placeholder="Telefon" />
                    </label>
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="uye_email">
                      <input type="email" class="input-text" name="uye_email" id="uye_email" value="" placeholder="Email" />
                    </label>
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="uye_parola">
                      <input class="input-text" type="password" name="uye_parola" id="uye_parola" placeholder="Parola" />
                    </label>
                  </p>

                  <button type="submit" class="button border fw margin-top-10" name="uyeKayit">Kayıt Ol</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="clearfix"></div>