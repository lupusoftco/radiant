<?php
$bildirimsayac = "<div>9</div>";
?>
<header class="header">
		<div class="header_overlay"></div>
		<div class="header_content d-flex flex-row align-items-center justify-content-start">
			<div class="logo">
				<a href="index.php">
					<div class="d-flex flex-row align-items-center justify-content-start">
						<div><img src="images/<?php echo $ayarlarsatir["logo"]; ?>" alt=""></div>
						<div><?php echo $ayarlarsatir["kadi"]; ?></div>
					</div>
				</a>	
			</div>
			<div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
			<nav class="main_nav">
				<ul class="d-flex flex-row align-items-start justify-content-start">
					<li class="active"><a href="index.php?sayfa=anasayfa#">Vitrin</a></li>
					<li><a href="index.php?sayfa=anasayfa#categorydiv">Kategoriler</a>
					</li>
				</ul>
			</nav>
			<div class="header_right d-flex flex-row align-items-center justify-content-start ml-auto">
				<!-- Search -->
				<div class="header_search">
					<form action="index.php?sayfa=kesfet" id="header_search_form" method="GET" onsubmit="onlyreplace();">
						<input type="text" class="search_input" id="search-input" name="arama" placeholder="Arama..." required="required">
						<button class="header_search_button"><img src="images/search.png" alt=""></button>
					</form>
				</div>
				<!-- User -->
				<div class="user"><a href="?sayfa=uyegiris"><div><img src="images/user.svg" alt="Üye Sayfası"><?php //echo $bildirimsayac; ?></div></a></div>
				<!-- Cart -->
				<div class="cart"><a href="?sayfa=sepet"><div><img class="svg" src="images/cart.svg" alt="Sepetim"></div></a></div>
				<!-- Phone -->
				<div class="header_phone d-flex flex-row align-items-center justify-content-start">
					<div><div><img src="images/phone.svg" alt="Telefon"></div></div>
					<div><?php echo $ayarlarsatir["tel"]; ?></div>
				</div>
			</div>
		</div>
	</header>
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