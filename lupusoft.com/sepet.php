<?php
	if(isset($_GET["ekle"])){
		$urunminimumalissorgu = "SELECT * FROM urunler WHERE id = ".base64_decode($_GET["ekle"]);
		$urunminimumalissorgugonder = mysqli_query($db,$urunminimumalissorgu);
		$urunminimumalissorgusatir = mysqli_fetch_array($urunminimumalissorgugonder);
			$sepeteuruneklesorgu = "INSERT INTO sepet(urun,miktar,sahip) VALUES(".base64_decode($_GET["ekle"]).",".$urunminimumalissorgusatir["minimumalis"].",".$_SESSION["uyeid"].")";
			$sepeteuruneklesorgugonder = mysqli_query($db,$sepeteuruneklesorgu);
			$sonsepetidsorgu = "select * from sepet where sahip =".$_SESSION["uyeid"]." and urun = ".base64_decode($_GET["ekle"])." ORDER BY id DESC LIMIT 1";
			$sonsepetidsorgugonder = mysqli_query($db,$sonsepetidsorgu);
			$sonsepetidsorgusatir = mysqli_fetch_array($sonsepetidsorgugonder);
			if(isset($_POST["topvar"])){
				for($i = 1;$i<=$_POST["topvar"];$i++){
					if(isset($_POST["varyasyon".$i])){
						$varyasyondegersql = "SELECT * FROM varyasyondeger where id = ".$_POST["varyasyon".$i];
						$varyasyondegersqlgonder = mysqli_query($db,$varyasyondegersql);
						$varyasyondegersatir = mysqli_fetch_array($varyasyondegersqlgonder);
						$varyasyonsorgulasql = "SELECT * FROM varyasyon where id = ".$varyasyondegersatir["sahip"];
						$varyasyonsorgulasqlgonder = mysqli_query($db,$varyasyonsorgulasql);
						$varyasyonsorgulasqlsatir = mysqli_fetch_array($varyasyonsorgulasqlgonder);
						$varyasyonsql = "INSERT INTO sepetvaryasyon(varyasyon,varyasyondeger,sahipsepet,urun) VALUES(".$varyasyonsorgulasqlsatir["id"].",".$_POST["varyasyon".$i].",".$sonsepetidsorgusatir["id"].",".base64_decode($_GET["ekle"]).")";
						$varyasyonsqlgonder = mysqli_query($db,$varyasyonsql);
					} 
				}
			}
			echo "<script type='text/javascript'>window.location.href='index.php?sayfa=sepet';</script>";
			header('Location: index.php?sayfa=sepet');
	}
	if(isset($_POST["sepetsil"])){
		$sepetibulsorgu = "SELECT * FROM sepet where sahip =".$_SESSION["uyeid"];
		$sepetibulsorgugonder = mysqli_query($db,$sepetibulsorgu);
		while($sepetibulsorgusatir = mysqli_fetch_array($sepetibulsorgugonder)){
			$sepetisilsorgu = "DELETE FROM sepet where sahip = ".$_SESSION["uyeid"];
			$sepettevaryasyonsilsorgu = "DELETE FROM sepetvaryasyon where sahipsepet = ".$sepetibulsorgusatir["id"];
			$sepettevaryasyonsilsorgugonder = mysqli_query($db,$sepettevaryasyonsilsorgu);
			$sepetisilsorgugonder = mysqli_query($db,$sepetisilsorgu);
		}
	}
	if(isset($_GET["urunSil"])){
		$sepettensilsorgu = "DELETE FROM sepet where id = ".base64_decode($_GET["urunSil"]);
		$sepettenvaryasyonsilsorgu = "DELETE FROM sepetvaryasyon where sahipsepet = ".base64_decode($_GET["urunSil"]);
		$sepettenvaryasyonsilsorgugonder = mysqli_query($db,$sepettenvaryasyonsilsorgu);
		$sepetisilsorgugonder = mysqli_query($db,$sepettensilsorgu);
	}
	if(isset($_POST["urunmiktar"]) and isset($_POST["urunid"])){
		$sepetsatirigetirsorgu = "SELECT * FROM sepet WHERE id =".base64_decode($_POST["urunid"]);
		$sepetsatirigetirsorgugonder = mysqli_query($db,$sepetsatirigetirsorgu);
		$sepetsatirisatir = mysqli_fetch_array($sepetsatirigetirsorgugonder);
		$urunminimumalissorgu = "SELECT * FROM urunler WHERE id = ".$sepetsatirisatir["urun"];
		$urunminimumalissorgugonder = mysqli_query($db,$urunminimumalissorgu);
		$urunminimumalissorgusatir = mysqli_fetch_array($urunminimumalissorgugonder);
		if($_POST["urunmiktar"] < $urunminimumalissorgusatir["minimumalis"]){
			$miktarduzenlesorgu = "UPDATE sepet SET miktar = ".$urunminimumalissorgusatir["minimumalis"]." WHERE id = ".base64_decode($_POST["urunid"])." and sahip = ".$_SESSION["uyeid"];
			$miktarduzenlegonder = mysqli_query($db,$miktarduzenlesorgu);
		}
		else if ($_POST["urunmiktar"] > $urunminimumalissorgusatir["maksimumalis"]){
			$miktarduzenlesorgu = "UPDATE sepet SET miktar = ".$urunminimumalissorgusatir["maksimumalis"]." WHERE id = ".base64_decode($_POST["urunid"])." and sahip = ".$_SESSION["uyeid"];
			$miktarduzenlegonder = mysqli_query($db,$miktarduzenlesorgu);
		}
		else {
			$miktarduzenlesorgu = "UPDATE sepet SET miktar = ".escape_sql_string($_POST["urunmiktar"])." WHERE id = ".base64_decode($_POST["urunid"])." and sahip = ".$_SESSION["uyeid"];
			$miktarduzenlegonder = mysqli_query($db,$miktarduzenlesorgu);
		}
	}
	$sepettotaltutar = 0;
	if(isset($_GET["coupon"]) and $_GET["coupon"] == "false"){ unset($_SESSION["uygulanmiskupon"]); }
?>
<link rel="stylesheet" type="text/css" href="styles/cart.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	function degistir(x) {
		$("#"+x).submit();
	}
	$(document).ready(function(){
		$(".sipTm2").click(function(){
			$("#form_sipTm > #subm").trigger('click');
		});
		<?php
		$teslimatsorgu = "SELECT * FROM teslimat where durum = 1";
		$teslimatsorgugonder = mysqli_query($db,$teslimatsorgu);
		$i = 1;
		while ($teslimatsatir = mysqli_fetch_array($teslimatsorgugonder)) { ?>
	$("#radio_<?php echo $i; ?>").click(function(){
				$("input[name=kargo]").val('<?php echo $teslimatsatir["isim"]." ".$teslimatsatir["tutar"]." ".$parabirimsatir["birim"]; ?>');
				$("input[name=kargotutar]").val('<?php echo $teslimatsatir["tutar"]; ?>');
				$(".teslimatfiyat").html('<?php echo $teslimatsatir["tutar"]." ".$parabirimsatir["birim"]; ?>');
			});	
		<?php
			$i++;
			}
		?>
});
</script>
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Alışveriş Sepetim</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="index.php">Ana Sayfa</a></li>
							<li>Sepetim</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Cart -->

		<div class="cart_section">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="cart_container">
							<?php
									$sepetsorgu = "select * from sepet where sahip = ".$_SESSION["uyeid"];
									$sepetsorgugonder = mysqli_query($db,$sepetsorgu);
									$sepetsayac = 0;
									if(mysqli_num_rows($sepetsorgugonder) > 0){
							?>
							<!-- Cart Bar -->
							<div class="cart_bar">
								<ul class="cart_bar_list item_list d-flex flex-row align-items-center justify-content-end">
									<li class="mr-auto">Ürün</li>
									<li>Birim</li>
									<li>Özellikler</li>
									<li>Fiyat</li>
									<li>Miktar</li>
									<li>Toplam</li>
								</ul>
							</div>

							<!-- Cart Items -->
							<div class="cart_items">
								<ul class="cart_items_list">
									<?php
										while($sepetsorgusatir = mysqli_fetch_array($sepetsorgugonder)){
											$sepetsayac++;
											$sepetteurunsorgu = "select * from urunler where id = ".$sepetsorgusatir["urun"];
											$sepetteurunsorgugonder = mysqli_query($db,$sepetteurunsorgu);
											$sepetteurunsorgusatir = mysqli_fetch_array($sepetteurunsorgugonder);
											$sepetteurunresimsorgu = "select * from resimler where sahip =".$sepetteurunsorgusatir["id"]." ORDER BY id ASC LIMIT 1"; 
											$sepetteurunresimsorgugonder = mysqli_query($db,$sepetteurunresimsorgu);
											$sepetteurunresimsatir = mysqli_fetch_array($sepetteurunresimsorgugonder);
													$tutaricinvaryasyonsorgula = "SELECT * FROM sepetvaryasyon WHERE sahipsepet = ".$sepetsorgusatir["id"]." and urun = ".$sepetteurunsorgusatir["id"];
													$tutaricinvaryasyonsorgulagonder = mysqli_query($db,$tutaricinvaryasyonsorgula);
													if(mysqli_num_rows($tutaricinvaryasyonsorgulagonder)> 0){
														$i = 1;
														$toplam_var_fiyat = 0;
														while($tutaricinvaryasyonsorgulasatir = mysqli_fetch_array($tutaricinvaryasyonsorgulagonder)){
															 $tutaricinvaryasyonadisorgula = "SELECT * FROM varyasyon where id = ".$tutaricinvaryasyonsorgulasatir["varyasyon"];
															 $tutaricinvaryasyonadisorgulagonder = mysqli_query($db,$tutaricinvaryasyonadisorgula);
															 $tutaricinvaryasyonadisorgusatir = mysqli_fetch_array($tutaricinvaryasyonadisorgulagonder);
															 $tutaricinvaryasyondegersorgula = "SELECT * FROM varyasyondeger where id = ".$tutaricinvaryasyonsorgulasatir["varyasyondeger"];
															 $tutaricinvaryasyondegersorgulagonder = mysqli_query($db,$tutaricinvaryasyondegersorgula);
															 $tutaricinvaryasyondegersorgusatir = mysqli_fetch_array($tutaricinvaryasyondegersorgulagonder);
															 $tutaricinvaryasyonadi[$i] = $tutaricinvaryasyonadisorgusatir["varyasyonadi"];
															 $tutaricinvaryasyondegeri[$i] = $tutaricinvaryasyondegersorgusatir["deger"];
															 $toplam_var_fiyat = $toplam_var_fiyat+$tutaricinvaryasyondegersorgusatir["tutar"];
															 $toplam_fiyat = ($sepetteurunsorgusatir["fiyat"]+$toplam_var_fiyat) * $sepetsorgusatir["miktar"];
															 $i++;
														}
													}
													else {
														$toplam_fiyat = $sepetteurunsorgusatir["fiyat"] * $sepetsorgusatir["miktar"];
													}
											$fiyat_dizi = explode (".",$sepetteurunsorgusatir["fiyat"]);
											if(@$fiyat_dizi[1] < 10){
												@$fiyat_dizi[1] = $fiyat_dizi[1]."0";
												ltrim($fiyat_dizi[1],"0");
											}
											$toplam_fiyat_dizi = explode (".",$toplam_fiyat);
											if(@$toplam_fiyat_dizi[1] < 10){
												@$toplam_fiyat_dizi[1] = $toplam_fiyat_dizi[1]."0";
												ltrim($toplam_fiyat_dizi[1],"0");
											}
											if(mysqli_num_rows($sepetteurunresimsorgugonder) < 1){
												$sepetteurunresimsatir["isim"] = "hazirlaniyor.png";
											}
											echo '
											<!-- Cart Item -->
											<li class="cart_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-end justify-content-start">
												<div class="product d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start mr-auto">
													<div><div class="product_number"><a href="?sayfa=sepet&urunSil='.base64_encode($sepetsorgusatir["id"]).'"><img src="images/delete.png" title="Bu ürünü sepetten çıkart" /></a> &nbsp;&nbsp;'.$sepetsayac.'</div></div>
													<div><div class="product_image"><img src="images/'.$sepetteurunresimsatir["isim"].'" alt="'.$sepetteurunsorgusatir["isim"].'"></div></div>
													<div class="product_name_container">
														<div class="product_name"><a href="?sayfa=detay&u='.base64_encode($sepetteurunsorgusatir["id"]).'">'.$sepetteurunsorgusatir["isim"].'</a></div>
														<div class="product_text">'.substr(strip_tags($sepetteurunsorgusatir["aciklama"]) , 0, 64).'...</div>
													</div>
												</div>
												<div class="product_color product_text" title="Birim"><span>Birim : </span>';
												$urunbirimsorgu = "SELECT * from birimler where id = ".$sepetteurunsorgusatir["birim"];
												$urunbirimsorgugonder = mysqli_query($db,$urunbirimsorgu);
												$urunbirimsorgusatir = mysqli_fetch_array($urunbirimsorgugonder);
												echo $urunbirimsorgusatir["isim"];
												echo'</div>';
												$varyasyonsorgula = "SELECT * FROM sepetvaryasyon WHERE sahipsepet = ".$sepetsorgusatir["id"]." and urun = ".$sepetteurunsorgusatir["id"];
												$varyasyonsorgulagonder = mysqli_query($db,$varyasyonsorgula);
												if(mysqli_num_rows($varyasyonsorgulagonder)> 0){
													echo '<div class="product_size product_text"><span>Özellikler : </span><b>Detay</b> <font class="circle">&#10067;</font><div class="data-popup">';
													$i = 0;
													while($varyasyonsorgulasatir = mysqli_fetch_array($varyasyonsorgulagonder)){
														 $varyasyonadisorgula = "SELECT * FROM varyasyon where id = ".$varyasyonsorgulasatir["varyasyon"];
														 $varyasyonadisorgulagonder = mysqli_query($db,$varyasyonadisorgula);
														 $varyasyonadisorgusatir = mysqli_fetch_array($varyasyonadisorgulagonder);
														 $varyasyondegersorgula = "SELECT * FROM varyasyondeger where id = ".$varyasyonsorgulasatir["varyasyondeger"];
														 $varyasyondegersorgulagonder = mysqli_query($db,$varyasyondegersorgula);
														 $varyasyondegersorgusatir = mysqli_fetch_array($varyasyondegersorgulagonder);
														 $varyasyonadi[$i] = $varyasyonadisorgusatir["varyasyonadi"];
														 $varyasyondegeri[$i] = $varyasyondegersorgusatir["deger"];
														 $i++;
														 echo '<strong>'.$varyasyonadisorgusatir["varyasyonadi"].'</strong> : '.$varyasyondegersorgusatir["deger"].' ('.$varyasyondegersorgusatir["tutar"].' '.$parabirimsatir["birim"].')<br>';
													}
												}
												else {
													echo '<div class="product_size product_text hidden-txt"><span></span><div class="data-popup">';
												}
												echo '</div></div>
												<div class="product_price product_text"><span>Tutar : </span>'.$fiyat_dizi[0].'.'.$fiyat_dizi[1].' '.$parabirimsatir["birim"].'</div><div class="product_quantity_container">
													<div class="product_quantity ml-lg-auto mr-lg-auto text-center">
														<form method="POST" id="'.md5($sepetsorgusatir["id"]).'">
															<input type="hidden" name="urunid" value="'.base64_encode($sepetsorgusatir["id"]).'"/>
															<input type="number" name="urunmiktar" min="'.$sepetteurunsorgusatir["minimumalis"].'" max="'.$sepetteurunsorgusatir["maksimumalis"].'" onkeyup="degistir(`'.md5($sepetsorgusatir["id"]).'`)" onchange="degistir(`'.md5($sepetsorgusatir["id"]).'`)" class="product_text product_num" value="'.$sepetsorgusatir["miktar"].'">
														</form>
													</div>
												</div>
												<div class="product_total product_text"><span>Toplam: </span>'.$toplam_fiyat_dizi[0].'.'.$toplam_fiyat_dizi[1].' '.$parabirimsatir["birim"].'</div>
											</li>';
											$sepettotaltutar = $sepettotaltutar + $toplam_fiyat_dizi[0] + ($toplam_fiyat_dizi[1] / 100);
										}
									}
									else {
										echo "<center><img src='images/bossepet.gif'><h2>Sepet şu anda boş!</h2>
										<br><a href='index.php' class='alisverisedon'>Haydi şimdi dolduralım!</a><center>";
									}
									
									?>

								</ul>
							</div>

							<!-- Cart Buttons -->
							<?php
								if($sepetsayac > 0){
							?>
							<div class="cart_buttons d-flex flex-row align-items-start justify-content-start">
								<div class="cart_buttons_inner ml-sm-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
									<form method="POST" style="display: block;width: 100%;">
										<input type="hidden" name="sepetsil" value="1">
										<div class="button button_clear trans_200" style="width:100%;"><a href="javascript:void(0);"><input class="clearinput" type="submit" value="Temizle"></a></div>
									</form>
										<input type="submit" value="Tamamla" class="checkout_button sipTm sipTm2" style="margin-top:0px;">	
								</div>
							</div>
							<?php
								}
								$kuponmetin = "";
								if(!isset($_SESSION["uygulanmiskupon"])){
									if(isset($_POST["kuponkodu"])){
										$kuponsorgu = "SELECT * FROM kuponkodu WHERE (durum = 1) and (kod='".$_POST["kuponkodu"]."')";
										$kuponsorgugonder = mysqli_query($db,$kuponsorgu);
										if(mysqli_num_rows($kuponsorgugonder) > 0){
											$kuponsatir = mysqli_fetch_array($kuponsorgugonder);
											$sepettotaltutar = $sepettotaltutar - ($sepettotaltutar * $kuponsatir["tutar"]);
											/*$kuponusilsorgu = "UPDATE kuponkodu set durum = 0, kullanan = ".$_SESSION["uyeid"];
											$kuponsilsorgugonder = mysqli_query($db,$kuponusilsorgu);*/
											$kuponsatir["tutar"] = str_replace("0.", "%", $kuponsatir["tutar"]);
											$kuponmetin = $kuponsatir["tutar"]."0";
											$_SESSION["uygulanmiskupon"] = $_POST["kuponkodu"];
										}
										else {
											$kuponmetin = "Uygulanamadı. Geçersiz kupon.";
										}
									}
								}
								else if(isset($_SESSION["uygulanmiskupon"])){
										$kuponsorgu = "SELECT * FROM kuponkodu WHERE (durum = 1) and (kod='".$_SESSION["uygulanmiskupon"]."')";
										$kuponsorgugonder = mysqli_query($db,$kuponsorgu);
										$kuponsatir = mysqli_fetch_array($kuponsorgugonder);
										$sepettotaltutar = $sepettotaltutar - ($sepettotaltutar * $kuponsatir["tutar"]);
										/*$kuponusilsorgu = "UPDATE kuponkodu set durum = 0, kullanan = ".$_SESSION["uyeid"];
										$kuponsilsorgugonder = mysqli_query($db,$kuponusilsorgu);*/
										$kuponsatir["tutar"] = str_replace("0.", "%", $kuponsatir["tutar"]);
										$kuponmetin = $kuponsatir["tutar"]."0";
								}
							?>
						</div>
					</div>
				</div>
				<div class="row cart_extra_row">
					<?php
						if($sepetsayac > 0){
					?>
					<div class="col-lg-6">
						<div class="cart_extra cart_extra_1">
							<div class="cart_extra_content cart_extra_coupon">
								<?php
									if($ayarlarsatir["kuponaktif"] == 1 && !isset($_SESSION["uygulanmiskupon"])){
										?>
										<div class="cart_extra_title">Kupon Kodu</div>
										<div class="coupon_form_container">
											<form id="coupon_form" method="POST" class="coupon_form">
												<input type="text" name="kuponkodu" class="coupon_input" required="required">
												<button class="coupon_button">Uygula</button>
											</form>
										</div>
										<div class="coupon_text">Eğer kupon koduna sahipseniz buraya girerek tutarınıza kuponun yüzdesi değerinde indirim uygulayabilirsiniz.</div>
										<?php
									}
									else if(isset($_SESSION["uygulanmiskupon"])){ ?>
										<div class="cart_extra_title">Kupon Kodu</div>
										<div class="coupon_form_container">
											Kupon durumu : aktif<a href="?sayfa=sepet&coupon=false"><button class="coupon_button">Geri al</button></a>
										</div>
									<?php }
								?>
								<div class="shipping">
									<div class="cart_extra_title">Teslimat seçimi</div>
									<ul>
										<?php
										$kargoadi= "";
										$kargoucreti = "";
										$teslimatsorgu = "SELECT * FROM teslimat where durum = 1";
										$teslimatsorgugonder = mysqli_query($db,$teslimatsorgu);
										$i = 1;
										while ($teslimatsatir = mysqli_fetch_array($teslimatsorgugonder)) {
										?>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_<?php echo $i; ?>" name="shipping_radio" class="shipping_radio"<?php if($i == 1){echo " checked='checked'"; $kargoadi = $teslimatsatir["isim"]; $kargoucreti = $teslimatsatir["tutar"]; } ?>>
												<span class="radio_mark"></span>
												<span class="radio_text"><?php echo $teslimatsatir["isim"]; ?></span>
											</label>
											<div class="shipping_price ml-auto">+<?php echo $teslimatsatir["tutar"]." ".$parabirimsatir["birim"]; ?></div>
										</li>
										<?php
										$i++;
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 cart_extra_col">
						<div class="cart_extra cart_extra_2">
							<div class="cart_extra_content cart_extra_total">
								<div class="cart_extra_title">Sepet Toplamı</div>
								<ul class="cart_extra_total_list">
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title"><u>Hizmet Adı</u></div>
										<div class="cart_extra_total_value ml-auto"><u>Ücreti</u></div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Teslimat</div>
										<div class="cart_extra_total_value ml-auto teslimatfiyat"><?php echo $kargoucreti." ".$parabirimsatir["birim"]; ?></div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Tutar</div>
										<div class="cart_extra_total_value ml-auto toplamfiyat"><?php echo $sepettotaltutar." ".$parabirimsatir["birim"]; ?></div>
									</li>
								<?php if(isset($_POST["kuponkodu"]) or isset($_SESSION["uygulanmiskupon"])){ ?>
									<li class="d-flex flex-row align-items-center justify-content-start dashed">
										<div class="cart_extra_total_title">İndirim</div>
										<div class="cart_extra_total_value ml-auto"><?php echo $kuponmetin; ?></div>
									</li>
								<?php } ?>
								</ul><br>
								<?php if($sepettotaltutar >= $ayarlarsatir["sipmintutar"]){ ?>
								<form method="POST" action="?sayfa=odeme" id="form_sipTm">
									<input type="hidden" name="kargo" value="<?php echo $kargoadi.' '.$kargoucreti.$parabirimsatir["birim"]; ?>">
									<input type="hidden" name="kargotutar" value="<?php echo $kargoucreti; ?>">
									<input type="hidden" name="tutar" value="<?php echo $sepettotaltutar; ?>">
									<input type="submit" id="subm" value="Siparişi Tamamla" class="checkout_button sipTm">	
								</form>
							<?php } else { ?>
									<center class="sipFalse"><span>&#9940;</span> En az <b><?php echo $ayarlarsatir["sipmintutar"]." ".$parabirimsatir["birim"]; ?></b> tutarında sipariş verebilirsiniz.<br><small>(Alt tutara teslimat ücreti dahil değildir.)</small></center>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>