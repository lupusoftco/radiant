<?php
session_start();
include("../db.php");
$_SESSION["yonetici"] = "0";
if(isset($_POST["eposta"]) and isset($_POST["sifre"])){
    $sorgu = mysqli_query($db,"SELECT * FROM yoneticiler WHERE eposta = '".$_POST["eposta"]."' and sifre = '".md5($_POST["sifre"])."'");
    if(mysqli_num_rows($sorgu) == 1){
        $satir = mysqli_fetch_assoc($sorgu);
        $_SESSION["yonetici"] = "1";
        $_SESSION["yonetici_id"] = $satir["id"];
        header('Location: index.php');
    }
    else {
        echo "<script type='text/javascript'>alert('E-posta adresiniz veya şifreniz yanlış.');</script>";
    }
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
        <title>Lupusoft Yönetici Girişi</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" href="adminlogo.png" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content" style="opacity: 0.95;">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><img src="adminlogo.png" style="width:20%;">YÖNETİM PANELİ</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">E-posta</label><input class="form-control py-4" id="inputEmailAddress" type="email" name="eposta" placeholder="E-posta adresinizi girin" /></div>
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Şifre</label><input class="form-control py-4" id="inputPassword" type="password" name="sifre" placeholder="Şifrenizi girin" /></div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><input type="submit" class="btn btn-primary" style="width:100%;" value="Giriş Yap"></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="http://docs.lupusoft.com/" target="_blank">Sorun mu yaşıyorsun? Destek al!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div style="opacity:0.4;background-image: url('bg.png');background-position: center;background-repeat: no-repeat;background-size: cover; width:100%;height:100%;position:absolute;margin:auto;z-index: -1;"></div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto" style="background: rgba(255,255,255,0.85) !important;">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"><a href="http://lupusoft.com" target="_blank">Lupusoft</a>&reg; Yazılım ve Donanım Hizmetleri <script>document.write(new Date().getFullYear());</script> </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
