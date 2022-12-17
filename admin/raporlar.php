                <?php
                if(isset($_GET["urun"])){
                    if($_GET["urun"] == ""){
                        ?>
                         <main>
                            <div class="container-fluid">
                                <h1 class="mt-4">Hay aksi!</h1>
                                <div class="card mb-4">
                                    <div class="card-body">Bir sorunla karşılaştık. Bir ürün seçimi yapılmamış.</div>
                                </div>
                            </div>
                        </main>
                        <?php
                        die();
                    }
                    $urun_getir = mysqli_query($db, "SELECT * FROM urunler WHERE id =".escape_sql_string($_GET["urun"]));
                    if(mysqli_num_rows($urun_getir) < 1){
                        ?>
                         <main>
                            <div class="container-fluid">
                                <h1 class="mt-4">Hay aksi!</h1>
                                <div class="card mb-4">
                                    <div class="card-body">Bir sorunla karşılaştık. Seçmiş olduğunuz ürünün verilerine ulaşılamıyor.</div>
                                </div>
                            </div>
                        </main>
                        <?php
                        die();
                    }
                    $urun_satir = mysqli_fetch_assoc($urun_getir);
                ?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Raporlar</h1>
                        <div class="card mb-4">
                            <div class="card-body"><?php echo $urun_satir["isim"]; ?> ürününün satış bazlı raporlandırması aşağıda yer almaktadır.<br><small>Tüm raporlar ürünlerin güncel fiyatları baz alınarak hazırlanır. Rapor doğruluğu ürün fiyatları son <?php echo $ayarlarsatir["rapor_gun"]; ?> gün içerisinde değiştirilmediği takdirde geçerlidir.</small></div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Ürün Bazlı İnceleme Raporu</div>
                            <div class="card-body">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>
                                                Satış Adeti
                                            </th>
                                            <th>
                                                Toplam Ciro
                                            </th>
                                            <th>
                                                İade Miktarı
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php
                                                    $satis_sayac = 0;
                                                    $iade_sayac = 0;
                                                    for ($i=$ayarlarsatir["rapor_gun"]; $i >=1 ; $i--) {
                                                            $rapor_tarihi = date("d.m.Y",strtotime("today - ".$i." days"));
                                                            $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '".$rapor_tarihi."%'");
                                                            while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                                                                $sipariste_urun_getir = mysqli_query($db,"SELECT * FROM siparislistesi WHERE urun = ".escape_sql_string($_GET["urun"])." and siparis = ".$siparis_satir["id"]);
                                                                while($sipariste_urun_satir = mysqli_fetch_assoc($sipariste_urun_getir)){
                                                                    $satis_sayac++;
                                                                }
                                                                $iade_getir = mysqli_query($db,"SELECT * FROM iadetalepleri WHERE siparis = ".$siparis_satir["id"]." and urun = ".escape_sql_string($_GET["urun"]));
                                                                while($iade_satir = mysqli_fetch_assoc($iade_getir)){
                                                                    $iade_sayac++;
                                                                }
                                                            }
                                                    }
                                                    echo $satis_sayac;
                                                ?>
                                            </td>
                                            <td>  
                                                <?php echo ($satis_sayac*$urun_satir["fiyat"])." ".$parabirimsatir["birim"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $iade_sayac; ?>   
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>
                                                Yorum Sayısı
                                            </th>
                                            <th>
                                                Favori Sayısı
                                            </th>
                                            <th>
                                                Görüntülenme
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php
                                                    $yorum_sayac = 0;
                                                    $yorum_getir = mysqli_query($db,"SELECT * FROM yorumlar WHERE urun = ".escape_sql_string($_GET["urun"]));
                                                    while($yorum_satir = mysqli_fetch_assoc($yorum_getir)){
                                                        $yorum_sayac++;
                                                    }
                                                    echo $yorum_sayac;
                                                ?>
                                                <small><small>(TÜM ZAMANLAR)</small></small>
                                            </td>
                                            <td>  
                                                <?php
                                                    $favori_sayac = 0;
                                                    $favori_getir = mysqli_query($db,"SELECT * FROM favoriler WHERE urun = ".escape_sql_string($_GET["urun"]));
                                                    while($favori_satir = mysqli_fetch_assoc($favori_getir)){
                                                        $favori_sayac++;
                                                    }
                                                    echo $favori_sayac;
                                                ?>
                                                <small><small>(TÜM ZAMANLAR)</small></small>
                                            </td>
                                            <td>
                                                <?php echo $urun_satir["goruntuleme"] ?>
                                                <small><small>(TÜM ZAMANLAR)</small></small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer small text-muted">Son Güncelleme <script>document.write( new Date().toLocaleString());</script> <small title="Ayarlar sayfasından raporlama gününü değiştirebilirsiniz." style="float:right;">SON <?php echo $ayarlarsatir["rapor_gun"]; ?> GÜN</small></div>
                        </div>
                    </div>
                </main>

                <?php }
                else { ?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Raporlar</h1>
                        <div class="card mb-4">
                            <div class="card-body">Raporlar, bu şablondaki grafikleri oluşturmak için kullanılan ayarlarınıza uyarlı bir yazılımdır. Aşağıdaki grafikler tercihlerinize göre özelleştirilmiştir.<br>Daha fazla özelleştirme seçeneği için lütfen <a href="index.php?sayfa=ayarlar">ayarlar</a> sayfasını ziyaret edin.<br>
                            <small>Tüm raporlar ürünlerin güncel fiyatları baz alınarak hazırlanır. Rapor doğruluğu ürün fiyatları son <?php echo $ayarlarsatir["rapor_gun"]; ?> gün içerisinde değiştirilmediği takdirde geçerlidir.</small>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Sipariş Karşılama Grafiği</div>
                            <div class="card-body"><canvas id="myAreaChartRep" width="100%" height="30"></canvas></div>
                            <div class="card-footer small text-muted">Son Güncelleme <script>document.write( new Date().toLocaleString());</script> <small title="Ayarlar sayfasından raporlama gününü değiştirebilirsiniz." style="float:right;">SON <?php echo $ayarlarsatir["rapor_gun"]; ?> GÜN</small></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Sipariş İstatistikleri</div>
                                    <div class="card-body"><canvas id="myBarChartRep" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted">Son Güncelleme <script>document.write( new Date().toLocaleString());</script> <small style="float:right;">SON 6 AY</small></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-pie mr-1"></i>Ödeme Çeşidine Göre</div>
                                    <div class="card-body"><canvas id="myPieChartRep" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted">Son Güncelleme <script>document.write( new Date().toLocaleString());</script> <small style="float:right;">TÜM ZAMANLAR</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php } ?>