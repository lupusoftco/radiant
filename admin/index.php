<?php
session_start();
if($_SESSION["yonetici"] == "1"){
include("../db.php");
$yonetici_getir = mysqli_query($db,"SELECT * FROM yoneticiler WHERE id = ".$_SESSION["yonetici_id"]);
$yonetici_bilgiler = mysqli_fetch_assoc($yonetici_getir);
if(isset($_POST["urunid"])){
    $urunu_getir = mysqli_query($db,"SELECT * FROM urunler WHERE id =".strip_tags($_POST["urunid"]));
    if(mysqli_num_rows($urunu_getir) > 0){
        $_POST["aciklama"] = mysqli_real_escape_string($db, $_POST["aciklama"]);
        if($_POST["marka"] == "" or $_POST["marka"] == null or !isset($_POST["marka"])){
            $_POST["marka"] = 0;
        }
        if($_POST["kategori"] == "" or $_POST["kategori"] == null or !isset($_POST["kategori"])){
            $_POST["kategori"] = 0;
        }
        mysqli_query($db,"UPDATE urunler SET barkod='".strip_tags($_POST["barkod"])."', isim='".strip_tags($_POST["urunadi"])."', aciklama='".$_POST["aciklama"]."', fiyat=".escape_sql_string($_POST["tutar"]).", kategori=".strip_tags($_POST["kategori"]).", marka=".strip_tags($_POST["marka"])." WHERE id=".strip_tags($_POST["urunid"]));
            echo $_POST["urunadi"]." ürünü güncellendi.";
    }
    else {
        echo "Silinen ürün güncellenemez.";
    }
    die();
}
else if (isset($_POST["urunvitrinid"])){
    $urunvitrin_sor = mysqli_query($db,"SELECT vitrin FROM urunler WHERE id=".escape_sql_string($_POST["urunvitrinid"]));
    if(mysqli_num_rows($urunvitrin_sor) > 0){
        $urunvitrin_satir = mysqli_fetch_assoc($urunvitrin_sor);
        $urunresim_sor = mysqli_query($db,"SELECT * FROM resimler WHERE sahip = ".escape_sql_string($_POST["urunvitrinid"]));
        if(mysqli_num_rows($urunresim_sor) > 2){
            if($urunvitrin_satir["vitrin"] == 1){
                mysqli_query($db,"UPDATE urunler SET vitrin = 0 WHERE id=".escape_sql_string($_POST["urunvitrinid"]));
                echo "Ürün vitrinden kaldırıldı.";
            }
            else {
                mysqli_query($db,"UPDATE urunler SET vitrin = 1 WHERE id=".escape_sql_string($_POST["urunvitrinid"]));
                echo "Ürün vitrine açıldı.";
            }
        }
        else {
            echo "Ürüne ait en az 3 görsel bulunmalıdır.";
        }
    }
    else {
        echo "Silinen ürünün vitrin durumu değiştirilemez.";
    }
    die();
}
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lupusoft E-Ticaret Kontrol Paneli</title>
        <link href="css/styles.css?v=<?php echo rand(1,999); ?>" rel="stylesheet" />
        <link rel="shortcut icon" href="adminlogo.png" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php"><img src="img/logo-panel.png" style="width:20%;"> LUPUSOFT</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Arama..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?sayfa=kullanici">Kullanıcı Ayarları</a>
                        <a class="dropdown-item" href="index.php?sayfa=ayarlar">Site Ayarları</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.php">Güvenli Çıkış</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Kontrol Merkezi</div>
                                <a class="nav-link" href="index.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Ana Sayfa
                                </a>
                                <a class="nav-link" href="index.php?sayfa=urun-yonetimi">
                                    <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>Ürün Yönetimi
                                </a>
                                <a class="nav-link" href="index.php?sayfa=kategori-yonetimi">
                                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>Kategori Yönetimi
                                </a>
                                <a class="nav-link" href="index.php?sayfa=siparis-yonetimi">
                                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>Sipariş Yönetimi
                                </a>
                                <a class="nav-link" href="index.php?sayfa=uye-yonetimi">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>Üye Yönetimi
                                </a>
                                <a class="nav-link" href="index.php?sayfa=kampanya-yonetimi">
                                    <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>Kampanya Yönetimi
                                </a>
                            <div class="sb-sidenav-menu-heading">Arayüz</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-desktop"></i></div>
                                Tasarım Ayarları
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php?sayfa=js-css">JS &amp; CSS Erişimi</a>
                                    <a class="nav-link" href="index.php?sayfa=hazir-temalar">Hazır Temalar</a>
                                    <a class="nav-link" href="index.php?sayfa=tasarimi-yonet">Tasarımı Yönet</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="index.php?sayfa=harici-sayfalar"><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Harici Sayfalar
                                <div class="sb-sidenav-collapse-arrow"><!--<i class="fas fa-angle-down"></i>--></div
                            ></a>
                            <!--<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        İçerik Sayfaları
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">İçerikleri Yönet</a>
                                            <a class="nav-link" href="401.html">Yeni İçerik Oluştur</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>-->
                            <div class="sb-sidenav-menu-heading">Eklentiler</div>
                            <a class="nav-link" href="index.php?sayfa=raporlar">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Raporlar</a>
                            <?php if($ayarlarsatir["gelistirici"] == 1){ ?>
                            <a class="nav-link" href="index.php?sayfa=webservis">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Webservis</a>
                            <a class="nav-link" href="index.php?sayfa=konsol">
                                <div class="sb-nav-link-icon"><i class="fas fa-terminal"></i></div>
                            Geliştirici Konsolu</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Şu hesapla giriş yapıldı:</div>
                        <?php
                        echo $yonetici_bilgiler["eposta"];
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <?php
                    if(!isset($_GET['sayfa']) or empty($_GET['sayfa'])) { // eğer boşsa anasayfa varsayalım.
                       $sayfa = 'anasayfa';
                    } 
                    else {
                       $sayfa = $_GET['sayfa'];
                    }
                    switch ($sayfa){
                    case "anasayfa":
                        include("panel.php");
                        break;
                    case "urun-yonetimi":
                        include("urunler.php");
                        break;
                    case "gelismis-duzenleyici":
                        include("duzenle.php");
                        break;
                    case "kategori-yonetimi":
                        include("kategoriler.php");
                        break;
                    case "siparis-yonetimi":
                        include("siparisler.php");
                        break;
                    case "siparis":
                    if(isset($_GET["detay"])){
                        include("siparis.php");
                    }
                    else if(isset($_GET["yazdir"])){
                        include("siparis.php");
                    }
                    else {
                        include("panel.php");
                    }
                        break;
                    case "uye-yonetimi":
                        include("uyeler.php");
                        break;
                    case "kampanya-yonetimi":
                        include("kampanyalar.php");
                        break;
                    case "js-css":
                        include("jscss.php");
                        break;
                    case "hazir-temalar":
                        include("temalar.php");
                        break;
                    case "harici-sayfalar":
                        include("sayfalar.php");
                        break;
                    case "urun-ekle":
                        include("urunekle.php");
                        break;
                    case "konsol":
                    	include("console.php");
                    	break;
                    case "raporlar":
                    	include("raporlar.php");
                    	break;
                    default:
                        include("panel.php");
                        break;
                    }
                ?>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"><a href="http://lupusoft.com" target="_blank">Lupusoft</a>&reg; Yazılım ve Donanım Hizmetleri <script>document.write(new Date().getFullYear());</script></div>
                            <div>
                               <a href="#">S.S.S.</a>
                                &middot;
                                <a href="#">Şartlar &amp; koşullar</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            CKEDITOR.replace('productdesc', { width: "100%" });
            CKEDITOR.replace('textarea', { width: "100%" });
            CKEDITOR.replace('sayfaicerik', { width: "100%" });
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <?php
        	if(@$_GET["sayfa"] == "anasayfa" or !isset($_GET["sayfa"])){
        ?>
        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [<?php
            $ay_yazi[1]="Ocak";

            $ay_yazi[2]="Şubat";

            $ay_yazi[3]="Mart";

            $ay_yazi[4]="Nisan";

            $ay_yazi[5]="Mayıs"; 

            $ay_yazi[6]="Haziran";

            $ay_yazi[7]="Temmuz";

            $ay_yazi[8]="Ağustos";

            $ay_yazi[9]="Eylül";

            $ay_yazi[10]="Ekim";

            $ay_yazi[11]="Kasım";

            $ay_yazi[12]="Aralık";
            for ($i=13; $i >=1 ; $i--) {
                if($i<2){
                    $buay  = date("n", strtotime("now -".$i." day"));
                    $buaytxt  = $ay_yazi[$buay];
                    echo '"'.date('d', strtotime("now -".$i." day")).' '.$buaytxt.'"';
                }
                else {
                    $buay  = date("n", strtotime("now -".$i." day"));
                    $buaytxt  = $ay_yazi[$buay];
                    echo '"'.date('d', strtotime("now -".$i." day")).' '.$buaytxt.'",';
                }
            }
        ?>],
    datasets: [{
      label: "Siparişler",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [<?php
            $maks = 0;
            for ($i=13; $i >=1 ; $i--) {
                if($i<2){
                    $rapor_tarihi = date("d.m.Y",strtotime("today - ".$i." days"));
                    $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '".$rapor_tarihi."%'");
                    if(mysqli_num_rows($siparis_getir)>0){
                        $toplam_siparis = 0;
                        while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                            $toplam_siparis++;
                            if($toplam_siparis > $maks){$maks = $toplam_siparis;}
                        }
                        echo "'".$toplam_siparis."'";
                    }
                    else {
                        echo "'0'";
                    }
                }
                else {
                    $rapor_tarihi = date("d.m.Y",strtotime("today - ".$i." days"));
                    $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '".$rapor_tarihi."%'");
                    if(mysqli_num_rows($siparis_getir)>0){
                        $toplam_siparis = 0;
                        while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                            $toplam_siparis++;
                            if($toplam_siparis > $maks){$maks = $toplam_siparis;}
                        }
                        echo "'".$toplam_siparis."',";
                    }
                    else {
                        echo "'0',";
                    }
                }
            }
        ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?php echo ceil($maks*1.25); ?>,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

        </script>
        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [<?php
        for ($i=6; $i >=1 ; $i--) {
                if($i<2){
                    $buay  = date("n", strtotime("now -".$i." month"));
                    $buaytxt  = $ay_yazi[$buay];
                    echo '"'.$buaytxt.'"';
                }
                else {
                    $buay  = date("n", strtotime("now -".$i." month"));
                    $buaytxt  = $ay_yazi[$buay];
                    echo '"'.$buaytxt.'",';
                }
            }
        ?>],
    datasets: [{
      label: "Ciro (₺)",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [<?php
            $maks = 0;
            for ($i=6; $i >=1 ; $i--) {
                if($i<2){
                    $rapor_tarihi = date("m.Y",strtotime("today - ".$i." month"));
                    $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '%".$rapor_tarihi."%'");
                    if(mysqli_num_rows($siparis_getir)>0){
                        $toplam_siparis = 0;
                        while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                            $toplam_siparis = $toplam_siparis + $siparis_satir["tutar"];
                            if($toplam_siparis > $maks){$maks = $toplam_siparis;}
                        }
                        echo "'".$toplam_siparis."'";
                    }
                    else {
                        echo "'0'";
                    }
                }
                else {
                    $rapor_tarihi = date("m.Y",strtotime("today - ".$i." month"));
                    $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '%".$rapor_tarihi."%'");
                    if(mysqli_num_rows($siparis_getir)>0){
                        $toplam_siparis = 0;
                        while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                            $toplam_siparis = $toplam_siparis + $siparis_satir["tutar"];
                            if($toplam_siparis > $maks){$maks = $toplam_siparis;}
                        }
                        echo "'".$toplam_siparis."',";
                    }
                    else {
                        echo "'0',";
                    }
                }
            }
        ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?php echo ceil($maks*1.25); ?>,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

        </script>
        <?php
        	}
        ?>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <?php
        	if(@$_GET["sayfa"] == "raporlar" && !isset($_GET["urun"])){
        ?>
        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var ctx = document.getElementById("myAreaChartRep");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [<?php
            $ay_yazi[1]="Ocak";

            $ay_yazi[2]="Şubat";

            $ay_yazi[3]="Mart";

            $ay_yazi[4]="Nisan";

            $ay_yazi[5]="Mayıs"; 

            $ay_yazi[6]="Haziran";

            $ay_yazi[7]="Temmuz";

            $ay_yazi[8]="Ağustos";

            $ay_yazi[9]="Eylül";

            $ay_yazi[10]="Ekim";

            $ay_yazi[11]="Kasım";

            $ay_yazi[12]="Aralık";
            for ($i=$ayarlarsatir["rapor_gun"]; $i >=1 ; $i--) {
                if($i<2){
                    $buay  = date("n", strtotime("now -".$i." day"));
                    $buaytxt  = $ay_yazi[$buay];
                    echo '"'.date('d', strtotime("now -".$i." day")).' '.$buaytxt.'"';
                }
                else {
                    $buay  = date("n", strtotime("now -".$i." day"));
                    $buaytxt  = $ay_yazi[$buay];
                    echo '"'.date('d', strtotime("now -".$i." day")).' '.$buaytxt.'",';
                }
            }
        ?>],
    datasets: [{
      label: "Siparişler",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [<?php
            $maks = 0;
            for ($i=$ayarlarsatir["rapor_gun"]; $i >=1 ; $i--) {
                if($i<2){
                    $rapor_tarihi = date("d.m.Y",strtotime("today - ".$i." days"));
                    $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '".$rapor_tarihi."%'");
                    if(mysqli_num_rows($siparis_getir)>0){
                        $toplam_siparis = 0;
                        while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                            $toplam_siparis++;
                            if($toplam_siparis > $maks){$maks = $toplam_siparis;}
                        }
                        echo "'".$toplam_siparis."'";
                    }
                    else {
                        echo "'0'";
                    }
                }
                else {
                    $rapor_tarihi = date("d.m.Y",strtotime("today - ".$i." days"));
                    $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '".$rapor_tarihi."%'");
                    if(mysqli_num_rows($siparis_getir)>0){
                        $toplam_siparis = 0;
                        while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                            $toplam_siparis++;
                            if($toplam_siparis > $maks){$maks = $toplam_siparis;}
                        }
                        echo "'".$toplam_siparis."',";
                    }
                    else {
                        echo "'0',";
                    }
                }
            }
        ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?php echo ceil($maks*1.25); ?>,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

        </script>
        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChartRep");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [<?php
        for ($i=6; $i >=1 ; $i--) {
                if($i<2){
                    $buay  = date("n", strtotime("now -".$i." month"));
                    $buaytxt  = $ay_yazi[$buay];
                    echo '"'.$buaytxt.'"';
                }
                else {
                    $buay  = date("n", strtotime("now -".$i." month"));
                    $buaytxt  = $ay_yazi[$buay];
                    echo '"'.$buaytxt.'",';
                }
            }
        ?>],
    datasets: [{
      label: "Ciro (₺)",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [<?php
            $maks = 0;
            for ($i=6; $i >=1 ; $i--) {
                if($i<2){
                    $rapor_tarihi = date("m.Y",strtotime("today - ".$i." month"));
                    $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '%".$rapor_tarihi."%'");
                    if(mysqli_num_rows($siparis_getir)>0){
                        $toplam_siparis = 0;
                        while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                            $toplam_siparis = $toplam_siparis + $siparis_satir["tutar"];
                            if($toplam_siparis > $maks){$maks = $toplam_siparis;}
                        }
                        echo "'".$toplam_siparis."'";
                    }
                    else {
                        echo "'0'";
                    }
                }
                else {
                    $rapor_tarihi = date("m.Y",strtotime("today - ".$i." month"));
                    $siparis_getir = mysqli_query($db,"SELECT * FROM siparis WHERE ipvetarih LIKE '%".$rapor_tarihi."%'");
                    if(mysqli_num_rows($siparis_getir)>0){
                        $toplam_siparis = 0;
                        while ($siparis_satir = mysqli_fetch_assoc($siparis_getir)) {
                            $toplam_siparis = $toplam_siparis + $siparis_satir["tutar"];
                            if($toplam_siparis > $maks){$maks = $toplam_siparis;}
                        }
                        echo "'".$toplam_siparis."',";
                    }
                    else {
                        echo "'0',";
                    }
                }
            }
        ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?php echo ceil($maks*1.25); ?>,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
        </script>
        <script type="text/javascript">
            <?php
                $yontemleri_getir = mysqli_query($db,"SELECT * FROM odemeyontemleri WHERE durum = 1");
            ?>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Pie Chart Example
            var ctx = document.getElementById("myPieChartRep");
            var myPieChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: [
                <?php
                    while($odeme_yontemleri = mysqli_fetch_assoc($yontemleri_getir)){
                        echo '"'.$odeme_yontemleri["isim"].'",';
                    }
                ?>
                ],
                datasets: [{
                  data: [
                  <?php
                $yontemleri_getir = mysqli_query($db,"SELECT * FROM odemeyontemleri WHERE durum = 1");
                    while($odeme_yontemleri = mysqli_fetch_assoc($yontemleri_getir)){
                        $siparis_daralt = mysqli_query($db,"SELECT COUNT(odemeTipi) FROM siparis WHERE odemeTipi = ".$odeme_yontemleri["id"]);
                        $siparis_daralt_satir = mysqli_fetch_assoc($siparis_daralt);
                        echo $siparis_daralt_satir["COUNT(odemeTipi)"].",";
                    }
                  ?>
                  ],
                  backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                }],
              },
            });

        </script>
    	<?php } ?>
    </body>
</html>
<?php
}
else {
    header('Location: login.php');
}
?>