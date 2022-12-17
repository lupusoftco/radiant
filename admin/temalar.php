<style type="text/css">
    .onizleme {position: absolute;width:100%;height:100%;background:rgba(55,55,55,.5);top: 0;left: 0;display: none;}
    .onizleme a {position: absolute;width: 180px;height: 40px;left: 0;right: 0;top: 0;bottom: 0;margin: auto;}
    .card:hover > .onizleme {display: block;}
</style>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Temalar</h1>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-palette mr-1"></i>Tüm temaları görüntüleyebilir ve yönetebilirsiniz.</div>
            <div class="card-body">
        <!--TEMALAR-->
	          <div class="card col-lg-2 mr-4 pd-4 d-inline-block">
                   <div class="card-header"><i class="fas fa-check-circle mr-1"></i>Etkin Tema</div>
                        <img src="img/templates/capucine.jpg" style="width:100%;">
                   <div class="card-footer"><strong>Capucine</strong> <a href="?sayfa=tasarimi-yonet" class="btn btn-secondary" style="float:right;"><i class="fas fa-paint-brush mr-1"></i> Özelleştir</a></div>
               </div>

               <div class="card col-lg-2 mr-4 pd-4 d-inline-block">
                   <div class="card-header">&nbsp;</div>
                   <div class="onizleme">
                        <a href="#" class="btn btn-primary"><i class="fas fa-glasses mr-1"></i>Canlı Önizleme</a>
                   </div>
                        <img src="img/templates/megaclite.jpg" style="width:100%;">
                   <div class="card-footer"><strong>Mega Clite</strong></div>
               </div>

               <div class="card col-lg-2 mr-4 pd-4 d-inline-block">
                   <div class="card-header">&nbsp;</div>
                   <div class="onizleme">
                        <a href="#" class="btn btn-primary"><i class="fas fa-glasses mr-1"></i>Canlı Önizleme</a>
                   </div>
                        <img src="img/templates/kroshka.jpg" style="width:100%;">
                   <div class="card-footer"><strong>Kroshka</strong></div>
               </div>            
        <!--TEMALAR-->
            </div>
        </div>
    </div>
</main>