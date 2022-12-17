<?php
if(isset($_POST["excele"])){
    include '../db.php';
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=urunler.csv');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('id', 'barkod', 'isim', 'aciklama', 'fiyat', 'kategori', 'vitrin', 'stok', 'goruntuleme', 'etiketler', 'minimumalis', 'maksimumalis', 'birim', 'marka'));

	// fetch the data
	$rows = mysqli_query($db,'SELECT * FROM urunler');

	// loop over the rows, outputting them
	while ($row = mysqli_fetch_assoc($rows)) {
		fputcsv($output, $row);
	}
}
?>