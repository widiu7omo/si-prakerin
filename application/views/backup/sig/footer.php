<footer id="ts-footer">
    <section id="ts-footer-main">
		<div class="container">
			<div class="row">
				<!--Brand and description-->
				<div class="col-md-12">
					<a href="#" class="brand">
						<img src="<?= base_url()?>assets/free_user/img/logo.png" alt="">
					</a>
					<p class="mb-4">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat tempor sapien.
						In lobortis posuere tincidunt. Curabitur malesuada tempus ligula nec maximus. Nam tortor
						arcu,
						tincidunt quis molestie non, sagittis dignissim ligula. Fusce est ipsum, pharetra in felis
						ac,
						lobortis volutpat diam.
					</p>
					<a href="#" class="btn btn-outline-dark mb-4">Contact Us</a>
				</div>
			</div>
		</div>
	</section>
    <section id="ts-footer-secondary">
		<div class="container">
			<div class="ts-copyright">(C) 2018 ThemeStarz, All rights reserved</div>
			<!--Social Icons-->
			<div class="ts-footer-nav">
				<nav class="nav">
					<a href="#" class="nav-link">
						<i class="fab fa-facebook-f"></i>
					</a>
					<a href="#" class="nav-link">
						<i class="fab fa-twitter"></i>
					</a>
					<a href="#" class="nav-link">
						<i class="fab fa-pinterest-p"></i>
					</a>
					<a href="#" class="nav-link">
						<i class="fab fa-youtube"></i>
					</a>
				</nav>
			</div>
		</div>
	</section>
</footer>
</div>
<style>
/* css to customize Leaflet default styles  */
.custom .leaflet-popup-tip,
.custom .leaflet-popup-content-wrapper {
    background: #e93434;
    color: #ffffff;
}
</style>
<?php if($komponen == 'home'){ ?>
	<script src="<?= base_url()?>assets/free_user/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/js/popper.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/js/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/js/owl.carousel.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/js/custom.js"></script>
<?php }elseif($komponen == 'maps'){ ?>
	<script src="<?= base_url()?>assets/free_user/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/js/popper.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/js/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/js/owl.carousel.min.js"></script>
	<script src="<?= base_url()?>assets/free_user/js/custom.js"></script>
	<!--Leaflet Maps Library JavaScript-->
  <script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/jquery.min.js'></script>
  <script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.js'></script>
  <script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.markercluster.js'></script>
	<!-- Javascript Untuk Mencari Data Autocomplete-->
	<script type='text/javascript' src='<?= base_url()?>assets/autocomplete/jquery-ui.js'></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#keyword').autocomplete({
				source: "<?php echo site_url('sig/maps/get_autocomplete');?>",
				select: function (event, ui) {
					$(this).val(ui.item.label);
					$("#form_search").submit(); 
				}
			});
		});
	</script>
	<!-- Javascript Untuk Menampilkan Maps-->
	<script type='text/javascript'>
    var markers = <?php echo $dataJSON?>;
    var map = L.map( 'mapid', {
      center: [-3.0, 115.0],
      minZoom: 2,
      zoom: 7,
    });

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      subdomains: ['a','b','c']
    }).addTo(map);

    var myIcon = L.icon({
      iconUrl: '<?= base_url()?>assets/plugin_maps/pin48.png',
      iconRetinaUrl: '<?= base_url()?>assets/plugin_maps/pin48.png',
      iconSize: [29, 24],
      iconAnchor: [9, 21],
      popupAnchor: [0, -14]
    });
		var customOptions =
        {
        'maxWidth': '500',
        'className' : 'custom'
        }
    var markerClusters = L.markerClusterGroup();
    for (var i = 0; i < markers.length; i++){
			
      var popups = '<div class="ts-marker-wrapper">'+ markers[i].name +'</div>';
      var m = L.marker([markers[i].lat, markers[i].lng], {icon: myIcon}).bindPopup(popups, customOptions);
      markerClusters.addLayer(m);
    }
    map.addLayer(markerClusters);
  </script>
	<?php }?>
</body>
</html>
