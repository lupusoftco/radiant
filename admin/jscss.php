<?php
if(isset($_POST["jskod"])){
  $jsfile = fopen("../js/custom.js", "w+") or die("Unable to open file!");
  fwrite($jsfile, $_POST["jskod"]);
  fclose($jsfile);
  unset($_POST["jskod"]);
}
else if(isset($_POST["csskod"])){
  $cssfile = fopen("../styles/main_styles.css", "w+") or die("Unable to open file!");
  fwrite($cssfile, $_POST["csskod"]);
  fclose($cssfile);
  unset($_POST["csskod"]);
}
else if (isset($_POST["sifirla"])){
  copy('../js/custom2.js', '../js/custom.js');
  copy('../styles/main_styles2.css', '../styles/main_styles.css');
}
?>
<style type="text/css">
    textarea {
        width: 100%;
        margin-top: 20px;
        height: 300px;
        font-family: monospace;
        background: url("img/coditor.png");
        background-attachment: local;
        background-repeat: no-repeat;
        padding-left: 35px;
        padding-top: 10px;
        border-color:#ccc;
        font-size: 11px;
        color: #666;
    }
</style>
<script type="text/javascript">
      el.style.color='orange'
      el.style.color='#000'

  function kelime_Arama(metin)
{
    var katar = metin.value;
    var aranacak = "";
    
    var sonuc = katar.indexOf(aranacak);
    
    if(sonuc == -1) {
      metin.style.color='#666';
    }
    else{
      metin.style.color='#222';
    }
}
</script>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">JS & CSS Erişimi</h1>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-code mr-1"></i>Düzenlenen Tema: <b>Capucine</b> <form method="POST" style="float:right;display: inline-block;"><input type="hidden" name="sifirla"><input type="submit" value="Varsayılana dön" class="btn btn-primary"></form></div>
            <div class="card-body">
        <!--editör-->
	          <div class="card col-lg-6 mr-4 d-inline-block">
                   <div class="card-header"><i class="fab fa-js-square mr-1"></i>Javascript</div>
                   <form method="POST">
                        <textarea name="jskod" onkeyup="kelime_Arama(this)"><?php
                          $jsfile = fopen("../js/custom.js", "r") or die("Unable to open file!");
                          echo fread($jsfile,filesize("../js/custom.js"));
                          fclose($jsfile);
                        ?></textarea>
                       <hr>
                       <input type="submit" value="Kaydet" class="btn btn-success mb-2" style="float:right;">
                   </form>
               </div>

               <div class="card col-lg-5 ml-4 d-inline-block">
                   <div class="card-header"><i class="fab fa-css3 mr-1"></i>Css</div>
                   <form method="POST">
                        <textarea name="csskod" onkeyup="kelime_Arama(this)"><?php
                          $cssfile = fopen("../styles/main_styles.css", "r") or die("Unable to open file!");
                          echo fread($cssfile,filesize("../styles/main_styles.css"));
                          fclose($cssfile);
                        ?></textarea>
                       <hr>
                       <input type="submit" value="Kaydet" class="btn btn-success mb-2" style="float:right;">
                   </form>
               </div>            
        <!--editör-->
            </div>
        </div>
    </div>
</main>