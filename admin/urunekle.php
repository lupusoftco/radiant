<?php
if(isset($_GET["copy"])){
  $urun_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".strip_tags($_GET["copy"]));
  if(mysqli_num_rows($urun_getir) == 1){
    $urun_satir = mysqli_fetch_assoc($urun_getir);
  }
  else {
    $urun_satir["isim"] = "Ürün bulunamadı.";
    $urun_satir["fiyat"] = "0";
    $urun_satir["stok"] = "0";
    $urun_satir["aciklama"] = "Ürün bulunamadı.";
  }
}
function replace_tr($text) {
   $text = trim($text);
   $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
   $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
   $new_text = str_replace($search,$replace,$text);
   return $new_text;
}
if(isset($_POST["urunadi"])){
    echo "<script type='text/javascript'>alert('sa.'');</script>";
    $_POST["urunadi"] = strip_tags($_POST["urunadi"]);
    $_POST["fiyat"] = strip_tags($_POST["fiyat"]);
    $_POST["stok"] = strip_tags($_POST["stok"]);
    mysqli_query($db,"INSERT INTO urunler(isim,aciklama,fiyat,kategori,vitrin,stok,goruntuleme,minimumalis,maksimumalis,birim,marka) VALUES('".$_POST["urunadi"]."','".$_POST["aciklama"]."',".$_POST["fiyat"].",0,0,".$_POST["stok"].",0,1,999,1,0)");
    if($_FILES['resim']['name']!=""){
        $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
        if (!(in_array($_FILES['resim']['type'], $arr_file_types))) {
            ?><script type='text/javascript'>alert("Desteklenmeyen uzantı.");</script><?php
            return;
        }
        $imagefile_name = time() . '_' . $_FILES['resim']['name'];
        $imagefile_name = replace_tr($imagefile_name);
        @move_uploaded_file($_FILES['resim']['tmp_name'], '../images/' . $imagefile_name);
        $last_id = mysqli_insert_id($db);
        mysqli_query($db,"INSERT INTO resimler(isim,sahip) VALUES('".$imagefile_name."',".$last_id.")");
        ?>
            <script type='text/javascript'>alert("Ürün başarıyla eklendi.");</script>
        <?php
     }
}
?>
<style type="text/css">
.panel {
  padding: 18px;
  display: none;
  background-color: #ccc;
  overflow: hidden;
}
.varyasyon-uyari {width:90%;margin:20px auto;background: #00cc11;padding:15px;border-radius: 2px; border:1px dashed green;font-weight: bold;}
#drop_file_zone {
    background-color: #eee;
    border-radius: 5px;
    border:2px dashed #666;
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
        <h1 class="mt-4">Ürün Ekle</h1>
        <div class="card mb-4">
            <div class="card-body">Ürün ekleme ekranındasınız. Aşağıdaki gerekli alanları doldurarak yeni bir ürün ekleyebilirsiniz.<br>
            <small>Dökümantasyon için <a href="http://docs.lupusoft.com">tıklayın</a>.</small>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-file-import mr-1"></i> Yeni Ürün Ekle</div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <input type="text" name="urunadi" class="form-control col-lg-3 ml-4" placeholder="Ürün adı" required="required" <?php if(isset($_GET["copy"])){ echo 'value="'.$urun_satir["isim"].'"'; } ?>>
                        <input type="number" name="fiyat" class="form-control col-lg-4 ml-4" placeholder="Fiyat" required="required" <?php if(isset($_GET["copy"])){ echo 'value="'.$urun_satir["fiyat"].'"'; } ?>>
                        <input type="number" name="stok" class="form-control col-lg-4 ml-4" placeholder="Stok sayısı" required="required" <?php if(isset($_GET["copy"])){ echo 'value="'.$urun_satir["stok"].'"'; } ?>>
                    </div>
                    <div class="row mt-4">
                      <div id="drop_file_zone">
                          <div id="drag_upload_file">
                              <p><input type="file" class="btn btn-success" name="resim" value="Dosya Seçin"></p>
                              <p><small>Önerilen boyutlar 1:1 ve 9:16</small></p>
                          </div>
                      </div>
                    </div>
                    <div class="row mt-4">
                        <textarea name="aciklama" placeholder="Ürün açıklaması" required="required" id="textarea"><?php if(isset($_GET["copy"])){ echo $urun_satir["aciklama"]; } else { ?>Ürün açıklaması<?php } ?></textarea>
                    </div>
                    <input type="submit" class="btn btn-success mt-3" value="Ürün Ekle">
                </form>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>
    </div>
</main>