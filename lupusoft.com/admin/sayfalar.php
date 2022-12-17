                <?php
                function replace_tr($text) {
                   $text = trim($text);
                   $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
                   $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
                   $new_text = str_replace($search,$replace,$text);
                   return $new_text;
                }
                if(isset($_POST["baslik"])){
                    $sozlesme_sql_ek = ", footeracik = 0 ";
                    if(isset($_POST["footeracik"]) and $_POST["footeracik"] == 1){
                        $sozlesme_sql_ek = ", footeracik = 1 ";
                    }
                    mysqli_query($db,"UPDATE sayfalar SET kod='".replace_tr($_POST["baslik"])."', baslik='".strip_tags($_POST["baslik"])."',icerik='".$_POST["icerik"]."'".$sozlesme_sql_ek." WHERE id = ".strip_tags($_GET["sayfa-duzenle"]));
                    echo "<script type='text/javascript'>alert('Sayfa güncellendi.');window.location='index.php?sayfa=harici-sayfalar'</script>";
                }
                if(isset($_POST["sayfaadi"])){
                    mysqli_query($db,"INSERT INTO sayfalar(kod,baslik,icerik,footeracik) VALUES('".replace_tr($_POST["sayfaadi"])."','".strip_tags($_POST["sayfaadi"])."','',0)");
                    echo "<script type='text/javascript'>alert('Sayfa eklendi.');window.location='index.php?sayfa=harici-sayfalar'</script>";
                }
                if(isset($_GET["sayfa-sil"])){
                    mysqli_query($db,"DELETE FROM sayfalar WHERE id = ".strip_tags($_GET["sayfa-sil"]));
                    echo "<script type='text/javascript'>alert('Sayfa silindi.');window.location='index.php?sayfa=harici-sayfalar'</script>";   
                }
                if(isset($_GET["sayfa-duzenle"])){
                    $sayfa_detay_getir = mysqli_query($db,"SELECT * FROM sayfalar WHERE id =".strip_tags($_GET["sayfa-duzenle"]));
                    $sayfa_detay_satir = mysqli_fetch_assoc($sayfa_detay_getir);
                ?>
                <style type="text/css">
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
                </style>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Sayfayı Düzenle</h1>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-file mr-1"></i> Sayfa</div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-lg-8 mt-4">
                                            <input type="text" name="baslik" class="form-control" placeholder="Sayfa adı" value="<?php echo $sayfa_detay_satir['baslik']; ?>">
                                        </div>
                                        <div class="checkbox ml-4 mt-4">
                                        Sözleşmeler arasında yer alsın:
                                            <label>
                                              <input type="checkbox" value="1" name="footeracik" class="switch_1" <?php if($sayfa_detay_satir['footeracik'] == 1){ echo 'checked="checked"';} ?>>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mt-4">
                                            <textarea id="sayfaicerik" name="icerik"><?php echo $sayfa_detay_satir['icerik']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="submit" value="Kaydet" class="btn btn-success ml-4 mt-4"> <a href="index.php?sayfa=harici-sayfalar" class="btn btn-danger ml-4 mt-4">Geri Dön</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php }
                else{
                ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $(".yenisayfa").click(function(){
                            var isim = prompt("Sayfa adını girin","");
                            if(isim == "" || isim == undefined || isim == null){
                                alert("Sayfa adı boş bırakılamaz.");
                            }
                            else {
                                $("input[name=sayfaadi]").val(isim);
                                $(".sayfaform").submit();
                            }
                        });
                    });
                </script>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Sayfa Yönetimi</h1>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-file mr-1"></i> Sayfalar <a style="float:right;" href="javascript:void(0);" class="btn btn-success yenisayfa">Yeni Sayfa Oluştur</a></div>
                            <form method="POST" class="sayfaform" style="display: none;">
                                <input type="text" name="sayfaadi">
                            </form>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sayfa Adı</th>
                                                <th>İçerik <small>(HTML içerebilir)</small></th>
                                                <th>Sözleşme</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sayfa Adı</th>
                                                <th>İçerik <small>(HTML içerebilir)</small></th>
                                                <th>Sözleşme</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $sayfagetir = mysqli_query($db,"SELECT * FROM sayfalar");
                                            while ($sayfasatir = mysqli_fetch_assoc($sayfagetir)) {
                                            ?>
                                            <tr>
                                                <td><a href="../index.php?sayfa=sayfa&icerik=<?php echo $sayfasatir['kod']; ?>" target="_blank"><i class="fas fa fa-eye"></i></a> <?php echo $sayfasatir["baslik"]; ?></td>
                                                <td><?php echo substr(htmlspecialchars($sayfasatir["icerik"]),0,120); ?>...</td>
                                                <td><?php if($sayfasatir["footeracik"] == 1){echo "✔";} else {echo "✖";} ?></td>
                                                <td>
                                                    <a href="index.php?sayfa=harici-sayfalar&sayfa-duzenle=<?php echo $sayfasatir['id']; ?>" class="btn btn-primary" title="Düzenle"><i class="fas fa fa-pen"></i></a>
                                                    <a href="javascript:if(confirm(`Sayfayı silmek istediğinize emin misiniz?`)){window.location='index.php?sayfa=harici-sayfalar&sayfa-sil=<?php echo $sayfasatir['id']; ?>'}" class="btn btn-danger" title="Sil"><i class="fas fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php 
                }
                ?>