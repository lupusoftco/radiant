<?php
$adminsor = mysqli_query($db,"SELECT * FROM yoneticiler WHERE id = ".$_SESSION["yonetici_id"]);
$admingetir = mysqli_fetch_array($adminsor);
?>
<style type="text/css">
  .minipanel > a > img {width:35px;background: #FFF;padding:3px;border-radius: 2px;margin-left: 4px;}
  body{margin-bottom: 50px;}
</style>
<div class="fixed-bottom p-2 minipanel" style="background: rgba(55,55,55,0.9) !important;">
  <a class="text-light mp-logo" href="admin/index.php"><img src="images/logo_1.png" title="Paneli Aç"></a>
  <a class="text-light" href="admin/login.php" style="float:right;"><img src="images/logout.svg" title="Çıkış Yap"></a>
  <a class="text-light" style="float:right;line-height:35px;margin-right: 4px;">Merhaba <?php echo $admingetir["kadi"]; ?></a>
</div>