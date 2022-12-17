<?php
if(isset($_POST["tutar"]) and isset($_POST["kargo"])){
?>
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
		<!-- Home -->
		<?php
		$uyebilgilerisorgu = "SELECT * FROM uyeler WHERE id = ".$_SESSION["uyeid"];
		$uyebilgilerisorgugonder = mysqli_query($db,$uyebilgilerisorgu);
		$uyebilgilerisorgusatir = mysqli_fetch_array($uyebilgilerisorgugonder);
		?>
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Ödeme Sayfası</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
							<li><a href="?sayfa=sepet">Sepetim</a></li>
							<li>Sipariş</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Checkout -->

		<div class="checkout">
			<div class="container">
				<div class="row">
					
					<!-- Billing -->
					<div class="col-lg-6">
						<div class="billing">
							<div class="checkout_title">Alıcı Bilgileri</div>
							<div class="checkout_form_container">
								<form method="POST" id="checkout_form" class="checkout_form">
									<div class="row">
										<div class="col-lg-6">
											<!-- Name -->
											<?php $isim_dizi = explode (" ",$uyebilgilerisorgusatir["adsoyad"]); $ikinci_isim = "";if((count($isim_dizi)-1) != 1){$ikinci_isim = " ".$isim_dizi[1];} ?>
											<input type="text" id="checkout_name" name="adi" class="checkout_input" placeholder="İsim" required="required" value="<?php echo $isim_dizi[0].$ikinci_isim; ?>">
										</div>
										<div class="col-lg-6">
											<!-- Last Name -->
											<input type="text" id="checkout_last_name" name="soyadi" class="checkout_input" placeholder="Soyisim" required="required" value="<?php echo $isim_dizi[count($isim_dizi)-1]; ?>">
										</div>
									</div>
									<div>
										<!-- Company -->
										<input type="text" id="checkout_company" name="sirketadi" placeholder="Şirket İsmi" class="checkout_input" value="<?php echo $uyebilgilerisorgusatir["sirket"]; ?>">
									</div>
									<div>
										<!-- Address -->
										<textarea id="checkout_address" class="checkout_input" disabled="disabled" placeholder="Adres Satırı" required="required" title="Değiştirebilmek için adres defterinize gidin."><?php echo $uyebilgilerisorgusatir["adres"]; ?></textarea>
										<input type="hidden" name="adresi" value="<?php echo $uyebilgilerisorgusatir["adres"]; ?>">
									</div>
									<div>
										<!-- Zipcode -->
										<input type="text" id="checkout_zipcode" class="checkout_input" disabled="disabled" placeholder="Posta Kodu" required="required" disabled="disabled" value="<?php echo $uyebilgilerisorgusatir["postakodu"]; ?>" title="Değiştirebilmek için adres defterinize gidin.">
									</div>
									<div>
										<!-- City / Town -->
										<select id="checkout_city" class="dropdown_item_select checkout_input" disabled="disabled" require="required" title="Değiştirebilmek için adres defterinize gidin.">
											<option><?php echo $uyebilgilerisorgusatir["sehir"]; ?></option>
										</select>
									</div>
									<input type="hidden" name="sehir" value="<?php echo $uyebilgilerisorgusatir["sehir"]; ?>">
									<input type="hidden" name="semt" value="<?php echo $uyebilgilerisorgusatir["semt"]; ?>">
									<div>
										<!-- Province -->
										<select id="checkout_province" name="semt" class="dropdown_item_select checkout_input" disabled="disabled" require="required" title="Değiştirebilmek için adres defterinize gidin.">
											<option><?php echo $uyebilgilerisorgusatir["semt"]; ?></option>
										</select>
									</div>
									<div>
										<!-- Phone no -->
										<input type="phone" id="checkout_phone" class="checkout_input" name="telefonu" placeholder="Telefon Numarası" required="required" value="<?php echo $uyebilgilerisorgusatir["telefon"]; ?>">
									</div>
									<div>
										<!-- Email -->
										<input type="phone" id="checkout_email" class="checkout_input" name="epostaadresi" placeholder="E-posta Adresi" required="required" value="<?php echo $uyebilgilerisorgusatir["eposta"]; ?>">
									</div>
									<div>
										<!-- Email -->
										<input type="text" id="checkout_input" class="checkout_input" name="tckn" placeholder="TC Kimlik Numarası" pattern="[0-9]{11}" required="required">
									</div>
									<div>
										<!-- Email -->
										<textarea class="checkout_input" name="sipnot" placeholder="Sipariş Notu" pattern="[0-9]{11}"></textarea>
									</div>
									<div class="checkout_extra">
										<ul>
											<li class="billing_info d-flex flex-row align-items-center justify-content-start">
												<label class="checkbox_container">
													<input type="checkbox" id="cb_1" name="billing_checkbox" class="billing_checkbox" required="required"<?php if($ayarlarsatir["sozlesmeonayli"] == 1) {echo ' checked="checked"';} ?>>
													<span class="checkbox_mark"></span>
													<span class="checkbox_text"><a href="index.php?sayfa=sayfa&icerik=mesafeli-satis-sozlesmesi" target="_blank">Mesafeli satış sözleşmesi</a>'ni okudum.</span>
												</label>
											</li>
										</ul>
									</div>
									<input type="hidden" name="odemeSekli" required="required">
									<input type="hidden" name="teslimat" value="<?php echo $_POST["kargo"]; ?>">
									<input type="hidden" name="toplamtutar" value="<?php echo ($_POST["kargotutar"]+$_POST["tutar"]); ?>">
									<input type="submit" style="display: none;" />
								</form>
							</div>
						</div>
					</div>

					<!-- Cart Total -->
					<div class="col-lg-6 cart_col">
						<div class="cart_total">
							<div class="cart_extra_content cart_extra_total">
								<div class="checkout_title">Sepet Tutarı</div>
								<ul class="cart_extra_total_list">
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Tutar</div>
										<div class="cart_extra_total_value ml-auto"><?php echo $_POST["tutar"]." ".$parabirimsatir["birim"]; ?></div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Kargo</div>
										<div class="cart_extra_total_value ml-auto"><?php echo $_POST["kargo"]; ?></div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Toplam</div>
										<div class="cart_extra_total_value ml-auto"><?php echo ($_POST["kargotutar"]+$_POST["tutar"])." ".$parabirimsatir["birim"]; ?></div>
									</li>
								</ul>
								<div class="payment_options">
									<div class="checkout_title">Ödeme Yöntemi Seçin</div>
									<ul>
										<?php
										$odemeyontemlerisorgu = "SELECT * FROM odemeyontemleri WHERE durum = 1";
										$odemeyontemlerisorgugonder = mysqli_query($db,$odemeyontemlerisorgu);
										$i = 1;
										while($odemeyontemlerisatir = mysqli_fetch_array($odemeyontemlerisorgugonder)){
										?>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start radios">
											<label class="radio_container">
												<input type="radio" id="radio_<?php echo $i; ?>" name="payment_radio" data-id="<?php echo $odemeyontemlerisatir["id"]; ?>" value="<?php echo $odemeyontemlerisatir['href']; ?>" class="payment_radio"<?php if($i == 1){ echo " checked='checked'"; } ?>>
												<span class="radio_mark"></span>
												<span class="radio_text"><?php echo $odemeyontemlerisatir["isim"]." (".$odemeyontemlerisatir["tutar"]." ".$parabirimsatir["birim"].")"; ?></span>
											</label>
										</li>
										<?php 
											$i++;} ?>
									</ul>
								</div>
								<div class="cart_text">
									<p><?php echo $ayarlarsatir["odemeaciklama"]; ?></p>
								</div>
								<div class="checkout_button trans_200 odemetamambutton"><a href="javascript:;">Ödemeye Geç</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/checkout.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var data_href = $("#radio_1").val();
		$("input[name=odemeSekli]").val($("#radio_1").attr("data-id"));
		$("#checkout_form").attr("action",data_href);
		$(".odemetamambutton").click(function(){
			$("#checkout_form").find('[type="submit"]').trigger('click');
		});
	<?php
		for($xyz = 1;$xyz < $i;$xyz++){ ?>
			$("#radio_<?php echo $xyz; ?>").click(function(){
				var data_href = $("#radio_<?php echo $xyz; ?>").val();
				$("input[name=odemeSekli]").val($("#radio_<?php echo $xyz; ?>").attr("data-id"));
				$("#checkout_form").attr("action",data_href);
			});
	<?php }
	?>
	});
</script>
<?php
}
else{
	echo "<script type='text/javascript'>location.href = 'index.php?sayfa=sepet';</script>";
	header('Location: index.php?sayfa=sepet');
}
?>