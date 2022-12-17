<div class="boxes" id="categorydiv">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<div class="section_title text-center" style="margin-bottom:10px;">Kategoriler</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="boxes_container d-flex flex-row align-items-start justify-content-between flex-wrap">
							<!-- Box -->
							<?php
							$kategorilersorgu = "SELECT * FROM kategoriler";
							$kategorilersorgugonder = mysqli_query($db, $kategorilersorgu);
							if(mysqli_num_rows($kategorilersorgugonder) > 0){
								while($kategorilersorgugsatir = mysqli_fetch_array($kategorilersorgugonder)){
									echo '
									<div class="box">
										<div class="background_image" style="background-image:url(images/'.$kategorilersorgugsatir["resim"].');filter: blur(10px); -webkit-filter: blur(10px);"></div>
										<div class="box_content d-flex flex-row align-items-center justify-content-start">
											<div class="box_left">
												<div class="box_image">
													<a href="?sayfa=kategori&k='.$kategorilersorgugsatir["kategorikodu"].'">
														<div class="background_image" style="background-image:url(images/'.$kategorilersorgugsatir["resim"].')"></div>
													</a>
												</div>
											</div>
											<div class="box_right text-center">
												<div class="box_title">'.$kategorilersorgugsatir["isim"].'</div>
											</div>
										</div>
									</div>
									';
								}
							}
							else {
								echo '
									<div class="box">
										<div class="background_image" style="background-image:url(images/'.$kategorilersorgugsatir["resim"].');filter: blur(10px); -webkit-filter: blur(10px);"></div>
										<div class="box_content d-flex flex-row align-items-center justify-content-start">
											<div class="box_left">
												<div class="box_image">
													<a>
														<div class="background_image" style="background-image:url(images/'.$kategorilersorgugsatir["resim"].')"></div>
													</a>
												</div>
											</div>
											<div class="box_right text-center">
												<div class="box_title">Üzgünüz şuan görüntülenecek hiçbir kategori bulunmamaktadır.</div>
											</div>
										</div>
									</div>
									';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>