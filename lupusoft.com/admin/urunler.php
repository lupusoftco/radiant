                <?php
                $sayfada = $ayarlarsatir["getirilecek_icerik_sayisi"]; // sayfada gösterilecek içerik miktarını belirtiyoruz.
				$sorgu = mysqli_query($db,'SELECT COUNT(*) AS toplam FROM urunler');
				$sonuc = mysqli_fetch_assoc($sorgu);
				$toplam_icerik = $sonuc['toplam'];
				$toplam_sayfa = ceil($toplam_icerik / $sayfada);
				// eğer sayfa girilmemişse 1 varsayalım.
				$sayfa = isset($_GET['s']) ? (int) $_GET['s'] : 1;
				// eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
				if($sayfa < 1) $sayfa = 1; 
				// toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                	if(isset($_GET["sil"])){
                		$_GET["sil"] = escape_sql_string($_GET["sil"]);
                		mysqli_query($db,"DELETE FROM urunler WHERE id =".$_GET["sil"]);
                		$varyasyon_getir = mysqli_query($db,"SELECT * FROM varyasyon WHERE urunid = ".$_GET["sil"]);
                		while($varyasyon_satir = mysqli_fetch_assoc($varyasyon_getir)){
                			mysqli_query($db,"DELETE FROM varyasyondeger WHERE sahip =".$varyasyon_satir["id"]);
                		}
                		mysqli_query($db,"DELETE FROM varyasyon WHERE urunid =".$_GET["sil"]);
                		mysqli_query($db,"DELETE FROM yorumlar WHERE urun =".$_GET["sil"]);
                		mysqli_query($db,"DELETE FROM favoriler WHERE urun =".$_GET["sil"]);
                		mysqli_query($db,"DELETE FROM resimler WHERE sahip =".$_GET["sil"]);
                		mysqli_query($db,"DELETE FROM sepet WHERE urun =".$_GET["sil"]);
                		mysqli_query($db,"DELETE FROM siparislistesi WHERE urun =".$_GET["sil"]);
                		echo "<script>window.close();</script>";
                	}
                	if(isset($_FILES["excel"])){
                		function replace_tr($text) {
						 $text = trim($text);
						 $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
						 $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
						 $new_text = str_replace($search,$replace,$text);
						 return $new_text;
						}
						$csvfile_name = time() . '_' . $_FILES['excel']['name'];
						$csvfile_name = replace_tr($csvfile_name);
						move_uploaded_file($_FILES['excel']['tmp_name'], 'backup/' . $csvfile_name);
                		if(($handle = fopen('backup/'. $csvfile_name, "r")) !== FALSE){
						    while(($row =   fgetcsv($handle)) !== FALSE){
						    	if($row[0] != "id"){
						    		if($row[1] == "" or $row[1] == null or !isset($row[1])){
						    			$row[1] = "&nbsp;";
						    		}
							    	$urun_sor = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$row[0]." or barkod = '".$row[1]."'");
							    	if(mysqli_num_rows($urun_sor) == 1){
							    		mysqli_query($db,"UPDATE urunler SET barkod = '".$row[1]."', isim = '".$row[2]."', aciklama = '".$row[3]."', fiyat = ".$row[4].", kategori = ".$row[5].", stok = ".$row[7].", etiketler = '".$row[9]."', minimumalis = ".$row[10].", maksimumalis = ".$row[11].", birim = ".$row[12].", marka = ".$row[13]." WHERE id = ".$row[0]);
							    	}
							    	else {
							        mysqli_query($db,'INSERT INTO urunler(barkod, isim, aciklama, fiyat, kategori, vitrin, stok, goruntuleme, etiketler, minimumalis, maksimumalis, birim, marka) VALUES ("'.$row[1].'","'.$row[2].'","'.$row[3].'",'.$row[4].','.$row[5].',0,'.$row[7].',0,"'.$row[9].'",'.$row[10].','.$row[11].','.$row[12].','.$row[13].')');
							        }
						        }
						    }
						    fclose($handle);
						}
                	}
                ?>
                <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
                <script type="text/javascript">
                	function gizle(x){
                		$(".table-tr-"+x).css("display","none");
                	}
                	$(document).ready(function(){
                		$(".btn-excel").click(function(){
                			$("input[name=excel]").click();
                		});
                		$("input[name=excel]").change(function () {
							$("#import-form").submit();
						});
                		var i = 1;
                		$(".showelements").click(function(){
                			i++;
                			var x = $(this).attr("data-id");
	                		$("."+x+"-span").toggle();
	                		$("."+x).toggle();
                		});
                		$(".btnvitrin").click(function(){
						    var tc = this.className || undefined;
						    $(this).toggleClass("btn-secondary");
  							$(this).toggleClass("btn-success");
                			var urunvitrinid = $(this).attr("data-id");
							$.ajax(
							    {
							        type: "POST",
							        url: 'index.php',
							        data: {urunvitrinid},
							        success: function (data)
							                {
							                    $("main").append('<div class="success-animate">'+data+'</div>');
							                },
							    }
						    );
                		});
                		$("button").click(function(){
                			var x = $(this).attr("data-id");
                			$("form#"+x).submit(function(){
                				return false;
                			});
                			$(".showelements[data-id="+x+"]").click();
                			var urunid = $("input[name=urunid"+x+"]").val();
							var urunadi = $("input[name=urunadi"+x+"]").val();
							var aciklama = $("textarea[name=aciklama"+x+"]").val();
							var barkod = $("input[name=barkod"+x+"]").val();
							var marka = $("select[name=marka"+x+"]").val();
							var kategori = $("select[name=kategori"+x+"]").val();
							var tutar = $("input[name=tutar"+x+"]").val();
							$.ajax(
							    {
							        type: "POST",
							        url: 'index.php',
							        data: {urunid,urunadi,aciklama,barkod,marka,kategori,tutar},
							        success: function (data)
							                {
							                    $("main").append('<div class="success-animate">'+data+'</div>');
							                },
							    }
						    );
                		});
                	});
                </script>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Ürün Yönetimi</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            	<div class="col-lg-6" style="display: inline-block;margin-left:-1%;"><i class="fas fa-box-open"></i> Ürünler
                            	</div>
                            	<div class="col-lg-2" style="display: inline-block;margin-left:-2%; text-align: right;">
                            		<form method="POST" id="import-form" enctype="multipart/form-data">
                            			<input type="file" name="excel" style="display: none;">
                            			<a href="javascript:void(0);" class="btn btn-success btn-excel">İçe Aktar</a>
                            		</form>
                            	</div>
                            	<div class="col-lg-2" style="display: inline-block;margin-left:-2%; text-align: right;">
                            		<form method="POST" action="export.php">
                            			<input type="hidden" name="excele" value="aktar">
                            			<input type="submit" value="Dışa Aktar" class="btn btn-danger">
                            		</form>
                            	</div>
                            	<div class="col-lg-2" style="display: inline-block;margin-left:-2%; text-align: right;">
                            		<a href="index.php?sayfa=urun-ekle" target="_blank" class="btn btn-primary">Yeni Ürün ekle</a>
                            	</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Ürün adı</th>
                                                <th>Açıklama</th>
                                                <th>Barkod</th>
                                                <th>Marka</th>
                                                <th>Kategori</th>
                                                <th>Fiyat</th>
                                                <th>İşlemler</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Ürün adı</th>
                                                <th>Açıklama</th>
                                                <th>Barkod</th>
                                                <th>Marka</th>
                                                <th>Kategori</th>
                                                <th>Fiyat</th>
                                                <th>İşlemler</th>

                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        	<?php
                                        		$limit = ($sayfa - 1) * $sayfada;
                                        		$urun_getir = mysqli_query($db,"SELECT * FROM urunler ORDER BY id DESC LIMIT ".$limit.", ".$sayfada);
                                        		while ($urun_satir = mysqli_fetch_assoc($urun_getir)) {
                                        	?>
                                            <tr class="table-tr-<?php echo $urun_satir['id']; ?>">
                                            	<form method="POST" id="<?php echo $urun_satir['id']; ?>">
                                            		<input type="hidden" value="<?php echo $urun_satir['id']; ?>" name="urunid<?php echo $urun_satir['id']; ?>">
	                                                <td>
	                                                	<span class="<?php echo $urun_satir['id']; ?>-span">
	                                                		<a href="../index.php?sayfa=detay&u=<?php echo base64_encode($urun_satir['id']); ?>" target="_blank" title="Ürünü Görüntüle">
	                                                			<i class="fas fa-eye"></i>
	                                                		</a> 
	                                                		<?php echo $urun_satir["isim"]; ?>
	                                                	</span>
	                                                	<input type="text" class="urunler-form <?php echo $urun_satir['id']; ?>" value="<?php echo $urun_satir['isim']; ?>" name="urunadi<?php echo $urun_satir['id']; ?>">
	                                            	</td>
	                                                <td>
	                                                	<span class="<?php echo $urun_satir['id']; ?>-span"><?php echo substr(htmlspecialchars($urun_satir["aciklama"]) , 0, 40); ?>...</span>
	                                                	<textarea style="width: 100%;" class="urunler-form <?php echo $urun_satir['id']; ?>" name="aciklama<?php echo $urun_satir['id']; ?>"><?php echo $urun_satir['aciklama']; ?></textarea>
	                                            	</td>
	                                                <td>
	                                                	<span class="<?php echo $urun_satir['id']; ?>-span"><?php echo $urun_satir['barkod']; ?></span>
	                                                	<input type="text" class="urunler-form <?php echo $urun_satir['id']; ?>" value="<?php echo $urun_satir['barkod']; ?>" name="barkod<?php echo $urun_satir['id']; ?>">
	                                            	</td>
	                                                <td>
	                                                	<span class="<?php echo $urun_satir['id']; ?>-span">
	                                                		<?php
	                                                			$marka_getir = mysqli_query($db,"SELECT * FROM markalar WHERE id = ".$urun_satir['marka']);
	                                                			$marka_satir = mysqli_fetch_assoc($marka_getir);
	                                                			echo $marka_satir["isim"];
	                                                		?>
	                                                	</span>
	                                                	<select class="urunler-form <?php echo $urun_satir['id']; ?>" name="marka<?php echo $urun_satir['id']; ?>">
	                                                		<option value="<?php echo $marka_satir["id"]; ?>">
	                                                			<?php 
	                                                				echo $marka_satir["isim"];
	                                                			?>
	                                                		</option>
	                                                		<?php
	                                                			$markalar_getir = mysqli_query($db,"SELECT * FROM markalar");
	                                                			while($markalar_satir = mysqli_fetch_assoc($markalar_getir)){
	                                                				echo '<option value="'.$markalar_satir["id"].'">'.$markalar_satir["isim"].'</option>';
	                                                			}
	                                                		?>
	                                                	</select>
	                                                </td>
	                                                <td>
	                                                	<span class="<?php echo $urun_satir['id']; ?>-span">
	                                                		<?php
	                                                			$kategori_getir = mysqli_query($db,"SELECT * FROM kategoriler WHERE id = ".$urun_satir['kategori']);
	                                                			$kategori_satir = mysqli_fetch_assoc($kategori_getir);
	                                                			echo $kategori_satir["isim"];
	                                                		?>
	                                                	</span>
	                                                	<select class="urunler-form <?php echo $urun_satir['id']; ?>" name="kategori<?php echo $urun_satir['id']; ?>">
	                                                		<option value="<?php echo $kategori_satir["id"]; ?>">
	                                                			<?php 
	                                                				echo $kategori_satir["isim"];
	                                                			?>
	                                                		</option>
	                                                		<?php
	                                                			$kategoriler_getir = mysqli_query($db,"SELECT * FROM kategoriler");
	                                                			while($kategoriler_satir = mysqli_fetch_assoc($kategoriler_getir)){
	                                                				echo '<option value="'.$kategoriler_satir["id"].'">'.$kategoriler_satir["isim"].'</option>';
	                                                			}
	                                                		?>
	                                                	</select>
	                                                </td>
	                                                <td>
	                                                	<span class="<?php echo $urun_satir['id']; ?>-span"><?php echo $urun_satir["fiyat"]." ".$parabirimsatir["birim"]; ?></span>
		                                              	<input type="text" class="urunler-form <?php echo $urun_satir['id']; ?>" value="<?php echo $urun_satir["fiyat"]; ?>" name="tutar<?php echo $urun_satir['id']; ?>">
	                                                </td>
	                                                <td>
	                                                	<button class="btn btn-success m-1 urunler-form <?php echo $urun_satir['id']; ?>" data-id="<?php echo $urun_satir['id']; ?>">Kaydet</button>
	                                                	<a href="javascript:void(0);" class="btn btn-warning showelements m-1" data-id="<?php echo $urun_satir['id']; ?>" title="Hızlı Düzenle"><i class="fas fa-pen"></i></a> 
	                                                	<a href="javascript:void(0);" data-id="<?php echo $urun_satir['id']; ?>" class="m-1 btnvitrin btn btn-<?php if($urun_satir['vitrin'] == 0){echo 'secondary';}else {echo 'success';} ?>" title="Vitrin <?php if($urun_satir['vitrin'] == 0){echo 'Pasif';}else {echo 'Aktif';} ?>"><i class="fas fa-star"></i></a> 
	                                                	<a href="index.php?sayfa=gelismis-duzenleyici&urun=<?php echo $urun_satir['id']; ?>#urundetayAc" target="_blank" class="btn btn-light m-1" style="box-shadow:0px 0px 0px 1px #888;" title="Gelişmiş Düzenleyici"><i class="fas fa-edit"></i></a> 
	                                                	<a href="index.php?sayfa=gelismis-duzenleyici&urun=<?php echo $urun_satir['id']; ?>#varyasyonlarAc" target="_blank" class="btn btn-dark m-1" title="Varyasyonları Düzenle"><i class="fas fa-project-diagram"></i></a> 
	                                                	<a href="index.php?sayfa=gelismis-duzenleyici&urun=<?php echo $urun_satir['id']; ?>#gorsellerAc" target="_blank" class="btn btn-info m-1" title="Resimleri Düzenle"><i class="fas fa-images"></i></a> 
	                                                	<a href="index.php?sayfa=urun-ekle&copy=<?php echo $urun_satir['id']; ?>" class="btn btn-primary m-1" target="_blank" title="Ürünü Kopyala"><i class="fas fa-copy"></i></a> 
	                                                	<a href="index.php?sayfa=raporlar&urun=<?php echo $urun_satir['id']; ?>" class="btn btn-secondary m-1" target="_blank" title="Satış Raporu"><i class="fas fa-tasks"></i></a> 
	                                                	<a href="javascript:if(confirm(`Ürünü silmek istediğinize emin misiniz?`)){window.open(`?sayfa=urun-yonetimi&sil=<?php echo $urun_satir['id']; ?>`, '_blank');gizle(<?php echo $urun_satir['id']; ?>);}" class="btn btn-danger m-1" title="Ürünü Sil"><i class="fas fa-trash"></i></a>
	                                                </td>
	                                            </form>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                     <?php
                                    for($s = 1; $s <= $toplam_sayfa; $s++) {
									   if($sayfa == $s) { // eğer bulunduğumuz sayfa ise link yapma.
									      echo $s . ' '; 
									   } else if($s > ($sayfa-3) and $s < ($sayfa+3)){
									      echo '<a href="?sayfa=urun-yonetimi&s=' . $s . '">' . $s . '</a> ';
									   }
									}
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>