<?php
session_start();
if($_SESSION["yonetici"] == "1"){
include("../db.php");
if(isset($_POST["durum"]) and isset($_POST["iade"])){
	$_POST["durum"] = strip_tags($_POST["durum"]);
	$_POST["iade"] = strip_tags($_POST["iade"]);
	if($_POST["durum"] == 4){
		$iade_getir = mysqli_query($db,"SELECT * FROM iadetalepleri WHERE id = ".$_POST["iade"]);
		$iade_satir = mysqli_fetch_assoc($iade_getir);
		if($iade_satir["takipno"] == "" or is_null($iade_satir["takipno"])){
			echo "<script type='text/javascript'>alert('Lütfen müşteriye görüntülemek için iade takip no giriniz.');</script>";
		}
		else {
			mysqli_query($db,"UPDATE iadetalepleri SET durum = ".$_POST["durum"]." WHERE id = ".$_POST["iade"]);
		}

	}
	else {
		mysqli_query($db,"UPDATE iadetalepleri SET durum = ".$_POST["durum"]." WHERE id = ".$_POST["iade"]);
	}
}
if(isset($_POST["takipno"]) and isset($_POST["iade"])){
	$_POST["takipno"] = strip_tags($_POST["takipno"]);
	$_POST["iade"] = strip_tags($_POST["iade"]);
	mysqli_query($db,"UPDATE iadetalepleri SET takipno = '".$_POST["takipno"]."' WHERE id = ".$_POST["iade"]);
}
echo "<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' type='text/css' href='../styles/islem.css?v=".rand(1,999)."'>
	<script type='text/javascript' src='../js/jquery-3.2.1.min.js'></script>
    <script type='text/javascript'>
	    $(document).ready(function(){
	    	$('select[name=durum]').on('change', function(){
	    		$('#durum_form').submit();
	    	});
		    $('#txtbxArama').keyup(function(){
	        	aramaFonk('txtbxArama','tepe');
		    });
	    });
		function aramaFonk(inputId,ulId) {
		    var input, filter, ul, li, a, i, txtValue;
		    input = document.getElementById(inputId);
		    filter = input.value.toUpperCase();
		    ul = document.getElementById(ulId);
		  	li = ul.getElementsByClassName('siparis-box');
		    for (i = 0; i < li.length; i++) {
		      //a = li[i].getElementsByTagName('li')[0];
		      txtValue = li[i].textContent || li[i].innerText;
		      if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        li[i].style.display = '';
		      } else {
		        li[i].style.display = 'none';
		      }

		  }

		}
    </script>	
    <title>İade Talepleri</title>
		<link rel='shortcut icon' href='img/return.png'/>
</head>
<body>
	<h2>İade Talepleri</h2>
	<input type='text' placeholder='Arama' style='float:right;padding:3px;' id='txtbxArama'>
	<br>&nbsp;<hr><br>
	<div id='tepe'>
	";
	$iadeler = mysqli_query($db,"SELECT * FROM iadetalepleri ORDER BY id DESC");
	if(mysqli_num_rows($iadeler) < 1){
		echo "İade talebi bulunmamaktadır.";
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
	    				<div class='detay'>İade durumu: <form method='POST' id='durum_form'><input type='hidden' name='iade' value='".$iade_satir['id']."'><select name='durum'><option>".$iade_durum_satir["durum"]."</option>";
	    				$durum_sorgu = mysqli_query($db, "SELECT * FROM iadedurum");
	    				while($durum_satir = mysqli_fetch_assoc($durum_sorgu)){
	    					echo "<option value='".$durum_satir['id']."'>".$durum_satir['durum']."</option>";
	    				}
	    				echo "</select></form></div>Sipariş: ".$siparis_satir["siptakipno"];
	    				if($iade_satir["durum"] == 3){
	    					echo "&nbsp;<form method='POST'><input type='text' placeholder='İade Takip Numarası' name='takipno'><input type='hidden' name='iade' value='".$iade_satir['id']."'><input type='submit' value='Müşteriye İlet'></form>";
	    				}
	    				if($iade_satir["durum"] == 4){
	    					echo "<br>İade takip no: <b>".$iade_satir["takipno"]."</b>";
	    				}
	    				echo "
	    				</div><br>
	    				<div>";
	    					$urun_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$iade_satir["urun"]);
	    					if(mysqli_num_rows($urun_getir) > 0){
		    					$urun_satir = mysqli_fetch_assoc($urun_getir);
		    					$urun_resim_sorgu = "SELECT * FROM resimler where sahip = ".$urun_satir["id"]." ORDER BY id ASC LIMIT 1";
								$urun_resim_sorgu_gonder = mysqli_query($db,$urun_resim_sorgu);
								$urun_resim_adi = "hazirlaniyor.png";
								if(mysqli_num_rows($urun_resim_sorgu_gonder) > 0){
									$urun_resim_satir = mysqli_fetch_array($urun_resim_sorgu_gonder);
									$urun_resim_adi = $urun_resim_satir["isim"];
								}
								$fiyat_dizi = explode (".",$urun_satir["fiyat"]);
								if(@$fiyat_dizi[1] < 10){
									@$fiyat_dizi[1] = $fiyat_dizi[1]."0";
									ltrim($fiyat_dizi[1],"0");
								}
								$birim_sorgu = mysqli_query($db,"SELECT * FROM birimler WHERE id = ".$urun_satir["birim"]);
								$birim_satir = mysqli_fetch_assoc($birim_sorgu);
								$urun_varyasyon = mysqli_query($db,"SELECT * FROM siplistevaryasyon WHERE sahipsipliste = ".$siparis_detay_satir["id"]." and urun = ".$siparis_detay_satir["urun"]);
		    					echo '
									<div class="urun" style="width:100%;background:#EFE;border:2px solid #EFC;">
							    		<img data-id="'.base64_encode($urun_satir["id"]).'" src="../images/'.$urun_resim_adi.'" class="urun-item urun-resim-click" />
							    		<span class="urun-item ym altmenulu">'.$urun_satir["isim"].'</a><p class="altmenu">';
							    		while (@$urun_varyasyon_satir = mysqli_fetch_assoc($urun_varyasyon)) {
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
							    }
							    else {
							    	echo '<div class="urun" style="width:100%;background:#EFE;border:2px solid #EFC;">Silinmiş ürün</div>';
							    }
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
}
else {
    header('Location: login.php');
}
?>