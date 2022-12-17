<?php
if(isset($_GET["detay"])){
$detay_getir = mysqli_query($db,"SELECT * FROM siparis WHERE id = ".$_GET["detay"]);
$detay_satir = mysqli_fetch_array($detay_getir);
$toplam_urun_sor = mysqli_query($db,"SELECT * FROM siparislistesi WHERE siparis = ".$_GET["detay"]);
$toplam_urun = mysqli_num_rows($toplam_urun_sor);
?>
<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Sipariş İşlemleri</h1>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-shopping-basket mr-1"></i> Sipariş Detayı
                            </div>
                            <div class="card-body">
                            	<a href="?sayfa=siparis&yazdir=<?php echo $_GET["detay"]; ?>" class="btn btn-secondary mr-2">Yazdır</a>
                            	<?php if($detay_satir["havaleisebanka"] != 0) { ?><a href="#" class="btn btn-success mr-2">Ödemeyi Tamamla</a><?php } ?>
                            	<a href="#" class="btn btn-danger">İade Yap</a>
                            	<form method="POST" style="float:right;"><label>Kargo Takip No:</label> <input type="text" name="kargotakipno"> <input type="submit" value="Güncelle" class="btn btn-success"></form>
                            	<hr>
                            	<div class="row">
                            		<div class="col-lg-4">
                            			<h5>Teslimat Bilgisi</h5>
                            			<ul style="font-size: 14px; list-style-type:disc;line-height:140%;">
                            				<li>
                            					<b><?php echo $detay_satir["adsoyad"]; ?></b>
                            				</li>
                            				<li>
												<b><?php echo $detay_satir["adres"]; ?></b>
                            				</li>
                            				<li>
												<b><?php echo $detay_satir["ililce"]; ?></b>
                            				</li>
                            				<li>
												TCKN: <b><?php echo $detay_satir["tckn"]; ?></b>
                            				</li>
                            				<li>
												Telefon: <b><?php echo $detay_satir["telefon"]; ?></b>
                            				</li>
                            				<li>
												E-posta: <b><?php echo $detay_satir["eposta"]; ?></b>
                            				</li>
                            				<li>
												Sipariş Notu: <b><?php echo $detay_satir["sipnot"]; ?></b>
                            				</li>
                            			</ul>
                            		</div>
                            		<div class="col-lg-4">
                            			<h5>Fatura Bilgisi</h5>
                            			<ul style="font-size: 14px; list-style-type:square;line-height:140%;">
                            				<li>
                            					<b><?php echo $detay_satir["sirket"]; ?></b>
                            				</li>
                            				<li>
												<b><?php echo $detay_satir["adres"]; ?></b>
                            				</li>
                            				<li>
												<b><?php echo $detay_satir["ililce"]; ?></b>
                            				</li>
                            				<li>
												VKN: <b><?php echo $detay_satir["tckn"]; ?></b>
                            				</li>
                            			</ul>
                            		</div>
                            		<div class="col-lg-4">
                            			<h5>Sipariş Bilgileri</h5>
                            			<ul style="font-size: 14px; list-style-type:circle;line-height:140%;">
                            				<li>
                            					Sipariş No: <b><?php echo $detay_satir["id"]; ?></b>
                            				</li>
                            				<li>
												Sipariş Tarihi: <b><?php $tarih_dizi = explode ("|",$detay_satir["ipvetarih"]); echo $tarih_dizi[0]; ?></b>
                            				</li>
                            				<!--<li>
												Hediye Çeki Kodu:
                            				</li>-->
                            				<li>
												Teslimat Türü: <b><?php echo $detay_satir["teslimat"]; ?></b>
                            				</li>
                            				<li>
												Sipariş Takip No: <?php echo $detay_satir["siptakipno"]; ?>
                            				</li>
                            				<li>
												IP Adresi: <b><?php echo $tarih_dizi[1]; ?></b>
                            				</li>
                            				<li>
												Reklam Parametresi: ?fb=true
                            				</li>
                            				<li>
												Toplam Ürün Adedi: <b><?php echo $toplam_urun; ?></b>
                            				</li>
                            			</ul>
                            		</div>
                            	</div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Barkod</th>
                                                <th>Ürün Adı</th>
                                                <th>Marka</th>
                                                <th>Miktar</th>
                                                <th>Birim Fiyat</th>
                                                <th>Toplam Fiyat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        		$sipliste_getir = mysqli_query($db,"SELECT * FROM siparislistesi WHERE siparis = ".$_GET["detay"]);
                                        		while($sipliste_satir = mysqli_fetch_array($sipliste_getir)){
                                        			$urungetir = mysqli_query($db,"SELECT * FROM urunler WHERE id = ".$sipliste_satir["urun"]);
                                        			$urunsatir = mysqli_fetch_array($urungetir);
                                        			$markagetir = mysqli_query($db,"SELECT * FROM markalar WHERE id = ".$urunsatir["marka"]);
                                        			$markasatir = mysqli_fetch_array($markagetir);
                                        			$varyasyongetir = mysqli_query($db,"SELECT * FROM siplistevaryasyon WHERE sahipsipliste = ".$sipliste_satir["id"]." AND urun = ".$urunsatir["id"]);
                                        			$urunfiyat = $urunsatir["fiyat"];
                                        			while($varyasyonsatir = mysqli_fetch_array($varyasyongetir)){
                                        				$varyasyondeger_getir = mysqli_query($db,"SELECT * FROM varyasyondeger WHERE id = ".$varyasyonsatir["varyasyondeger"]);
                                        				while($varyasyondeger_satir = mysqli_fetch_array($varyasyondeger_getir)){
                                        					$urunfiyat = $urunfiyat + $varyasyondeger_satir["tutar"];
                                        				}
                                        			}
                                        		?>
                                        		<tr>
                                        		<td><?php echo $sipliste_satir["urun"]; ?></td>
                                        		<td><?php echo $urunsatir["barkod"]; ?></td>
                                        		<td><?php echo $urunsatir["isim"]; ?>
                                        		<small>
                                        		<?php 
                                        		$varyasyongetir = mysqli_query($db,"SELECT * FROM siplistevaryasyon WHERE sahipsipliste = ".$sipliste_satir["id"]." AND urun = ".$urunsatir["id"]);
                                        			while($varyasyonsatir = mysqli_fetch_array($varyasyongetir)){
                                        				$varyasyondeger_getir = mysqli_query($db,"SELECT * FROM varyasyondeger WHERE id = ".$varyasyonsatir["varyasyondeger"]);
                                        				while($varyasyondeger_satir = mysqli_fetch_array($varyasyondeger_getir)){
                                        					echo "</br><span><u>".$varyasyondeger_satir["deger"]."</u> : ".$varyasyondeger_satir["tutar"]." ".$parabirimsatir["birim"]."</span>";
                                        				}
                                        			}
                                        		?></small></td>
                                        		<td><?php echo $markasatir["isim"]; ?></td>
                                        		<td><?php echo $sipliste_satir["miktar"]; ?></td>
                                        		<td><?php echo $urunfiyat." ".$parabirimsatir["birim"]; ?></td>
                                        		<td><?php echo ($urunfiyat * $sipliste_satir["miktar"])." ".$parabirimsatir["birim"]; ?></td>
                                        	</tr>
                                        		<?php
                                        		}
                                        	?>
                                        </tbody>
                                    </table>
                                    </div><hr>
                                    <div class="row">
                                    	<div class="col-lg-8">
                                    		<font color="darkred">Yapılan Teslimat İşlemleri</font>
		                            		<table class="table table-bordered" width="100%" cellspacing="0">
		                                        <thead>
		                                            <tr>
		                                                <th>Teslimat Türü</th>
		                                                <th>Takip No</th>
		                                                <th>İşlem</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                        	<tr>
		                                        		<td>Hızlı Kargo(1-3 iş günü) 10₺</td>
		                                        		<td>SIP120760354BD173931</td>
		                                        		<td>Teslim Edildi</td>
		                                        	</tr>
		                                        </tbody>
		                                    </table>
                                    	</div>
                                    	<div class="col-lg-4">
                                    		<table class="table table-bordered" width="100%" cellspacing="0">
		                                        <tbody>
		                                        	<tr>
		                                        		<td bgcolor="#EEE">Kapıda Ödeme Tutarı</td>
		                                        		<td>10 ₺</td>
		                                        	</tr>
		                                        	<tr>
		                                        		<td bgcolor="#EEE">Özelleştirme Ücreti</td>
		                                        		<td>0 ₺</td>
		                                        	</tr>
		                                        	<tr>
		                                        		<td bgcolor="#EEE">Toplam</td>
		                                        		<td>690 ₺</td>
		                                        	</tr>
		                                        	<tr>
		                                        		<td bgcolor="#EEE">Teslimat Bedeli</td>
		                                        		<td>10 ₺</td>
		                                        	</tr>
		                                        	<tr>
		                                        		<td bgcolor="#EEE">Toplam İndirimler</td>
		                                        		<td>0 ₺</td>
		                                        	</tr>
		                                        </tbody>
		                                    </table>
                                    	</div>
                                    </div><hr>
                                    <div class="log">Log
                                    	<pre>
<code>- log işlem 1 12,12,2122
- log işlem 2 21,17,2079
- log işlem 3 31,12,1997
- log işlem 4 08,09,2003</code>
                                    	</pre>
                                    	
                                    </div>
                            </div>
                        </div>
                    </div>
                </main>
<?php }
else if(isset($_GET["yazdir"])){ ?>
<script type="text/javascript">
function yazdir(){
	var printContents = document.getElementById('printDiv').innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	setTimeout(function(){ document.body.innerHTML = originalContents; }, 1000);
}
window.onload=function(){
	yazdir();
}
</script>
<main>
	<div class="container-fluid">
		<h1 class="mt-4">Sipariş Yazdırma</h1>
		 <div class="card mb-4 fatura-yazdir">
                            <div class="card-header"><i class="fas fa-print mr-1"></i> Sipariş Detayı
		 					<button onclick="yazdir();" class="btn btn-success" style="float:right;">Yazdır</button>
                            </div>
                            <div class="card-body" id="printDiv">
								  <style>
								    @import url(https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic);
								/** GLOBAL **/
								.fatura-yazdir > * {
								  font-family: "Lato", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
								  color: #333447;
								  line-height: 1.5;
								}
								/* TYPOGRAPHY */

								.fatura-yazdir > h1 {
								  font-size: 2.5rem;
								}
								.fatura-yazdir > h2 {
								  font-size: 2rem;
								}
								.fatura-yazdir > h3 {
								  font-size: 1.375rem;
								}
								.fatura-yazdir > h4 {
								  font-size: 1.125rem;
								}
								.fatura-yazdir > h5 {
								  font-size: 1rem;
								}
								.fatura-yazdir > h6 {
								  font-size: 0.875rem;
								}
								.fatura-yazdir > p {
								  font-size: 1.125rem;
								  font-weight: 200;
								  line-height: 1.8;
								}
								.fatura-yazdir > .font-light {
								  font-weight: 300;
								}
								.fatura-yazdir > .font-regular {
								  font-weight: 400;
								}
								.fatura-yazdir > .font-heavy {
								  font-weight: 700;
								}
								/* POSITIONING */

								.fatura-yazdir > .left {
								  text-align: left;
								}
								.fatura-yazdir > .right {
								  float: right;
								  text-align: right;
								}
								.fatura-yazdir > .center {
								  text-align: center;
								  margin-left: auto;
								  margin-right: auto;
								}
								.fatura-yazdir > .justify {
								  text-align: justify;
								}
								/** standard padding**/

								.fatura-yazdir > .no-padding {
								  padding: 0px;
								}
								.fatura-yazdir > .standard-padding {
								  padding: 20px;
								}
								.fatura-yazdir > .standard-padding-right {
								  padding-right: 20px;
								}
								.fatura-yazdir > .standard-padding-left {
								  padding-left: 20px;
								}
								.fatura-yazdir > .standard-padding-right {
								  padding-left: 20px;
								}
								.fatura-yazdir > .standard-padding-top {
								  padding-top: 20px;
								}
								.fatura-yazdir > .standard-padding-bottom {
								  padding-bottom: 20px;
								}
								.fatura-yazdir > .container {
								  width: 100%;
								  margin-left: auto;
								  margin-right: auto;
								}
								.fatura-yazdir > .row {
								  position: relative;
								  width: 100%;
								}
								.fatura-yazdir > .row [class^="col"] {
								  float: left;
								  margin: 0.5rem 2%;
								  min-height: 0.125rem;
								}
								.fatura-yazdir > .row::after {
								  content: "";
								  display: table;
								  clear: both;
								}
								.hidden-sm {
								  display: none;
								}
								.invoice-box {
								  background: #ffffff;
								  /*max-width: 900px;*/
								  margin: 60px auto;
								  padding: 30px;
								  border: 1px solid #002336;
								  box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
								  font-size: 16px;
								  line-height: 24px;
								  color: #002336;
								}
								.title {
								  margin-bottom: 0px;
								  padding-bottom: 0px;
								  margin-left: 10px;
								  margin-right: 10px;
								  font-weight: bold;
								  border-bottom: 1px solid #8B8B8B;
								  margin-bottom: 4px;
								}
								.infoblock {
								  margin-left: 10px;
								  margin-right: 10px;
								  margin-top: 0px;
								  padding-top: 0px;
								}
								.titles {
								  padding-top: 4px;
								  margin-top: 20px;
								  background: #000;
								  font-weight: bold;
								}
								.titles tr th{
								  color:#fff;
								}
								@media only screen and (max-width: 600px) {
								  .invoice-box table tr.top table td {
								    width: 100%;
								    display: block;
								    text-align: center;
								  }
								  .invoice-box table tr.information table td {
								    width: 100%;
								    display: block;
								    text-align: center;
								  }
								}
								/** RTL **/

								.rtl {
								  direction: rtl;
								  font-family: "Lato", Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
								}
								.rtl table {
								  text-align: right;
								}
								.rtl table tr td:nth-child(2) {
								  text-align: left;
								}
								.eqWrap {
								  display: flex;
								}
								.eq {
								  padding: 10px;
								}
								.item:nth-of-type(odd) {
								  background: #F9F9F9;
								}
								.item:nth-of-type(even) {
								  background: #fff;
								}
								.equalHW {
								  flex: 1;
								}
								.equalHM {
								  width: 32%;
								}
								.equalHMR {
								  width: 32%;
								  margin-bottom: 2%;
								}
								table.table {
								  width: 100%;
								  margin-top: 20px;
								  border-collapse: collapse;
								}
								    .table th{
								      color:#fff;
								    }
								.table th, .table td {
								  text-align: left;
								  padding: 0.75em;
								}
								.table tr {
								  border-bottom: 1px solid #DDD;
								}
								button:hover {
								  box-shadow: 0 0 4px rgba(3, 3, 3, 0.8);
								  opacity: 0.9;
								}
								  </style>
								  <div class="invoice-box">
								    <div class="container">
								      <div class="row">
								        <div class="equalHWrap eqWrap top">
								          <div class="equalHW eq logo-block">
								            <a href=""><img src="../images/logo_1.png" style="width:100%; max-width:72px;"></a>
								          </div>

								          <div class="equalHW eq title-block">
								            <h2 class="right no-padding" id="InvoiceSumExVat" style="margin:0px;">Lupusoft Yazılım ve Donanım Hizmetleri</h2>
								            
								          </div>
								        </div>
								        <div class="row" style="margin-top:20px;">
								          <div class="equalHWrap eqWrap nomargin-nopadding to-block">
								            <div class="equalHW eq nomargin-nopadding title">
								              Fatura Adresi
								            </div>
								            <div class="equalHW eq nomargin-nopadding title from-block">
								              Teslimat Adresi
								            </div>
								            <div class="equalHW eq nomargin-nopadding title info-block">
								              Sipariş Detayları
								            </div>
								          </div>
								          <div class="row">
								            <div class="equalHWrap eqWrap">
								              <div class="equalHW eq infoblock to-block">
								                <span id="CustomerName">V. Vinay Kumar</span><br>
								                <span id="AccountProject">Kondapur</span><br>
								                <span id="CustomerAddress">Hyderabad</span><br>
								                <span id="CustomerPostalCode">500084</span>, <span id="CustomerCity">Telangana</span><br>
								                <span id="CustomerCountry">India</span><br>
								              </div>
								              <div class="equalHW eq infoblock from-block">
								                <span id="AccountName">L Karthik </span><br>
								                <span id="AccountProject">Parkala</span><br>
								                <span id="AccountAddress">Warangal</span><br>
								                <span id="AccountPostalCode">505104</span>, <span id="AccountCity">Telangana</span><br>
								                <span id="AccountCountry">India</span><br>
								              </div>
								              <div class="equalHW eq infoblock info-block">
								                <span id="">Invoice Date:</span> <span class="right" id="CreatedDate">21. Januar 2017</span><br>
								                <span id="">Invoice Number</span>: <span class="right" id="KidNumber">0000374334</span><br>
								                <span id="">Order Number</span>: <span class="right" id="InvoiceBankAccount">1503 44 06941</span><br>
								                <span id="">Order Date</span>: <span class="right" id="InvoiceIban">21. Januar 2017</span>
								              </div>
								            </div>
								          </div>
								          <table class="table">
								            <tr class="titles">
								              <th>Ürün</th>
								              <th>Açıklama</th>
								              <th>Miktar</th>
								              <th>Birim Fiyat</th>
								              <th>Kdv</th>
								              <th class="right">Ara Toplam</th>
								            </tr>
								            <tr class="item" id="ProductList">
								              <td id="Product"><span id="ProuductName">Product-1<span></span></span></td>
								              <td><span id="ProductNumUnits">Product -1 Description<span></span></span></td>
								              <td><span id="ProductUnit">2<span></span></span></td>
								              <td><span id="ProductUnitPrice">100</span></td>
								              <td><span id="ProductDiscount">50</span></td>
								              <td class="right"><span id="ProductTax">250</span></td>
								            </tr>
								            <tr class="item">
								             <td id="Product"><span id="ProuductName">Product-2<span></span></span></td>
								              <td><span id="ProductNumUnits">Product -2 Description<span></span></span></td>
								              <td><span id="ProductUnit">2<span></span></span></td>
								              <td><span id="ProductUnitPrice">200</span></td>
								              <td><span id="ProductDiscount">50</span></td>
								              <td class="right"><span id="ProductTax" >450</span></td>
								            </tr>

								 
								          </table>
								        </div>
								        <div class="row">
								          <div class="equalHWrap eqWrap">
								            <div class="equalHW eq">
								              <table class="right">
								                <tr>
								                  <td><span style="display:inline-block;margin-right:10px;"><strong>Toplam:</strong></span></td>
								                  <td><span id="InvoceTotalVat">700</span></td>
								                </tr>
								                <tr>
								                </tr>
								              </table>
								            </div>
								          </div>
								          <div class="center">
								            <a href="mailto:<?php echo $ayarlarsatir['eposta']; ?>" style="text-decoration:none;">Soru ve sorunlarınız için <span style="border-bottom:1px solid #000;">iletişime geçin.</span></a>
								          </div>
								        </div>
								      </div>
								    </div>
								  </div>
                            </div>
         </div>
	</div>
</main>
<?php }
else {
	echo "<script type='text/javascript'>window.location.href='?sayfa=anasayfa';</script>";
}
?>