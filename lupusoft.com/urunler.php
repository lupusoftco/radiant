<?php
$sonyuklenenlersorgu = "SELECT * FROM urunler WHERE stok > ".$ayarlarsatir["bitikstok"]." ORDER BY id DESC LIMIT 6";
$sonyuklenenlersorgugonder = mysqli_query($db, $sonyuklenenlersorgu);
while($sonyuklenenlersatir = mysqli_fetch_array($sonyuklenenlersorgugonder))
	{
		$fiyat_dizi = explode (".",$sonyuklenenlersatir["fiyat"]);
		$sonyuklenenkategorisorgu = "SELECT * FROM kategoriler where id=".$sonyuklenenlersatir["kategori"];
		$sonyuklenenkategorisorgugonder = mysqli_query($db, $sonyuklenenkategorisorgu);
		$sonyuklenenlerkategorisatir = mysqli_fetch_array($sonyuklenenkategorisorgugonder);
		if(@$fiyat_dizi[1] < 10){
			@$fiyat_dizi[1] = $fiyat_dizi[1]."0";
			ltrim($fiyat_dizi[1],"0");
		}
		$sonyuklenenlerresimsorgu = "SELECT * FROM resimler where sahip =".$sonyuklenenlersatir["id"]." ORDER BY id ASC LIMIT 1 ";
		$sonyuklenenlerresimsorgugonder = mysqli_query($db, $sonyuklenenlerresimsorgu);
		if(mysqli_num_rows($sonyuklenenlerresimsorgugonder) < 1){
			$sonyuklenenlerresimsatir["isim"] = "hazirlaniyor.png";
		}
		else {
			$sonyuklenenlerresimsatir = mysqli_fetch_array($sonyuklenenlerresimsorgugonder);
		}
		$kategori_metin = "";
		if($sonyuklenenlerkategorisatir["id"] != 0 or $sonyuklenenlerkategorisatir["isim"] != "" or $sonyuklenenlerkategorisatir["isim"] != null){
			$kategori_metin = '<div class="product_category"><a href="?sayfa=kategori&k='.$sonyuklenenlerkategorisatir["kategorikodu"].'">'.$sonyuklenenlerkategorisatir["isim"].'</a> Kategorisinden</div>';
		}
	echo '
	<div class="col-xl-4 col-md-6">
							<div class="product">
								<div class="product_image"><img src="images/'.$sonyuklenenlerresimsatir["isim"].'" alt="'.$sonyuklenenlersatir["isim"].'">
								';
								if($ayarlarsatir["stokuyari"] == 1){
									if($sonyuklenenlersatir["stok"] < $ayarlarsatir["stokuyarideger"]){
										echo '<div class="alert">
											<div class="dpib a-1">Kritik stok!</div>
											<div class="dpib a-2">Son '.($sonyuklenenlersatir["stok"]-$ayarlarsatir["bitikstok"]).' ürün!</div>
										</div>';
									}
								}
								echo '
								</div>
								<div class="product_content">
									<div class="product_info d-flex flex-row align-items-start justify-content-start">
										<div>
											<div>
												<div class="product_name"><a href="?sayfa=detay&u='.base64_encode($sonyuklenenlersatir["id"]).'">'.$sonyuklenenlersatir["isim"].'</a></div>
												'.$kategori_metin.'
											</div>
										</div>
										<div class="ml-auto text-right">';
										if($ayarlarsatir["goruntulenmeaktif"] == 1){
										echo '<div class="rating_r rating_r_0 home_item_rating"><img src="images/show.png" alt="Görüntüleme" /> ';
											if($sonyuklenenlersatir["goruntuleme"] > 999 and $sonyuklenenlersatir["goruntuleme"] < 999999){
												$bolme = explode(".", ($sonyuklenenlersatir["goruntuleme"]/1000));
												echo $bolme[0]." bin";
											}
											else if ($sonyuklenenlersatir["goruntuleme"] > 999999){
												$bolme = explode(".", ($sonyuklenenlersatir["goruntuleme"]/1000000));
												echo $bolme[0]." mn";
											}
											else {
												echo $sonyuklenenlersatir["goruntuleme"];
											} 
											echo '</div>';
										}
											echo '<div class="product_price text-right">'.$fiyat_dizi[0].'<span>.'.$fiyat_dizi[1].'</span>'.$parabirimsatir["birim"].'</div>
										</div>
									</div>
									<div class="product_buttons">
										<div class="text-right d-flex flex-row align-items-start justify-content-start">
											<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center" title="Favorilere Ekle">
												<div><div><a href="?sayfa=detay&u='.base64_encode($sonyuklenenlersatir["id"]).'&fav=1"><img src="images/heart_2.svg" class="svg" alt="'.$sonyuklenenlersatir["isim"].' ürünü favorilerine ekle"></a><div>+</div></div></div>
											</div>
											<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="Detaylı İncele">
												<div><div><a href="?sayfa=detay&u='.base64_encode($sonyuklenenlersatir["id"]).'"><img src="images/detail.svg" class="svg" alt=""></a><div>+</div></div></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
	';
}
?>