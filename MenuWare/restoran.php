<?php include('header.php');
if (isset($_GET['id'])) {
  $id=$_GET['id'];

  $restoranSorgu=$conn->prepare("SELECT * FROM restoran where rest_id= :rest_id");
  $restoranSorgu->execute(array('rest_id' => $id));
  $restoran=$restoranSorgu->fetch(PDO::FETCH_ASSOC);
  $say=$restoranSorgu->rowCount();

  if($say < 1){
    header("location:index.php");
  }

  $rest_id = $restoran['rest_id'];
}else {
  header("location:index.php");
}

?>

<div class="container">
  <div class="row utf_sticky_main_wrapper">
    <div class="col-lg-7 col-md-8">
      <div id="titlebar" class="utf_listing_titlebar">
       <div class="row d-flex justify-content-start align-items-center">
        <div class="col-md-2">
          <img src="<?=$restoran['rest_logo']; ?>" style="max-height: 100px;">
        </div>
        <div class="utf_listing_titlebar_title">
         <h2><?=$restoran['rest_adi']; ?></h2>       
         <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> <?=$restoran['rest_adres']; ?></a> </span>     
         <span class="call_now"><i class="sl sl-icon-phone"></i> <?=$restoran['rest_tel']; ?></span>
         

       </div>
     </div>
   </div>

   <?php if(empty($_SESSION['uye_giris'])){ ?>
    <h3>Rezervasyon için Üye Girişi Yapmanız Gerekmekte</h3>
  <?php } else { ?>

   <div class="utf_box_widget booking_widget_box margin-bottom-30">
    <h3><i class="fa fa-calendar"></i> Rezervasyon Oluştur

    </h3>

    <form action="rezervasyon.php" method="POST">
      <div class="row with-forms margin-top-0">
        <div class="col-lg-12 col-md-12">
          <input type="hidden" name="rest_id" id="rest_id" value="<?=$rest_id; ?>">
          <input type="date" name="tarih" id="tarih" placeholder="Select Date" value="<?php echo date('Y-m-d',strtotime('+1 days')); ?>">
        </div>

        <div class="screenNameError  text-center">
        </div>



      </div>          
    </form>
    <div class="clearfix"></div>
  </div>


<?php } ?>

<div class="utf_listing_section screenNameError2">


</div>








</div>

<!-- Sidebar -->
<div class="col-lg-5 col-md-4 margin-top-75 sidebar-search">


  <div class="utf_listing_section">
    <div class="utf_pricing_list_section">
      <h4>Menü</h4>
       
      <ul style="    margin-bottom: 0px;">
        <?php 
        $veriCek=$conn->prepare("SELECT * FROM menuler WHERE menu_rest_id = '{$rest_id}' ORDER BY menu_adi ASC");
        $veriCek->execute();
        while ($var=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>
          <li class="d-flex justify-content-start">
            <label style="display:contents;margin-right: 15px;font-size:22px;font-weight: bolder"><img src="<?=$var['menu_img']; ?>" style="width: 80px;
    height: 80px;
    border-radius: 100%;
    box-shadow: 0 0 6px #000000;
    margin-right: 10px;"></label>
            <label style="display:contents;margin-right: 15px;font-size:22px;font-weight: bolder"><?=$var['menu_adi']; ?></label> --
            <label style="display:contents;margin-right: 15px;font-size:22px;font-weight: bolder"><?=$var['menu_fiyat']; ?> ₺</label>
            <button  menu-id="<?php echo $var['menu_id']; ?>"  class="addToCartBtn" style="background: #f72525;padding:0px 10px;border-radius: 5px;color:white;border:none;"> + Ekle</button>

          </li>

        <?php } ?>

      </ul>
     <div class="text-right">
         
      <a class="button border with-icon" href="sepet.php?temizle">Sepeti Boşalt</a>
     </div> 
    </div>

  </div>



  <div id="utf_listing_overview" class="utf_listing_section">
    <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">Açıklama</h3>
    <?=$restoran['rest_aciklama']; ?>


  </div>


</div>
</div>
</div>

<?php include('footer.php'); ?>

<script type="text/javascript">

 $(document).ready(function() {
  $("#tarih").change(function(){
    var tarih = $("#tarih").val();
    $.ajax({
      type: 'post',
      url: 'kontrol.php',
      data: {tarih: tarih},
      success: function(r) {
        $('.screenNameError').html(r);
      }
    });
  });

  $("#baslangic").change(function(){
    var baslangic = $("#baslangic").val();
    var tarih = $("#tarih").val();
    $.ajax({
      type: 'post',
      url: 'saat-kontrol.php',
      data: {baslangic: baslangic,tarih: tarih},
      success: function(r) {
        $('.screenNameError2').html(r);
      }
    });
  });

  $(".addToCartBtn").click(function () {
    var url = "ekle.php";
    var data = {
      menu_id : $(this).attr("menu-id")
    }
    $.post(url,data,function (response) {
      $("#sepet").text(response);
    })
  })


});
</script>