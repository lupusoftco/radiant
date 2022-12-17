<?php
$icerik = mysqli_query($db,"SELECT * FROM sayfalar WHERE kod = '".$_GET["icerik"]."'");
if(mysqli_num_rows($icerik) == 1){
$icerik_satir = mysqli_fetch_assoc($icerik);
?>

<link rel="stylesheet" type="text/css" href="styles/category.css">
<link rel="stylesheet" type="text/css" href="styles/category_responsive.css">
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title"><?php echo $icerik_satir["baslik"]; ?></div>
				</div>
			</div>
		</div>

		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row products_row products_container grid">
					<?php echo $icerik_satir["icerik"]; ?>
				</div>
			</div>
		</div>
<?php
}
else {
?>
<script type="text/javascript">window.location = "index.php?sayfa=kategori&k=404"; </script>
<?php
}
?>