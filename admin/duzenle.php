<?php
if(isset($_GET["urun"])){
    $urun_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".strip_tags($_GET["urun"]));
    if($_GET["urun"] == "" || mysqli_num_rows($urun_getir) < 1){
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
    $urun_satir = mysqli_fetch_array($urun_getir);
    if(isset($_POST["productname"])){
        $urun_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id =".strip_tags($_GET["urun"]));
        if(mysqli_num_rows($urun_getir) > 0){
            if($_POST["star"] != 1){
                $_POST["star"] = 0;
                $_POST["productdesc"] = mysqli_real_escape_string($db, $_POST["productdesc"]);
                if($_POST["mark"] == "" or $_POST["mark"] == null or !isset($_POST["mark"])){
                    $_POST["mark"] = 0;
                }
                if($_POST["category"] == "" or $_POST["category"] == null or !isset($_POST["category"])){
                    $_POST["category"] = 0;
                }
            mysqli_query($db,"UPDATE urunler SET barkod='".strip_tags($_POST["productgtin"])."', isim='".strip_tags($_POST["productname"])."', aciklama='".$_POST["productdesc"]."', fiyat=".escape_sql_string($_POST["price"]).", kategori=".strip_tags($_POST["category"]).", vitrin=".strip_tags($_POST["star"]).", stok=".strip_tags($_POST["stock"]).", etiketler='".strip_tags($_POST["tags"])."', minimumalis=".strip_tags($_POST["minbuy"]).", maksimumalis=".strip_tags($_POST["maxbuy"]).", birim=".strip_tags($_POST["type"]).", marka=".strip_tags($_POST["mark"])." WHERE id=".strip_tags($_GET["urun"]));
                echo "<script type='text/javascript'>alert('Ürün güncellendi.');window.close();</script>";
            }
            else if ($_POST["star"] == 1){
              $resim_sor = mysqli_query($db,"SELECT * FROM resimler WHERE sahip = ".strip_tags($_GET["urun"]));
              if(mysqli_num_rows($resim_sor) > 2){
                $_POST["productdesc"] = mysqli_real_escape_string($db, $_POST["productdesc"]);
                if($_POST["mark"] == "" or $_POST["mark"] == null or !isset($_POST["mark"])){
                    $_POST["mark"] = 0;
                }
                if($_POST["category"] == "" or $_POST["category"] == null or !isset($_POST["category"])){
                    $_POST["category"] = 0;
                }
            mysqli_query($db,"UPDATE urunler SET barkod='".strip_tags($_POST["productgtin"])."', isim='".strip_tags($_POST["productname"])."', aciklama='".$_POST["productdesc"]."', fiyat=".escape_sql_string($_POST["price"]).", kategori=".strip_tags($_POST["category"]).", vitrin=".strip_tags($_POST["star"]).", stok=".strip_tags($_POST["stock"]).", etiketler='".strip_tags($_POST["tags"])."', minimumalis=".strip_tags($_POST["minbuy"]).", maksimumalis=".strip_tags($_POST["maxbuy"]).", birim=".strip_tags($_POST["type"]).", marka=".strip_tags($_POST["mark"])." WHERE id=".strip_tags($_GET["urun"]));
                echo "<script type='text/javascript'>alert('Ürün güncellendi.');window.close();</script>";
              }
              else {
                echo "<script type='text/javascript'>alert('Ürüne ait en az 3 görsel olmalıdır.');</script>";
              }
            }
            
        }
        else {
            echo "Silinen ürün güncellenemez.";
            die();
        }
    }
if(isset($_GET["var-deger-sil"])){
	mysqli_query($db,"DELETE FROM varyasyondeger WHERE id =".strip_tags($_GET["var-deger-sil"]));
    echo "<script type='text/javascript'>alert('Değer Silindi');window.close();</script>";
}
else if(isset($_POST["anavaryasyonsil"])){
  mysqli_query($db,"DELETE FROM varyasyondeger WHERE sahip = ".strip_tags($_POST["anavaryasyonsil"]));
  mysqli_query($db,"DELETE FROM varyasyon WHERE id = ".strip_tags($_POST["anavaryasyonsil"]));
}
else if (isset($_POST["anavaryasyonid"])){
  $anavardurum = 0;
  if(isset($_POST["anavaraktif"]) and $_POST["anavaraktif"] == 1){
    $anavardurum = 1;
  }
  mysqli_query($db,"UPDATE varyasyon SET varyasyonadi='".strip_tags($_POST["anavaryasyonadi"])."', durum=".$anavardurum." WHERE id = ".strip_tags($_POST["anavaryasyonid"]));
}
else if (isset($_POST["yenianavaryasyonadi"])){
  mysqli_query($db,"INSERT INTO varyasyon(varyasyonadi,urunid,durum) VALUES('".strip_tags($_POST["yenianavaryasyonadi"])."',".strip_tags($_GET["urun"]).",1)");
}
else if (isset($_POST["resimsil"])){
  $silinecekresim = mysqli_query($db,"SELECT * FROM resimler WHERE id = ".strip_tags($_POST["resimsil"]));
  @$resimadi = mysqli_fetch_assoc($silinecekresim);
  @unlink('../images/'.$resimadi["isim"]);
  mysqli_query($db,"DELETE FROM resimler WHERE id = ".strip_tags($_POST["resimsil"]));
}
else if (isset($_POST["yorumusil"])){
  mysqli_query($db,"DELETE FROM yorumlar WHERE id = ".strip_tags($_POST["yorumusil"]));
}
?>
<style>
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none !important;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}
.tablink:hover {
  background-color: #777;
}
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
}
#urundetay {background-color: #4E81F5;}
#varyasyonlar {background-color: #35A67B;}
#gorseller {background-color: #D18964;}
#yorumlar {background-color: #8839B3;}
input[type="checkbox"].switch_1{
font-size: 30px;
-webkit-appearance: none;
   -moz-appearance: none;
        appearance: none;
width: 2em;
height: 1em;
background: #ddd;
border-radius: 3em;
position: relative;
cursor: pointer;
outline: none;
-webkit-transition: all .2s ease-in-out;
transition: all .2s ease-in-out;
}

input[type="checkbox"].switch_1:checked{
background: #0ebeff;
}

input[type="checkbox"].switch_1:after{
position: absolute;
content: "";
width: 1em;
height: 1em;
border-radius: 50%;
background: #fff;
-webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
        box-shadow: 0 0 .25em rgba(0,0,0,.3);
-webkit-transform: scale(.7);
        transform: scale(.7);
left: 0;
-webkit-transition: all .2s ease-in-out;
transition: all .2s ease-in-out;
}

input[type="checkbox"].switch_1:checked:after{
left: calc(100% - 1em);
}
.accordiontb {
  background-color: #00cc99;
  color: #fff;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none !important;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordiontb:hover {
  background-color: #00cc66; 
}

.panel {
  padding: 18px;
  display: none;
  background-color: #339966;
  overflow: hidden;
}
.varyasyon-uyari {width:90%;margin:20px auto;background: #00cc11;padding:15px;border-radius: 2px; border:1px dashed green;font-weight: bold;}
#drop_file_zone {
    background-color: #E8A06F;
    border-radius: 5px;
    border:2px dashed #A67250;
    width: 100%;
    padding: 50px;
    font-size: 18px;
}
#drag_upload_file {
  width:50%;
  margin:0 auto;
}
#drag_upload_file p {
  text-align: center;
}
#drag_upload_file #selectfile {
  display: none;
}
</style>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Gelişmiş Düzenleyici</h1>
        <div class="card mb-4">
            <div class="card-body"><a href="../index.php?sayfa=detay&u=<?php echo base64_encode($urun_satir['id']); ?>" target="_blank"><?php echo $urun_satir["isim"]; ?></a> ürününü düzenliyorsunuz.</small>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-pen"></i> Ürünü Düzenle</div>
            <div class="card-body">
                <button class="tablink" onclick="openPage('urundetay', this, '#4E81F5')" id="urundetayAc">Ürün Bilgileri</button>
                <button class="tablink" onclick="openPage('varyasyonlar', this, '#35A67B')" id="varyasyonlarAc">Varyasyonlar</button>
                <button class="tablink" onclick="openPage('gorseller', this, '#D18964')" id="gorsellerAc">Görseller</button>
                <button class="tablink" onclick="openPage('yorumlar', this, '#8839B3')" id="yorumlarAc">Yorumlar</button>

                <div id="urundetay" class="tabcontent">
                  <h3>Ürün Bilgileri</h3>
                  <form method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="productname">Ürün Adı*</label>
                          <input type="text" name="productname" class="form-control" placeholder="Ürün Adını Girin" value="<?php echo $urun_satir['isim']; ?>" id="productname" required="required">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="productgtin">Ürün Barkodu</label>
                          <input type="text" name="productgtin" class="form-control" placeholder="Ürün Barkodunu Girin" value="<?php echo $urun_satir['barkod']; ?>" id="productgtin">
                        </div>
                      </div>
                      <!--  col-md-6   -->

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="aciklama">Ürün Açıklaması*</label>
                          <textarea class="form-control" rows="10" cols="80" placeholder="Ürün Açıklaması Girin" id="productdesc" name="productdesc" required="required"><?php echo $urun_satir['aciklama']; ?></textarea>
                        </div>
                      </div>
                      <!--  col-md-6   -->
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="price">Fiyat ( <?php echo $parabirimsatir["birim"]; ?> )*</label>
                          <input type="number" name="price" class="form-control" placeholder="Ürün Fiyatı Girin" value="<?php echo $urun_satir['fiyat']; ?>" id="price" required="required">
                        </div>


                      </div>
                      <!--  col-md-6   -->

                      <div class="col-md-6">

                        <div class="form-group">
                          <label for="stock">Stok Sayısı*</label>
                          <input type="number" name="stock" class="form-control" id="stock" placeholder="Stok Sayısı Girin" value="<?php echo $urun_satir['stok']; ?>" required="required">
                        </div>
                      </div>
                      <!--  col-md-6   -->
                    </div>
                    <!--  row   -->


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tags">Ürün Etiketleri</label>
                          <input type="text" name="tags" class="form-control" id="tags" placeholder="Ürün Etiketi Girin" value="<?php echo $urun_satir['etiketler']; ?>">
                          <small>Virgül ( , ) kullanarak ayırınız.</small>
                        </div>
                      </div>
                      <!--  col-md-6   -->

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="minbuy">En Az Alım Miktarı</label>
                          <input type="number" name="minbuy" class="form-control" id="minbuy" value="<?php echo $urun_satir['minimumalis']; ?>" placeholder="1">
                        </div>

                      </div>
                      <!--  col-md-3   -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="maxbuy">En Fazla Alım Miktarı</label>
                          <input type="number" name="maxbuy" class="form-control" id="maxbuy" value="<?php echo $urun_satir['maksimumalis']; ?>" placeholder="999">
                        </div>

                      </div>
                      <!--  col-md-3   -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mark">Ürün Markası</label>
                            <?php
                                $marka_getir = mysqli_query($db,"SELECT * FROM markalar WHERE id = ".$urun_satir['marka']);
                                $marka_satir = mysqli_fetch_assoc($marka_getir);
                            ?>
                            <select name="mark" id="mark" class="form-control">
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
                        </div>

                      </div>
                      <!--  col-md-6   -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="category">Ürün Kategorisi</label>
                            <?php
                                    $kategori_getir = mysqli_query($db,"SELECT * FROM kategoriler WHERE id = ".$urun_satir['kategori']);
                                    $kategori_satir = mysqli_fetch_assoc($kategori_getir);
                                ?>
                            <select class="form-control" id="category" name="category">
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
                        </div>

                      </div>
                      <!--  col-md-6  -->
                    </div>
                    <!--  row   -->


                    <div class="row">
                        <div class="col-md-6">
                            <label for="type">Ürün Birimi</label>
                            <?php
                                    $birim_getir = mysqli_query($db,"SELECT * FROM birimler WHERE id = ".$urun_satir['birim']);
                                    $birim_satir = mysqli_fetch_assoc($birim_getir);
                                ?>
                            <select class="form-control" id="type" name="type">
                                <option value="<?php echo $birim_satir["id"]; ?>">
                                    <?php 
                                        echo $birim_satir["isim"];
                                    ?>
                                </option>
                                <?php
                                    $birimler_getir = mysqli_query($db,"SELECT * FROM birimler");
                                    while($birimler_satir = mysqli_fetch_assoc($birimler_getir)){
                                        echo '<option value="'.$birimler_satir["id"].'">'.$birimler_satir["isim"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                        	<div class="form-group">
	                            <label for="vitrin">Ürün vitrine açılsın mı?</label>
	                            <div class="checkbox">
	                              <label>
	                                <input type="checkbox" value="1" id="vitrin" name="star" class="switch_1" <?php if($urun_satir["vitrin"] == 1){ echo "checked='checked'"; } ?>>
	                              </label>
	                            </div>
	                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <input type="submit" class="btn btn-success" value="Kaydet ve kapat">
                            <a href="javascript:if(confirm(`Yaptığınız değişiklikler kaydedilmeyecektir. Çıkmak istediğinize emin misiniz?`)){window.close();}" class="btn btn-danger">Kaydetmeden çık</a>
                        </div>
                    </div>
                  </form>
                </div>

                <div id="varyasyonlar" class="tabcontent">
                  <h3>Mevcut Varyasyonlar</h3>
                <div class="row">
                 <div class="col-lg-3">&nbsp;
                  <form method="POST" style="display: none;" class="varyasyonform">
                      <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="vardeger">Varyasyon Değeri</label>
                              <input type="text" name="vardeger" class="form-control" id="vardeger" placeholder="Varyasyon Değeri Girin" required="required">
                            </div>
                          </div>
                          <!--  col-md-6   -->

                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="vartutar">Fiyata Ek Tutarı</label>
                              <input type="number" name="vartutar" class="form-control" id="vartutar" placeholder="Varyasyon Tutarını Girin " required="required">
                              <small>(ÜRÜN FİYATINA EKLENİR)</small>
                            </div>

                          </div>
                          <!--  col-md-3   -->
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="varaktif">Varyasyon değeri aktif mi?</label>
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" value="1" id="varaktif" name="varaktif" class="switch_1">
                                    </label>
                                  </div>
                              </div>
                            </div>
                          <!--  col-md-3   -->
                          <input type="hidden" name="varyasyondegerid" id="varyasyondegerid">
                          <input type="hidden" name="varyasyonsahipid" id="varyasyonsahipid">
                          <input type="submit" class="btn btn-primary vargonderbtn" value="Kaydet">
                          &nbsp;&nbsp;<a target="_blank" class="btn btn-danger vardegersilbtn">Değeri Sil</a>
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-9">
                  <?php
                  $varyasyon_getir = mysqli_query($db,"SELECT * FROM varyasyon WHERE urunid=".strip_tags($_GET["urun"]));
                  while($varyasyon_satir = mysqli_fetch_assoc($varyasyon_getir)){
                  ?>
                  <button class="accordiontb"><?php echo $varyasyon_satir["varyasyonadi"] ?> Varyasyonu</button>
                  <div class="panel">Düzenlemek istediğiniz varyasyon değerini seçin:<br>
		              <select class="varyasyonselect" data-id="<?php echo $varyasyon_satir["id"] ?>" size="10" style="width:100%;outline: none !important;">
		              	<?php
		              	$varyasyon_deger_getir = mysqli_query($db,"SELECT * FROM varyasyondeger WHERE sahip = ".$varyasyon_satir["id"]." ORDER BY id ASC");
		              	while ($varyasyon_deger_satir = mysqli_fetch_assoc($varyasyon_deger_getir)) {
		              	?>
		                <option value="<?php echo $varyasyon_deger_satir['id']; ?>" data-id="<?php echo $varyasyon_satir["id"]; ?>" data-text="<?php echo $varyasyon_deger_satir['tutar']; ?>" data-att="<?php echo $varyasyon_deger_satir['durum']; ?>"><?php echo $varyasyon_deger_satir['deger']; ?></option>
		            	<?php } ?>
		                <option value="yenideger" data-id="<?php echo $varyasyon_satir["id"] ?>">Yeni Varyasyon Değeri Ekle</option>
		              </select>
                  <form method="POST">
                    <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="anavaryasyonadi">Varyasyon Adı</label>
                              <input type="text" name="anavaryasyonadi" class="form-control" id="anavaryasyonadi" value="<?php echo $varyasyon_satir["varyasyonadi"] ?>" placeholder="Varyasyon Adını Girin" required="required">
                            </div>
                          </div>
                          <!--  col-md-6   -->
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="anavaraktif">Varyasyon aktif mi?</label>
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" value="1" id="anavaraktif" name="anavaraktif" class="switch_1" <?php if($varyasyon_satir["durum"] == 1){echo "checked='checked'";} ?>>
                                    </label>
                                  </div>
                              </div>
                            </div>
                          <!--  col-md-3   -->
                          <input type="hidden" name="anavaryasyonid" value="<?php echo $varyasyon_satir["id"]; ?>">
                          <input type="submit" class="btn btn-primary" value="Güncelle">
                      </div>
                  </form>
                  <form method="POST">
                          <input type="hidden" name="anavaryasyonsil" value="<?php echo $varyasyon_satir["id"]; ?>">
                          <input style="float:right;margin-top:-38px;" type="submit" class="btn btn-danger" value="Varyasyonu Sil">
                  </form>
                  </div>  
              	<?php }
              	if(isset($_POST["varyasyondegerid"])){
              		$vardegerdurum = 0;
              		if(isset($_POST["varaktif"]) && $_POST["varaktif"] == 1){
              			$vardegerdurum = 1;
              		}
              		if($_POST["varyasyondegerid"] == "yenideger"){
              			mysqli_query($db,"INSERT INTO varyasyondeger(deger,tutar,sahip,durum) VALUES('".strip_tags($_POST["vardeger"])."',".strip_tags($_POST["vartutar"]).",".strip_tags($_POST["varyasyonsahipid"]).",".$vardegerdurum.");");
              			$son_eklenen_id = mysqli_insert_id($db);
              			echo '<div class="varyasyon-uyari">Ekleme tamamlandı</div><script type="text/javascript">$("select[data-id='.$_POST["varyasyonsahipid"].']").append("<option value=\"'.$son_eklenen_id.'\" data-text=\"'.$_POST["vartutar"].'\" data-att=\"'.$vardegerdurum.'\">'.$_POST["vardeger"].'</option>");</script>';
              		}

              		else {
              			mysqli_query($db,"UPDATE varyasyondeger SET deger='".strip_tags($_POST["vardeger"])."', tutar=".strip_tags($_POST["vartutar"]).", durum=".$vardegerdurum." WHERE id=".strip_tags($_POST["varyasyondegerid"]));
              			echo '<div class="varyasyon-uyari">Güncelleme tamamlandı</div><script type="text/javascript">$("option[value='.$_POST["varyasyondegerid"].']").attr({ "data-text": "'.$_POST["vartutar"].'", "data-att": "'.$vardegerdurum.'" });$("option[value='.$_POST["varyasyondegerid"].']").html("'.$_POST["vardeger"].'");</script>';
              		}
              	}
              	?> </div>
                  </div>
                  <hr>
                  <h3>Yeni Varyasyon Ekle</h3>
                  <form method="POST">
                      <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="yenianavaryasyonadi">Varyasyon Adı</label>
                              <input type="text" name="yenianavaryasyonadi" class="form-control" id="yenianavaryasyonadi" value="<?php echo $varyasyon_satir["varyasyonadi"] ?>" placeholder="Varyasyon Adını Girin" required="required">
                            </div>
                          </div>
                      </div>
                          <input type="submit" class="btn btn-primary" value="Ekle">
                  </form>
                </div>
                <div id="gorseller" class="tabcontent">
                  <h3>Ürün Görselleri</h3>
                  <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                      <div id="drag_upload_file">
                          <p>Fotoğrafı sürükleyin</p>
                          <p>ya da</p>
                          <p><input type="button" class="btn btn-success" value="Dosya Seçin" onclick="file_explorer();"></p>
                          <p><small>Önerilen boyutlar 1:1 ve 9:16</small></p>
                          <input type="file" id="selectfile">
                      </div>
                  </div>
                  <div class="col-lg-12 mt-4 row mevcutresimler">
                    <?php
                    $resimleri_getir = mysqli_query($db,"SELECT * FROM resimler WHERE sahip =".$_GET["urun"]);
                    if(mysqli_num_rows($resimleri_getir) > 0){
                      echo "<h3 class='col-lg-12'>Mevcut Resimler</h3>";
                      while ($resimler_satir = mysqli_fetch_assoc($resimleri_getir)) {
                        ?>
                        <div class="col-lg-2">
                          <img src="../images/<?php echo $resimler_satir['isim']; ?>" class="col-lg-12">
                          <form method="POST">
                            <input type="hidden" name="resimsil" value="<?php echo $resimler_satir['id']; ?>">
                            <input type="submit" class="btn btn-danger col-lg-11" style="display:block;margin:10px auto;" value="Görseli Sil">
                          </form>
                        </div>  
                        <?php
                      }
                    }
                    ?>
                  </div>
                </div>

                <div id="yorumlar" class="tabcontent">
                  <h3>Yorumlar</h3>
                  <?php
                  $yorum_getir = mysqli_query($db,"SELECT * FROM yorumlar WHERE urun = ".$_GET["urun"]);
                  if(mysqli_num_rows($yorum_getir) > 0){
                    while($yorum_satir = mysqli_fetch_assoc($yorum_getir)){
                      $uye_adi = "Silinmiş Üyelik";
                      $uyegetir = mysqli_query($db,"SELECT * FROM uyeler WHERE id = ".$yorum_satir["uye"]);
                      if(mysqli_num_rows($uyegetir) == 1){
                        $uyesatir = mysqli_fetch_assoc($uyegetir);
                        $uye_adi = $uyesatir["adsoyad"];
                      }
                      ?>
                      <hr>
                      <p>
                        <?php echo $uye_adi; ?>
                        <form method="POST">
                        <i><?php echo $yorum_satir["yorum"]; ?></i>
                          <input type="hidden" name="yorumusil" value="<?php echo $yorum_satir['id']; ?>">
                          <input type="submit" class="btn btn-danger" style="float:right;" value="x">
                        </form>
                      </p>
                      <?php
                    }
                  }
                  else {
                    echo "Henüz yorum yapılmamış.";
                  }
                  ?>
                </div>
            </div>
            <div class="card-footer small text-muted">Gelişmiş Düzenleyici <small title="Ayarlar sayfasından raporlama gününü değiştirebilirsiniz." style="float:right;">v. 0.1b</small></div>
        </div>
    </div>
</main>
<script type="text/javascript">
	$(document).ready(function(){
		document.onkeydown = function (e) {  
            return (e.which || e.keyCode) != 116;  
        };  
		var silinen = "x";
		$(".varyasyonselect option").click(function(){
			if($(this).val() != "yenideger"){
				var isim = $(this).html();
				var tutar = $(this).attr("data-text");
				var aktif = $(this).attr("data-att");
				var vardegerid = $(this).val();
        var varyasyonsahipid = $(this).attr("data-id");
        $("#varyasyonsahipid").val(Number(varyasyonsahipid));
				$("#vardeger").val(isim);
				$("#vartutar").val(Number(tutar));
				$("#varaktif").val(Number(1));
				$(".vardegersilbtn").attr("href","?sayfa=gelismis-duzenleyici&urun=<?php echo $_GET["urun"]; ?>&var-deger-sil="+vardegerid+"#varyasyonlarAc");
				silinen = vardegerid;
				if(aktif == 1){
					$("#varaktif").attr("checked","checked");
				}
				else if (aktif == 0){
					$("#varaktif").removeAttr('checked');
				}
				$("#varyasyondegerid").val(vardegerid);
				$(".vargonderbtn").val("Güncelle");
				$(".vardegersilbtn").css("display","block");
			}
			else {
        var varyasyonsahipid = $(this).attr("data-id");
        $("#varyasyonsahipid").val(Number(varyasyonsahipid));
				$("#vardeger").val("");
				$("#vartutar").val(Number(0));
				$("#varaktif").val(Number(1));
				$("#varyasyondegerid").val("yenideger");
				$(".vargonderbtn").val("Değer Ekle");
				$("#varaktif").val(Number(1));
				$(".vardegersilbtn").css("display","none");
			}
			$(".varyasyonform").fadeIn();
		});
		$(".vardegersilbtn").click(function(){
			$(".varyasyonselect option[value="+silinen+"]").css("display","none");
		});
	});
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}
var hash = window.location.hash.substring(1);
if (hash == null || hash == undefined || hash == ""){
    hash = "urundetayAc";
}
document.getElementById(hash).click();

var acc = document.getElementsByClassName("accordiontb");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
      $(".varyasyon-uyari").fadeOut();
	$(".varyasyonform").css("display","none");
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
var fileobj;
function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}
 
function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        fileobj = document.getElementById('selectfile').files[0];
        ajax_file_upload(fileobj);
    };
}
 
function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
        var form_data = new FormData();             
        form_data.append('file', file_obj);
        $.ajax({
            type: 'POST',
            url: 'ajax.php?u=<?php echo $_GET["urun"]; ?>',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                alert("Ürün fotoğrafı başarıyla yüklendi.")
                $('#selectfile').val('');
                $(".mevcutresimler").append("<h3 class='col-lg-12'>Mevcut Resimler</h3><div class='col-lg-2'><img src='../images/"+response+"' class='col-lg-12'><form method='POST'><input type='hidden' name='resimsil' value=''><input type='submit' class='resimsilclick btn btn-danger col-lg-11' style='display:block;margin:10px auto;' value='Görseli Sil'></form></div>");
                $(".resimsilclick").click();
            }
        });
    }
}
</script>
<?php
}
else {
    echo "<script type='text/javascript'>window.location.href='index.php'</script>";
    header('Location: index.php');
}
?>