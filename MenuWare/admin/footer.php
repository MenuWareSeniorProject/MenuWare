
<footer class="sticky-footer bg-white">
 <div class="container my-auto">
  <div class="copyright text-center my-auto">
    <span><?=$kullanici['admin_kadi']; ?> &nbsp; </span>
  </div>
</div>


</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/select2/dist/js/select2.min.js"></script>
<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
<script src="vendor/clock-picker/clockpicker.js"></script>
<script src="js/ruang-admin.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/sweetalert.min.js"></script>

<script src="js/summernote.min.js"></script>
<script src="js/summernote-tr-TR.js"></script>

<!-- Page level custom scripts -->
<script>
  $(document).ready(function () {
    $('.select2-single').select2();

    $('#rest_aciklama').summernote({
      placeholder: 'Hadi yazmaya başla',
    lang: 'tr-TR', // default: 'en-US'
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture']],
      ['view', ['codeview']]
      ]
  });
  
  
    
    $('#dataTableHover').DataTable( {
      "pageLength": 10,
      "aaSorting": []
    } );
  });
</script>

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
      title: 'İşlem Başarısız!'
    })
  </script>
<?php } ?>


<?php if (@$_GET['status'] == "invalid") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'error',
      title: 'Kullanıcı adı veya e-posta zaten kullanımda!'
    })
  </script>
<?php } ?>



<?php if (@$_GET['status'] == "2") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'error',
      title: 'Şifreniz Yanlış!'
    })
  </script>
<?php } ?>


<?php if (@$_GET['status'] == "1") { ?>
  <script type="text/javascript">
    ToastTopEnd.fire({
      icon: 'error',
      title: 'Yeni Şifreler Uyuşmuyor!'
    })
  </script>
  <?php } ?>