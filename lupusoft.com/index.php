<?php session_start(); date_default_timezone_set('Europe/Istanbul'); include("db.php"); if($ayarlarsatir["kurulum"] == 0){ echo "<div style='font-weight:bold;font-family:arial,sans-serif;text-shadow:0px 2px 2px #fff;box-shadow:0px 1px 3px #ccc;position:absolute;width:25%;height:25%;top:0px;left:0px;bottom:0px;right:0px;margin:auto;padding:2%;background:url(images/howfix.webp) no-repeat center center;'><u>".$ayarlarsatir["paket"]."</u> paketi kurulumu tamamlanmamış.<br>Lütfen kurulumu tamamlayın yada <a href='http://lupusoft.com'>yöneticiye</a> başvurun.</div>"; die(); } error_reporting(0);
?>
<!DOCTYPE html>
<html lang="tr">
<?php
	include("head.php");
?>
<body>
<?php
	if($_SESSION["yonetici"] == "1"){
		include("minipanel.php");
	}
?>
<!-- Menu -->

<?php include("menu.php"); ?>

<div class="super_container">

	<!-- Header -->

	<?php include("header.php"); ?>

	<div class="super_container_inner">
		<div class="super_overlay"></div>

		<?php
		if(isset($_GET["arama"])){
		    include("kesfet.php");
		    unset($_SESSION["sipno"]);
		}
		else {
			if(!isset($_GET['sayfa']) or empty($_GET['sayfa'])) { // eğer boşsa anasayfa varsayalım.
			   $sayfa = 'anasayfa';
			} 
			else {
			   $sayfa = $_GET['sayfa'];
			}
			switch ($sayfa){
			case "anasayfa":
			    include("default.php");
			    unset($_SESSION["sipno"]);
			    break;
			case "sayfa":
				include("icerik.php");
				break;
			case "kategori":
				if(!empty($_GET["k"])){
					include("category.php");
					unset($_SESSION["sipno"]);
				}
				else {
			    	include("default.php");
			    	unset($_SESSION["sipno"]);
			    }
			    break;
			case "detay":
			    if(!empty($_GET["u"])){
					include("detay.php");
					unset($_SESSION["sipno"]);
				}
				else {
			    	include("default.php");
			    	unset($_SESSION["sipno"]);
			    }
			    break;
			case "kesfet":
				$_GET["arama"] = "";
			    include("kesfet.php");
			    unset($_SESSION["sipno"]);
			    break;
	    	case "odeme":
			    include("checkout.php");
			    unset($_SESSION["sipno"]);
			    break;
			case "sepet":
			    if($_SESSION["oturum"] == "acik" and !empty($_SESSION["oturum"])){
					include("sepet.php");
					unset($_SESSION["sipno"]);
				}
				else {
			    	include("uyegiris.php");
			    	unset($_SESSION["sipno"]);
			    }
			    break;  
			case "uyegiris":
			    if(@$_SESSION["oturum"] != "acik" or empty($_SESSION["oturum"])){
					include("uyegiris.php");
					unset($_SESSION["sipno"]);
				}
				else {
			    	include("profil.php");
			    	unset($_SESSION["sipno"]);
			    }
			    break; 
	  		case "profil":
			    if($_SESSION["oturum"] == "acik"){
					include("profil.php");
					unset($_SESSION["sipno"]);
				}
				else {
			    	include("uyegiris.php");
			    	unset($_SESSION["sipno"]);
			    }
			    break;
			case "cikis":
				if(!empty($_SESSION["oturum"])){
				    unset($_SESSION["oturum"]);
				    echo "<script type='text/javascript'>alert('Çıkış yapıldı.');</script>";
			    }
			    include("default.php");
			    unset($_SESSION["sipno"]);
			    break;
			case "sipTamamla":
				if(isset($_SESSION["oturum"]) and isset($_GET["t"])){
					include("order.php");
			    }
			    else {
			    	include("default.php");
			    	unset($_SESSION["sipno"]);
			    }
			    break;
			default:
				unset($_SESSION["sipno"]);
			    include("default.php");
			    unset($_SESSION["sipno"]);
			    break;
			}
		}
		?>
		<!-- Footer -->
		<?php include("footer.php"); ?>
	</div>
		
</div>

		<?php include("javascript.php"); ?>
</body>
</html>