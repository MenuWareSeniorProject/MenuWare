
<?php include 'header.php'; 

sessionkontrol();


$uyeSorgu=$conn->prepare("SELECT * FROM uye where uye_id= :uye_id");
$uyeSorgu->execute(array('uye_id' => $_SESSION['uye_giris']));
$uye=$uyeSorgu->fetch(PDO::FETCH_ASSOC);
$say=$uyeSorgu->rowCount();
$uye_id = $uye['uye_id'];
if($say < 1){
  header("location:index.php");
}
?>


<div class="container margin-top-50">
  <div class="row"> 
    <div class="col-md-8">
      <section id="contact" class="margin-bottom-70">
        <h4><i class="fa fa-cogs"></i> Profil Ayarları</h4>          
        <form id="contactform" action="inc/islemler.php" method="POST">
          <div class="row">
            <div class="col-md-12">   
            <label>E-mail</label>            
            <input type="hidden" name="uye_id" value="<?=$uye_id; ?>"> 
              <input name="uye_email" type="email" placeholder="E-posta Adresiniz" required value="<?=$uye['uye_email']; ?>" disabled/>                
            </div>
            <div class="col-md-6">  
            <label>Adınız Soyadınız</label>      
              <input name="uye_adi" type="text" placeholder="Adınız Soyadınız" required value="<?=$uye['uye_adi']; ?>"/>                
            </div>
            <div class="col-md-6"> 
            <label>Telefon Numaranız</label>                     
              <input name="uye_tel" type="text" placeholder="Telefon Numaranız" required value="<?=$uye['uye_tel']; ?>"/>                
            </div>

          </div>            
          <button type="submit" name="profilGuncelle" class="submit button">Güncelle</button>
        </form>
      </section>

      <section id="contact" class="margin-bottom-70">
        <h4><i class="fa fa-cogs"></i> Parola Ayarları</h4>          
        <form id="contactform" action="inc/islemler.php" method="POST">
          <div class="row">
            <div class="col-md-12">   
            <label>Şuanki Parola</label>            
            <input type="hidden" name="uye_id" value="<?=$uye_id; ?>"> 
            <input name="currentPass" type="password" placeholder="Şuanki Parola" required/>                
            </div>
            <div class="col-md-6">  
            <label>Yeni Parola</label>      
              <input name="newPass1" type="password" placeholder="Yeni Parola" required/>                
            </div>
            <div class="col-md-6"> 
            <label>Yeni Parola Tekrar</label>                     
              <input name="newPass2" type="password" placeholder="Yeni Parola Tekrar" required/>                
            </div>

          </div>            
          <button type="submit" name="sifreGuncelle" class="submit button">Güncelle</button>
        </form>
      </section>
    </div>
    <div class="col-md-4">
      <div class="utf_box_widget margin-bottom-70">
        <h3><i class="sl sl-icon-user"></i> Bağlantılar</h3>
        <div class="utf_sidebar_textbox">
          <ul class="utf_contact_detail">

            <li><a href="rezervasyonlarim.php">Rezervasyonlarım</a></li>
            <li><a href="cikis.php">Çıkış Yap</a></li>
          </ul>
        </div>  
      </div>
    </div>

  </div>
</div>


<?php include 'footer.php'; ?>