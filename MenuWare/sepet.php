<?php include('header.php');

if(isset($_GET['temizle'])){
  unset($_SESSION["sepetimdekiler"]);
  header("Location:./");
}


?>

<div class="container">
  <div class="row utf_sticky_main_wrapper">


    <!-- Sidebar -->
    <div class="col-lg-12 col-md-12 margin-top-75 sidebar-search">

      <div class="utf_box_widget booking_widget_box">
        <h3><i class="fa fa-shopping-cart"></i> Sepet
        </h3>
        <div class="row with-forms margin-top-0">
          <div class="col-lg-12 col-md-12">
           <?php
           if(isset($_SESSION['sepetimdekiler'])) {
            $icerik = "";
            $sepet_verisi = $_SESSION['sepetimdekiler'];

            foreach ($sepet_verisi['urunler'] as $value) {
              $icerik = $icerik. $value->count." adet ". $value->menu_adi." -> ".$value->total_price."₺ <br>";
            }

          }
          else {
            $icerik = 'Sepetinize henüz ürün eklenmemiş';
          }
          ?>
          <?php echo $icerik; ?>
          <br>
          <?php 
          if(isset($_SESSION['sepetimdekiler'])) {
           ?>
           <a class="button border with-icon" href="?temizle">Sepeti Boşalt</a>
         <?php } else {  ?>
           <a class="button border with-icon" href="./">Anasayfa</a>
         <?php } ?>
       </div>
     </div>  
     <div class="clearfix"></div>
   </div>


 </div>
</div>
</div>

<?php include('footer.php'); ?>