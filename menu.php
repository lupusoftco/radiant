<div class="menu">

	<!-- Search -->
	<div class="menu_search">
			<form action="index.php?sayfa=kesfet" id="menu_search_form" method="GET" onsubmit="onlyreplace();">
			<input type="text" class="search_input" placeholder="Arama..." name="arama" required="required">
			<button class="menu_search_button"><img src="images/search.png" alt=""></button>
		</form>
	</div>
	<!-- Navigation -->
	<div class="menu_nav">
		<ul>
			<li><a href="index.php?sayfa=anasayfa#">Vitrin</a></li>
			<li><a href="index.php?sayfa=anasayfa#categorydiv">Kategoriler</a></li>
		</ul>
	</div>
	<!-- Contact Info -->
	<div class="menu_contact">
		<div class="menu_phone d-flex flex-row align-items-center justify-content-start">
			<div><div><img src="images/phone.svg" alt="Telefon"></div></div>
			<div><?php echo $ayarlarsatir["tel"]; ?></div>
		</div>
		<?php
		if($ayarlarsatir["footersosyal"] == 1){
		?>
		<div class="menu_social">
			<ul class="menu_social_list d-flex flex-row align-items-start justify-content-start">
				<?php
					$sosyal_sorgu = mysqli_query($db,"SELECT * FROM sosyal");
					if(mysqli_num_rows($sosyal_sorgu) > 0){
						while ($sosyal_satir = mysqli_fetch_assoc($sosyal_sorgu)) {
							$sosyal_medya = mysqli_query($db,"SELECT * FROM sosyalmedyalar WHERE id = ".$sosyal_satir["sosyalmedya"]);
							$sosyal_medya_isim = mysqli_fetch_assoc($sosyal_medya);
							echo '<li><a href="'.$sosyal_satir['link'].'" target="_blank"><i class="fa fa-'.$sosyal_medya_isim["isim"].'" aria-hidden="true"></i></a></li>';
						}
					}
					else {
						echo '<li><a href="tel:'.$ayarlarsatir['tel'].'"><i class="fa fa-phone" aria-hidden="true"></i></a></li>';
					}
				?>
			</ul>
		</div>
		<?php
		}
		?>
	</div>
</div>
<script type="text/javascript">
		function escapeHtml(unsafe) {
		    return unsafe
		         .replace(/&/g, "&amp;")
		         .replace(/</g, "&lt;")
		         .replace(/>/g, "&gt;")
		         .replace(/"/g, "&quot;")
		         .replace(/'/g, "&#039;");
		 }
		function onlyreplace() {
		  var str = document.getElementById("search-input").value; 
		  var res = escapeHtml(str);
		  document.title = res;
		  document.getElementById("search-input").value = res;
		}
	</script>