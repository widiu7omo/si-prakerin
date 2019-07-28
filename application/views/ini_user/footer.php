      <div class="layout-footer">
        <div class="layout-footer-body">
          <small class="version">Version 1.0</small>
          <small class="copyright">2019 &copy; SIG Tempat Prakerin <a href="http://madebytilde.com/">Made by madebytilde.com</a></small>
        </div>
      </div>
    </div>
    <?php if($komponen == 'home'){ ?>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/vendor.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/elephant.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/application.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/demo.min.js"></script>
    <?php }elseif($komponen == 'view'){ ?>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/vendor.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/elephant.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/application.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/demo.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/toast/js/jquery.toast.js"></script>
      <?php if($this->session->flashdata('session_notif') == 'notif'){?>
      <script>
      $(document).ready(function(){ 
        $.toast({
          heading: '<strong><?php echo $this->session->flashdata('judul_notif')?></strong>',
          text: '<?php echo $this->session->flashdata('ket_notif')?>',
          showHideTransition: 'plain',
          position: 'bottom-right',
          icon: 'times',
          bgColor: '#29af12',
          hideAfter: 4000
        });
      });
      </script>
      <?php }?>
    <?php }elseif($komponen == 'action'){ ?>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/vendor.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/elephant.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/application.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/demo.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/ckeditor/ckeditor.js"></script>
    <?php }elseif($komponen == 'maps'){ ?>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/vendor.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/elephant.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/application.min.js"></script>
      <script type='text/javascript' src="<?= base_url()?>assets/user/js/demo.min.js"></script>
      <script type='text/javascript'>
      var markers = <?php echo $dataJSON?>;
      var map = L.map( 'mapid', {
        center: [1.0, 115.0],
        minZoom: 2,
        zoom: 5,
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

      var markerClusters = L.markerClusterGroup();

      for (var i = 0; i < markers.length; i++){
        var popup = markers[i].name;
        var m = L.marker([markers[i].lat, markers[i].lng], {icon: myIcon}).bindPopup(popup);
        markerClusters.addLayer(m);
      }
      map.addLayer(markerClusters);
      </script>
    <?php }?>
</html>