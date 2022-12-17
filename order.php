<?php
function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
if((!isset($_POST["adi"])) and ((!isset($_POST["soyadi"]))) and ((!isset($_POST["tckn"]))) and ((!isset($_POST["adresi"]))) and ((!isset($_POST["telefonu"]))) and ((!isset($_POST["epostaadresi"]))) and ((!isset($_POST["odemeSekli"]))) and ((!isset($_POST["toplamtutar"])))){
	echo "<script type='text/javascript'>location.href = 'index.php?sayfa=sepet';</script>";
	header('Location: index.php?sayfa=sepet');
}
$odemeyontemlerisorgu = "SELECT * FROM odemeyontemleri where id=".$_POST["odemeSekli"];
$odemeyontemlerisorgugonder = mysqli_query($db,$odemeyontemlerisorgu);
$odemeyontemlerisatir = mysqli_fetch_array($odemeyontemlerisorgugonder);
$_POST["toplamtutar"] = $_POST["toplamtutar"] + $odemeyontemlerisatir["tutar"];
function orderCodeCreator() {
	$siparisnumarasi = uniqid('SIP'.$_SESSION["uyeid"].rand(0,999));
	@$sipnosorgula = mysqli_query($db,"select * from siparis where siptakipno = '".$siparisnumarasi."'");
	if(@mysqli_num_rows($sipnosorgula) > 0){
		while(mysqli_num_rows($sipnosorgula) < 1){
			$siparisnumarasi = uniqid('SIP'.$_SESSION["uyeid"].rand(0,999));
			$sipnosorgula = mysqli_query($db,"select * from siparis where siptakipno = '".$siparisnumarasi."'");
		}
	}
	return $siparisnumarasi;
}

if(!isset($_SESSION["sipno"])){
	$_SESSION["sipno"] = strtoupper(orderCodeCreator());
}

?><link rel="stylesheet" type="text/css" href="styles/category.css">
<link rel="stylesheet" type="text/css" href="styles/category_responsive.css">
<script src="js/jquery-3.2.1.min.js"></script><?php
if($_GET["t"] == "kartGir"){ ?>

<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Online Ödeme</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
							<li><a href="?sayfa=sepet">Sepetim</a></li>
							<li><a href="?sayfa=odeme">Sipariş</a></li>
							<li>Ödeme</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row products_row products_container grid">
					<div class="col-xl-12 col-md-12 grid-item">
						<div class="product">
							<div class="product_image" style="width:100%;text-align: center;">
								<h3>İyzico ile öde</h3>
								Ödemenizi aşağıdaki formu kullanarak yapın ve siparişinizi tamamlayın.<br>
								&nbsp;
							</div>
							<div class="product_content mt-2">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_category">urun kategori</div>
												<div id="iyzipay-checkout-form" class="responsive"></div> ///////////////////////
											<div>form alti yazi</div>
										</div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="Ödememi tamamladım.">
											<div><div><a href='index.php'><img src="images/select.svg" class="svg" alt=""></a></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php }
else if($_GET["t"] == "havale"){ 
?>
<script type="text/javascript">
	function havaleBankaSecim(id){
		$(".product").html('<div class="product_image" style="width:100%;text-align: center;"><img src="images/scorder.svg" width="100" /><br>&nbsp;<br>Siparişiniz Tamamlandı.<br>&nbsp;</div>');
		$(".product").append('<div class="product_content"><center>Sipariş Numaranız : <?php echo $_SESSION["sipno"]; ?></center></div><div class="ml-auto text-right">Sipariş Tutarı<div class="product_price text-right"><?php echo $_POST["toplamtutar"]; ?> <?php echo $parabirimsatir["birim"]; ?></div></div></div><div class="product_buttons"><div class="text-right d-flex flex-row align-items-start justify-content-start"><div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center" title="Anasayfaya Dön"><div><div><a href="index.php"><img src="images/return.svg" class="svg" alt=""></a></div></div></div><div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="Siparişlerimde Görüntüle"><div><div><a href="javascript:void(0);" onclick="window.open(\'islem.php?sayfa=sip&id=<?php echo $_SESSION["uyeid"] ?>\', \'newwindow\', \'width=600,height=500\'); return false;"><img src="images/detail.svg" class="svg" alt=""></a></div></div></div></div></div></div>');
		$(".home").append("<iframe src='islem.php?bank="+id+"&order=<?php echo $_SESSION["sipno"]; ?>' style='display:none;'>");
	}
</script>
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Hesap Bilgileri</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
							<li><a href="?sayfa=sepet">Sepetim</a></li>
							<li><a href="?sayfa=odeme">Sipariş</a></li>
							<li>Ödeme</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row products_row products_container grid">
					<div class="col-xl-12 col-md-12 grid-item">
						<div class="product">
							<div class="product_image" style="width:100%;text-align: center;">
								<h3>Çalıştığımız Bankalar</h3>
								Ödemenizi aşağıdaki banka bilgilerini kullanarak yapın ve işlem yaptığınız bankayı seçerek siparişinizi tamamlayın.<br>
								Siparişinizin Tutarı : <big><b><?php echo $_POST["toplamtutar"]; ?></b></big> <?php echo $parabirimsatir["birim"]; ?><br>&nbsp;
							</div>
							<?php
							$bankalarsorgu = "SELECT * FROM calisilanbankalar";
							$bankalarsorgugonder = mysqli_query($db, $bankalarsorgu);
							if(mysqli_num_rows($bankalarsorgugonder) > 0){
							while($bankalarsorgusatir = mysqli_fetch_array($bankalarsorgugonder)){
								$bankaisimsorgu = "SELECT * FROM bankalar where id =".$bankalarsorgusatir["banka"];
								$bankaisimsorgugonder = mysqli_query($db,$bankaisimsorgu);
								$bankaisimsatir = mysqli_fetch_array($bankaisimsorgugonder);
							?>
							<div class="product_content mt-2">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><img src="images/bankalogo/<?php echo $bankaisimsatir["logo"]; ?>" width="22" style="vertical-align: top;"> <a href='javascript:;'><?php echo $bankaisimsatir["isim"]; ?></a></div>
											<div class="product_category"><a href="javascript:;"><?php echo $bankalarsorgusatir["iban"]; ?></a></div>
											<div>Hesap No. <?php echo $bankalarsorgusatir["hesapno"]; ?></div>
										</div>
									</div>
									<div class="ml-auto text-right">Ünvan
										<div class="text-right"><?php echo $bankalarsorgusatir["unvan"]; ?></div>
										<div>Şube adı "<?php echo $bankalarsorgusatir["subeadi"]; ?>" Şube Kodu <?php echo $bankalarsorgusatir["subekodu"]; ?></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="<?php echo $bankaisimsatir["isim"]; ?> ile ödeme yaptım">
											<div><div><a href='javascript:havaleBankaSecim(<?php echo $bankalarsorgusatir["id"] ?>);'><img src="images/select.svg" class="svg" alt=""></a></div></div>
										</div>
									</div>
								</div>
							</div>
							<?php }}
							else { ?>
							<div class="product_content mt-2">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<h2>Çalıştığımız banka bulunmamaktadır.</h2>
											Lütfen geri dönerek başka bir ödeme yöntemi seçiniz.
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php } else{ ?>
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Sipariş Tamamlandı</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
							<li><a href="?sayfa=sepet">Sepetim</a></li>
							<li><a href="?sayfa=odeme">Sipariş</a></li>
							<li>Ödeme</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row products_row products_container grid">
					<!-- Product -->
					<div class="col-xl-12 col-md-12 grid-item">
						<div class="product">
							<div class="product_image" style="width:100%;text-align: center;">
								<img src="images/scorder.svg" width="100" />
								<br>&nbsp;
								<br>
									Siparişiniz Tamamlandı.
								<br>&nbsp;
							</div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href='javascript:;'>Sipariş Numaranız</a></div>
											<div class="product_category"><a href="javascript:;"><?php echo $_SESSION["sipno"] ?></a></div>
											Ödeme Yöntemi : <?php if($_GET["o"] == "kn"){ echo "Kapıda nakit ödeme"; } else if($_GET["o"] == "kk") { echo "Kapıda kredi kartı ile ödeme"; } else { echo "Kapıda ödeme (işlem seçilmemiş)";} ?>
										</div>
									</div>
									<div class="ml-auto text-right">Sipariş Tutarı
										<div class="product_price text-right"><?php echo $_POST["toplamtutar"]; ?> <?php echo $parabirimsatir["birim"]; ?></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center" title="Anasayfaya Dön">
											<div><div><a href='index.php'><img src="images/return.svg" class="svg" alt=""></a></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="Siparişlerimde Görüntüle">
											<div><div><a href="javascript:void(0);" onclick="window.open('islem.php?sayfa=sip&id=<?php echo $_SESSION['uyeid'] ?>', 'newwindow', 'width=600,height=500'); return false;"><img src="images/detail.svg" class="svg" alt=""></a></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }	
	$siparissorgulama = mysqli_query($db,"SELECT * FROM siparis WHERE siptakipno = '".$_SESSION["sipno"]."'");
	if(mysqli_num_rows($siparissorgulama) < 1){
		if(!isset($_POST["sirketadi"]) or $_POST["sirketadi"] == null or $_POST["sirketadi"] == ""){
			$_POST["sirketadi"] == " ";
		}
		$sipariskaydet = "INSERT INTO siparis(sahip,adsoyad,tckn,telefon,sirket,adres,eposta,ililce,tutar,ipvetarih,durum,siptakipno,sipnot,odemeTipi,havaleisebanka,teslimat) VALUES(".$_SESSION["uyeid"].",'".$_POST["adi"]." ".$_POST["soyadi"]."','".$_POST["tckn"]."','".$_POST["telefonu"]."','".$_POST["sirketadi"]."','".$_POST["adresi"]."','".$_POST["epostaadresi"]."','".$_POST["sehir"]."/".$_POST["semt"]."',".$_POST["toplamtutar"].",'". date("d.m.Y") ." | ".getUserIP()."',1,'".$_SESSION["sipno"]."','".$_POST["sipnot"]."',".$_POST["odemeSekli"].",0,'".$_POST["teslimat"]."')";
		mysqli_query($db,$sipariskaydet);
		if(isset($_SESSION["uygulanmiskupon"])){
			mysqli_query($db,"UPDATE kuponkodu set durum = 0, kullanan = ".$_SESSION["uyeid"]." WHERE kod = '".$_SESSION["uygulanmiskupon"]."'");
			unset($_SESSION["uygulanmiskupon"]);
		}
		$siparis_id = mysqli_insert_id($db);
		$sepetlistele = mysqli_query($db,"SELECT * FROM sepet where sahip = ".$_SESSION["uyeid"]);
		while ($sepetsatir = mysqli_fetch_assoc($sepetlistele)) {
			$siparisdetaykaydet = mysqli_query($db,"INSERT INTO siparislistesi(urun,miktar,siparis) VALUES(".$sepetsatir['urun'].",".$sepetsatir['miktar'].",".$siparis_id.")");
			$sipliste_id = mysqli_insert_id($db);
			$varyasyonlistele = mysqli_query($db,"SELECT * FROM sepetvaryasyon WHERE sahipsepet = ".$sepetsatir['id']);
			while ($varyasyonsatir = mysqli_fetch_assoc($varyasyonlistele)) {
				mysqli_query($db,"INSERT INTO siplistevaryasyon(varyasyon,varyasyondeger,sahipsipliste,urun) VALUES(".$varyasyonsatir['varyasyon'].",".$varyasyonsatir['varyasyondeger'].",".$sipliste_id.",".$varyasyonsatir['urun'].")");
			}
		}
		if($ayarlarsatir["siptamamsepetsil"] == 1){
			$sepetibulsorgu = "SELECT * FROM sepet where sahip =".$_SESSION["uyeid"];
			$sepetibulsorgugonder = mysqli_query($db,$sepetibulsorgu);
			while($sepetibulsorgusatir = mysqli_fetch_array($sepetibulsorgugonder)){
				$sepetisilsorgu = "DELETE FROM sepet where sahip = ".$_SESSION["uyeid"];
				$sepettevaryasyonsilsorgu = "DELETE FROM sepetvaryasyon where sahipsepet = ".$sepetibulsorgusatir["id"];
				$sepettevaryasyonsilsorgugonder = mysqli_query($db,$sepettevaryasyonsilsorgu);
				$sepetisilsorgugonder = mysqli_query($db,$sepetisilsorgu);
			}
		}
	}
	?>