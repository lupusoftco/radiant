<?php
session_start();
if($_SESSION["yonetici"] == "1" and isset($_GET["u"])){
include("../db.php");
function replace_tr($text) {
 $text = trim($text);
 $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
 $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
 $new_text = str_replace($search,$replace,$text);
 return $new_text;
}
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
 
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "false";
    return;
}
 
if (!file_exists('uploads')) {
    mkdir('uploads', 0777);
}
$imagefile_name = time() . '_' . $_FILES['file']['name'];
$imagefile_name = replace_tr($imagefile_name);
move_uploaded_file($_FILES['file']['tmp_name'], '../images/' . $imagefile_name);
mysqli_query($db,"INSERT INTO resimler(isim,sahip) VALUES('".$imagefile_name."',".$_GET["u"].")");
 
echo $imagefile_name;
}
else {
	echo "Oturum süresi doldu.";
}
?>