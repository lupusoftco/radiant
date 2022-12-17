
<link rel="stylesheet" type="text/css" href="styles/category.css">
<link rel="stylesheet" type="text/css" href="styles/category_responsive.css">
<?php
if(empty($_GET["k"])){
	header("location:index.php");
}
if(isset($_GET["orderby"])){
	if($_GET["orderby"] == "asc"){
		$orderby = " ORDER BY fiyat ASC ";
	}
	else if($_GET["orderby"] == "desc"){
		$orderby = " ORDER BY fiyat DESC ";
	}
	else {
		$orderby = "";
	}
}
else {
	$orderby = "";
}
if(isset($_GET["where"])){
	if($_GET["where"] == "popular"){
		$orderby = " ORDER BY goruntuleme DESC ";
	}
	else if($_GET["where"] == "new"){
		$orderby = " ORDER BY id DESC ";
	}
	else if($_GET["where"] == "forgotten") {
		$orderby = " ORDER BY goruntuleme ASC ";
	}
	else if($_GET["where"] == "stok") {
		$where = " and stok < ".$ayarlarsatir["stokuyarideger"]." ";
	}
	else {
		$where = "";
	}
}
?>
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title"><?php
											$_GET["k"] = strip_tags($_GET["k"]);
											$kategorisayfasisorgu = "SELECT * FROM kategoriler where kategorikodu='".escape_sql_string($_GET["k"])."'";
											$kategorisayfasisorgugonder = mysqli_query($db, $kategorisayfasisorgu);
											if(mysqli_num_rows($kategorisayfasisorgugonder) > 0){
												$kategorisayfasisorgusatir = mysqli_fetch_array($kategorisayfasisorgugonder);
												echo $kategorisayfasisorgusatir["isim"];
											
											?></div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="index.php">Anasayfa</a></li>
							<li><a href="index.php?sayfa=kategori&k=<?php echo $kategorisayfasisorgusatir['kategorikodu']; ?>"><?php echo $kategorisayfasisorgusatir['isim']; ?></a></li>
							<li><a href="index.php?sayfa=kesfet">Son ürünler</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row products_bar_row">
					<div class="col">
						<div class="products_bar d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
							<div class="products_bar_links">
								<ul class="d-flex flex-row align-items-start justify-content-start">
									<li><a href="?sayfa=kategori&k=<?php echo $_GET["k"]; ?>">Tümü</a></li>
									<li><a href="?sayfa=kategori&k=<?php echo $_GET["k"]; ?>&where=popular">En Popüler</a></li>
									<li><a href="?sayfa=kategori&k=<?php echo $_GET["k"]; ?>&where=new">Yeni Ürünler</a></li>
									<li><a href="?sayfa=kategori&k=<?php echo $_GET["k"]; ?>&where=forgotten">Keşfedilmemiş</a></li>
								</ul>
							</div>
							<div class="products_bar_side d-flex flex-row align-items-center justify-content-start ml-lg-auto">
								<div class="products_dropdown product_dropdown_sorting">
									<div class="isotope_sorting_text"><span>Fiyata Göre Sıralama</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
									<ul>
										<li class="item_sorting_btn"><a href='?sayfa=kategori&k=<?php echo $_GET["k"]; ?>'>Standart</a></li>
										<li class="item_sorting_btn"><a href='?sayfa=kategori&k=<?php echo $_GET["k"]; ?>&orderby=asc'>Artan</a></li>
										<li class="item_sorting_btn"><a href='?sayfa=kategori&k=<?php echo $_GET["k"]; ?>&orderby=desc'>Azalan</a></li>
									</ul>
								</div>
								<div class="products_dropdown text-right product_dropdown_filter">
									<div class="isotope_filter_text"><span>Filtre</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
									<ul>
										<li class="item_filter_btn"><a href='?sayfa=kategori&k=<?php echo $_GET["k"]; ?>'>Tümü</li>
										<li class="item_filter_btn"><a href='?sayfa=kategori&k=<?php echo $_GET["k"]; ?>&where=stok'>Kritik Stok</a></li>
										<!--<li class="item_filter_btn"><a href="">Yeni</li>-->
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row products_row products_container grid">
					<?php
						$sayfada = $ayarlarsatir["getirilecek_icerik_sayisi"]; // sayfada gösterilecek içerik miktarını belirtiyoruz.
		                @$sorgu = mysqli_query($db,"SELECT COUNT(*) AS toplam FROM urunler where kategori = ".$kategorisayfasisorgusatir["id"].$where.$orderby);
		                $sonuc = mysqli_fetch_assoc($sorgu);
		                $toplam_icerik = $sonuc['toplam'];
		                $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		                // eğer sayfa girilmemişse 1 varsayalım.
		                $sayfa = isset($_GET['s']) ? (int) $_GET['s'] : 1;
		                // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
		                if($sayfa < 1) $sayfa = 1; 
		                // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
		                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

						@$kategoridekiurunsorgu = "SELECT * FROM urunler where kategori = ".$kategorisayfasisorgusatir["id"].$where.$orderby;
						$kategoridekiurunsorgugonder = mysqli_query($db,$kategoridekiurunsorgu);
						while($kategoridekiurunsorgusatir = mysqli_fetch_array($kategoridekiurunsorgugonder)){
							if($kategoridekiurunsorgusatir["stok"] > $ayarlarsatir["bitikstok"]){
							$urunresimgetirsorgu = "SELECT * FROM resimler where sahip = ".$kategoridekiurunsorgusatir["id"]." ORDER BY id ASC LIMIT 1 ";
							$urunresimgetirsorgugonder = mysqli_query($db,$urunresimgetirsorgu);
							if(mysqli_num_rows($urunresimgetirsorgugonder) < 1){
								$urunresimgetirsatir["isim"] = "hazirlaniyor.png";
							}
							else {
								$urunresimgetirsatir = mysqli_fetch_array($urunresimgetirsorgugonder);
							}
							$fiyat_dizi = explode (".",$kategoridekiurunsorgusatir["fiyat"]);
							if(@$fiyat_dizi[1] < 10){
								@$fiyat_dizi[1] = $fiyat_dizi[1]."0";
								ltrim($fiyat_dizi[1],"0");
							}
					?>
					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item new">
						<div class="product">
							<div class="product_image"><img src="images/<?php echo $urunresimgetirsatir['isim']; ?>" alt="">
							<?php
								if($ayarlarsatir["stokuyari"] == 1){
									if($kategoridekiurunsorgusatir["stok"] < $ayarlarsatir["stokuyarideger"]){
										?>
										<div class="alert">
											<div class="dpib a-1">Kritik stok!</div>
											<div class="dpib a-2">Son <?php echo ($kategoridekiurunsorgusatir["stok"]-$ayarlarsatir["bitikstok"]); ?> ürün!</div>
										</div>
										<?php
									}
								}
								?>
							</div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href='?sayfa=detay&u=<?php echo base64_encode($kategoridekiurunsorgusatir["id"]); ?>'><?php echo $kategoridekiurunsorgusatir["isim"]; ?></a></div>
											<div class="product_category"><a href="index.php?sayfa=kategori&k=<?php echo $kategorisayfasisorgusatir['kategorikodu']; ?>"><?php echo $kategorisayfasisorgusatir['isim']; ?></a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<?php
											if($ayarlarsatir["goruntulenmeaktif"] == 1){
												echo '<div class="rating_r rating_r_0 home_item_rating"><img src="images/show.png" alt="Görüntüleme" /> ';
												if($kategoridekiurunsorgusatir["goruntuleme"] > 999 and $kategoridekiurunsorgusatir["goruntuleme"] < 999999){
													$bolme = explode(".", ($kategoridekiurunsorgusatir["goruntuleme"]/1000));
													echo $bolme[0]." bin";
												}
												else if ($kategoridekiurunsorgusatir["goruntuleme"] > 999999){
													$bolme = explode(".", ($kategoridekiurunsorgusatir["goruntuleme"]/1000000));
													echo $bolme[0]." mn";
												}
												else {
													echo $kategoridekiurunsorgusatir["goruntuleme"];
												} 
												echo '</div>';
											}
										?>
										<div class="product_price text-right"><?php echo $fiyat_dizi[0]; ?><span>.<?php echo $fiyat_dizi[1]; ?></span><?php echo $parabirimsatir["birim"]; ?></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center" title="Favorilere Ekle">
											<div><div><a href='?sayfa=detay&u=<?php echo base64_encode($kategoridekiurunsorgusatir["id"]); ?>&fav=1'><img src="images/heart_2.svg" class="svg" alt=""></a><div>+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="Detaylı İncele">
											<div><div><a href='?sayfa=detay&u=<?php echo base64_encode($kategoridekiurunsorgusatir["id"]); ?>'><img src="images/detail.svg" class="svg" alt=""></a><div>+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
						}}
					?>
				</div>
				<?php
					if(@mysqli_num_rows($kategoridekiurunsorgugonder) < 1){
						echo '<div class="col-xl-4 col-md-6 grid-item new m-auto text-center">
									<div class="product">
										<div class="product_image"><span style="font-size:100px;">&#9746;</span></div>
										<br>
										<div class="product_content">
											<div>
												<div>
													Seçtiğiniz kriterlere uygun görüntülenecek ürün bulunamadı.
												</div>
											</div>
										</div>
									</div>
								</div>';
					}
				?>
				<div class="row page_nav_row">
					<div class="col">
						<div class="page_nav">
							<ul class="d-flex flex-row align-items-start justify-content-center">
								<?php
                                    for($s = 1; $s <= $toplam_sayfa; $s++) {
									   if($sayfa == $s) { // eğer bulunduğumuz sayfa ise link yapma.
									      echo '<li class="active"><a href="?sayfa=kategori&k='.$_GET["k"].'&s=' . $s . '">' . $s . '</a></li>';
									   } else {
									      echo '<li><a href="?sayfa=kategori&k='.$_GET["k"].'&s=' . $s . '">' . $s . '</a></li>';
									   }
									}
                                    ?>
							</ul>
							
						</div>
					</div>
				</div>
			</div>
		</div>
<?php } else {
								echo "<div class='glitch' data-text='404&nbsp;HATASI'>404&nbsp;HATASI</div> </div></div></div></div><div class='products'>
			<div class='container'><img src='images/searching.gif' style='display:inline-block;vertical-align:middle;'/> <h2 style='display:inline-block;vertical-align:middle;'>&nbsp;Sayfa bulunamadı.</h2></div></div>";
							} ?>