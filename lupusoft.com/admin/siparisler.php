                <?php
                $sayfada = $ayarlarsatir["getirilecek_icerik_sayisi"]; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                if(isset($_GET["silinen"])){
                	$silinen = "WHERE durum = 5";
                	$silinenlink = "&silinen=siparisler";
					$sorgu = mysqli_query($db,'SELECT COUNT(*) AS toplam FROM siparis WHERE durum = 5');
                }
                else {
                	$sorgu = mysqli_query($db,'SELECT COUNT(*) AS toplam FROM siparis WHERE durum != 5');
                	$silinen = "WHERE durum != 5";
                	$silinenlink = "";
                }
				$sonuc = mysqli_fetch_assoc($sorgu);
				$toplam_icerik = $sonuc['toplam'];
				$toplam_sayfa = ceil($toplam_icerik / $sayfada);
				// eğer sayfa girilmemişse 1 varsayalım.
				$sayfa = isset($_GET['s']) ? (int) $_GET['s'] : 1;
				// eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
				if($sayfa < 1) $sayfa = 1; 
				// toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                if(isset($_POST["siparisdurum"])){
                	if($_POST["durum"] == 4){
                		$siparisgetir = mysqli_query($db,"SELECT * FROM siparis WHERE id = ".$_POST["siparisdurum"]);
                		$siparissatir = mysqli_fetch_assoc($siparisgetir);
                		if($siparissatir["durum"] == $_POST["durum"]){
                			echo "<script type='text/javascript'>alert('Sipariş durumu zaten aynı.');</script>";
                		}
                		else {
                			$siplistegetir = mysqli_query($db,"SELECT * FROM siparislistesi WHERE siparis = ".$siparissatir["id"]);
                			while ($siplistesatir = mysqli_fetch_assoc($siplistegetir)) {
                				mysqli_query($db,"UPDATE urunler SET stok = stok -".$siplistesatir["miktar"]." WHERE id = ".$siplistesatir["urun"]);
                			}
                		}
                	}
                	else {
                		$siparisgetir = mysqli_query($db,"SELECT * FROM siparis WHERE id = ".$_POST["siparisdurum"]);
                		$siparissatir = mysqli_fetch_assoc($siparisgetir);
                		if($siparissatir["durum"] == 4){
                			$siplistegetir = mysqli_query($db,"SELECT * FROM siparislistesi WHERE siparis = ".$siparissatir["id"]);
                			while ($siplistesatir = mysqli_fetch_assoc($siplistegetir)) {
                				mysqli_query($db,"UPDATE urunler SET stok = stok +".$siplistesatir["miktar"]." WHERE id = ".$siplistesatir["urun"]);
                			}
                		}
                	}
                    mysqli_query($db,"UPDATE siparis SET durum = ".$_POST["durum"]." WHERE id = ".$_POST["siparisdurum"]);
                }
                ?>
                <script type="text/javascript">
                	function formsbmt(x){
                		var gonderilecekform = document.getElementById(x);
                		gonderilecekform.submit();
                	}
                </script>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Sipariş Yönetimi</h1>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-shopping-bag mr-1"></i> Siparişler
                            	<a href='?sayfa=siparis-yonetimi&silinen=siparisler' style='float:right;margin:0 5px;' class="btn btn-danger">Silinenler</a>
                            	<a href='?sayfa=siparis-yonetimi' style='float:right;margin:0 5px;' class="btn btn-success">Siparişler</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th title="Sipariş Takip Numarası">ID (S.T.N.)</th>
                                                <th>Adı Soyadı</th>
                                                <th>Telefon Numarası</th>
                                                <th>Sipariş Tutarı</th>
                                                <th>Sipariş Tarihi</th>
                                                <th>Sipariş Durumu</th>
                                                <th>Ödeme Tipi</th>
                                                <th>Teslimat</th>
                                                <th>Eylemler</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th title="Sipariş Takip Numarası">ID (S.T.N.)</th>
                                                <th>Adı Soyadı</th>
                                                <th>Telefon Numarası</th>
                                                <th>Sipariş Tutarı</th>
                                                <th>Sipariş Tarihi</th>
                                                <th>Sipariş Durumu</th>
                                                <th>Ödeme Tipi</th>
                                                <th>Teslimat</th>
                                                <th>Eylemler</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        	<?php
                                        	$limit = ($sayfa - 1) * $sayfada;
                                        	$siparisler = mysqli_query($db,"SELECT * FROM siparis ".$silinen." ORDER BY id DESC LIMIT  ".$limit.", ".$sayfada);
                                        	while(@$siparisler_satir = mysqli_fetch_assoc($siparisler)){
                                        	?>
                                            <tr>
                                                <td>(<?php echo $siparisler_satir["id"]; ?>) <?php echo $siparisler_satir["siptakipno"]; ?></td>
                                                <td><?php echo $siparisler_satir["adsoyad"]; ?></td>
                                                <td><?php echo $siparisler_satir["telefon"]; ?></td>
                                                <td><?php echo $siparisler_satir["tutar"]." ".$parabirimsatir["birim"]; ?></td>
                                                <td><?php $tarih_dizi = explode ("|",$siparisler_satir["ipvetarih"]); echo $tarih_dizi[0]; ?></td>
                                                <td>
                                                	<form method="POST" id="<?php echo $siparisler_satir['id']; ?>">
	                                                	<input type="hidden" name="siparisdurum" value="<?php echo $siparisler_satir['id']; ?>">
	                                                    <select name="durum" onchange="formsbmt(<?php echo $siparisler_satir['id']; ?>);">
	                                                    	<?php
	                                                    	$sipdurum = mysqli_query($db,"SELECT * FROM siparisdurum WHERE id = ".$siparisler_satir["durum"]);
	                                                    	$sipdurum_satir = mysqli_fetch_assoc($sipdurum);
	                                                    	?>
	                                                        <option value="<?php echo $sipdurum_satir['id']; ?>"><?php echo $sipdurum_satir["durum"]; ?></option>
	                                                    	<?php
	                                                    	$durumlar = mysqli_query($db,"SELECT * FROM siparisdurum");
	                                                    	while($durumlar_satir = mysqli_fetch_assoc($durumlar)){
	                                                    		?>
	                                                    		<option value="<?php echo $durumlar_satir['id']; ?>"><?php echo $durumlar_satir["durum"]; ?></option>
	                                                    		<?php
	                                                    	}
	                                                    	?>
	                                                    </select>
                                                	</form>
                                                </td>
                                                <td><?php
                                                    $odemetipi = mysqli_query($db,"SELECT * FROM odemeyontemleri WHERE id = ".$siparisler_satir["odemeTipi"]);
                                                    $odemetipi_satir = mysqli_fetch_assoc($odemetipi);
                                                    echo $odemetipi_satir["isim"];
                                                ?></td>
                                                <td><?php
                                                    echo $siparisler_satir["teslimat"];
                                                ?></td>
                                                <td>
                                                    <a href="?sayfa=siparis&detay=<?php echo $siparisler_satir['id']; ?>" target="_blank" class="btn btn-primary" title="Detaylı incele"><i class="fas fa-external-link-alt"></i></a>
                                                    <a href="?sayfa=siparis&yazdir=<?php echo $siparisler_satir['id']; ?>" target="_blank" class="btn btn-secondary" title="Yazdır"><i class="fas fa-print"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    for($s = 1; $s <= $toplam_sayfa; $s++) {
									   if($sayfa == $s) { // eğer bulunduğumuz sayfa ise link yapma.
									      echo $s . ' '; 
									   } else if($s > ($sayfa-3) and $s < ($sayfa+3)){
									      echo '<a href="?sayfa=siparis-yonetimi'.$silinenlink.'&s=' . $s . '">' . $s . '</a> ';
									   }
									}
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>