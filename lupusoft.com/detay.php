<?php
if(isset($_GET["fav"]) and $_GET["fav"] == 1){
	if(isset($_SESSION["oturum"]) and ($_SESSION["oturum"] == "acik") and isset($_SESSION["uyeid"])){
		$favsorgulasorgu = "SELECT * FROM favoriler where urun =".base64_decode($_GET["u"])." and sahip = ".$_SESSION["uyeid"];
		$favsorgulagonder = mysqli_query($db,$favsorgulasorgu);
		if(mysqli_num_rows($favsorgulagonder) > 0){
			echo "<script type='text/javascript'>alert('Ürün zaten favori listenizde mevcut.');</script>";
		}
		else {
			$faveklesorgu = "INSERT INTO favoriler(urun,sahip) VALUES(".base64_decode($_GET["u"]).",".$_SESSION["uyeid"].")";
			$faveklesorgugonder = mysqli_query($db,$faveklesorgu);
			echo "<script type='text/javascript'>alert('Ürün favorilerinize eklenmiştir.');</script>";
		}
	}
	else {
		header('Location: index.php?sayfa=uyegiris');
	}
}
$sorgu="SELECT * FROM urunler where id = ".base64_decode($_GET["u"]);
$gonder = mysqli_query($db, $sorgu);
$urunkontrol = 0;
if(mysqli_num_rows($gonder) < 1){
	$urunkontrol = 1;
}
?>
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/jquery.dataTables.css">
	<style type="text/css">
		.img-magnifier-container {
		  position:relative;
		  cursor:none;
		}
		.img-magnifier-container:hover .img-magnifier-glass {
			display:block;
		  	cursor: none;
		}
		.img-magnifier-glass {
		  display:none;
		  position: absolute;
		  border: 3px solid #666;
		  cursor: none;
		  width: 175px;
		  height: 175px;
		}
	</style>
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Ürün Detayı</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Product -->

		<div class="product">
			<div class="container">
				<div class="row">
					
					<!-- Product Image -->
					<div class="col-lg-6">
						<div class="product_image_slider_container">
							<div id="slider" class="flexslider">
								<ul class="slides">
									<?php
										$resimsorgu = "select * from resimler where sahip=".base64_decode($_GET["u"])." ORDER BY id ASC";
										$resimsorgugonder = mysqli_query($db,$resimsorgu);
										if(mysqli_num_rows($resimsorgugonder) < 1){
											echo '<li><div><img src="images/hazirlaniyor.png" /></div></li>';
										}
										else {
											$sayac = 1;
											while($resimsorgusatir = mysqli_fetch_assoc($resimsorgugonder)){
												echo '
													<li data-id="'.$resimsorgusatir["id"].'" style="display:none;">
														<div class="img-magnifier-container"><img id="myimage'.$sayac.'" src="images/'.$resimsorgusatir["isim"].'"/></div>
													</li>
												';
												$sayac++;
											}
										}
									?>
								</ul>
							</div>
							<div class="carousel_container">
								<div id="carousel" class="flexslider">
									<ul class="slides">
										<?php
										$resimsorgu = "select * from resimler where sahip=".base64_decode($_GET["u"]);
										$resimsorgugonder = mysqli_query($db,$resimsorgu);
										while($resimsorgusatir = mysqli_fetch_assoc($resimsorgugonder)){
											echo '
												<li data-id="'.$resimsorgusatir["id"].'">
													<div><img src="images/'.$resimsorgusatir["isim"].'" /></div>
												</li>
											';
										}
										?>
									</ul>
								</div>
							</div>
						</div>
						<?php
							function url_origin( $s, $use_forwarded_host = false )
							{
							    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
							    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
							    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
							    $port     = $s['SERVER_PORT'];
							    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
							    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
							    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
							    return $protocol . '://' . $host;
							}

							function full_url( $s, $use_forwarded_host = false )
							{
							    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
							}

							$absolute_url = full_url( $_SERVER );

							if($ayarlarsatir["urunsosyal"] == 1 && $urunkontrol == 0){
						?>
						<div class="product_text">
							<div class="product_size_title"><i class="fa fa-share" style="font-size:36px;"></i> Bu ürünü paylaş<div style='float:right;padding-top: 10px;'><a class='resmibuyut' target="_blank" style="color:#333;"><img src='images/search.png'> Büyük fotoğraf</a></div></div>
							<span style="clear:both;"></span>
							<ul class="footer_social_list d-flex flex-row align-items-start justify-content-start">
								<li><a href="https://api.whatsapp.com/send?text=Hey bulduğum şu harika ürüne bak! <?php echo $absolute_url; ?>" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $absolute_url; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Hey%20bulduğum%20şu%20harika%20ürüne%20bak!%20<?php echo $absolute_url; ?>" data-size="large" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="https://pinterest.com/pin/create/button/?url=<?php echo $absolute_url; ?>&media=&description=Hey%20bulduğum%20şu%20harika%20ürüne%20bak!" target=";_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li><a href="mailto:info@example.com?&subject=&body=<?php echo $absolute_url; ?> Hey bulduğum şu harika ürüne bak!" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
							</ul>
							<hr>
						</div>
						<?php
							}
							if($ayarlarsatir["urunyorum"] == 1 && $urunkontrol == 0){
						?>
						<div class="product_text">
							<div class="product_size_title"><i class="fa fa-comments-o" style="font-size:36px;"></i> Yorumlar</div>
							<p>&nbsp;</p>
							<?php
								$urunyorumsorgu = "SELECT * FROM yorumlar WHERE durum = 1 and urun = ".base64_decode($_GET["u"])." ORDER BY id DESC";
								$urunyorumsorgugonder = mysqli_query($db,$urunyorumsorgu);
								if(mysqli_num_rows($urunyorumsorgugonder) > 0){
									?>
									<table id="yorumlar">
										<thead>
											<tr>
												<th>Üye</th>
												<th width="80%">Yorum</th>
											</tr>
										</thead>
										<tbody>
									<?php
									while($urunyorumsatir = mysqli_fetch_array($urunyorumsorgugonder)){
										$uyesorgu = "SELECT * FROM uyeler where id = ".$urunyorumsatir["uye"];
										$uyesorgugonder = mysqli_query($db,$uyesorgu);
										$uyesorgusatir = mysqli_fetch_array($uyesorgugonder);
										?><tr>
											<td><?php echo $uyesorgusatir["adsoyad"]; ?></td>
											<td><?php echo $urunyorumsatir["yorum"]; ?></td>
										  </tr>
										<?php } ?>
										</tbody>
									</table>
									<?php
								}
								else {?>
									<p>Henüz yorum yapılmamış. İlk yorum yapan sen ol!</p>
								<?php } 
									if(empty($_SESSION["oturum"]) or $_SESSION["oturum"] != "acik"){ ?>
									<small><a href="?sayfa=uyegiris">Yorum yazabilmek için üye girişi yapmalısın.</a></small>
									<?php }
									else if(!empty($_SESSION["oturum"]) and $_SESSION["oturum"] == "acik"){ ?>
										<form method="POST" class="yorumform" id="yorumformu">
											<textarea placeholder="Yaşadığınız tecrübeler, ürün hakkındaki fikirleriniz ve teslimat ile ilgili görüşlerinizden bahsedin." name="yorum"></textarea>
											<input type="submit" value="Yorum Yap"/>
										</form>
									<?php }
									if(isset($_POST["yorum"])){
										$yorumyapsorgu = "INSERT INTO yorumlar(urun,uye,yorum,durum) VALUES(".base64_decode($_GET["u"]).",".$_SESSION["uyeid"].",'".$_POST["yorum"]."',0)";
										$yorumyapsorgugonder = mysqli_query($db,$yorumyapsorgu);
										echo "<p id='yorum-uyari'>Yorumunuz gönderildi. İncelendikten sonra yayınlanacaktır.</p>";
										echo "<script type='text/javascript'>location.href = '#yorumformu';</script>";
									}
								?>
						<hr>
						</div>
						<?php } ?>
					</div>

					<!-- Product Info -->
					<div class="col-lg-6 product_col">
						<div class="product_info">
							<?php
								$satir = mysqli_fetch_array($gonder);
								$kategorisorgu ="SELECT * FROM kategoriler where id = ".$satir["kategori"];
								$kategorisorgugonder = mysqli_query($db, $kategorisorgu);
								$kategorisatir = mysqli_fetch_array($kategorisorgugonder);
								$fiyat_dizi = explode (".",$satir["fiyat"]);
								if(@$fiyat_dizi[1] < 10){
									@$fiyat_dizi[1] = $fiyat_dizi[1]."0";
									ltrim($fiyat_dizi[1],"0");
								}
							?>
							<div class="product_name"><?php if($urunkontrol == 0){echo $satir["isim"];} else { echo "Ürün Bulunamadı.";} ?></div>
							<?php if($urunkontrol == 0){ ?>
							<div class="product_text">
								<?php
								$markasorgu = "select * from markalar where id = ".$satir["marka"];
								$markasorgugonder = mysqli_query($db,$markasorgu);
								if(mysqli_num_rows($markasorgugonder) > 0 && $ayarlarsatir["markagoster"] == 1){
									$markasorgusatir = mysqli_fetch_array($markasorgugonder);
									echo '<img width="50" src="images/'.$markasorgusatir["logo"].'"> &nbsp; <!--<a href="?arama='.$markasorgusatir["isim"].'">-->'.$markasorgusatir["isim"].'<!--</a>-->';
								}
								?>
							</div>
							<div class="product_category">
								<?php if($kategorisatir["isim"] != null or $kategorisatir["isim"] != "" or $kategorisatir["id"] != 0){ ?>
								<a href="?sayfa=kategori&k=<?php echo $kategorisatir["kategorikodu"]; ?>"><?php echo $kategorisatir["isim"]; ?></a> kategorisinden
								<?php } ?>
							</div>
							<div class="product_rating_container d-flex flex-row align-items-center justify-content-start">
								<?php if($ayarlarsatir["goruntulenmeaktif"] == 1){ ?>
									<div class="product_reviews"><img src="images/show.png" alt="Görüntüleme" />
										<?php 

											if($satir["goruntuleme"] > 999 and $satir["goruntuleme"] < 999999){
												$bolum = explode(".", ($satir["goruntuleme"]/1000));
												echo $bolum[0]." bin";
											}
											else if ($satir["goruntuleme"] > 999999){
												$bolum = explode(".", ($satir["goruntuleme"]/1000000));
												echo $bolum[0]." mn";
											}
											else {
												echo $satir["goruntuleme"];
											} 
										?>
									</div>
								<div class="product_reviews_link"><a href="javascript:;">Görüntülenme</a></div>
								<?php } ?>
							</div>			
							<div class="product_price amount"><font id="tamtutar"><?php echo $fiyat_dizi[0].'</font><span>.'.$fiyat_dizi[1].'</span> '.$parabirimsatir["birim"]; ?></div>
							<?php
								if($ayarlarsatir["barkodaktif"] == 1 && !empty($satir["barkod"])){
							?>
							<div class="product_text">
								<div>
									<img src="images/barcode.png" width="100"><br>
									<small><?php echo $satir["barkod"]; ?></small>
								</div>
							</div>
							<?php }
							if($ayarlarsatir["stokuyari"] == 1){
								if($satir["stok"] < $ayarlarsatir["stokuyarideger"] && $satir["stok"] > $ayarlarsatir["bitikstok"]){
									echo '<div class="alert-2">
											<div class="dpib a-1">Kritik stok!</div>
											<div class="dpib a-2">Son '.($satir["stok"]-$ayarlarsatir["bitikstok"]).' ürün!</div>
										</div>';
								}
							} ?>	
							<div class="product_size">
							<form method="POST" action="index.php?sayfa=sepet&ekle=<?php echo $_GET['u']; ?>" id="varyasyon">
								<?php
								if($satir["stok"] > $ayarlarsatir["bitikstok"]){
									$varyasyonsorgu = "select * from varyasyon where durum = 1 and urunid = ".$satir["id"];
									$varyasyonsorgugonder = mysqli_query($db,$varyasyonsorgu);
									if(mysqli_num_rows($varyasyonsorgugonder) > 0){
										$satirsayac = 1;
										while($varyasyonsatir = mysqli_fetch_array($varyasyonsorgugonder)){
								?>
								<div class="product_size_title"><?php echo $varyasyonsatir["varyasyonadi"] ?> Seçiniz:</div>
								<ul class="d-flex flex-row align-items-start justify-content-start">
									<?php
										$varyasyondegersorgu = "select * from varyasyondeger where sahip = ".$varyasyonsatir["id"]." ORDER BY id ASC";
										$varyasyondegergonder = mysqli_query($db,$varyasyondegersorgu);
										$xy = 0;
										while($varyasyondegersatir = mysqli_fetch_array($varyasyondegergonder)){
											if($varyasyondegersatir["durum"] < 1){
									?>
									<li>
										<input type="radio" id="<?php echo $varyasyondegersatir['id'];?>" disabled name="varyasyon<?php echo $satirsayac; ?>" class="regular_radio radio_1">
										<label for="<?php echo $varyasyondegersatir['id'];?>"><?php echo $varyasyondegersatir['deger'];?></label>
									</li>
									<?php
											}
											else {
												if($xy == 0){
									?>
									<li>
										<input type="radio" id="<?php echo $varyasyondegersatir['id'];?>" name="varyasyon<?php echo $satirsayac; ?>" data-id="<?php echo $varyasyondegersatir['tutar']; ?>" value="<?php echo $varyasyondegersatir["id"]; ?>" class="regular_radio radio_2" checked>
										<label class="fiyatDegistir" title="<?php echo $varyasyondegersatir['tutar'].' '.$parabirimsatir["birim"]; ?>" for="<?php echo $varyasyondegersatir['id'];?>"><?php echo $varyasyondegersatir['deger'];?></label>
									</li>
								<?php   		$xy++;
												}
												else {
								?>
													<li>
														<input type="radio" id="<?php echo $varyasyondegersatir['id'];?>" name="varyasyon<?php echo $satirsayac; ?>" data-id="<?php echo $varyasyondegersatir['tutar']; ?>" value="<?php echo $varyasyondegersatir["id"]; ?>" class="regular_radio radio_2">
														<label class="fiyatDegistir" title="<?php echo $varyasyondegersatir['tutar'].' '.$parabirimsatir["birim"]; ?>" for="<?php echo $varyasyondegersatir['id'];?>"><?php echo $varyasyondegersatir['deger'];?></label>
													</li>
														
								<?php
												}
											}
										}
										$satirsayac++;
										echo "</ul><hr>";
									}
										echo "<input type='hidden' name='topvar' value='".($satirsayac-1)."'/>";
								?>
								<small>Seçimlerin fiyatlarını görüntülemek için imleci üzerinde bekletin.*</small>
								<?php
								}} ?>
								</form>
							</div>
							<div class="product_text">
								<p><?php echo $satir["aciklama"]; ?></p>
							</div>
							<div class="product_buttons">
								<div class="text-right d-flex flex-row align-items-start justify-content-start">
									<?php
									if($satir["stok"] > $ayarlarsatir["bitikstok"]){
										?>
									<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center" title="Favorilere Ekle">
										<div><div><a href="?sayfa=detay&u=<?php echo $_GET['u']; ?>&fav=1"><img src="images/heart_2.svg" class="svg" alt="<?php echo $satir["isim"]; ?> Ürününü Favorilere Ekle"></a><div>+</div></div></div>
									</div>
									<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" title="Sepete Ekle">
										<div><div><a href="javascript:formPost();"><img src="images/cart.svg" class="svg" alt="<?php echo $satir["isim"]; ?> Ürününü Sepete Ekle"></a><div>+</div></div></div>
									</div>
										<?php
									}
									else {
										?>
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<i class="fa fa-close"></i> Ürün stoklarımızda kalmamıştır.
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php
						if($ayarlarsatir["urunetiket"] == 1 && $urunkontrol == 0){
							if($satir["etiketler"] != "" or $satir["etiketler"] != null){
					?>
					<div class="col-lg-12">
						<h4>Etiketler</h4>
						<p id="etiketler">
							<?php
								$i = 0;
								$etiketler = explode (",",$satir["etiketler"]);
								$son = count($etiketler);
								while($i < $son){
									if($i < $son && $i > ($son-2)){
										echo "<a href='?arama=".$etiketler[$i]."'>".$etiketler[$i]."</a> ";
									}
									else {
										echo "<a href='?arama=".$etiketler[$i]."'>".$etiketler[$i]."</a>, ";
									}
									$i++;
								}
							?>
						</p>
					</div>
					<?php }} ?>
				</div>
			</div>

				<?php
					$aynikategori = mysqli_query($db,"SELECT * FROM urunler WHERE kategori = ".$satir["kategori"]." and id !=".$satir["id"]);
					if(mysqli_num_rows($aynikategori) > 0 && $ayarlarsatir["benzerurunler"] == 1){
				?>
				<br><hr><br>
				<h2>&nbsp;&nbsp;&nbsp;Benzer Ürünler</h2>
			<div class="scrolling-wrapper" id="scwrapper">
				<?php
				while($ayniurunler = mysqli_fetch_assoc($aynikategori)){
					$ayniurun_resim = mysqli_query($db,"SELECT * FROM resimler WHERE sahip =".$ayniurunler["id"]." ORDER BY id ASC LIMIT 1");
					$resimi = "hazirlaniyor.png";
					if(mysqli_num_rows($ayniurun_resim) > 0){
						$ayniurun_resimsatir = mysqli_fetch_assoc($ayniurun_resim);
						$resimi = $ayniurun_resimsatir["isim"];
					}
				?>
					<div class="card-likes">
							<h4 style=""><?php echo substr($ayniurunler["isim"] , 0, 20); ?></h4>
							<hr>
						<a href="?sayfa=detay&u=<?php echo base64_encode($ayniurunler["id"]); ?>">
							<div style="width:100%;height: 90%;background: url('images/<?php echo $resimi; ?>') no-repeat center center;background-size:cover;"></div>
						</a>
					</div>
				<?php }
					} ?>
			</div>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".fiyatDegistir").click(function(){
					setTimeout(function(){
						var fiyat = <?php echo $satir["fiyat"]; ?>;
						var topvar = $("input[name=topvar]").val();
						for (var i = 1; i <= topvar; i++) {
							var x = $("input[name='varyasyon"+i+"']:checked").attr("data-id");
							fiyat = Number(fiyat) + Number(x);
						}
						$("#tamtutar").html(fiyat);
			         },50)
				});
				$('#yorumlar').DataTable({
				  "searching": false,
				   "lengthChange": false
				});
				$("#slider .slides :nth-child(1)").slideDown();
				var imgsrc = $("#slider .slides :nth-child(1) img").attr("src");
				$('.resmibuyut').attr("href",imgsrc);
				$("#carousel .slides li").click(function(){
					var id = $(this).attr("data-id");
					$("#slider .slides li").slideUp();
					$("#slider .slides li[data-id="+id+"]").slideDown();
					imgsrc = $("#slider .slides li[data-id="+id+"] img").attr("src");
					$('.resmibuyut').attr("href",imgsrc);
				});
				var toplamresim = $("#slider > ul > li").length;
				for(i = 1;i<=toplamresim;i++){
					magnify("myimage"+i, 1.75);
				}
			});
			function formPost(){
				$("#varyasyon").submit();
			}
		</script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
		    const ele = document.getElementById('scwrapper');
		    ele.style.cursor = 'grab';

		    let pos = { top: 0, left: 0, x: 0, y: 0 };

		    const mouseDownHandler = function(e) {
		        ele.style.cursor = 'grabbing';
		        ele.style.userSelect = 'none';

		        pos = {
		            left: ele.scrollLeft,
		            top: ele.scrollTop,
		            // Get the current mouse position
		            x: e.clientX,
		            y: e.clientY,
		        };

		        document.addEventListener('mousemove', mouseMoveHandler);
		        document.addEventListener('mouseup', mouseUpHandler);
		    };

		    const mouseMoveHandler = function(e) {
		        // How far the mouse has been moved
		        const dx = e.clientX - pos.x;
		        const dy = e.clientY - pos.y;

		        // Scroll the element
		        ele.scrollTop = pos.top - dy;
		        ele.scrollLeft = pos.left - dx;
		    };

		    const mouseUpHandler = function() {
		        ele.style.cursor = 'grab';
		        ele.style.removeProperty('user-select');

		        document.removeEventListener('mousemove', mouseMoveHandler);
		        document.removeEventListener('mouseup', mouseUpHandler);
		    };

		    // Attach the handler
		    ele.addEventListener('mousedown', mouseDownHandler);
		});
			function magnify(imgID, zoom) {
			  var img, glass, w, h, bw;
			  img = document.getElementById(imgID);
			  /*create magnifier glass:*/
			  glass = document.createElement("DIV");
			  glass.setAttribute("class", "img-magnifier-glass");
			  /*insert magnifier glass:*/
			  img.parentElement.insertBefore(glass, img);
			  /*set background properties for the magnifier glass:*/
			  glass.style.backgroundImage = "url('" + img.src + "')";
			  glass.style.backgroundRepeat = "no-repeat";
			  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
			  bw = 3;
			  w = glass.offsetWidth / 2;
			  h = glass.offsetHeight / 2;
			  /*execute a function when someone moves the magnifier glass over the image:*/
			  glass.addEventListener("mousemove", moveMagnifier);
			  img.addEventListener("mousemove", moveMagnifier);
			  /*and also for touch screens:*/
			  glass.addEventListener("touchmove", moveMagnifier);
			  img.addEventListener("touchmove", moveMagnifier);
			  function moveMagnifier(e) {
			    var pos, x, y;
			    /*prevent any other actions that may occur when moving over the image*/
			    e.preventDefault();
			    /*get the cursor's x and y positions:*/
			    pos = getCursorPos(e);
			    x = pos.x;
			    y = pos.y;
			    /*prevent the magnifier glass from being positioned outside the image:*/
			    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
			    if (x < w / zoom) {x = w / zoom;}
			    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
			    if (y < h / zoom) {y = h / zoom;}
			    /*set the position of the magnifier glass:*/
			    glass.style.left = (x - w) + "px";
			    glass.style.top = (y - h) + "px";
			    /*display what the magnifier glass "sees":*/
			    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
			  }
			  function getCursorPos(e) {
			    var a, x = 0, y = 0;
			    e = e || window.event;
			    /*get the x and y positions of the image:*/
			    a = img.getBoundingClientRect();
			    /*calculate the cursor's x and y coordinates, relative to the image:*/
			    x = e.pageX - a.left;
			    y = e.pageY - a.top;
			    /*consider any page scrolling:*/
			    x = x - window.pageXOffset;
			    y = y - window.pageYOffset;
			    return {x : x, y : y};
			  }
			}
		</script>
		<?php
			$satir["goruntuleme"]++;
			$goruntulemeeklesorgu = "UPDATE urunler SET goruntuleme =".$satir["goruntuleme"]." where id =".$satir["id"];
			mysqli_query($db,$goruntulemeeklesorgu);
		?>