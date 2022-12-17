<?php
session_start();
date_default_timezone_set('Europe/Istanbul');
error_reporting(0);
function getUserIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$forbidden =  "<h1>Forbidden</h1><p>You don't have permission to access this resource.</p><hr><address>Apache/2.4.".rand(1,99)." (Win64) PHP/7.3.".rand(0,12)." Server at <a href='http://lupusoft.com' target='_blank'>Lupusoft</a>&reg; E-Ticaret Sistemleri Port ".rand(1,99)."</address>";
if (isset($_GET["bank"]) and isset($_GET["order"])){
	include("db.php");
	mysqli_query($db,"UPDATE siparis SET havaleisebanka = ".$_GET["bank"]." WHERE siptakipno = '".$_GET["order"]."'");
	$havalebankaguncelle = "BANKA GÜNCELLEME SQL ".$_GET["order"];
	echo $havalebankaguncelle;
}
else if(empty($_GET["id"]) or empty($_SESSION["uyeid"]) or ($_SESSION["uyeid"] != $_GET["id"]) or ($_SESSION["oturum"] != "acik")){
	echo $forbidden;
	die();
}
else {
		include("db.php");
		if(!isset($_GET['sayfa'])) { // eğer boşsa anasayfa varsayalım.
		   $sayfa = 'default';
		} else {
		   $sayfa = $_GET['sayfa'];
		}
		switch ($sayfa){
		case "fav":
		    echo '
		    <html>
			    <head>
			    	<link rel="stylesheet" type="text/css" href="styles/islem.css?v='.rand(1,999).'">
			    	<script type="text/javascript">
					function favorikaldir(i) {
					  var r = confirm("Silmek istediğinize emin misiniz?");
					  if (r == true) {
					    alert("Ürün favorilerim listesinden kaldırıldı.");
					    window.location.href = "?sayfa=favsil&id='.$_SESSION["uyeid"].'&favorikaldir="+i;
					  } 
					}
					</script>
			    </head>
			    <body>
			    	<h2>Favorilerim</h2><br><hr><br>';
			$favgostersorgu = "SELECT * FROM favoriler WHERE sahip = ".$_SESSION["uyeid"];
			$favgostersorgugonder = mysqli_query($db,$favgostersorgu);
			if(mysqli_num_rows($favgostersorgugonder) > 0){
				while($favgostersorgusatir = mysqli_fetch_array($favgostersorgugonder)){
					$urungostersorgu = "SELECT * FROM urunler WHERE id = ".$favgostersorgusatir["urun"];
					$urungostersorgugonder = mysqli_query($db,$urungostersorgu);
					while($urungostersatir = mysqli_fetch_array($urungostersorgugonder)){
						$urunresimsorgu = "SELECT * FROM resimler where sahip = ".$urungostersatir["id"]." ORDER BY id ASC LIMIT 1";
						$urunresimsorgugonder = mysqli_query($db,$urunresimsorgu);
						$urunresimadi = "hazirlaniyor.png";
						if(mysqli_num_rows($urunresimsorgugonder) > 0){
							$urunresimsatir = mysqli_fetch_array($urunresimsorgugonder);
							$urunresimadi = $urunresimsatir["isim"];
						}
						$fiyat_dizi = explode (".",$urungostersatir["fiyat"]);
						if($fiyat_dizi[1] < 10){
							$fiyat_dizi[1] = $fiyat_dizi[1]."0";
							ltrim($fiyat_dizi[1],"0");
						}
					echo '
						<div class="urun">
				    		<img src="images/'.$urunresimadi.'" class="urun-item" />
				    		<span class="urun-item">'.$urungostersatir["isim"].'</span>
				    		<span class="urun-item">'.$fiyat_dizi[0].','.$fiyat_dizi[1].' '.$parabirimsatir["birim"].'</span>
				    		<span class="urun-item"><a href="javascript:favorikaldir(\''.base64_encode($favgostersorgusatir["id"]).'\');"><img src="images/delete.png" title="Favorilerimden çıkart"/></a>&nbsp;&nbsp;&nbsp;<a href="javascript:window.parent.ClosePopupGoProduct(\''.base64_encode($urungostersatir["id"]).'\');"><img src="images/go.png" title="Ürünü Görüntüle"/></a></span>
				    	</div>
				    	<hr>
					';
					}
				}
			}
			else {
				echo '
					<div style="width:100%;height:85%;background:url(\'images/emptylist.png?v='.rand(1,999).'\') no-repeat center center;">
				    </div>
				';
			}
			echo '</body>
			</html>
		    ';
		    break; 
  		case "des":
  			echo '<html>
		    	<head>
			    	<link rel="stylesheet" type="text/css" href="styles/islem.css?v='.rand(1,999).'">
					<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
			    	<script type="text/javascript">
			    	var secilenmesaj = "";
			    	function showMessage(i){
			    		$(".mesajlar").css("display","none");
			    		$(".mesajlar[data-id="+i+"]").slideToggle();
			    		$(".destek-birim-mesaj").fadeIn();
			    		secilenmesaj = i;
			    	}
			    	function sendMessage(){
			    		$("input[type=hidden]").attr("value",secilenmesaj);
			    		$(".destek-birim-mesaj").submit();
			    	}
			    	function createNewMessage(){
			    		$(".guncel-konusma").html("<div class=\"mesajlar\" style=\"display:block;\">&nbsp;</div><form method=\"POST\"><textarea style=\"display:inline-block;vertical-align: middle;outline: none;border-radius:5px;width:77%;border: 1px solid #ccc;height:19%;\" placeholder=\"Bir mesaj yazın...\" name=\"yenimesaj\"></textarea><input style=\"width:19%;height:19%;background:url(images/send.png) no-repeat center center;border:0;color:#FFF;cursor:pointer;font-weight: bold;display:inline-block;vertical-align: middle;\" value=\"\" type=\"submit\"></form>");
			    		$(".gecmis-konusmalar").html("<a class=\"newMessageButton\"><span>+</span>&nbsp; Yeni Mesaj Oluştur</a>");
			    		$(".destek-birim-mesaj").css("display","block");

			    	}
			    	</script>
		    	</head>';

	  		if(isset($_POST["selectmessage"]) and isset($_POST["cevapmesaji"])){
	  			$cevapversorgu = "insert into mesajlar(icerik,konusma,sahip) values('".$_POST["cevapmesaji"]."',".$_POST["selectmessage"].",".$_SESSION["uyeid"].")";
	  			$cevapversorgugonder = mysqli_query($db,$cevapversorgu);
	  			header('Location: ?sayfa=des&id='.$_SESSION["uyeid"].'&sohbet-id='.$_POST["selectmessage"]);
	  		}
	  		if (isset($_POST["yenimesaj"])){
	  			$konusmayaratsorgu = "insert into konusmalar(tarih,ipadresi,sahip) values('".date('Y-m-d')."','".getUserIp()."',".$_SESSION["uyeid"].")";
	  			$konusmayaratsorgugonder = mysqli_query($db,$konusmayaratsorgu);
	  			$sonkonusmaidsorgu = "select * from konusmalar where sahip =".$_SESSION["uyeid"]." ORDER BY id DESC LIMIT 1 ";
	  			$sonkonusmaidsorgugonder = mysqli_query($db,$sonkonusmaidsorgu);
	  			$sonkonusmaidsatir = mysqli_fetch_array($sonkonusmaidsorgugonder);
	  			$cevapversorgu = "insert into mesajlar(icerik,konusma,sahip) values('".$_POST["yenimesaj"]."',".$sonkonusmaidsatir["id"].",".$_SESSION["uyeid"].")";
	  			$cevapversorgugonder = mysqli_query($db,$cevapversorgu);
	  			header('Location: ?sayfa=des&id='.$_SESSION["uyeid"].'&sohbet-id='.$_POST["yenimesaj"]);
	  		}
		    echo '
		    	<body>
		    		<div class="gecmis-konusmalar">
		    		<a class="newMessageButton" href="javascript:createNewMessage();"><span>+</span>&nbsp; Yeni Mesaj Oluştur</a>
		    		<h3>Sohbetler</h3><hr>
		    		';
		    			$konusmalarsorgu = "select * from konusmalar where sahip =".$_SESSION["uyeid"]." ORDER BY id DESC";
		    			$konusmalarsorgugonder = mysqli_query($db,$konusmalarsorgu);
		    			while($konusmalarsatir = mysqli_fetch_array($konusmalarsorgugonder)){
		    				$sonmesajsorgu = "select icerik from mesajlar where konusma =".$konusmalarsatir["id"]." ORDER BY id DESC LIMIT 1";
		    				$sonmesajsorgugonder = mysqli_query($db,$sonmesajsorgu);
		    				$sonmesajsorgusatir = mysqli_fetch_array($sonmesajsorgugonder);
							$sonmesajsorgusatir["icerik"] = substr($sonmesajsorgusatir["icerik"] , -18);
		    				echo '<a href="javascript:showMessage(`'.$konusmalarsatir["id"].'`);">...'.$sonmesajsorgusatir["icerik"].' <small>'.$konusmalarsatir["tarih"].'</small></a>';
		    			}
		    		echo '
		    		</div>
		    		<div class="guncel-konusma">
		    		';
		    			$display_style = "";
		    			$konusmaiceriksorgu = "select * from konusmalar where sahip =".$_SESSION["uyeid"];
		    			$konusmaiceriksorgugonder = mysqli_query($db,$konusmaiceriksorgu);
		    			while($konusmaiceriksatir = mysqli_fetch_array($konusmaiceriksorgugonder)){
					  		if(!empty($_GET["sohbet-id"]) && $_GET["sohbet-id"] == $konusmaiceriksatir["id"]){
					  			echo '<script>secilenmesaj = '.$_GET["sohbet-id"].';</script>
				    			<div class="mesajlar" style="display:block;" data-id="'.$_GET["sohbet-id"].'">
				    				';
				    			$display_style = "style='display:block;'";
			    				$mesajlarigetirsorgu= "select * from mesajlar where konusma =".$_GET["sohbet-id"]." ORDER BY id ASC";
			    				$mesajlarigetirsorgugonder = mysqli_query($db,$mesajlarigetirsorgu);
			    				while($mesajlarsatir = mysqli_fetch_array($mesajlarigetirsorgugonder)){
			    					if($mesajlarsatir["sahip"] == $_SESSION["uyeid"]){
			    						echo '<div class="uye-mesaj"><span>'.$mesajlarsatir["icerik"].'</span></div>';
			    					}
			    					else {
			    						echo '<div class="birim-mesaj"><span>'.$mesajlarsatir["icerik"].'</span></div>';
			    					}
			    				}
			    				echo '</div>';
					  		}
					  		else {
								echo '
				    			<div class="mesajlar" data-id="'.$konusmaiceriksatir["id"].'">
				    				';
			    				$mesajlarigetirsorgu= "select * from mesajlar where konusma =".$konusmaiceriksatir["id"]." ORDER BY id ASC";;
			    				$mesajlarigetirsorgugonder = mysqli_query($db,$mesajlarigetirsorgu);
			    				while($mesajlarsatir = mysqli_fetch_array($mesajlarigetirsorgugonder)){
			    					if($mesajlarsatir["sahip"] == $_SESSION["uyeid"]){
			    						echo '<div class="uye-mesaj"><span>'.$mesajlarsatir["icerik"].'</span></div>';
			    					}
			    					else {
			    						echo '<div class="birim-mesaj"><span>'.$mesajlarsatir["icerik"].'</span></div>';
			    					}
			    				}
			    				echo '</div>';
		    				}
		    			}
		    				echo '
		    			<form method="POST" class="destek-birim-mesaj" '.$display_style.'>
		    				<textarea name="cevapmesaji" placeholder="Bir mesaj yaz..."></textarea>
		    				<input type="hidden" name="selectmessage">
		    				<a href="javascript:sendMessage();" class="input">&nbsp;</a>
		    			</form>
		    		</div>
		    	</body>
		    </html>
		    ';
		    break;
		case "iad":
			if(isset($_GET["sip"]) and isset($_GET["urun"])){
				$iade_sorgu = mysqli_query($db,"SELECT * FROM iadetalepleri WHERE urun = ".$_GET["urun"]." and siparis = ".$_GET["sip"]);
				if(mysqli_num_rows($iade_sorgu) > 0){
					echo "<script type='text/javascript'>alert('Zaten ürün için iade talebi oluşturulmuş.');window.location = 'islem.php?sayfa=iad&id=".$_SESSION["uyeid"]."';</script>";
				}
				else {
					mysqli_query($db,"INSERT INTO iadetalepleri(siparis,urun,durum,sahip,takipno) VALUES(".$_GET["sip"].",".$_GET["urun"].",1,".$_SESSION["uyeid"].",'')");
					echo "<script type='text/javascript'>alert('İade talebiniz oluşturulmuştur.');window.location = 'islem.php?sayfa=iad&id=".$_SESSION["uyeid"]."';</script>";
				}
			}
			else if (isset($_GET["sil"])){
				mysqli_query($db,"DELETE FROM iadetalepleri WHERE id = ".$_GET["sil"]." and sahip = ".$_SESSION["uyeid"]);
				echo "<script type='text/javascript'>alert('İade talebiniz iptal edilmiştir.');window.location = 'islem.php?sayfa=iad&id=".$_SESSION["uyeid"]."';</script>";
			}
			echo "<!DOCTYPE html>
		    <html>
		    <head>
			    <link rel='stylesheet' type='text/css' href='styles/islem.css?v=".rand(1,999)."'>
				<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>
			    <script type='text/javascript'>
				    $(document).ready(function(){
				    	$('.urun-resim-click').click(function(){
				    		var x = $(this).attr('data-id');
				    		window.parent.ClosePopupGoProduct(x);
				    	});
				    });
			    </script>
		    </head>
		    <body>
		    	<h2>İade Taleplerim</h2><br>
		    	<hr><br>
		    	<div>
		    	";
		    	$iadeler = mysqli_query($db,"SELECT * FROM iadetalepleri WHERE sahip = ".$_SESSION["uyeid"]);
		    	if(mysqli_num_rows($iadeler) < 1){
		    		echo "İade talebiniz bulunmamaktadır.";
		    	}
		    	else {
		    		while ($iade_satir = mysqli_fetch_array($iadeler)) {
		    			$siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE id = ".$iade_satir["siparis"]);
				    	if(mysqli_num_rows($siparis_getir) > 0){
				    		while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
				    			$siparis_detay_getir = mysqli_query($db,"SELECT * FROM siparislistesi WHERE siparis = ".$siparis_satir["id"]." and urun = ".$iade_satir["urun"]);
				    			$siparis_detay_satir = mysqli_fetch_assoc($siparis_detay_getir);
				    			$tarih = explode ("|",$siparis_satir["ipvetarih"]);
				    				$iade_durum = mysqli_query($db,"SELECT * FROM iadedurum WHERE id = ".$iade_satir["durum"]);
				    				$iade_durum_satir = mysqli_fetch_array($iade_durum);
				    				echo "<div class='siparis-box'>
				    				<div class='ust'>
				    				<div class='detay'>İade durumu: ".$iade_durum_satir["durum"]."</div>
				    				";
				    				if($iade_satir["durum"] == 1){
					    				echo "
					    				<div class='tutar'><a href='islem.php?sayfa=iad&id=".$_SESSION["uyeid"]."&sil=".$iade_satir["id"]."' class='iade-iptal-buton'>İade talebini iptal et</a>
					    				</div>";
				    				}
				    				else if($iade_satir["durum"] == 3) {
				    					echo "İade kodu: <span title='Bu kod ile ürünü ilgili birime teslim ediniz.'>".$iade_satir["takipno"]."</span>";
				    				}
				    				else if($iade_satir["durum"] == 4) {
				    					echo "İade tamamlandı";
				    				}
				    				echo "
				    				</div><br>
				    				<div>";
				    					$urun_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$iade_satir["urun"]);
				    					$urun_satir = mysqli_fetch_assoc($urun_getir);
				    					$urun_resim_sorgu = "SELECT * FROM resimler where sahip = ".$urun_satir["id"]." ORDER BY id ASC LIMIT 1";
										$urun_resim_sorgu_gonder = mysqli_query($db,$urun_resim_sorgu);
										$urun_resim_adi = "hazirlaniyor.png";
										if(mysqli_num_rows($urun_resim_sorgu_gonder) > 0){
											$urun_resim_satir = mysqli_fetch_array($urun_resim_sorgu_gonder);
											$urun_resim_adi = $urun_resim_satir["isim"];
										}
										$fiyat_dizi = explode (".",$urun_satir["fiyat"]);
										if($fiyat_dizi[1] < 10){
											$fiyat_dizi[1] = $fiyat_dizi[1]."0";
											ltrim($fiyat_dizi[1],"0");
										}
										$birim_sorgu = mysqli_query($db,"SELECT * FROM birimler WHERE id = ".$urun_satir["birim"]);
										$birim_satir = mysqli_fetch_assoc($birim_sorgu);
										$urun_varyasyon = mysqli_query($db,"SELECT * FROM siplistevaryasyon WHERE sahipsipliste = ".$siparis_detay_satir["id"]." and urun = ".$siparis_detay_satir["urun"]);
				    					echo '
											<div class="urun" style="width:100%;background:#EFE;border:2px solid #EFC;">
									    		<img data-id="'.base64_encode($urun_satir["id"]).'" src="images/'.$urun_resim_adi.'" class="urun-item urun-resim-click" />
									    		<span class="urun-item ym altmenulu">'.$urun_satir["isim"].'</a><p class="altmenu">';
									    		while ($urun_varyasyon_satir = mysqli_fetch_assoc($urun_varyasyon)) {
									    			$urun_varyasyon_adi = mysqli_query($db,"SELECT * FROM varyasyon where id = ".$urun_varyasyon_satir["varyasyon"]);
									    			$urun_varyasyon_deger = mysqli_query($db,"SELECT * FROM varyasyondeger where id = ".$urun_varyasyon_satir["varyasyondeger"]);
									    			$urun_varyasyon_adi_satir = mysqli_fetch_assoc($urun_varyasyon_adi);
									    			$urun_varyasyon_deger_satir = mysqli_fetch_assoc($urun_varyasyon_deger);
									    			echo $urun_varyasyon_adi_satir["varyasyonadi"].": ".$urun_varyasyon_deger_satir["deger"]." ".$urun_varyasyon_deger_satir["tutar"]." ".$parabirimsatir["birim"]."<br><font></font>";
									    			$urun_satir["fiyat"] = $urun_satir["fiyat"] + $urun_varyasyon_deger_satir["tutar"];
									    		}
									    		echo '</p></span>
									    		<span class="urun-item ym">'.$fiyat_dizi[0].','.$fiyat_dizi[1].' '.$parabirimsatir["birim"].'</span>
									    		<span class="urun-item ym">'.$siparis_detay_satir["miktar"].' '.$birim_satir["isim"].'</span>
									    		<span class="urun-item ym">'.($urun_satir["fiyat"]*$siparis_detay_satir["miktar"]).' '.$parabirimsatir["birim"].'</span>
									    	</div>';
				    				echo"
				    				</div>
				    				</div>";
				    		}
				    	}
	    			}
		    	}
		    	echo "
		    	</div>
		    </body>
		    </html>";
		    break;
		case "sip":
		     echo "<!DOCTYPE html>
		    <html>
		    <head>
			    <link rel='stylesheet' type='text/css' href='styles/islem.css?v=".rand(1,999)."'>
				<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>
			    <script type='text/javascript'>
				    $(document).ready(function(){
				    	$('.urun-resim-click').click(function(){
				    		var x = $(this).attr('data-id');
				    		window.parent.ClosePopupGoProduct(x);
				    	});
				    });
			    </script>
		    </head>
		    <body>
		    	<h2>Siparişlerim</h2><br>
		    	<hr><br>
		    	<div>";
		    	$siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE sahip = ".$_SESSION["uyeid"]." ORDER BY id DESC");
		    	if(mysqli_num_rows($siparis_getir) > 0){
		    		while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
		    			$siparis_detay_getir = mysqli_query($db,"SELECT * FROM siparislistesi WHERE siparis = ".$siparis_satir["id"]);
		    			$siparis_durum_getir = mysqli_query($db,"SELECT * FROM siparisdurum WHERE id = ".$siparis_satir["durum"]);
		    			$siparis_durum_satir = mysqli_fetch_assoc($siparis_durum_getir);
		    			$tarih = explode ("|",$siparis_satir["ipvetarih"]);
		    			$tarih[0] = rtrim($tarih[0]," ");
		    				echo "<div class='siparis-box'>
		    				<div class='ust'>
		    				<div class='detay'>Sipariş no: ".$siparis_satir["siptakipno"]." <br><small>Sipariş tarihi: ".$tarih[0]."</small><br>Durum: ".$siparis_durum_satir["durum"]."</div><div class='tutar'>Tutar ".$siparis_satir["tutar"]." ".$parabirimsatir["birim"]."</div>
		    				</div>
		    				<div class='alt'>";
		    				while ($siparis_detay_satir = mysqli_fetch_assoc($siparis_detay_getir)) {
		    					$urun_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$siparis_detay_satir["urun"]);
		    					$urun_satir = mysqli_fetch_assoc($urun_getir);
		    					$urun_resim_sorgu = "SELECT * FROM resimler where sahip = ".$urun_satir["id"]." ORDER BY id ASC LIMIT 1";
								$urun_resim_sorgu_gonder = mysqli_query($db,$urun_resim_sorgu);
								$urun_resim_adi = "hazirlaniyor.png";
								if(mysqli_num_rows($urun_resim_sorgu_gonder) > 0){
									$urun_resim_satir = mysqli_fetch_array($urun_resim_sorgu_gonder);
									$urun_resim_adi = $urun_resim_satir["isim"];
								}
								$fiyat_dizi = explode (".",$urun_satir["fiyat"]);
								if($fiyat_dizi[1] < 10){
									$fiyat_dizi[1] = $fiyat_dizi[1]."0";
									ltrim($fiyat_dizi[1],"0");
								}
								$birim_sorgu = mysqli_query($db,"SELECT * FROM birimler WHERE id = ".$urun_satir["birim"]);
								$birim_satir = mysqli_fetch_assoc($birim_sorgu);
								$odeme_yontemi_sorgu = mysqli_query($db,"SELECT * FROM odemeyontemleri WHERE id = ".$siparis_satir["odemeTipi"]);
								$odeme_yontemi_satir = mysqli_fetch_assoc($odeme_yontemi_sorgu);
								$urun_varyasyon = mysqli_query($db,"SELECT * FROM siplistevaryasyon WHERE sahipsipliste = ".$siparis_detay_satir["id"]." and urun = ".$siparis_detay_satir["urun"]);
		    					echo '
									<div class="urun" style="width:100%;background:#EFE;border:2px solid #EFC;">
							    		<img data-id="'.base64_encode($urun_satir["id"]).'" src="images/'.$urun_resim_adi.'" class="urun-item urun-resim-click" />
							    		<span class="urun-item ym altmenulu">'.$urun_satir["isim"].'</a><p class="altmenu">';
							    		while ($urun_varyasyon_satir = mysqli_fetch_assoc($urun_varyasyon)) {
							    			$urun_varyasyon_adi = mysqli_query($db,"SELECT * FROM varyasyon where id = ".$urun_varyasyon_satir["varyasyon"]);
							    			$urun_varyasyon_deger = mysqli_query($db,"SELECT * FROM varyasyondeger where id = ".$urun_varyasyon_satir["varyasyondeger"]);
							    			$urun_varyasyon_adi_satir = mysqli_fetch_assoc($urun_varyasyon_adi);
							    			$urun_varyasyon_deger_satir = mysqli_fetch_assoc($urun_varyasyon_deger);
							    			echo $urun_varyasyon_adi_satir["varyasyonadi"].": ".$urun_varyasyon_deger_satir["deger"]." ".$urun_varyasyon_deger_satir["tutar"]." ".$parabirimsatir["birim"]."<br><font></font>";
							    			$urun_satir["fiyat"] = $urun_satir["fiyat"] + $urun_varyasyon_deger_satir["tutar"];
							    		}
							    		echo '</p></span>
							    		<span class="urun-item ym">'.$fiyat_dizi[0].','.$fiyat_dizi[1].' '.$parabirimsatir["birim"].'</span>
							    		<span class="urun-item ym">'.$siparis_detay_satir["miktar"].' '.$birim_satir["isim"].'</span>
							    		<span class="urun-item ym">'.($urun_satir["fiyat"]*$siparis_detay_satir["miktar"]).' '.$parabirimsatir["birim"].'</span>
							    	</div>';
									if (strtotime("now") < strtotime($tarih[0]. ' + 21 days') and $siparis_satir["durum"] == 4) {
									  echo '<a href="islem.php?sayfa=iad&id='.$_SESSION["uyeid"].'&sip='.$siparis_satir["id"].'&urun='.$urun_satir["id"].'" class="iade-talep-buton">Bu ürün için iade talep et</a>';
									}
		    				}
		    				echo"<div>
		    						Teslimat Adresi<br><br>
									<p>".$siparis_satir["adsoyad"]." ".$siparis_satir["adres"]." ".$siparis_satir["ililce"]."</p>
								</div>
		    					<div>
		    						Tercihler<br><br>
		    						<p>
		    						".$siparis_satir["teslimat"]."<br>
		    						".$odeme_yontemi_satir["isim"]." ".$odeme_yontemi_satir["tutar"]." ".$parabirimsatir["birim"]."
		    						</p>
		    						<small><small>``".$siparis_satir["sipnot"]."``</small></small>
		    					</div>
		    					<div>
		    						Sipariş Özeti<br><br>
		    						<p>
									Ara Toplam  : ".($siparis_satir["tutar"] - ($siparis_satir["tutar"] * 0.18))." ".$parabirimsatir["birim"]." <br>
									Toplam KDV  : ".($siparis_satir["tutar"] * 0.18)." ".$parabirimsatir["birim"]."  <br><br><hr><br>
									Toplam  : ".$siparis_satir["tutar"]." ".$parabirimsatir["birim"]."
									</p>
								</div>
		    				</div>
		    				</div>";
		    		}
		    	}
		    	else {
		    		echo "Siparişiniz bulunmamaktadır.";
		    	}
		    	echo "</div>
		    </body>
		    </html>";
		    break;
	    case "adeft":
	    	if(isset($_POST["adresid"])){
	    		mysqli_query($db,"UPDATE adresler SET durum = 0 WHERE sahip = ".$_SESSION["uyeid"]);
	    		mysqli_query($db,"UPDATE adresler SET durum = 1 WHERE id =".$_POST["adresid"]." and sahip = ".$_SESSION["uyeid"]);
	    		$secilen_adres = mysqli_query($db,"SELECT * FROM adresler WHERE durum = 1 and sahip = ".$_SESSION["uyeid"]);
	    		$secilen_adres_satir = mysqli_fetch_assoc($secilen_adres);
	    		mysqli_query($db,"UPDATE uyeler SET sirket = '".$secilen_adres_satir['sirket']."', adres = '".$secilen_adres_satir['adres']."', sehir = '".$secilen_adres_satir['sehir']."', semt = '".$secilen_adres_satir['semt']."', postakodu = '".$secilen_adres_satir['postakodu']."', telefon ='".$secilen_adres_satir['telefon']."' WHERE id = ".$_SESSION["uyeid"]);
	    	}
	    	if(isset($_GET["adressil"])){
	    		$adres_sayisi = mysqli_query($db,"SELECT * FROM adresler WHERE sahip = ".$_SESSION["uyeid"]);
	    		if(mysqli_num_rows($adres_sayisi) > 1){
	    			mysqli_query($db,"DELETE FROM adresler WHERE id = ".$_GET["adressil"]." and sahip = ".$_SESSION["uyeid"]);
	    		}
	    	}
		    echo "<!DOCTYPE html>
		    <html>
		    <head>
			    <link rel='stylesheet' type='text/css' href='styles/islem.css?v=".rand(1,999)."'>
		    </head>
		    <body>
		    	<h2>Adres Defterim</h2><br><hr><br>
		    	<a class='custom-btn btn-13' href='islem.php?sayfa=aya&id=".$_SESSION["uyeid"]."'>Ayarlar</a>&nbsp;&nbsp;<a class='custom-btn btn-13' href='islem.php?sayfa=adkay&id=".$_SESSION["uyeid"]."'>Yeni ekle</a><br>
		    	<div id='sayfa'>";
		    	$adresgetir = mysqli_query($db,"SELECT * FROM adresler WHERE sahip = ".$_SESSION["uyeid"]);
		    	while ($adressatir = mysqli_fetch_assoc($adresgetir)) {
		    		$secili = "";
		    		$secili_buton = "Adrese geçiş yap";
		    		$secili_class = "btn-13";
		    		if($adressatir["durum"] == 1){
		    			$secili = "disabled='disabled'";
		    			$secili_buton = "Seçili adres";
		    			$secili_class = "btn-4";
		    		}
		    		echo "<div class='adres-box'>
			    		<div class='yonet'><a href='islem.php?sayfa=adkay&id=".$_SESSION["uyeid"]."&adresinid=".$adressatir["id"]."'><img width='25' src='images/edit-icon.png'></a> &nbsp <a href='islem.php?sayfa=adeft&id=".$_SESSION["uyeid"]."&adressil=".$adressatir["id"]."'><img width='25' src='images/trash-address-ico.png'></a></div>
			    		<strong>".$adressatir["isim"]."</strong><hr>
			    		".$adressatir["sirket"]." ".$adressatir["adres"]." ".$adressatir["semt"]." / ".$adressatir["sehir"]."
			    		<form method='POST'>
			    		<input type='hidden' name='adresid' value='".$adressatir["id"]."'>
			    		<input type='submit' ".$secili." class='adres-buton custom-btn ".$secili_class."' value='".$secili_buton."'>
		    			</form>
			    	</div>";
		    	}
			    	echo "
		    	</div>
		    </body>
		    </html>";
		    break;
	    case "adkay":
	    	if(isset($_GET["adresinid"])){
	    		$adres_getir = mysqli_query($db,"SELECT * FROM adresler WHERE id = ".$_GET["adresinid"]." and sahip =".$_SESSION["uyeid"]);
	    		$adres_satir = mysqli_fetch_assoc($adres_getir);
	    		if(isset($_POST["isim"])){
	    			mysqli_query($db,"UPDATE adresler SET isim = '".$_POST["isim"]."', sirket='".$_POST["sirket"]."', adres='".$_POST["adres"]."', sehir='".$_POST["il"]."', semt='".$_POST["ilce"]."', postakodu='".$_POST["postakodu"]."', telefon='".$_POST["telefon"]."' WHERE id = ".$_GET['adresinid']." and sahip = ".$_SESSION['uyeid']);
			  			sleep(1);
						header('Location: ?sayfa=adeft&id='.$_SESSION["uyeid"]);
	    		}
	    		echo "<!DOCTYPE html>
	    		<html>
	    		<head>
			    <link rel='stylesheet' type='text/css' href='styles/islem.css?v=".rand(1,999)."'>
	    		</head>
	    		<body>
	    		<h2>Adresinizi Düzenleyin</h2><br><hr><br>
		    		<form method='POST' class='adres-guncelleme-formu'>
			    		<table style='margin:5px auto;'>
			    			<tr>
				    			<td>
				    			Kayıt ismi : 
				    			</td>
				    			<td>
				    			<input placeholder='Evim, İşyerim vb.' name='isim' class='lovely-input' value='".$adres_satir['isim']."'>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Şirket Adı(varsa) : 
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><input name='sirket' placeholder='Ticari Ünvan' class='lovely-input' value='".$adres_satir['sirket']."'></span>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Adres : 
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><textarea name='adres' class='lovely-input' placeholder='1.sokak 2.cadde no:3, daire:4'>".$adres_satir['adres']."</textarea></span>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Şehir / Semt :
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><select class='lovely-input' name='il' id='il'><option>".$adres_satir['sehir']."</option></select> / <select class='lovely-input' name='ilce' id='ilce'><option>".$adres_satir['semt']."</option></select></span>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Posta Kodu :  
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><input name='postakodu' placeholder='00001' class='lovely-input' value='".$adres_satir['postakodu']."'></span>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Telefon :  
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><input name='telefon' placeholder='0512 345 67 89' class='lovely-input' value='".$adres_satir['telefon']."'></span>
				    			</td>
			    			</tr>
			    			<tr>
			    				<td style='padding:10px;'>
				    				<a href='islem.php?sayfa=adeft&id=".$_SESSION['uyeid']."' class='lovely-input' style='border:3px solid green;border:3px solid rgba(10,100,10,0.5);cursor:pointer;text-decoration:none;'>Geri Dön</a>
				    			</td>
				    			<td style='padding:10px;'>
				    				<input class='lovely-input' style='border:3px solid green;border:3px solid rgba(10,100,10,0.5);cursor:pointer;width:80%;' type='submit' value='Güncelle'>
				    			</td>
			    			</tr>
			    		</table>
		    		</form>
		    		<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>
					<script type='text/javascript'>
						$.getJSON('il-bolge.json', function(sonuc){
					        $.each(sonuc, function(index, value){
					            var row='';
					            row +='<option value=\"'+value.il+'\">'+value.il+'</option>';
					            $('#il').append(row);
					        })
					    });
						$('#il').on('change', function(){
					        var il=$(this).val();
					        $('#ilce').attr('disabled', false).html('<option value=\"MERKEZ\">MERKEZ</option>');
					        $.getJSON('il-ilce.json', function(sonuc){
					            $.each(sonuc, function(index, value){
					                var row='';
					                if(value.il==il)
					                {
					                    row +='<option value=\"'+value.ilce+'\">'+value.ilce+'</option>';
					                    $('#ilce').append(row);
					                }
					            });
					        });
					    });
					</script>
	    		</body>
	    		</html>";
	    	}
	    	else {
	    		if(isset($_POST["isim"]) and isset($_POST["adres"]) and isset($_POST["il"]) and isset($_POST["ilce"]) and isset($_POST["postakodu"]) and isset($_POST["telefon"])){
    				mysqli_query($db,"INSERT INTO adresler(sahip,durum,isim,sirket,adres,sehir,semt,postakodu,telefon) VALUES(".$_SESSION["uyeid"].",0,'".$_POST["isim"]."','".$_POST["sirket"]."','".$_POST["adres"]."','".$_POST["il"]."','".$_POST["ilce"]."','".$_POST["postakodu"]."','".$_POST["telefon"]."')");
		  			sleep(1);
					header('Location: ?sayfa=adeft&id='.$_SESSION["uyeid"]);
	    		}
	    		echo "<!DOCTYPE html>
	    		<html>
	    		<head>
			    <link rel='stylesheet' type='text/css' href='styles/islem.css?v=".rand(1,999)."'>
	    		</head>
	    		<body>
	    		<h2>Adresinizi Düzenleyin</h2><br><hr><br>
		    		<form method='POST' class='adres-guncelleme-formu'>
			    		<table style='margin:5px auto;'>
			    			<tr>
				    			<td>
				    			Kayıt ismi : 
				    			</td>
				    			<td>
				    			<input placeholder='Evim, İşyerim vb.' name='isim' class='lovely-input' require='required'>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Şirket Adı(varsa) : 
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><input name='sirket' placeholder='Ticari Ünvan' class='lovely-input'></span>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Adres : 
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><textarea name='adres' class='lovely-input' placeholder='1.sokak 2.cadde no:3, daire:4' require='required'></textarea></span>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Şehir / Semt :
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><select class='lovely-input' name='il' id='il' require='required'><option>İl Seçiniz...</option></select> / <select class='lovely-input' name='ilce' id='ilce' require='required'><option>İlçe Seçiniz...</option></select></span>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Posta Kodu :  
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><input name='postakodu' placeholder='00001' class='lovely-input' require='required'></span>
				    			</td>
			    			</tr>
			    			<tr>
				    			<td>
				    			Telefon :  
				    			</td>
				    			<td>
				    			<span class='input-wrapper'><input name='telefon' placeholder='0512 345 67 89' class='lovely-input' require='required'></span>
				    			</td>
			    			</tr>
			    			<tr>
			    				<td style='padding:10px;'>
				    				<a href='islem.php?sayfa=adeft&id=".$_SESSION['uyeid']."' class='lovely-input' style='border:3px solid green;border:3px solid rgba(10,100,10,0.5);cursor:pointer;text-decoration:none;'>Geri Dön</a>
				    			</td>
				    			<td style='padding:10px;'>
				    				<input class='lovely-input' style='border:3px solid green;border:3px solid rgba(10,100,10,0.5);cursor:pointer;width:80%;' type='submit' value='Kaydet'>
				    			</td>
			    			</tr>
			    		</table>
		    		</form>
		    		<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>
					<script type='text/javascript'>
						$.getJSON('il-bolge.json', function(sonuc){
					        $.each(sonuc, function(index, value){
					            var row='';
					            row +='<option value=\"'+value.il+'\">'+value.il+'</option>';
					            $('#il').append(row);
					        })
					    });
						$('#il').on('change', function(){
					        var il=$(this).val();
					        $('#ilce').attr('disabled', false).html('<option value=\"MERKEZ\">MERKEZ</option>');
					        $.getJSON('il-ilce.json', function(sonuc){
					            $.each(sonuc, function(index, value){
					                var row='';
					                if(value.il==il)
					                {
					                    row +='<option value=\"'+value.ilce+'\">'+value.ilce+'</option>';
					                    $('#ilce').append(row);
					                }
					            });
					        });
					    });
					</script>
	    		</body>
	    		</html>";
	    	}
		    break;
		case "aya":
		    echo "<!DOCTYPE html>
		    <html>
		    <head>
			    <link rel='stylesheet' type='text/css' href='styles/islem.css?v=".rand(1,999)."'>
		    </head>
		    <body>
		    	<h2>Hesap Ayarları</h2><br>
		    	<hr><br>
		    	<a href='islem.php?sayfa=hspaya&id=".$_SESSION["uyeid"]."' class='hesap-ayarlari-link'><img src='images/settings.svg'><br><span>Bilgilerimi güncelle</span></a>
		    	<a href='islem.php?sayfa=adeft&id=".$_SESSION["uyeid"]."' class='hesap-ayarlari-link'><img src='images/icon_3.svg'><br><span>Adres Defterim</span></a>
		    	<a href='javascript:if(confirm(`Hesabınızı silmek istediğinize emin misiniz?`)){location.replace(`islem.php?sayfa=hspsil&id=".$_SESSION["uyeid"]."`)}' class='hesap-ayarlari-link'><img src='images/delete-all.png'><br><span>Hesabımı Sil</span></a>
		    </body>
		    </html>";
		    break; 
		case "hspsil":
			if(isset($_POST["sifresi"])){
				$sorgu = mysqli_query($db,"SELECT * FROM uyeler WHERE sifre = '".md5($_POST["sifresi"])."' and id=".$_SESSION["uyeid"]);
				if(mysqli_num_rows($sorgu) > 0){
					mysqli_query($db,"DELETE FROM uyeler WHERE id = ".$_SESSION["uyeid"]);
					unset($_SESSION["oturum"]);
					unset($_SESSION["uyeid"]);
					echo "<script type='text/javascript'>alert(`Hesap bilgileriniz silinmiştir.`);window.parent.goHomePage();</script>";
				}
				else {
					echo "<script type='text/javascript'>alert(`Şifre yanlış`);</script>";
				}
			}
			echo "<!DOCTYPE html>
		    <html>
		    <head>
			    <link rel='stylesheet' type='text/css' href='styles/islem.css?v=".rand(1,999)."'>
		    </head>
		    <body>
		    	<h2>Siz Olduğunuzu Doğrulayın</h2><br><hr><br>
		    	<form method='POST'>
		    	<p>Şifreniz : <input type='password' name='sifresi' class='lovely-input'></p><br>
		    	<p><input type='submit' value='Hesabımı Sil' class='lovely-input' style='border:3px solid green;border:3px solid rgba(10,100,10,0.5);cursor:pointer;width:80%;'></p>
		    	</form>
		    </body>
		    </html>";

			break;
		case "hspaya":
			if(isset($_POST["isim"])){
				$sifre_dogrula = mysqli_query($db,"SELECT * FROM uyeler WHERE sifre = '".md5($_POST["sifre"])."' and id = ".$_SESSION["uyeid"]);
				if(mysqli_num_rows($sifre_dogrula) > 0){
					$sifredegis = "";
					$basarili = 1;
					if(strlen($_POST["yenisifre"]) > 0){
						if(strlen($_POST["yenisifre"]) < 6){
							echo "<script type='text/javascript'>alert('Şifreniz en az 6 karakter uzunluğunda olmalıdır.');</script>";
							$basarili = 0;
						}
						else {
							if($_POST["yenisifre"] == $_POST["yenisifretekrar"]){
								$sifredegis = ", sifre = '".md5($_POST["yenisifre"])."'";
							}
							else {
								echo "<script type='text/javascript'>alert('Şifreler aynı değil.');</script>";
								$basarili = 0;
							}
						}
					}
					if($_POST["ebulten"] == 1){
						$ebulten_sql = mysqli_query($db,"SELECT * FROM ebulten WHERE eposta = '".$_POST["email"]."'");
						if(mysqli_num_rows($ebulten_sql) < 1){
							mysqli_query($db,"INSERT INTO ebulten(eposta) VALUES('".$_POST["email"]."')");
						}
					}
					else {
						$ebulten_sql = mysqli_query($db,"SELECT * FROM ebulten WHERE eposta = '".$_POST["email"]."'");
						if(mysqli_num_rows($ebulten_sql) > 0){
							mysqli_query($db,"DELETE FROM ebulten WHERE eposta = '".$_POST["email"]."'");
						}
					}
					mysqli_query($db,"UPDATE uyeler SET adsoyad = '".$_POST["isim"]." ".$_POST["soyisim"]."', eposta = '".$_POST["email"]."'".$sifredegis." WHERE id=".$_SESSION["uyeid"]);
					if($basarili == 1){
						echo "<script type='text/javascript'>alert('Bilgileriniz güncellendi.');</script>";
					}
				}
				else {
					echo "<script type='text/javascript'>alert('Şifreniz yanlış.');</script>";
				}
			}
			$kullanici_sql = mysqli_query($db,"SELECT * FROM uyeler WHERE id = ".$_SESSION["uyeid"]);
			$kullanici_bilgiler = mysqli_fetch_assoc($kullanici_sql);
			$ebulten_sql = mysqli_query($db,"SELECT * FROM ebulten WHERE eposta = '".$kullanici_bilgiler["eposta"]."'");
			$ebulten = "";
			if(mysqli_num_rows($ebulten_sql) > 0){
				$ebulten = "checked='checked'";
			}
			$isim_dizi = explode(" ", $kullanici_bilgiler["adsoyad"]);
			if((count($isim_dizi)-1) != 1){
				$ikinci_isim = $isim_dizi[1];
			}
			echo "<!DOCTYPE html>
		    <html>
		    <head>
			    <link rel='stylesheet' type='text/css' href='styles/islem.css?v=".rand(1,999)."'>
		    	<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>
			      <script type='text/javascript'>
				    function sifregoster() {
				      var x = document.getElementById('sifreler1');
				      var xy = document.getElementById('sifreler2');
				      var xyz = document.getElementById('sifreler3');
				      if (x.type === 'password') {
				        x.type = 'text';
				        xy.type = 'text';
				        xyz.type = 'text';
				      } else {
				        x.type = 'password';
				        xy.type = 'password';
				        xyz.type = 'password';
				      }
				    }
				  </script>
		    </head>
		    <body>
		    	<h2>Bilgilerimi Güncelle</h2><br>
		    	<hr><br>
		    	<form method='POST'>
		    		<p style='padding-top:10px;'>*İsim :  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='lovely-input' name='isim' placeholder='İsim' type='text' value='".$isim_dizi[0]." ".$ikinci_isim."'></p>
		    		<p style='padding-top:10px;'>*Soyisim :  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<input class='lovely-input' name='soyisim' placeholder='Soyisim' type='text' value='".$isim_dizi[count($isim_dizi) - 1]."'></p>
		    		<p style='padding-top:10px;'>*E-posta : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<input class='lovely-input' type='email' name='email' placeholder='birisi@example.com' value='".$kullanici_bilgiler["eposta"]."'></p>
		    		<p style='padding-top:10px;'>*Mevcut şifre :<input class='lovely-input' type='password' name='sifre' placeholder='Şifre' id='sifreler1'></p>
		    		<p style='padding-top:10px;'>Yeni şifre :  &nbsp;&nbsp;&nbsp; <input class='lovely-input' type='password' name='yenisifre' placeholder='Yeni şifre' id='sifreler2'></p>
		    		<p style='padding-top:10px;'>Şifre tekrar : &nbsp;<input class='lovely-input' type='password' name='yenisifretekrar' placeholder='Yeni şifre tekrar' id='sifreler3'></p>
		    		<p style='padding-top:10px;'>E-bülten üyesi olmak istiyorum : <input type='checkbox' name='ebulten' value='1' ".$ebulten." /> </p>
		    		<p style='padding-top:10px;'><a href='islem.php?sayfa=aya&id=".$_SESSION["uyeid"]."' style='border:3px solid green;border:3px solid rgba(10,100,10,0.5);cursor:pointer;margin:10px;text-decoration:none;padding:7px;font-weight:bold;color:#333;'>Geri Dön</a>Şifreleri göster : <img src='images/show.png'/> <input type='checkbox' onclick='sifregoster()'/> <input type='submit' value='Güncelle' class='lovely-input' style='border:3px solid green;border:3px solid rgba(10,100,10,0.5);cursor:pointer;margin:10px;'></p><small><i>* zorunlu alanlar</i></small>
		    	</form>
		    </body>
		    </html>";
			break;
		case "favsil":
			if(isset($_GET["favorikaldir"])){
	  			$favsilsorgu = "DELETE FROM favoriler WHERE id =".base64_decode($_GET["favorikaldir"]);
	  			$favsilsorgugonder = mysqli_query($db,$favsilsorgu);
	  			sleep(1);
				header('Location: ?sayfa=fav&id='.$_SESSION["uyeid"]);
	  		}
	  		else {
	  			echo $forbidden;
	  			die();
	  		}
		    break;
		default:
			echo $forbidden;
			die();
		}
}
?>