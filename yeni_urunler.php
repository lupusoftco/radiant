<div class="products">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<div class="section_title text-center">Yeni Ürünler</div>
					</div>
				</div>
				<div class="row page_nav_row">
					<div class="col">
						<div class="page_nav">
							<ul class="d-flex flex-row align-items-start justify-content-center">
								<?php
									$kategorilersorgu = "SELECT * FROM kategoriler";
									$kategorilersorgugonder = mysqli_query($db, $kategorilersorgu);
									while($kategorilersatir = mysqli_fetch_array($kategorilersorgugonder))
									{
										echo '<li><a href="?sayfa=kategori&k='.$kategorilersatir["kategorikodu"].'">'.$kategorilersatir["isim"].'</a></li>';
										
									}
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="row products_row">
					
					<?php include("urunler.php"); ?>

				</div>
				<div class="row load_more_row">
					<div class="col">
						<div class="button load_more ml-auto mr-auto"><a href="?sayfa=kesfet">Daha fazla</a></div>
					</div>
				</div>
			</div>
		</div>