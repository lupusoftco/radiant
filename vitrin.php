<?php
if($ayarlarsatir["vitrintipi"] == 1){ ?>
<div class="home">
			<!-- Home Slider -->
			<div class="home_slider_container">
				<div class="owl-carousel owl-theme home_slider">
					
					<!-- Slide -->
					<?php
						$sorgu="SELECT * FROM urunler where vitrin = 1 and stok > ".$ayarlarsatir["bitikstok"];
						$gonder = mysqli_query($db, $sorgu);
							while($satir = mysqli_fetch_array($gonder))
							{
								$sayac = 0;
								$resimsorgu="SELECT * FROM resimler where sahip = ".$satir["id"]." ORDER BY id ASC";
								$resimsorgugonder = mysqli_query($db, $resimsorgu);
								while($resimsatir = mysqli_fetch_array($resimsorgugonder))
								{
									$resimler[$sayac] = $resimsatir['isim'];
									$sayac++;
								}
								$fiyat_dizi = explode (".",$satir["fiyat"]);
								$kategorisorgu ="SELECT * FROM kategoriler where id = ".$satir["kategori"];
								$kategorisorgugonder = mysqli_query($db, $kategorisorgu);
								$kategorisatir = mysqli_fetch_array($kategorisorgugonder);
								if(@$fiyat_dizi[1] < 10){
									@$fiyat_dizi[1] = $fiyat_dizi[1]."0";
									ltrim($fiyat_dizi[1],"0");
								}
								echo '
								<div class="owl-item">
							<div class="background_image" style="background-image:url(images/'.$resimler[0].'); filter: blur(10px); -webkit-filter: blur(10px);box-shadow: inset 0px 0px 50px 50px #aaa;"></div>
							<div class="container fill_height">
								<div class="row fill_height">
									<div class="col fill_height">
										<div class="home_container d-flex flex-column align-items-center justify-content-start">
											<div class="home_content">
												<div class="home_title">'.$ayarlarsatir["vitrinustbaslik"].'</div>
												<div class="home_subtitle">'.$ayarlarsatir["vitrinaltbaslik"].'</div>
												<div class="home_items">
													<div class="row">
													<div class="col-sm-3 offset-lg-1">
															<div class="home_item_side"><a href="?sayfa=detay&u='.base64_encode($satir["id"]).'"><img src="images/'.$resimler[1].'" alt=""></a></div>
														</div>
														<div class="col-lg-4 col-md-6 col-sm-8 offset-sm-2 offset-md-0">
															<div class="product home_item_large">
																<div class="product_tag d-flex flex-column align-items-center justify-content-center">
																	<div>
																		<div>SADECE</div>
																		<div>'.$fiyat_dizi[0].'<span>.'.$fiyat_dizi[1].'</span>'.$parabirimsatir["birim"].'</div>
																	</div>
																</div>
																<div class="product_image"><img src="images/'.$resimler[0].'" alt=""></div>
																<div class="product_content">
																	<div class="product_info d-flex flex-row align-items-start justify-content-start">
																		<div>
																			<div>
																				<div class="product_name"><a href="?sayfa=detay&u='.base64_encode($satir["id"]).'">'.$satir["isim"].'</a></div>
																				<div class="product_category"><a href="?sayfa=kategori&k='.$kategorisatir["kategorikodu"].'">'.$kategorisatir["isim"].'</a> Kategorisinden</div>
																			</div>
																		</div>
																		<div class="ml-auto text-right">
																			<!--<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>-->
																			<div class="product_price text-right">'.$fiyat_dizi[0].'<span>.'.$fiyat_dizi[1].'</span>'.$parabirimsatir["birim"].'</div>
																		</div>
																	</div>
																	<div class="product_buttons">
																		<div class="text-right d-flex flex-row align-items-start justify-content-start">
																			<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center" title="Favorilere Ekle">
																				<div><div><a href="?sayfa=detay&u='.base64_encode($satir["id"]).'&fav=1"><img src="images/heart_2.svg" alt="Ürünü Favorilerine Ekle" style="box-shadow:0px 0px 2px 2px #fff;"></a><div>+</div></div></div>
																			</div>
																			<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="Detaylı İncele">
																				<div><div><a href="?sayfa=detay&u='.base64_encode($satir["id"]).'"><img src="images/detail.svg" style="box-shadow:0px 0px 2px 2px #fff;" alt="Sepete Ekle"></a><div>+</div></div></div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="home_item_side"><a href="?sayfa=detay&u='.base64_encode($satir["id"]).'"><img src="images/'.$resimler[2].'" alt=""></a></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
								';
							$sayac = 0;
							}
					?>

				</div>
				<div class="home_slider_nav home_slider_nav_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
				<div class="home_slider_nav home_slider_nav_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>

				<!-- Home Slider Dots -->
				
				<div class="home_slider_dots_container">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="home_slider_dots">
									<ul id="home_slider_custom_dots" class="home_slider_custom_dots d-flex flex-row align-items-center justify-content-center">
										<?php
											$vitrinsayisorgu = "select * from urunler where vitrin = 1 and stok > ".$ayarlarsatir["bitikstok"];
											$vitrinsayisorgugonder = mysqli_query($db,$vitrinsayisorgu);
											$vitrinsayac = 1;
											while($vitrinsayisatir = mysqli_fetch_array($vitrinsayisorgugonder)){
												if($vitrinsayac < 10){
													$vitrinsayac = "0".$vitrinsayac;
												}
												echo '
													<li class="home_slider_custom_dot">'.$vitrinsayac.'</li>
												';
												$vitrinsayac++;
											}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>	
				</div>

			</div>
		</div>

<?php }
else if($ayarlarsatir["vitrintipi"] == 2){ ?>
<div class="mt-4" style="background:#FFFEFA;">
	<div class="text-center"><h1><?php echo $ayarlarsatir["vitrinustbaslik"]; ?></h1></div>
	<div class="text-center"><h2><?php echo $ayarlarsatir["vitrinaltbaslik"]; ?></h2></div>
					<?php
						$sorgu="SELECT * FROM urunler where vitrin = 1 and stok > ".$ayarlarsatir["bitikstok"];
						$gonder = mysqli_query($db, $sorgu);
							while($satir = mysqli_fetch_array($gonder))
							{
								$sayac = 0;
								$resimsorgu="SELECT * FROM resimler where sahip = ".$satir["id"]." ORDER BY id ASC";
								$resimsorgugonder = mysqli_query($db, $resimsorgu);
								while($resimsatir = mysqli_fetch_array($resimsorgugonder))
								{
									$resimler[$sayac] = $resimsatir['isim'];
									$sayac++;
								}
								$fiyat_dizi = explode (".",$satir["fiyat"]);
								$kategorisorgu ="SELECT * FROM kategoriler where id = ".$satir["kategori"];
								$kategorisorgugonder = mysqli_query($db, $kategorisorgu);
								$kategorisatir = mysqli_fetch_array($kategorisorgugonder);
								if(@$fiyat_dizi[1] < 10){
									@$fiyat_dizi[1] = $fiyat_dizi[1]."0";
									ltrim($fiyat_dizi[1],"0");
								}
								echo '
								<div class="col-lg-2 m-3 d-inline-block border text-dark">
									<div class="product home_item_large">
										<div class="product_tag d-flex flex-column align-items-center justify-content-center">
											<div>
												<div>SADECE</div>
												<div>'.$fiyat_dizi[0].'<span>.'.$fiyat_dizi[1].'</span>'.$parabirimsatir["birim"].'</div>
											</div>
										</div>
										<div class="product_image"><img src="images/'.$resimler[0].'" alt=""></div>
										<div class="product_content">
											<div class="product_info d-flex flex-row align-items-start justify-content-start">
												<div>
													<div>
														<div class="product_name"><a href="?sayfa=detay&u='.base64_encode($satir["id"]).'">'.$satir["isim"].'</a></div>
														<div class="product_category"><a href="?sayfa=kategori&k='.$kategorisatir["kategorikodu"].'">'.$kategorisatir["isim"].'</a> Kategorisinden</div>
													</div>
												</div>
												<div class="ml-auto text-right">
													<!--<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>-->
													<div class="product_price text-right">'.$fiyat_dizi[0].'<span>.'.$fiyat_dizi[1].'</span>'.$parabirimsatir["birim"].'</div>
												</div>
											</div>
											<div class="product_buttons">
												<div class="text-right d-flex flex-row align-items-start justify-content-start">
													<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center" title="Favorilere Ekle">
														<div><div><a href="?sayfa=detay&u='.base64_encode($satir["id"]).'&fav=1"><img src="images/heart_2.svg" alt="Ürünü Favorilerine Ekle" style="box-shadow:0px 0px 2px 2px #fff;"></a><div>+</div></div></div>
													</div>
													<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="Detaylı İncele">
														<div><div><a href="?sayfa=detay&u='.base64_encode($satir["id"]).'"><img src="images/detail.svg" style="box-shadow:0px 0px 2px 2px #fff;" alt="Sepete Ekle"></a><div>+</div></div></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								';
							$sayac = 0;
							}
					?>
</div><hr>
<?php }
?>