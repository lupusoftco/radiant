<?php
$myfile = fopen("sartlarvekosullar.html", "w");
$txt = "Sartlar ve kosullar";
fwrite($myfile, $txt);
fclose($myfile);
?>