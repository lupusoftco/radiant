                <?php
                function replace_tr($text) {
                   $text = trim($text);
                   $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
                   $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
                   $new_text = str_replace($search,$replace,$text);
                   return $new_text;
                }
                if(isset($_POST["yeniisim"]) and isset($_FILES["yeniresim"]) and isset($_POST["yeniaciklama"])){
                    $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
                    if (!(in_array($_FILES['yeniresim']['type'], $arr_file_types))) {
                        ?><script type='text/javascript'>
                            alert("Desteklenmeyen uzantı.");
                        </script><?php
                        return;
                    }
                    $kategorikodu = replace_tr($_POST["yeniisim"]);
                    $imagefile_name = time() . '_' . $_FILES['yeniresim']['name'];
                    $imagefile_name = replace_tr($imagefile_name);
                    move_uploaded_file($_FILES['yeniresim']['tmp_name'], '../images/' . $imagefile_name);
                    mysqli_query($db,"INSERT INTO kategoriler(isim,kategorikodu,resim,aciklama) VALUES('".strip_tags($_POST["yeniisim"])."','".$kategorikodu."','".$imagefile_name."','".strip_tags($_POST["yeniaciklama"])."')"); 
                    ?><script type='text/javascript'>alert("Kategori başarıyla eklendi.");</script><?php
                }
                else if (isset($_POST["isim"])){
                    if($_FILES['resim']['name']!=""){
                        $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
                        if (!(in_array($_FILES['resim']['type'], $arr_file_types))) {
                            ?><script type='text/javascript'>alert("Desteklenmeyen uzantı.");</script><?php
                            return;
                        }
                        $resimgetir = mysqli_query($db,"SELECT * FROM kategoriler WHERE id = ".strip_tags($_POST["kategorikodu"]));
                        $resimadi = mysqli_fetch_assoc($resimgetir);
                        @move_uploaded_file($_FILES['resim']['tmp_name'], '../images/' . $resimadi["resim"]);
                    }
                    $kategorikod = replace_tr($_POST["isim"]);
                    mysqli_query($db,"UPDATE kategoriler SET isim = '".$_POST["isim"]."', kategorikodu = '".$kategorikod."', aciklama = '".strip_tags($_POST["aciklama"])."' WHERE id = ".strip_tags($_POST["kategorikodu"]));
                    ?><script type='text/javascript'>alert("Kategori başarıyla güncellendi.");</script><?php
                }
                else if (isset($_GET["sil"])){
                    $silgetir = mysqli_query($db,"SELECT * FROM kategoriler WHERE id = ".strip_tags($_GET["sil"]));
                    $silresimadi = mysqli_fetch_assoc($silgetir);
                    unlink("../images/".$silresimadi["resim"]);
                    mysqli_query($db,"DELETE FROM kategoriler WHERE id = ".strip_tags($_GET["sil"]));
                    ?><script type='text/javascript'>window.close();</script><?php
                }
                ?>
                <style type="text/css">
                    .g {display: none;}
                    .card-adder {padding-bottom:15px;overflow: hidden;}
                    .at {margin-top: 25px;}
                    .card-adder > .card-adder-body {display: none;}
                    .menubtn {cursor: pointer;}
                </style>
                <script type="text/javascript">
                    function formgoster(x) {
                        $(".duzenle"+x+"span").toggle();
                        $(".duzenle"+x).toggle();
                    }
                    $(document).ready(function(){
                        var rotate = 0;
                        $(".menubtn").click(function(){
                            rotate += 180;
                            $(".card-adder-body").slideToggle();
                            $(".fa-chevron-down").css("transform","rotate("+rotate+"deg)");
                        });
                    });
                </script>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Kategori Yönetimi</h1>
                        <div class="card mb-4 card-adder">
                                <div class="card-header menubtn"><i class="fas fa-chevron-down mr-1"></i> Yeni Kategori Oluştur</div>
                                <div class="table-responsive card-adder-body">
                                    <table class="table table-bordered at" width="100%" cellspacing="0">
                                        <tbody>
                                            <form method="POST" enctype="multipart/form-data">
                                                <tr>
                                                    <td>
                                                        <input type="text" name="yeniisim" placeholder="Kategori Adı" required="required">
                                                    </td>
                                                    <td>
                                                        <input type="file" name="yeniresim" placeholder="Kategori Resimi" required="required">
                                                    </td>
                                                    <td>
                                                        <textarea name="yeniaciklama" placeholder="Kategori Açıklaması"></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="submit" value="Oluştur" class="btn btn-success">
                                                    </td>
                                                </tr>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-list mr-1"></i> Mevcut Kategoriler</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kategori Adı</th>
                                                <th>Resim</th>
                                                <th>Açıklama <small>(SEO için)</small></th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Kategori Adı</th>
                                                <th>Resim</th>
                                                <th>Açıklama <small>(SEO için)</small></th>
                                                <th>İşlem</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $kategorileri_getir = mysqli_query($db,"SELECT * FROM kategoriler");
                                                while($kategoriler_satir = mysqli_fetch_assoc($kategorileri_getir)){
                                            ?>
                                            <tr>
                                                <form method="POST" enctype="multipart/form-data">
                                                    <td>
                                                        <span class="duzenle<?php echo $kategoriler_satir["id"]; ?>span"><?php echo $kategoriler_satir["isim"]; ?></span>
                                                        <input type="text" class="g duzenle<?php echo $kategoriler_satir["id"]; ?>" name="isim" value="<?php echo $kategoriler_satir["isim"]; ?>">
                                                    </td>
                                                    <td align="center">
                                                        <span class="duzenle<?php echo $kategoriler_satir["id"]; ?>span"><img src='../images/<?php echo $kategoriler_satir["resim"]; ?>' width='200'></span>
                                                        <input type="file" class="g duzenle<?php echo $kategoriler_satir["id"]; ?>" name="resim">
                                                    </td>
                                                    <td>
                                                        <span class="duzenle<?php echo $kategoriler_satir["id"]; ?>span"><?php echo $kategoriler_satir["aciklama"]; ?></span>
                                                        <textarea class="g duzenle<?php echo $kategoriler_satir["id"]; ?>" name="aciklama"><?php echo $kategoriler_satir["aciklama"]; ?></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="kategorikodu" value="<?php echo $kategoriler_satir["id"]; ?>">
                                                        <input type="submit" value="Kaydet" class="btn btn-success g duzenle<?php echo $kategoriler_satir["id"]; ?>">
                                                        <a class="btn btn-warning" href="javascript:formgoster(<?php echo $kategoriler_satir['id']; ?>);">Düzenle</a>
                                                        <a href="javascript:if(confirm(`<?php echo $kategoriler_satir["isim"]; ?> kategorisini silmek istediğinize emin misiniz?`)){window.open(`?sayfa=kategori-yonetimi&sil=<?php echo $kategoriler_satir['id']; ?>`, '_blank');}" class="btn btn-danger">Sil</a>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>