                <?php
                $sayfada = $ayarlarsatir["getirilecek_icerik_sayisi"]; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                $sorgu = mysqli_query($db,'SELECT COUNT(*) AS toplam FROM uyeler');
                $sonuc = mysqli_fetch_assoc($sorgu);
                $toplam_icerik = $sonuc['toplam'];
                $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                // eğer sayfa girilmemişse 1 varsayalım.
                $sayfa = isset($_GET['s']) ? (int) $_GET['s'] : 1;
                // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                if($sayfa < 1) $sayfa = 1; 
                // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                if(isset($_POST["uyeadi"])){
                	mysqli_query($db,"INSERT INTO uyeler(adsoyad,sirket,adres,sehir,semt,postakodu,telefon,eposta,sifre) VALUES('".$_POST["uyeadi"]."','','','','','','','','".md5(rand(1,99))."')");
                	echo '<script type="text/javascript">alert("Üye eklendi.");window.location="index.php?sayfa=uye-yonetimi";</script>';
                }
                if(isset($_POST["adsoyad"])){
                	mysqli_query($db,"UPDATE uyeler SET adsoyad='".strip_tags($_POST["adsoyad"])."', eposta='".strip_tags($_POST["eposta"])."', telefon='".strip_tags($_POST["telefon"])."',adres='".strip_tags($_POST["adres"])."' WHERE id = ".$_POST["id"]);
                	echo '<script type="text/javascript">alert("Üye bilgileri güncellendi.");window.location="index.php?sayfa=uye-yonetimi";</script>';
                }
                if(isset($_POST["sil"])){
                	$sepetgetir = mysqli_query($db,"SELECT * FROM sepet WHERE sahip = ".$_POST["sil"]);
                	$sepetsatir = mysqli_fetch_assoc($sepetgetir);
                	mysqli_query($db,"DELETE FROM sepetvaryasyon WHERE sahipsepet = ".$sepetsatir["id"]);
                	mysqli_query($db,"DELETE FROM sepet WHERE sahip = ".$_POST["sil"]);
                	mysqli_query($db,"DELETE FROM uyeler WHERE id = ".$_POST["sil"]);
                	echo '<script type="text/javascript">alert("Üye silindi.");window.location="index.php?sayfa=uye-yonetimi";</script>';
                }
	            if(isset($_POST["sepetsil"])){
	            	$sepetgetir = mysqli_query($db,"SELECT * FROM sepet WHERE sahip = ".$_POST["sepetsil"]);
                	$sepetsatir = mysqli_fetch_assoc($sepetgetir);
                	mysqli_query($db,"DELETE FROM sepetvaryasyon WHERE sahipsepet = ".$sepetsatir["id"]);
                	mysqli_query($db,"DELETE FROM sepet WHERE sahip = ".$_POST["sepetsil"]);
                	echo '<script type="text/javascript">alert("Üyenin sepeti silindi.");window.location="index.php?sayfa=uye-yonetimi";</script>';
	            }
                if(isset($_GET["sepetler"])){
                    mysqli_query($db,"DELETE FROM sepetvaryasyon");
                    mysqli_query($db,"DELETE FROM sepet");
                    echo '<script type="text/javascript">alert("Üyelerin sepetleri silindi.");window.location="index.php?sayfa=uye-yonetimi";</script>';
                }
                ?>
                <script type="text/javascript">
                	$(document).ready(function(){
                		$(".yeniuyelik").click(function(){
	                		var isim = prompt("Üye adını girin","");
	                		if(isim == "" || isim == undefined || isim == null){
	                			alert("Üye adı boş bırakılamaz.");
	                		}
	                		else {
		                		$("input[name=uyeadi]").val(isim);
		                		$(".yeniuyelikform").submit();
	                		}
	                	});
	                	$("button").click(function(){
	                		var id = $(this).attr("data-id");
	                		var adsoyad = $(".adsoyad-"+id).attr("data-text");
	                		var eposta = $(".eposta-"+id).attr("data-text");
	                		var telefon = $(".telefon-"+id).attr("data-text");
	                		var adres = $(".adres-"+id).attr("data-text");
                			$("#tableData > tbody > tr").toggle();
                			$("input[name=adsoyad]").val(adsoyad);
                			$("input[name=eposta]").val(eposta);
                			$("input[name=telefon]").val(telefon);
                			$("input[name=adres]").val(adres);
                			$("input[name=id]").val(id);
	                	});
	                	$(".uyesilbtn").click(function(){
	                		if(!confirm("Üyeyi silmek istediğinize emin misiniz?")){
	                			return false;
	                		}
	                	});
                	});
                </script>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Üye Yönetimi</h1>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-user mr-1"></i> Üyeler <a style="float:right;" href="javascript:void(0);" class="btn btn-success yeniuyelik">Yeni Üyelik Oluştur</a> <?php $sepetsor = mysqli_query($db,"SELECT * FROM sepet"); if(mysqli_num_rows($sepetsor) > 0){ ?><a style="float:right;" href="index.php?sayfa=uye-yonetimi&sepetler=sil" class="btn btn-danger mr-2">Sepetleri Sil</a><?php } ?></div>
                            <form method="POST" class="yeniuyelikform" style="display: none;">
                            	<input type="text" name="uyeadi">
                            </form>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>İsim Soyisim</th>
                                                <th>E-posta Adresi</th>
                                                <th>Telefon</th>
                                                <th>Adres</th>
                                                <th>E-posta İzin</th>
                                                <th>Toplam Siparişler</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>İsim Soyisim</th>
                                                <th>E-posta Adresi</th>
                                                <th>Telefon</th>
                                                <th>Adres</th>
                                                <th>E-posta İzin</th>
                                                <th>Toplam Siparişler</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        	<tr style="display: none;" id="updateForm">
                                        		<form method="POST">
	                                        		<td><input type="text" name="adsoyad" placeholder="İsim soyisim"></td>
	                                        		<td><input type="email" name="eposta" placeholder="E-posta adresi"></td>
	                                        		<td><input type="text" name="telefon" placeholder="Telefon numarası"></td>
	                                        		<td><input type="text" name="adres" placeholder="Adres"></td>
	                                        		<td><input type="hidden" name="id"></td>
	                                        		<td></td>
	                                        		<td><input type="submit" value="Kaydet" class="btn btn-success"> <button class="btn btn-danger" onclick="javascript:return false;">Geri Dön</button></td>
                                        		</form>
                                        	</tr>
                                        	<?php
                                            $limit = ($sayfa - 1) * $sayfada;
                                        	$uyegetir = mysqli_query($db,"SELECT * FROM uyeler ORDER BY id DESC LIMIT  ".$limit.", ".$sayfada);
                                        	while($uyesatir = mysqli_fetch_assoc($uyegetir)){
                                        	?>
                                            <tr>
                                                <td class="adsoyad-<?php echo $uyesatir["id"]; ?>" data-text="<?php echo $uyesatir["adsoyad"]; ?>"><?php echo $uyesatir["adsoyad"]; ?></td>
                                                <td class="eposta-<?php echo $uyesatir["id"]; ?>" data-text="<?php echo $uyesatir["eposta"]; ?>"><?php echo $uyesatir["eposta"]; ?></td>
                                                <td class="telefon-<?php echo $uyesatir["id"]; ?>" data-text="<?php echo $uyesatir["telefon"]; ?>"><?php echo $uyesatir["telefon"]; ?></td>
                                                <td class="adres-<?php echo $uyesatir["id"]; ?>" data-text="<?php echo $uyesatir["adres"]; ?>"><?php echo $uyesatir["adres"]." ".$uyesatir["semt"]."/".$uyesatir["sehir"]; ?></td>
                                                <td><?php 
                                                	$ebultengetir = mysqli_query($db,"SELECT * FROM ebulten WHERE eposta = '".$uyesatir["eposta"]."'");
                                                	if(mysqli_num_rows($ebultengetir) > 0){
                                                		echo "✔";
                                                	}
                                                	else {
                                                		echo "✖";
                                                	}
                                                ?></td>
                                                <td><?php
                                                	$siparisgetir = mysqli_query($db,"SELECT * FROM siparis WHERE sahip = ".$uyesatir["id"]);
                                                	echo mysqli_num_rows($siparisgetir);
                                                ?></td>	
                                                <td>
                                                	<div class="row">
                                                        <?php
                                                        $sepet_getir = mysqli_query($db,"SELECT * FROM sepet WHERE sahip =".$uyesatir["id"]);
                                                        if(mysqli_num_rows($sepet_getir) > 0){
                                                        ?>
	                                                	<form method="POST">
	                                                		<input type="hidden" name="sepetsil" value="<?php echo $uyesatir['id']; ?>">
	                                                		<input type="submit" class="btn btn-secondary ml-2" value="Sepeti Sil">
	                                                	</form>
                                                        <?php } ?>
	                                                	<button class="btn btn-warning ml-2" data-id="<?php echo $uyesatir["id"]; ?>">Düzenle</button>
	                                                	<form method="POST">
	                                                		<input type="hidden" name="sil" value="<?php echo $uyesatir['id']; ?>">
	                                                		<input type="submit" class="btn btn-danger ml-2 uyesilbtn" value="Üye Sil">
	                                                	</form>
                                                	</div>
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
                                          echo '<a href="?sayfa=uye-yonetimi&s=' . $s . '">' . $s . '</a> ';
                                       }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>