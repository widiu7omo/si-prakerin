	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul id="additional_links">
						<li><strong><a href="#">Politeknik Negeri Tanah Laut</a></strong></li>
						<li><strong><?= '@'.date('Y').' SIG Tempat Prakerin'?></strong></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	<!-- page -->
	<div id="toTop"></div><!-- Back to top button -->
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/jquery.min.js'></script>
	<script rel="stylesheet" href="<?= base_url()?>assets/frontend/toast/sweetalert2.min.css"></script>
	<script type='text/javascript' src="<?= base_url()?>assets/frontend/toast/sweetalert2.all.js"></script>
	<?php if($komponen == 'login'){ ?>
	<script src="<?= base_url()?>assets/frontend/js/common_scripts.js"></script>
	<script src="<?= base_url()?>assets/frontend/js/functions.js"></script>
	<script src="<?= base_url()?>assets/frontend/js/validate.js"></script>
	<?php }elseif($komponen == 'home'){ ?>
	<!-- COMMON SCRIPTS -->
  	<script src="<?= base_url()?>assets/frontend/js/common_scripts.js"></script>
	<script src="<?= base_url()?>assets/frontend/js/functions.js"></script>
	<script src="<?= base_url()?>assets/frontend/js/validate.js"></script>
	<!--Leaflet Maps Library JavaScript-->
	<script type='text/javascript' src='<?= base_url()?>assets/autocomplete/jquery-ui.js'></script>
    <script type='text/javascript' src="<?= base_url()?>assets/plugin_maps/cari_cari/leaflet.customsearchbox.min.js"> </script>
  	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.js'></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/Control.Geocoder.js'></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/leaflet-routing-machine.min.js'></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/config.js'></script>
  	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.markercluster.js'></script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#title').autocomplete({
                source: "<?php echo site_url('sig/home/get_autocomplete');?>",
                select: function (event, ui) {
                    $(this).val(ui.item.label);
					console.log($(this).val());
                }
            });
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#title_mobile').autocomplete({
                source: "<?php echo site_url('sig/home/get_autocomplete');?>",
                select: function (event, ui) {
                    $(this).val(ui.item.label);
					console.log($(this).val());
                }
            });
		});
	</script>
	<!-- Javascript Untuk Menampilkan Maps-->
	<script type='text/javascript'>
		// Data Json Titik
		var markers = <?php echo $dataJSON?>;
		var map = L.map( 'mapid', {
			center: [-3.0, 115.0],
			minZoom: 2,
			zoom: 5,
			worldCopyJump: true,
		});
		map.zoomControl.setPosition('bottomright');
		// Kontribusi OpenStreetMap dan Plugin Leaflet
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | SIG Tempat Prakerin <?= date('Y')?>',
			subdomains: ['a','b','c']
		}).addTo(map);
		
		//Gambar Titik Ikon
		var myIcon = L.icon({
			iconUrl: '<?= base_url()?>assets/plugin_maps/pin48.png',
			iconRetinaUrl: '<?= base_url()?>assets/plugin_maps/pin48.png',
			iconSize: [20, 25],
			iconAnchor: [9, 21],
			popupAnchor: [0, -14]
		});
		
		//Marker Tampil Maps dan Cluster
		var markerClusters = L.markerClusterGroup();
		for (var i = 0; i < markers.length; i++){
			var conten = '<h6>'+ markers[i].name +'</h6>' +
				'<hr style="margin-top: 1px; margin-bottom: 5px;">' +
				'<table>'+
				'<tr>'+
					'<td><p>Alamat : '+ markers[i].alamat + '</p></td>'+
				'</tr>'+
				'</table>'+
				'<hr style="margin-top: 5px; margin-bottom: 10px;">'+
				'<a class="loc_open" style="margin-right:10px" onClick="javascript:getLocationLeaflet('+ markers[i].lat +','+ markers[i].lng +');" href="#"><i class="icon_compass_alt"></i> Rute</a>'+
				'<a class="loc_open" href="<?php echo base_url('sig/perusahaan/')?>'+ markers[i].id +'" role="button"><i class="icon_question_alt2"></i> Info Lebih Lengkap</a>';
			var m = L.marker([markers[i].lat, markers[i].lng], {icon: myIcon}).bindPopup(conten);
			
		markerClusters.addLayer(m);
		}
		map.addLayer(markerClusters);

		function getLocationLeaflet(t, k) {
			map.on('locationfound', function(e){
				var peta_pt  = t+','+k;
				var peta_lok = e.latlng.lat+','+e.latlng.lng;
				window.open('https://www.google.com/maps/dir/?api=1&origin='+peta_lok+'&destination='+peta_pt+'&travelmode=driving','_newtab');
			});
		 	map.on('locationerror', function(e){ 
				Swal.fire('Aktivasi GPS Bermasalah', 'Pastikan Internet dan GPS Hidup', 'warning');
			});
		 	map.locate({
				 setView: false
			});
		}
	</script>
	<?php }elseif($komponen == 'perusahaan'){ ?>
	<!-- COMMON SCRIPTS -->
  	<script src="<?= base_url()?>assets/frontend/js/common_scripts.js"></script>
	<script src="<?= base_url()?>assets/frontend/js/functions.js"></script>
	<script src="<?= base_url()?>assets/frontend/js/validate.js"></script>

	<!--Leaflet Maps Library JavaScript-->
  	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.js'></script>
  	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.markercluster.js'></script>
	<!-- Javascript Untuk Menampilkan Maps-->
	<script type='text/javascript'>
		var markers = <?php echo $dataJSON?>;
		var map = L.map( 'mapid', {
			center: [-3.0, 115.0],
			minZoom: 2,
			zoom: 5,
			worldCopyJump: true,
		});
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
			subdomains: ['a','b','c']
		}).addTo(map);
		
		var myIcon = L.icon({
			iconUrl: '<?= base_url()?>assets/plugin_maps/pin48.png',
			iconRetinaUrl: '<?= base_url()?>assets/plugin_maps/pin48.png',
			iconSize: [20, 25],
			iconAnchor: [9, 21],
			popupAnchor: [0, -14]
		});
		
		var markerClusters = L.markerClusterGroup();
		for (var i = 0; i < markers.length; i++){	
			var conten = '<h6>'+ markers[i].name +'</h6>' +
				'<hr style="margin-top: 5px; margin-bottom: 10px;">'+
				'<a class="loc_open" style="margin-right:10px" onClick="javascript:getLocationLeaflet('+ markers[i].lat +','+ markers[i].lng +');" href="#"><i class="icon_compass_alt"></i> Rute</a>';
			var m = L.marker([markers[i].lat, markers[i].lng], {icon: myIcon}).bindPopup(conten);
			markerClusters.addLayer(m);
		}
		map.addLayer(markerClusters);

		function getLocationLeaflet(t, k) {
			map.on('locationfound', function(e){
				var peta_pt  = t+','+k;
				var peta_lok = e.latlng.lat+','+e.latlng.lng;
				window.open('https://www.google.com/maps/dir/?api=1&origin='+peta_lok+'&destination='+peta_pt+'&travelmode=driving','_newtab');
			});
		 	map.on('locationerror', function(e){ 
				Swal.fire('Aktivasi GPS Bermasalah', 'Pastikan Internet dan GPS Hidup', 'warning');
			});
		 	map.locate({
				 setView: false
			});
		}
	</script>
	<script type='text/javascript' src="<?= base_url()?>assets/frontend/media/lightslider.js"></script>
	<script type='text/javascript' src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
	<script type='text/javascript' src="<?= base_url()?>assets/frontend/media/lightgallery-all.min.js"></script>
	<script type='text/javascript' src="<?= base_url()?>assets/frontend/media/jquery.mousewheel.min.js"></script>
	<script type='text/javascript'>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                keyPress:true,
				speed:500,
                auto:true,
            });
			$('#content-slider').lightGallery();
		});
    </script>
	<script src="<?= base_url()?>assets/frontend/jquery.twbsPagination.js"></script>
	<script type='text/javascript'>
		pageSize = 7;
		pagesCount = $(".count_tampil").length;
		var totalPages = Math.ceil(pagesCount / pageSize)

		$('.pagination').twbsPagination({
			totalPages: totalPages,
			visiblePages: 5,
			onPageClick: function (event, page) {
				var startIndex = (pageSize*(page-1))
				var endIndex = startIndex + pageSize
				$('.count_tampil').hide().filter(function(){
					var idx = $(this).index();
					return idx>=startIndex && idx<endIndex;
				}).show()
			}
		});
	</script>
	<?php }elseif($komponen == 'prakerin'){ ?>
	<!-- COMMON SCRIPTS -->
  	<script type='text/javascript' src="<?= base_url()?>assets/frontend/js/common_scripts.js"></script>
	<script type='text/javascript' src="<?= base_url()?>assets/frontend/js/functions.js"></script>
	<script src="<?= base_url()?>assets/frontend/js/validate.js"></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.js'></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/Control.Geocoder.js'></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/leaflet-routing-machine.min.js'></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/config.js'></script>
  	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.markercluster.js'></script>
	<script type="text/javascript">
		var map = L.map('mapid', {
			center: [-3.0, 115.0],
			minZoom: 2,
			zoom: 5,
			worldCopyJump: true,
		});
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
			subdomains: ['a','b','c']
		}).addTo(map);

		function getLocationLeaflet() {
			map.on('locationfound', function(e){
				var lng = e.latlng.lng;
				var lat = e.latlng.lat;
				document.getElementById("lng").value = lng;
				document.getElementById("lat").value = lat;
			});
		 	map.on('locationerror', function(e){ 
				Swal.fire('Aktivasi GPS Bermasalah', 'Pastikan Internet dan GPS Hidup', 'warning');
			});
		 	map.locate({
				 setView: false
			});
		}
  	</script>
	<script type='text/javascript'>
		$(document).ready(function(){
			$("#id_negara").change(function (){
				///console.log("Aksi");
				var negara = $('#id_negara').val();
				if (negara != ''){
					var url = "<?php echo site_url('sig/prakerin/provinsi');?>/"+$(this).val();
					$('#id_provinsi').load(url);
					$('#id_kabupaten').html('<option value="">Pilih Kabupaten</option>');
					$('#id_kecamatan').html('<option value="">Pilih Kecamatan</option>');
					return false;
				}else{
					$('#id_provinsi').html('<option value="">Pilih Provinsi</option>');
					$('#id_kabupaten').html('<option value="">Pilih Kabupaten</option>');
					$('#id_kecamatan').html('<option value="">Pilih Kecamatan</option>');
				}
			})

			$("#id_provinsi").change(function (){
				var provinsi = $('#id_provinsi').val();
				if (provinsi != ''){
					var url = "<?php echo site_url('sig/prakerin/kabupaten');?>/"+$(this).val();
					$('#id_kabupaten').load(url);
					$('#id_kecamatan').html('<option value="">Pilih Kecamatan</option>');
					return false;
				}else{
					$('#id_kabupaten').html('<option value="">Pilih Provinsi</option>');
				}
			})

			$("#id_kabupaten").change(function (){
				var kabupaten = $('#id_kabupaten').val();
				if (kabupaten != ''){
					var url = "<?php echo site_url('sig/prakerin/kecamatan');?>/"+$(this).val();
						$('#id_kecamatan').load(url);
					return false;
				}else{
					$('#id_kecamatan').html('<option value="">Pilih Kecamatan</option>');
				}
			})
		});
	</script>
	<?php }?>
	<?php if($this->session->flashdata('session_notif') == 'notif'){?>
    <script type='text/javascript'>
			Swal.fire({
				type	: '<?php echo $this->session->flashdata('icon')?>',
				title	: '<?php echo $this->session->flashdata('judul_notif')?>',
				html	: '<?php echo $this->session->flashdata('ket_notif')?>',
				showConfirmButton: false,
				timer: 3000,
			});
    </script>
    <?php }?>
	<script type='text/javascript'>
		$('#file').bind('change', function() {
			var uploadField = document.getElementById("file");
			var FileSize = uploadField.files[0].size / 1024 / 1024; // in MB
			if(FileSize > 2){
				Swal.fire('Ukuran File Melebihi Batas Maksimum', 'Unggah Foto Min 2MB', 'warning');
				$(file).val('');
			}
    	});
	</script>
</body>
</html>