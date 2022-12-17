<head>
<title><?php 
	if(isset($_GET["arama"])){
		echo ucfirst($_GET["arama"])." aramasına ait sonuçlar |";
	}
	else {
		switch (@$_GET["sayfa"]){
		case "kategori":
			if(!empty($_GET["k"])){
		   		$kategoriadisorgu = "SELECT isim FROM kategoriler where kategorikodu = '".$_GET["k"]."'";
		  		$kategoriadisorgugonder = mysqli_query($db,$kategoriadisorgu);
		  		$kategoriadisorgusatir = mysqli_fetch_array($kategoriadisorgugonder);
		  		echo $kategoriadisorgusatir["isim"]." |";
			}
		    break;
		case "detay":
		  	 if(isset($_GET["u"])){
		  		$urunadisorgu = "SELECT isim FROM urunler where id = ".base64_decode($_GET["u"]);
		  		$urunadisorgugonder = mysqli_query($db,$urunadisorgu);
		  		$urunadisorgusatir = mysqli_fetch_array($urunadisorgugonder);
		  		echo $urunadisorgusatir["isim"]." |";
		  	 }
		    break;
		case "kesfet":
		   	 echo "Keşfet |";
		    break;
		case "sepet":
		   	 echo "Sepetim |";
		    break;  
		case "uyegiris":
			if(@$_SESSION["oturum"] == "acik"){
			 echo "Profilim |";
			}
			else {
		  	 echo "Üye Girişi |";
			}
		    break;
	   	case "odeme":
		  	 echo "Ödeme Bilgileri |";
	   		break;
		case "sipTamamla":
		  	 echo "Sipariş Tamamlandı |";
			break;
		case "profil":
		  	 echo "Profilim |";
		    break;
		default:
		  	 echo "Anasayfa |";
		}
	}
	echo " ".$ayarlarsatir["baslik"];
?>
</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="<?php 
	if(isset($_GET["arama"])){
		echo ucfirst(strtolower($_GET["arama"])).' kelimesine ait ürün arama sonuçları ve fiyat bilgileri. Kampanyaları ve fırsatları takip etmek için tıklayın.';
	}
	else {
		switch (@$_GET["sayfa"]){
		case "kategori":
			if(!empty($_GET["k"])){
		   		$kategoriadisorgu = "SELECT isim,aciklama FROM kategoriler where kategorikodu = '".$_GET["k"]."'";
		  		$kategoriadisorgugonder = mysqli_query($db,$kategoriadisorgu);
		  		$kategoriadisorgusatir = mysqli_fetch_array($kategoriadisorgugonder);
		  		echo $kategoriadisorgusatir["isim"]." ".$kategoriadisorgusatir["aciklama"];
			}
		    break;
		case "detay":
		  	 if(isset($_GET["u"])){
		  		$urunadisorgu = "SELECT aciklama FROM urunler where id = ".base64_decode($_GET["u"]);
		  		$urunadisorgugonder = mysqli_query($db,$urunadisorgu);
		  		$urunadisorgusatir = mysqli_fetch_array($urunadisorgugonder);
		  		echo strip_tags($urunadisorgusatir["aciklama"]);
		  	 }
		    break;
		case "kesfet":
		   	 echo "Keşfet";
		    break;
		case "sepet":
		   	 echo "Sepetim";
		    break;  
		case "uyegiris":
			if($_SESSION["oturum"] == "acik"){
			 echo "Profilim";
			}
			else {
		  	 echo "Üye girişi";
			}
		    break; 
		case "profil":
		  	 echo "Profilim";
		    break;
		default:
		  	 echo "Anasayfa";
		}
	}
?>
">
<meta name="keywords" content="<?php 
	if(isset($_GET["arama"])){
		echo $_GET["arama"].' kelimesine ait arama sonuçları,'.$_GET["arama"].' fiyatları,'.$_GET["arama"].' ürünü,'.$_GET["arama"].' güncel fiyatları,'.$_GET["arama"].' stok bilgisi,'.$_GET["arama"].' kampanyaları,'.$_GET["arama"].' indirim,'.$_GET["arama"].' üretim yeri,'.$_GET["arama"].' markası';
	}
	else {
		switch (@$_GET["sayfa"]){
		case "kategori":
			if(!empty($_GET["k"])){
		   		$kategoriadisorgu = "SELECT isim FROM kategoriler where kategorikodu = '".$_GET["k"]."'";
		  		$kategoriadisorgugonder = mysqli_query($db,$kategoriadisorgu);
		  		$kategoriadisorgusatir = mysqli_fetch_array($kategoriadisorgugonder);
		  		echo $kategoriadisorgusatir["isim"].", ".$_GET["k"];
			}
		    break;
		case "detay":
		  	 if(isset($_GET["u"])){
		  		$urunadisorgu = "SELECT etiketler FROM urunler where id = ".base64_decode($_GET["u"]);
		  		$urunadisorgugonder = mysqli_query($db,$urunadisorgu);
		  		$urunadisorgusatir = mysqli_fetch_array($urunadisorgugonder);
		  		echo $urunadisorgusatir["etiketler"];
		  	 }
		    break;
		case "kesfet":
		   	 echo "Keşfet";
		    break;
		case "sepet":
		   	 echo "Sepetim";
		    break;  
		case "uyegiris":
			if($_SESSION["oturum"] == "acik"){
			 echo "Profilim";
			}
			else {
		  	 echo "Üye girişi";
			}
		    break; 
		case "profil":
		  	 echo "Profilim";
		    break;
		default:
		  	 echo "Anasayfa";
		}
	}
?>">
<meta name="author" content="<?php echo $ayarlarsatir["paket"]; ?>">
<meta name="language" content="<?php echo $ayarlarsatir["dil"]; ?>">
<meta name="revisit-after" content="<?php echo $ayarlarsatir["taramasikligi"]; ?> days">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/<?php echo $ayarlarsatir["favicon"]; ?>" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<?php if($ayarlarsatir["titlebosta"] != "null"){ ?>
<script type="text/javascript">
	var title = document.title;
	var alttitle = '<?php echo $ayarlarsatir["titlebosta"]; ?>';
	window.onblur = function () { document.title = alttitle; };
	window.onfocus = function () { document.title = title; };
</script>
<?php } ?>
</head>