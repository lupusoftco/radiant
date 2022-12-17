<?php
$csvfile_name = $_GET["csv"];
if(($handle = fopen('backup/'. $csvfile_name, "r")) !== FALSE){
    while(($row =   fgetcsv($handle)) !== FALSE){
    	if($row[0] != "id"){
    		if($row[1] == "" or $row[1] == null or !isset($row[1])){
    			$row[1] = "&nbsp;";
    		}
	    	$urun_sor = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$row[0]." or barkod = '".$row[1]."'");
	    	if(mysqli_num_rows($urun_sor) == 1){
	    		mysqli_query($db,"UPDATE urunler SET barkod = '".$row[1]."', isim = '".$row[2]."', aciklama = '".$row[3]."', fiyat = ".$row[4].", kategori = ".$row[5].", stok = ".$row[7].", etiketler = '".$row[9]."', minimumalis = ".$row[10].", maksimumalis = ".$row[11].", birim = ".$row[12].", marka = ".$row[13]." WHERE id = ".$row[0]);
	    	}
	    	else {
	        mysqli_query($db,'INSERT INTO urunler(barkod, isim, aciklama, fiyat, kategori, vitrin, stok, goruntuleme, etiketler, minimumalis, maksimumalis, birim, marka) VALUES ("'.$row[1].'","'.$row[2].'","'.$row[3].'",'.$row[4].','.$row[5].',0,'.$row[7].',0,"'.$row[9].'",'.$row[10].','.$row[11].','.$row[12].','.$row[13].')');
	        }
        }
    }
    fclose($handle);
}
?>