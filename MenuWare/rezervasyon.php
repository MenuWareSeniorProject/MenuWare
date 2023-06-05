<?php include('header.php');


sessionkontrol();

if (isset($_GET['rest_id'])) {
  $id=$_GET['rest_id'];

  $restoranSorgu=$conn->prepare("SELECT * FROM restoran where rest_id= :rest_id");
  $restoranSorgu->execute(array('rest_id' => $id));
  $restoran=$restoranSorgu->fetch(PDO::FETCH_ASSOC);
  $say=$restoranSorgu->rowCount();

  if($say < 1){
    header("location:index.php");
  }

  $rest_id = $restoran['rest_id'];
  $masa_id=$_GET['id'];

  $masalar = $conn->query("SELECT * FROM masalar WHERE masa_id = '{$masa_id}'")->fetch(PDO::FETCH_ASSOC);


}else {
  header("location:index.php");
}

?>

<div class="container">
  <div class="row utf_sticky_main_wrapper">


    <!-- Sidebar -->
    <div class="col-lg-12 col-md-12 margin-top-75 sidebar-search">

        
               <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30"><?=$restoran['rest_iban']; ?></h3>
  <p><?=$restoran['rest_odeme']; ?></p>
 
      <div class="utf_box_widget booking_widget_box">
        <h3><i class="fa fa-calendar"></i> <?php echo $restoran['rest_adi'].' - '.date('d.m.Y H:i',strtotime($_GET['tarih'])).' tarihinde '.$masalar['masa_no'].' nolu masaya rezervasyon'; ?>

      </h3>
      <form action="inc/islemler.php" method="POST">
        <div class="row with-forms margin-top-0">
          <div class="col-lg-12 col-md-12">
            <input type="hidden" name="uye_id" value="<?=$_SESSION['uye_giris']; ?>">
            <input type="hidden" name="rest_id" value="<?=$rest_id; ?>">
            <input type="hidden" name="masa_id" value="<?=$masa_id; ?>">
            <input type="hidden" name="tarih" value="<?php echo date('Y-m-d H:i:s',strtotime($_GET['tarih'])); ?>">

            <?php
            if(isset($_SESSION['sepetimdekiler'])) {
              $icerik = "";
              $sepet_verisi = $_SESSION['sepetimdekiler'];

              foreach ($sepet_verisi['urunler'] as $value) {

                $menuRestoranaAitMi=$conn->prepare("SELECT * FROM menuler where menu_id= :menu_id and menu_rest_id != '{$rest_id}'");
                $menuRestoranaAitMi->execute(array('menu_id' => $value->menu_id));
                $menuData=$menuRestoranaAitMi->fetch(PDO::FETCH_ASSOC);
                $sayi=$menuRestoranaAitMi->rowCount();

                if($sayi > 0){
                  $icerik =' ';
                  break;
                }
                else {
                  $icerik = $icerik. $value->count." adet ". $value->menu_adi." -> ".$value->total_price."₺ \xA";
                }
                
              }

            }
            else {
              $icerik = '';
            }
            ?>
            <textarea name="rezerve_siparis" readonly><?php  echo $icerik; ?></textarea>

          </div>
        </div>
        <?php if($icerik !='' and $icerik !=' '){ ?>

          <button class="utf_progress_button button fullwidth_block margin-top-5" name="rezerveYap">Oluştur</button>
        <?php } else { ?>
          <h3>Sepetinizde Seçili Restorandan Menü Olması Gerekmekte</h3>
          <a href="./">Anasayfa</a>
        <?php } ?>     
      </form>
      <div class="clearfix"></div>
    </div>


  </div>
</div>
</div>

<?php include('footer.php'); ?>