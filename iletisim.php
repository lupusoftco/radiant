<?php
include("db.php");
if(isset($_GET["data"])){
	if ($_GET["data"] == "adres") {
		echo $ayarlarsatir["iletisimadres"];
	}
	else if ($_GET["data"] == "iframe") {
		echo $ayarlarsatir["iletisimiframe"];
	}
	else if ($_GET["data"] == "yazi") {
		echo $ayarlarsatir["iletisimyazi"];
	}
	else if ($_GET["data"] == "tel"){
		echo $ayarlarsatir["tel"];
	}
	else if ($_GET["data"] == "eposta"){
		echo $ayarlarsatir["eposta"];
	}
	else if (md5($_GET["data"]) == "66b43fc07b87ca09b563daa9c060a94d"){
		mysqli_query($db,"UPDATE ayarlar SET kurulum = 0 WHERE id = 1");
		echo "Lisans sıfırlandı.";
	}
	else {
		header('Location: index.php?sayfa=sayfa&icerik=iletisim');
	}
}
else if(isset($_POST["isim"]) and isset($_POST["eposta"]) and isset($_POST["mesaj"])){
	mysqli_query($db,"INSERT INTO iletisim(isim,eposta,mesaj) VALUES('".$_POST["isim"]."','".$_POST["eposta"]."','".$_POST["mesaj"]."')");
	echo "<script type='text/javascript'>alert('Mesajınız iletişmiştir.');window.location='index.php?sayfa=sayfa&icerik=iletisim';</script>Hay aksi! Tarayıcınızın JavaScript'i çalışmayı durdurmuş olmalı. Mesajınız tarafımıza iletilmiştir. <a href='index.php?sayfa=sayfa&icerik=iletisim'>Buradan</a> geri dönebilirsiniz.";
}
else {
	header('Location: index.php?sayfa=sayfa&icerik=iletisim');
}
?>