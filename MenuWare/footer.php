
<div id="" class="footer_sticky_part"> 
	<div class="container">


		<div class="row">
			<div class="col-md-12">
				<div class="footer_copyright_part">Tüm Hakları Saklıdır</div>
			</div>
		</div>
	</div>
</div>
<div id="bottom_backto_top"><a href="#"></a></div>
</div>

<!-- Scripts --> 

<script src="scripts/jquery-3.4.1.min.js"></script> 
<script src="scripts/chosen.min.js"></script> 
<script src="scripts/slick.min.js"></script> 
<script src="scripts/rangeslider.min.js"></script> 
<script src="scripts/magnific-popup.min.js"></script> 
<script src="scripts/jquery-ui.min.js"></script> 
<script src="scripts/bootstrap-select.min.js"></script>
<script src="scripts/mmenu.js"></script>
<script src="scripts/tooltips.min.js"></script> 
<script src="scripts/color_switcher.js"></script>
<script src="scripts/jquery_custom.js"></script>
<script src="scripts/sweetalert.min.js"></script>

</body>
</html>


<script>
  const ToastTopEnd = Swal.mixin({
    toast: false,
    position: 'top',
    showConfirmButton: false,
    timer: 4000,
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
      title: 'İşlem Başarısız!'
    })
  </script>
<?php } ?>
<?php if (@$_GET['status'] == "2") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'error',
      title: 'Geçerli Parolanız Yanlış!'
    })
  </script>
<?php } ?>
<?php if (@$_GET['status'] == "1") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'error',
      title: 'Yeni şifrenizi doğru şekilde onaylamadınız!'
    })
  </script>
<?php } ?>
<?php if (@$_GET['status'] == "invalid") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'error',
      title: 'Bu email hesabı zaten kullanımda!'
    })
  </script>
<?php } ?>

<?php if (@$_GET['status'] == "rezerveVar") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'error',
      title: 'Bu seçeneklerde zaten bir rezervasyon yapıldı!'
    })
  </script>
<?php } ?>

