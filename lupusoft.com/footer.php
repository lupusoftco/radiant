<footer class="footer">
			<div class="footer_content">
				<div class="container">
					<div class="row">
						
						<!-- About -->
						<div class="col-lg-4 footer_col">
							<div class="footer_about">
								<div class="footer_logo">
									<a href="index.php">
										<div class="d-flex flex-row align-items-center justify-content-start">
											<div class="footer_logo_icon"><img src="images/<?php echo $ayarlarsatir["logo"]; ?>" alt=""></div>
											<div><?php echo $ayarlarsatir["kadi"]; ?></div>
										</div>
									</a>		
								</div>
								<div class="footer_about_text">
									<p><?php echo $ayarlarsatir["footeryazi"]; ?></p>
								</div>
							</div>
						</div>

						<!-- Footer Links -->
						<div class="col-lg-4 footer_col">
							<div class="footer_menu">
								<div class="footer_title">Yardım</div>
								<ul class="footer_list">
									<?php
									$footer_sayfalar = mysqli_query($db,"SELECT * FROM sayfalar WHERE footeracik = 1");
									while ($sayfalar_liste = mysqli_fetch_assoc($footer_sayfalar)) {
										echo '<li>
											<a href="?sayfa=sayfa&icerik='.$sayfalar_liste["kod"].'"><div>'.$sayfalar_liste["baslik"].'</div></a>
										</li>';
									}
										
									?>
								</ul>
							</div>
						</div>

						<!-- Footer Contact -->
						<div class="col-lg-4 footer_col">
							<div class="footer_contact">
								<div class="footer_title">E-Bülten</div>
								<div class="newsletter">
									<?php
										if(isset($_POST["ebulten"])){
											mysqli_query($db, "INSERT INTO ebulten(eposta) VALUES('".escape_sql_string($_POST["ebulten"])."')");
										}
									?>
									<form id="newsletter_form" method="POST" class="newsletter_form">
										<input type="email" class="newsletter_input" name="ebulten" placeholder="Epostanıza kampanya gönderelim" required="required">
										<button class="newsletter_button">+</button>
									</form>
								</div>
								<div class="footer_social">
									<?php
									if($ayarlarsatir["footersosyal"] == 1){
										?>
										<div class="footer_title">Sosyal Medya</div>
										<ul class="footer_social_list d-flex flex-row align-items-start justify-content-start">
											<?php
												$sosyal_sorgu = mysqli_query($db,"SELECT * FROM sosyal");
												if(mysqli_num_rows($sosyal_sorgu) > 0){
													while ($sosyal_satir = mysqli_fetch_assoc($sosyal_sorgu)) {
														$sosyal_medya = mysqli_query($db,"SELECT * FROM sosyalmedyalar WHERE id = ".$sosyal_satir["sosyalmedya"]);
														$sosyal_medya_isim = mysqli_fetch_assoc($sosyal_medya);
														echo '<li><a href="'.$sosyal_satir['link'].'" target="_blank"><i class="fa fa-'.$sosyal_medya_isim["isim"].'" aria-hidden="true"></i></a></li>';
													}
												}
												else {
													echo '<li><a href="tel:'.$ayarlarsatir['tel'].'"><i class="fa fa-phone" aria-hidden="true"></i></a></li>';
												}
											?>
										</ul>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer_bar">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="footer_bar_content d-flex flex-md-row flex-column align-items-center justify-content-start">
								<div class="copyright order-md-1 order-2">
Bu site <a href="http://lupusoft.com" target="_blank">Lupusoft</a>&reg; E-Ticaret Sistemleri ile geliştirilmiştir.
<script>document.write(new Date().getFullYear());</script> </div>
								<nav class="footer_nav ml-md-auto order-md-2 order-1">
									<ul class="d-flex flex-row align-items-center justify-content-start">
										<li><a href="index.php?sayfa=sayfa&icerik=s-s-s">S.S.S.</a></li>
										<li><a href="index.php?sayfa=sayfa&icerik=hakkimizda">Hakkımızda</a></li>
										<li><a href="index.php?sayfa=sayfa&icerik=iletisim">İletişim</a></li>
										<li><img src="images/kart.png" /></li>
										<li><img style="height:30px;" src="images/yerli-uretim.png"></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>