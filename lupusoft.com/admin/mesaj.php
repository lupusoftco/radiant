<?php
session_start();
if($_SESSION["yonetici"] == "1" and isset($_GET["detay"])){
include("../db.php");
if(isset($_POST["mesaj"])){
	$cevapversorgu = "insert into mesajlar(icerik,konusma,sahip) values('".$_POST["mesaj"]."',".$_GET["detay"].",0)";
	$cevapversorgugonder = mysqli_query($db,$cevapversorgu);
	header('Location: mesaj.php?detay='.$_GET["detay"]);
}
$konusmaiceriksorgu = "select * from konusmalar where id =".$_GET["detay"];
$konusmaiceriksorgugonder = mysqli_query($db,$konusmaiceriksorgu);
$konusmaiceriksatir = mysqli_fetch_array($konusmaiceriksorgugonder);
$uye_getir = mysqli_query($db,"SELECT * FROM uyeler WHERE id = ".$konusmaiceriksatir["sahip"]);
$uye_satir = mysqli_fetch_assoc($uye_getir);
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $uye_satir["adsoyad"]; ?> kişisi ile sohbet</title>
		<style type="text/css">
			*,*:before,*:after {box-sizing: border-box;padding:0;margin:0;font-family: arial,sans-serif,helvetica;}
			.uye {text-align:left;}
			.uye, .admin {display:block;margin:15px;}
			.uye span, .admin span {padding: 5px;line-height:24px;box-shadow: 0px 0px 1px #222;background: white;border-radius: 5px;}
			.admin span {background: green;color:white;}
			.admin {text-align:right;}
			.main {background: url('../images/chatbackground.jpg');padding:10px;height:100vh;}
			.chat-blob {height: 15vh;}
			.chat-area {width:100%;height:15vh;background: white;position: fixed;left:0px;bottom:0px;right:0px;}
			textarea, input {display:inline-block;vertical-align: top;height: 15vh;outline: 0;}
			textarea {width:80%;}
			input {width:20%;}
		</style>
		<link rel="shortcut icon" href="img/chat.png"/>
	</head>
	<body>
		<div class="main">
			<?php
				$konusmaiceriksorgu = "select * from konusmalar where id =".$_GET["detay"];
				$konusmaiceriksorgugonder = mysqli_query($db,$konusmaiceriksorgu);
				while($konusmaiceriksatir = mysqli_fetch_array($konusmaiceriksorgugonder)){
		  			echo '<div class="mesajlar" style="display:block;" data-id="'.$_GET["detay"].'">
	    				';
	    			$display_style = "style='display:block;'";
					$mesajlarigetirsorgu= "select * from mesajlar where konusma =".$_GET["detay"]." ORDER BY id ASC";
					$mesajlarigetirsorgugonder = mysqli_query($db,$mesajlarigetirsorgu);
					while($mesajlarsatir = mysqli_fetch_array($mesajlarigetirsorgugonder)){
						if($mesajlarsatir["sahip"] == 0){
							echo '<div class="admin"><span>'.$mesajlarsatir["icerik"].'</span></div>';
						}
						else {
							$uye_getir = mysqli_query($db,"SELECT * FROM uyeler WHERE id = ".$mesajlarsatir["sahip"]);
							$uye_satir = mysqli_fetch_assoc($uye_getir);
							echo '<div class="uye"><span>'.$mesajlarsatir["icerik"].'</span></div>';
						}
					}
					echo '</div>';
				}
			?>
		<div class="chat-blob"></div>
		<div class="chat-area"><form method="POST"><textarea name="mesaj" placeholder="Mesajınızı yazın..."></textarea><input type="submit" value="Gönder"></form></div>
		</div>
	</body>
</html>
<?php
}
else {
    header('Location: login.php');
}
?>