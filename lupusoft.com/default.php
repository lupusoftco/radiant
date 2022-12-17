<!-- Home -->
		<?php if($ayarlarsatir["slider_aktif"] == 1){
			if($ayarlarsatir["vitrintipi"] == 2){
				include("slider.php"); 
			}
		}
		$vitrinsorgu ="SELECT * FROM urunler where vitrin = 1 and stok > ".$ayarlarsatir["bitikstok"];
		$vitrinsorgugonder = mysqli_query($db, $vitrinsorgu);
		if(mysqli_num_rows($vitrinsorgugonder) > 0){
			include("vitrin.php");
		}
		?>
		<!-- Products -->

		<?php include("yeni_urunler.php"); ?>

		<!-- Boxes -->

		<?php include("kategori.php"); ?>

		<!-- Features -->

		<?php include("anasayfa.php"); ?>