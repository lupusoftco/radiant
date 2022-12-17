<?php
if($_SESSION["yonetici"] == "1"){
?>
<script type="text/javascript">
	function readyQuery(sql,parameter){
		var inp = document.getElementById("sorgu");
		var cons = document.getElementById("console");
		var row = document.getElementById('rowType').value;
		if(parameter == "undefined"){
			parameter = " ";
		}
		if(row == "ROWS"){
			inp.value = "SELECT * FROM "+parameter;
		}
		else {
			inp.value = sql+" "+parameter;
		}
		cons.submit();
	}
</script>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Geliştirici Konsolu</h1>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-terminal mr-1"></i>Tüm veritabanınıza sql sorgusu gönderebilirsiniz.</div>
            <div class="card-body"></small>
		        <img src="img/danger.gif" width="20"><small style="color:#F20;font-weight: bold;"> DİKKAT! Gönderilen sorgunun geri dönüşü yoktur.</small><br>&nbsp;
		        <form method="POST" id="console">
		        	<textarea name="sorgu" id="sorgu" spellcheck="false" style="font-family:monospace;outline: none;width: calc(100% - 10px);padding: 10px;line-height: 10px;border: none;height: 100%;resize: none;background: #222;color:#FFF;" placeholder="SQL SORGUSU GİRİN [ Sınırlayıcı '; ]"></textarea>
		        	<input type="submit" value="Çalıştır"> &nbsp; <input type="button" onclick="readyQuery('SHOW TABLES','undefined','undefined');" value="Tüm Tablolar"> &nbsp; <span style="border:1px solid #222;padding:10px;display: inline-block;"> <select id='tablolar'>
		        	<?php 
		        		$tablolar_sorgu = mysqli_query($db,"SHOW TABLES");
		        		while($tablolar_satir = mysqli_fetch_array($tablolar_sorgu)){
		        			if($tablolar_satir["Tables_in_".$dbn] != "ayarlar"){
		        				echo "<option value='".$tablolar_satir["Tables_in_".$dbn]."'>".$tablolar_satir["Tables_in_".$dbn]."</option>";
		        			}
		        		}
		        	?>
		        		
		        	</select> tablosunun <select id="rowType"><option value="COLUMNS">Sütunlarını</option><option value="ROWS">Satırlarını</option></select> <input type="button" onclick="readyQuery('SHOW '+document.getElementById('rowType').value+' FROM',document.getElementById('tablolar').value);" value="Görüntüle"></span>
		        	<br><code>Ayarlar tablosuna sorgu gönderilemez.</code><br>
		        </form><br>
		        	<?php
		        	if(isset($_POST["sorgu"])){ ?>
		        		<b>Çıktı:</b> <br>
		    		<?php } ?>
		        <pre style="border:1px solid #222;padding:3px;background: #EEE;"><?php
		        	if(isset($_POST["sorgu"])){
		        		if($_POST["sorgu"] == ""){
		        			echo "Sorgunuz boş bırakılamaz.";
		        		}
		        		else {
							$ayar= 'ayarlar';
							$search = strpos($_POST["sorgu"], $ayar);
							if ($search === false) {
				        		$sorgu = mysqli_query($db,$_POST["sorgu"]);
				        		if(!$sorgu){
				        			echo mysqli_error($db);
				        		}
				        		else {
				        			while($cevap = mysqli_fetch_array($sorgu)){
				        				var_dump($cevap);
				        			}
				        		}
							} else {
							    echo "Ayarlar tablosuna sorgu gönderilemez.";
							}
						}
		        	}
		        		
		        	?>
		        </pre>
            </div>
        </div>
    </div>
</main>
<?php
}
else {
    header('Location: login.php');
}
?>