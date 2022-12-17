<main> 
        <script type="text/javascript">
            function setCookie(cname, cvalue, exdays) {
              var d = new Date();
              d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
              var expires = "expires="+d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
              var name = cname + "=";
              var ca = document.cookie.split(';');
              for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                  c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
                }
              }
              return "";
            }
            function deleteCookie(cname) {
                document.cookie = cname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.location.href = "index.php?sayfa=anasayfa";
            }
            function setShortcut(cname,cid) {
              var link = prompt("Kısayol linkini yapıştırın", "http://");
              if (link != null) {
                var shortcutlink = setCookie(""+cname+"",link,9999);
                document.getElementById("sc"+cid).innerHTML =  "<li><b><a href='"+link+"' target='_blank'>"+link+"</a> <small><a href='javascript:deleteCookie(`shortcut"+cid+"`);'>(sil)</a></small></b></li>";
              }
            }
            window.onload = function() {
                for (var i = 1; i <= 6; i++) {
                    var shortcutlink = getCookie("shortcut"+i);
                    if(shortcutlink != ""){
                        if(i == 1){
                            document.getElementById("sc"+i).innerHTML =  "<li><b><a href='"+shortcutlink+"' target='_blank'>"+shortcutlink+"</a> <small><a href='javascript:deleteCookie(`shortcut"+i+"`);'>(sil)</a></small></b></li>";
                        }
                        else {
                            document.getElementById("sc"+i).innerHTML =  "<li><b><a href='"+shortcutlink+"' target='_blank'>"+shortcutlink+"</a> <small><a href='javascript:deleteCookie(`shortcut"+i+"`);'>(sil)</a></small></b></li>";
                        }
                    }
                }
            };        
            </script>
                    <div class="container-fluid">
                        <h1 class="mt-4">Ana Sayfa</h1>
                        <ol class="breadcrumb mb-4" id="kisayollist">
                            <li class="breadcrumb-item active" id="sc1"><b><a href="javascript:setShortcut(`shortcut1`,1);">Kısayol Ekle (+)</a></b></li>
                            <li class="breadcrumb-item active" id="sc2"><b><a href="javascript:setShortcut(`shortcut2`,2);">Kısayol Ekle (+)</a></b></li>
                            <li class="breadcrumb-item active" id="sc3"><b><a href="javascript:setShortcut(`shortcut3`,3);">Kısayol Ekle (+)</a></b></li>
                            <li class="breadcrumb-item active" id="sc4"><b><a href="javascript:setShortcut(`shortcut4`,4);">Kısayol Ekle (+)</a></b></li>
                            <li class="breadcrumb-item active" id="sc5"><b><a href="javascript:setShortcut(`shortcut5`,5);">Kısayol Ekle (+)</a></b></li>
                            <li class="breadcrumb-item active" id="sc6"><b><a href="javascript:setShortcut(`shortcut6`,6);">Kısayol Ekle (+)</a></b></li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Kazanç <small><small>(BUGÜN)</small></small></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    	<?php
                                    		$toplam_ciro=0;
                                    		$toplam_siparis=0;
                                    		$siparis_ortalamasi = 0;
                                        	$rapor_index_tarihi = date("d.m.Y",strtotime("today"));
                                        	$siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '".$rapor_index_tarihi."%'");
                                        	while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                                        		$toplam_siparis++;
                                        		$toplam_ciro = $toplam_ciro + $siparis_satir["tutar"];
                                        	}
                                        	if($toplam_ciro > 0 and $toplam_siparis > 0){
                                    			$siparis_ortalamasi = $toplam_ciro / $toplam_siparis;
                                    		}
                                    	?>
                                        Toplam Ciro: <?php echo $toplam_ciro." ".$parabirimsatir["birim"]; ?><br>
                                        Sepet Ortalaması: <?php echo $siparis_ortalamasi." ".$parabirimsatir["birim"]; ?><br>
                                        Sipariş Adedi: <?php echo $toplam_siparis; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">En Çok Satan Ürünler <small><small>(SON <?php echo $ayarlarsatir["rapor_gun"]; ?> GÜN)</small></small></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    	<?php
                                            $array = array();
                                            for ($i=$ayarlarsatir["rapor_gun"]; $i >=0 ; $i--) {
                                            	$rapor_index_tarihi = date("d.m.Y",strtotime("-".$i." day"));
                                            	$siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '".$rapor_index_tarihi."%'");
                                            	while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                                            		$siparis_liste_getir = mysqli_query($db,"SELECT * FROM siparislistesi WHERE siparis = ".$siparis_satir["id"]);
                                            		while ($siparis_liste_satir = mysqli_fetch_assoc($siparis_liste_getir)) {
                                            			$urun_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$siparis_liste_satir["urun"]);
                                            			$urun_satir = mysqli_fetch_assoc($urun_getir);
                                            			$birim_getir = mysqli_query($db,"SELECT * FROM birimler WHERE id = ".$urun_satir["birim"]);
                                            			$birim_satir = mysqli_fetch_assoc($birim_getir);
                                            			if(array_key_exists($urun_satir["isim"], $array)){
                                            				$array[$urun_satir["isim"]] = $array[$urun_satir["isim"]] + $siparis_liste_satir["miktar"];
                                            			}
                                            			else {
                                            				$array[$urun_satir["isim"]] = $siparis_liste_satir["miktar"];
                                            			}
                                            		}
                                            	}
                                            }
                                            if(mysqli_num_rows($siparis_getir) < 1){
                                                echo "&nbsp;<br>Son ".$ayarlarsatir["rapor_gun"]." günde hiç satış yapılmamış.<br>&nbsp;";
                                            }
                                            else {
    											arsort($array);
    											$satir = 0;
    											foreach ($array as $key => $val) {
    											 echo $key." - ".$val." ".$birim_satir["isim"]."<br>";
    											 $satir++;
    											 if($satir==3){
    											 	break;
    											 }
    											}
                                            }
                                    	?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">En Çok Ciro Yapan Ürünler <small><small>(SON <?php echo $ayarlarsatir["rapor_gun"]; ?> GÜN)</small></small></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    	<?php
                                            $array = array();
                                            for ($i=$ayarlarsatir["rapor_gun"]; $i >=0 ; $i--) {
                                            	$rapor_index_tarihi = date("d.m.Y",strtotime("-".$i." day"));
                                            	$siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '".$rapor_index_tarihi."%'");
                                            	while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                                            		$siparis_liste_getir = mysqli_query($db,"SELECT * FROM siparislistesi WHERE siparis = ".$siparis_satir["id"]);
                                            		while ($siparis_liste_satir = mysqli_fetch_assoc($siparis_liste_getir)) {
                                            			$urun_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$siparis_liste_satir["urun"]);
                                            			$urun_satir = mysqli_fetch_assoc($urun_getir);
                                            			$varyasyon_getir = mysqli_query($db,"SELECT * FROM siplistevaryasyon WHERE sahipsipliste = ".$siparis_liste_satir["id"]);
                                            			while($varyasyon_satir = mysqli_fetch_assoc($varyasyon_getir)){
                                            				$varyasyon_deger_getir = mysqli_query($db,"SELECT * FROM varyasyondeger WHERE id = ".$varyasyon_satir["varyasyondeger"]);
                                            				$varyasyon_deger_satir = mysqli_fetch_assoc($varyasyon_deger_getir);
                                            				$urun_satir["fiyat"] = $urun_satir["fiyat"] + $varyasyon_deger_satir["tutar"];
                                            			}
                                            			if(array_key_exists($urun_satir["isim"], $array)){
                                        					$array[$urun_satir["isim"]] = $array[$urun_satir["isim"]] + ($siparis_liste_satir["miktar"] * $urun_satir["fiyat"]);
                                            			}
                                            			else {
                                            				$array[$urun_satir["isim"]] = ($siparis_liste_satir["miktar"] * $urun_satir["fiyat"]);
                                            			}
                                            		}
                                            	}
                                            }
                                            if(mysqli_num_rows($siparis_getir) < 1){
                                                echo "&nbsp;<br>Son ".$ayarlarsatir["rapor_gun"]." günde hiç satış yapılmamış.<br>&nbsp;";
                                            }
                                            else {
											 arsort($array);
											 $satir = 0;
											 foreach ($array as $key => $val) {
    											 echo $key." - ".$val." ".$parabirimsatir["birim"]."<br>";
    											 $satir++;
    											 if($satir==3){
    											 	break;
    											 }
    											}
                                            }
                                    	?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">İade Talepleri</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between"><br><br><br>
                                        <a class="small text-white stretched-link" href="javascript:void(0);" onclick="window.open(`iade.php`, `newwindow`, `width=800,height=600`); return false;" title="İadeleri Görüntüle">Detaylı Görüntüle</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Sipariş Karşılama Grafiği</div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Sipariş İstatistikleri</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-envelope-open-text mr-1"></i>Cevap Bekleyen Mesajlar</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Sohbet Tarihi</th>
                                                        <th>İsim Soyisim</th>
                                                        <th>Son Sipariş</th>
                                                        <th>İşlem</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $mesajlar_getir = mysqli_query($db,"SELECT * FROM konusmalar ORDER BY tarih DESC");
                                                    while ($mesaj_satir = mysqli_fetch_assoc($mesajlar_getir)) {
                                                        $uye_getir = mysqli_query($db,"SELECT * FROM uyeler WHERE id = ".$mesaj_satir["sahip"]);
                                                        $uye_satir = mysqli_fetch_assoc($uye_getir);
                                                        $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE sahip = ".$mesaj_satir["sahip"]." ORDER BY id DESC");
                                                        if(mysqli_num_rows($siparis_getir) > 0){
                                                            $siparis_satir = mysqli_fetch_assoc($siparis_getir);
                                                            $siptakipno = $siparis_Satir["siptakipno"];
                                                        }
                                                        else {
                                                            $siptakipno = "Hiç sipariş verilmemiş";
                                                        }
                                                        echo '<tr>
                                                                <td>'.$mesaj_satir["tarih"].'</td>
                                                                <td>'.$uye_satir["adsoyad"].'</td>
                                                                <td>'.$siptakipno.'</td>
                                                                <td>
                                                                   <a href="javascript:void(0);" onclick="window.open(`mesaj.php?detay='.$mesaj_satir["id"].'`, `newwindow`, `width=500,height=600`); return false;" title="Sohbeti Görüntüle"><i class="fas fa-comment-dots"></i></a> &nbsp;&nbsp;&nbsp; <a href="javascript:void(0);" title="Sohbeti Sonlandır"><i class="fas fa-comment-slash"></i></a>
                                                                </td>
                                                            </tr>';   
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-fire mr-1"></i>En Popüler Ürünler</div>
                                    <div class="card-body" style="overflow-y:auto;height:270px;">
                                        <?php
                                            $urun_getir = mysqli_query($db,"SELECT * FROM urunler ORDER BY goruntuleme DESC LIMIT 3");
                                            while ($urun_satir = mysqli_fetch_assoc($urun_getir)){
                                                $resim_getir = mysqli_query($db,"SELECT * FROM resimler WHERE sahip = ".$urun_satir["id"]." ORDER BY id ASC LIMIT 1");
                                                if(mysqli_num_rows($resim_getir) >0 ){
                                                    $resim_satir = mysqli_fetch_assoc($resim_getir);
                                                }
                                                else {
                                                    $resim_satir = array('isim' => "hazirlaniyor.png");
                                                }
                                                echo '<a href="../?sayfa=detay&u='.base64_encode($urun_satir["id"]).'" target="_blank"><img src="../images/'.$resim_satir['isim'].'" style="width:100px;margin-right: 20px;"></a> '.$urun_satir['isim'].' | '.$urun_satir['goruntuleme'].' Görüntülenme<hr>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-exclamation-triangle mr-1"></i>Lisans Bilgileri</div>
                                    <div class="card-body">
                                        <b>Paket Adı:</b> <img src="img/radiant.png" width="22" style="vertical-align: top;">  <?php echo $ayarlarsatir["paket"]; ?><br>
                                        <b>Yazılım Versiyonu:</b> v 1411.21a<br>
                                        <b>Lisans Numarası:</b>    <?php
                                        $lisans = str_split(md5($ayarlarsatir["uniq_customer_no"]), 4);
                                        echo $lisans[0];
                                        for ($i=1; $i < count($lisans); $i++) { 
                                            echo "-".$lisans[$i];
                                        }
                                        ?><br>
                                        <b>Paket Başlangıç Tarihi:</b> <?php echo date('d.m.Y', strtotime($ayarlarsatir["start_date"])); ?><br>
                                        <b>Paket Bitiş Tarihi:</b>    <?php echo date('d.m.Y', strtotime($ayarlarsatir["start_date"].' +'.$ayarlarsatir["license_life"].' year')); ?><br>
                                        <b>Trafik Bilgisi:</b> <a href="index.php?sayfa=trafik">Detay</a><br>
                                        &nbsp;
                                        <?php
                                            $tarih1 = strtotime($ayarlarsatir["start_date"]);
                                            $tarih2 = strtotime($ayarlarsatir["start_date"].' +'.$ayarlarsatir["license_life"].' year');
                                            $tarih3 = strtotime("now");
                                            $fark = $tarih2 - $tarih1;
                                            $now_value = $tarih3 - $tarih1;
                                        ?>
                                        <progress value="<?php echo floor($now_value / (60 * 60 * 24)); ?>" max="<?php echo floor($fark / (60 * 60 * 24)); ?>" class="col-xl-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>