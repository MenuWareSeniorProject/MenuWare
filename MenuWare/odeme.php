<?php include('header.php'); ?>

<div class="container  margin-top-50 margin-bottom-75">
	<div class="row">
		<div class="col-lg-8 col-md-8 utf_listing_payment_section">
			

			<div class="utf_booking_payment_option_form">
				<h3><i class="sl sl-icon-credit-card "></i> Ödeme Yöntemi</h3>
				<div class="payment">
					


					<div class="utf_payment_tab_block utf_payment_tab_block_active">
						<div class="utf_payment_trigger_tab">
							<input checked="" id="paypal" name="cardType" type="radio" value="paypal">
							<label for="paypal">Havale</label>
						</div>
						<div class="utf_payment_tab_block_content">				  
							<p>84814814189118181 Hesap numarasına isim ve soyisim belirterek havale yapabilirsiniz.</p>
						</div>
					</div>			  			 

					
				</div>
				<a href="basarili.php" class="button utf_booking_confirmation_button margin-top-20 margin-bottom-10">Rezervasyonu Tamamla</a> 		
			</div>
		</div>
		<div class="col-lg-4 col-md-4 margin-top-0 utf_listing_payment_section">
			
			<div class="boxed-widget opening-hours summary margin-top-0">
				<h3><i class="fa fa-calendar-check-o"></i> Rezervasyon Bilgileri</h3>
				<ul>
					<li>Tarih: <span>10 Jan 2022</span></li>
					<li>Başlangıç Saati <span>19:30</span></li>
					<li>Bitiş Saati <span>20:30</span></li>    

					<li class="total-costs">Sipariş Toplamı <span>248.00 ₺</span></li>

				</ul>
			</div>
		</div>
	</div>
</div>


<?php include('footer.php'); ?>