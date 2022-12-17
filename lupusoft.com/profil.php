<?php
if($_SESSION["oturum"] != "acik"){
	die();
	header('Location: index.php?sayfa=anasayfa');
}
$uyesayfasorgu="SELECT * FROM uyeler where id =".$_SESSION["uyeid"];
$uyesayfasorgugonder = mysqli_query($db,$uyesayfasorgu);
$uyesayfasorgusatir = mysqli_fetch_array($uyesayfasorgugonder);
?>
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/profil.css">
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".fancyframe").click(function(){
			var page = $(this).attr("data-href");
			var userid = $(this).attr("data-id");
			if(page == "fav"){
				$(".fancy-content > .iframe").html('<iframe style="width:100%;min-height:500px;background:#FFF;" src="islem.php?sayfa='+page+'&id='+userid+'" title="Favoriler Listem"></iframe>');
			}
			else if(page == "des") {
				$(".fancy-content > .iframe").html('<iframe style="width:100%;min-height:500px;background:#FFF;" src="islem.php?sayfa='+page+'&id='+userid+'" title="Destek Birimleriyle İletişim"></iframe>');
			}
			else if(page == "sip") {
				$(".fancy-content > .iframe").html('<iframe style="width:100%;min-height:500px;background:#FFF;" src="islem.php?sayfa='+page+'&id='+userid+'" title="Sipariş Durumu ve Geçmişi"></iframe>');
			}
			else if(page == "aya") {
				$(".fancy-content > .iframe").html('<iframe style="width:100%;min-height:500px;background:#FFF;" src="islem.php?sayfa='+page+'&id='+userid+'" title="Hesap Ayarları"></iframe>');
			}
			else if(page == "adeft") {
				$(".fancy-content > .iframe").html('<iframe style="width:100%;min-height:500px;background:#FFF;" src="islem.php?sayfa='+page+'&id='+userid+'" title="Adres Defterim"></iframe>');
			}
			else if(page == "iad") {
				$(".fancy-content > .iframe").html('<iframe style="width:100%;min-height:500px;background:#FFF;" src="islem.php?sayfa='+page+'&id='+userid+'" title="Adres Defterim"></iframe>');
			}
			$(".fancy-bg").fadeToggle();
		});
		$(".fancy-close").click(function() {
			$(".fancy-bg").fadeToggle();
		});
	});
	function ClosePopupGoProduct(u)
    {
        $(".fancy-bg").fadeToggle();
        window.location.href ="index.php?sayfa=detay&u="+u;
    }
    function goHomePage()
    {
        $(".fancy-bg").fadeToggle();
        window.location.href ="index.php";
    }
</script>
<div class="fancy-bg">
	<div class="fancy-close"><b>X</b></div>
	<div class="fancy-content">
		<div class="iframe">&nbsp;</div>
	</div>
</div>
	<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Profil</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Product -->

		<div class="product">
			<div class="container">
				<div class="row">
					<!-- Product Info -->
					<div class="col-lg-12 product_col">
						<div class="product_info">
							<div class="product_name">Üye Bilgileri</div>
							<div class="product_category"><?php echo $uyesayfasorgusatir["adsoyad"]; ?></div>
							<div class="product_text">
								"Profil" sayfasından siparişlerinizi ve arıza/iade/değişim işlemlerinizi takip edebilir, üyelik bilgisi güncelleme, şifre ve adres değişikliği gibi hesap ayarlarınızı kolayca yapabilirsiniz.
								<p><?php echo $ayarlarsatir["uyesayfasiduyuru"]; ?></p>
							</div>
							<div class="product_buttons">
								<div class="text-right d-flex flex-row align-items-start justify-content-start">
									<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
										Favori ürünlerim<div><div><a class="fancyframe" data-id="<?php echo $_SESSION['uyeid']; ?>" data-href="fav" href="javascript:;"><img src="images/heart_2.svg" class="svg" alt=""></a></div></div>
									</div>
									<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
										Sepetim<div><div><a href="?sayfa=sepet"><img src="images/cart.svg" class="svg" alt=""></a></div></div>
									</div>
								</div>
							</div>
							<div class="product_buttons">
								<div class="text-right d-flex flex-row align-items-start justify-content-start">
									<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
										Bilet oluştur<div><div><a class="fancyframe" data-id="<?php echo $_SESSION['uyeid']; ?>" data-href="des" href="javascript:;"><img src="images/support.svg" class="svg" alt=""></a></div></div>
									</div>
									<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
										Sipariş geçmişim<div><div><a class="fancyframe" data-id="<?php echo $_SESSION['uyeid']; ?>" data-href="sip" href="javascript:;"><img src="images/return.svg" class="svg" alt=""></a></div></div>
									</div>
								</div>
							</div>
							<div class="product_buttons">
								<div class="text-right d-flex flex-row align-items-start justify-content-start">
									<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
										Hesap ayarları<div><div><a class="fancyframe" data-id="<?php echo $_SESSION['uyeid']; ?>" data-href="aya" href="javascript:;"><img src="images/settings.svg" class="svg" alt=""></a></div></div>
									</div>
									<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
										Çıkış yap<div><div><a href="?sayfa=cikis"><img src="images/logout.svg" class="svg" alt=""></a></div></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Boxes -->

		<div class="boxes">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="box d-flex flex-row align-items-center justify-content-start">
							<div class="mt-auto"><div class="box_image"><img src="images/return-order.svg" alt=""></div></div>
							<div class="box_content" style="padding-top:20px;">
								<div class="box_title">İade&nbsp;Talepleri</div>
								<div class="box_text" id="settings"><a class="fancyframe" data-id="<?php echo $_SESSION['uyeid']; ?>" data-href="iad" href="javascript:;">Buradan</a> iade taleplerinizi görüntüleyebilirsiniz.
									<!--<p>
										<form method="POST" style="background:#f8f8f8;padding:10px;box-shadow:0px 2px 2px #999;">
											<input type="text" name="" placeholder="İsim Soyisim">&nbsp;&nbsp;&nbsp;<input type="text" name="" placeholder="Şirket Adı (Varsa)">&nbsp;&nbsp;&nbsp;
											<input type="text" name="" placeholder="Adres satırı 1">&nbsp;&nbsp;&nbsp;<input type="text" name="" placeholder="Adres satırı 2">&nbsp;&nbsp;&nbsp;
											<input type="text" name="" placeholder="Posta Kodu">&nbsp;&nbsp;&nbsp;<select><option>Şehir</option></select>&nbsp;&nbsp;&nbsp;
											<input type="text" name="" placeholder="Telefon Numarası">&nbsp;&nbsp;&nbsp;<select><option>Semt</option></select>&nbsp;&nbsp;&nbsp;
											<input type="submit" name="" value="Güncelle" style="cursor:pointer;">&nbsp;&nbsp;&nbsp;
											<a href=""><button>Güvenlik Ayarları</button></a>
										</form>
									</p>-->
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 box_col">
						<div class="box d-flex flex-row align-items-center justify-content-start">
							<div class="mt-auto"><div class="box_image"><img src="images/address.svg" alt=""></div></div>
							<div class="box_content" style="padding-top:20px;">
								<div class="box_title">Adres&nbsp;Defterim</div>
								<div class="box_text">Tüm adreslerinizi <a class="fancyframe" data-id="<?php echo $_SESSION['uyeid']; ?>" data-href="adeft" href="javascript:;">adres defterinizden</a> yönetebilirsiniz.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>