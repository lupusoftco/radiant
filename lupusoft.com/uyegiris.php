<?php
	if(!empty($_POST["giriseposta"]) && !empty($_POST["girissifre"])){
		$girissorgu = "SELECT * FROM uyeler WHERE eposta='".$_POST["giriseposta"]."' and sifre='".md5($_POST["girissifre"])."'";
		$girissorgugonder = mysqli_query($db,$girissorgu);
		if(mysqli_num_rows($girissorgugonder) == 1) {
			$girissorgusatir = mysqli_fetch_array($girissorgugonder);
			$_SESSION["uyeid"] = $girissorgusatir["id"];
			$_SESSION["oturum"] = "acik";
			sleep(1);
			if(!empty($_GET["ekle"])){
				echo "<script type='text/javascript'>location.href = 'index.php?sayfa=detay&u=".$_GET["ekle"]."';</script>";
				header('Location: index.php?sayfa=detay&u='.$_GET["ekle"]);
			}
			else {
				echo "<script type='text/javascript'>location.href = 'index.php?sayfa=profil';</script>";
				header('Location: index.php?sayfa=profil');
			}
		}
		else {
			echo "<script type='text/javascript'>alert('Hatalı kullanıcı adı yada şifre');</script>";
		}
	}
	if (!empty($_POST["kayitisim"]) && !empty($_POST["kayitsoyisim"]) && !empty($_POST["kayitadresbir"]) && !empty($_POST["kayittel"]) && !empty($_POST["kayiteposta"]) && !empty($_POST["kayitsifre"])){
		$epostavarmisorgu = "SELECT * FROM uyeler WHERE eposta = '".$_POST["kayiteposta"]."'";
		$epostavarmisorgugonder = mysqli_query($db,$epostavarmisorgu);
		if(mysqli_num_rows($epostavarmisorgugonder) < 1){
			$kayitsorgu = "INSERT INTO `uyeler` (`id`, `adsoyad`, `sirket`, `adres`,`postakodu`, `sehir`,`semt`, `telefon`, `eposta`, `sifre`) VALUES (NULL, '".escape_sql_string($_POST["kayitisim"])." ".escape_sql_string($_POST["kayitsoyisim"])."', '".escape_sql_string($_POST["kayitsirketisim"])."', '".escape_sql_string($_POST["kayitadresbir"])." ".escape_sql_string($_POST["kayitadresiki"])."','".escape_sql_string($_POST["kayitpostakodu"])."', '".escape_sql_string($_POST["il"])."','".escape_sql_string($_POST["ilce"])."', '".escape_sql_string($_POST["kayittel"])."', '".escape_sql_string($_POST["kayiteposta"])."', '".md5($_POST["kayitsifre"])."')";
			if(isset($_POST["ebultenuyelik"])){
				mysqli_query($db, "INSERT INTO ebulten(eposta) VALUES('".escape_sql_string($_POST["kayiteposta"])."')");
			}
			$kayitsorgugonder = mysqli_query($db,$kayitsorgu);
			/*
			$girissorgu = "SELECT * FROM uyeler WHERE eposta='".escape_sql_string($_POST["kayiteposta"])."' and sifre='".escape_sql_string($_POST["kayitsifre"])."'";
			$girissorgugonder = mysqli_query($db,$girissorgu);
			$girissorgusatir = mysqli_fetch_array($girissorgugonder);
			$_SESSION["uyeid"] = $girissorgusatir["id"];
			$_SESSION["oturum"] = "acik";
			*/
			echo "<script type='text/javascript'>alert('Üyelik işleminiz tamamlanmıştır.');</script>";
			/*
			if(!empty($_GET["ekle"])){
				echo "<script type='text/javascript'>location.href = 'index.php?sayfa=detay&u=".$_GET["ekle"]."';</script>";
				header('Location: index.php?sayfa=detay&u='.$_GET["ekle"]);
			}
			else {*/
				echo "<script type='text/javascript'>location.href = 'index.php?sayfa=profil';</script>";
				header('Location: index.php?sayfa=profil');
			//}
		}
		else {
			echo "<script type='text/javascript'>alert('Bu eposta adresi zaten kullanılmakta.');</script>";
		}
	}
?>
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Üye Girişi</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="index.php">Ana Sayfa</a></li>
							<li>Üye Girişi</li>
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
							<div class="checkout_title">Üye Ol</div>
							<div class="checkout_form_container">
								<form method="POST" id="register_form" class="checkout_form">
									<div class="row">
										<div class="col-lg-6">
											<!-- Name -->
											<input type="text" id="checkout_name" class="checkout_input" name="kayitisim" placeholder="İsim" required="required">
										</div>
										<div class="col-lg-6">
											<!-- Last Name -->
											<input type="text" id="checkout_last_name" class="checkout_input" name="kayitsoyisim" placeholder="Soyisim" required="required">
										</div>
									</div>
									<div>
										<!-- Company -->
										<input type="text" id="checkout_company" name="kayitsirketisim" placeholder="Varsa Şirket İsmi" class="checkout_input">
									</div>
									<!--<div>
										<select name="checkout_country" id="checkout_country" class="dropdown_item_select checkout_input" require="required">
											<option>Country</option>
											<option>Country</option>
										</select>
									</div> -->
									<div>
										<!-- Address -->
										<input type="text" id="checkout_address" class="checkout_input" name="kayitadresbir" placeholder="Adres satırı 1" required="required">
										<input type="text" id="checkout_address_2" class="checkout_input checkout_address_2" name="kayitadresiki" placeholder="Adres satırı 2" required="required">
									</div>
									<div>
										<!-- Zipcode -->
										<input type="text" id="checkout_zipcode" class="checkout_input" name="kayitpostakodu" placeholder="Posta kodu" required="required">
									</div>
									<div>
										<!-- City / Town -->
										<select name="il" id="il" class="dropdown_item_select checkout_input form-control" require="required">
											<option>İl Seçiniz...</option>
										</select>
									</div>
									<div>
										<!-- Province -->
										<select name="ilce" id="ilce" class="dropdown_item_select checkout_input form-control" require="required">
											<option>İlçe Seçiniz...</option>
										</select>
									</div>
									<div>
										<!-- Phone no -->
										<input type="phone" id="checkout_phone" class="checkout_input" placeholder="Telefon numarası" name="kayittel" required="required">
									</div>
									<div>
										<!-- Email -->
										<input type="email" id="checkout_email" class="checkout_input" placeholder="E-posta adresi" name="kayiteposta" required="required">
									</div>
									<div>
										<!-- Pw -->
										<input type="password" class="checkout_input" placeholder="Şifre" name="kayitsifre" required="required">
									</div>
									<div class="checkout_extra">
										<ul>
											<li class="billing_info d-flex flex-row align-items-center justify-content-start">
												<label class="checkbox_container">
													<input type="checkbox" id="cb_1" name="sartkosul" class="billing_checkbox" required="required">
													<span class="checkbox_mark"></span>
													<span class="checkbox_text"><a href="index.php?sayfa=sayfa&icerik=uyelik-sozlesmesi" target="_blank">Üyelik sözleşmesi</a>ni okudum</span>
												</label>
											</li>
											<li class="billing_info d-flex flex-row align-items-center justify-content-start">
												<label class="checkbox_container">
													<input type="checkbox" id="cb_3" name="ebultenuyelik" class="billing_checkbox">
													<span class="checkbox_mark"></span>
													<span class="checkbox_text">E-Bülten üyesi olarak ekle</span>
												</label>
											</li>
										</ul>
									</div>
									<input class="checkout_button trans_200" style="cursor:pointer;font-weight: bold;color:#FFF;font-size:22px;" type="submit" value="Üye Ol">
								</form>
							</div>
						</div>
					</div>

					<!-- Cart Total -->
					<div class="col-lg-6 cart_col">
						<div class="cart_total">
							<form method="POST" id="login_form" class="checkout_form">
								<div class="cart_extra_content cart_extra_total">
									<div class="checkout_title">Giriş Yap</div>
									<div class="cart_text">
										<p></p>
									</div>
									<div>
										<!-- Email -->
										<input type="phone" id="login_email" class="checkout_input" name="giriseposta" placeholder="E-posta adresi" required="required">
									</div>
									<div class="cart_text">
										<p></p>
									</div>
									<div>
										<!-- Pw -->
										<input type="password" class="checkout_input" name="girissifre" placeholder="Şifre" required="required">
									</div>
									<input class="checkout_button trans_200" style="cursor:pointer;font-weight: bold;color:#FFF;font-size:22px;" type="submit" value="Giriş Yap">
									<div class="cart_text">
										<p><a href="">Şifreni mi unuttun?</a></p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript">
			$.getJSON("il-bolge.json", function(sonuc){
		        $.each(sonuc, function(index, value){
		            var row="";
		            row +='<option value="'+value.il+'">'+value.il+'</option>';
		            $("#il").append(row);
		        })
		    });
			$("#il").on("change", function(){
		        var il=$(this).val();
		        $("#ilce").attr("disabled", false).html('<option value="MERKEZ">MERKEZ</option>');
		        $.getJSON("il-ilce.json", function(sonuc){
		            $.each(sonuc, function(index, value){
		                var row='';
		                if(value.il==il)
		                {
		                    row +='<option value="'+value.ilce+'">'+value.ilce+'</option>';
		                    $("#ilce").append(row);
		                }
		            });
		        });
		    });
		</script>