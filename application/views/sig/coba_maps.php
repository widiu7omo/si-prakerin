<!DOCTYPE html>
<html>

<head>
	<title>Leaflet GeoJSON Example</title>
	<meta charset="utf-8" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.2/leaflet.js"></script>
	<script src="https://code.jquery.com/ui/1.8.24/jquery-ui.min.js"></script>
    <script src="<?= base_url()?>assets/plugin_maps/cari_cari/leaflet.customsearchbox.min.js"> </script>
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/leaflet.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/cari_cari/searchbox.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugin_maps/routing/leaflet-routing-machine.css" />
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.js'></script>
  	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/leaflet.markercluster.js'></script>
	
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/Control.Geocoder.js'></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/leaflet-routing-machine.min.js'></script>
	<script type='text/javascript' src='<?= base_url()?>assets/plugin_maps/routing/config.js'></script>
	<script>
		$(document).ready(function () {
			var map = L.map( 'maps', {
				center: [-3.0, 115.0],
				minZoom: 2,
				zoom: 5,
				worldCopyJump: true,
			});
			var markers = [<?php echo $dataJSON?>];
			map.zoomControl.setPosition('bottomright');
			map.addLayer(new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
			}));
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
					var conten = '<h5>'+ markers[i].name +'</h5>' +
					'<hr style="margin-top: 1px; margin-bottom: 10px;">' +
					'<p>'+ markers[i].alamat + '</p>'+
					'<hr style="margin-top: 10px; margin-bottom: 10px;">'+
					'<a class="loc_open" href="<?php echo base_url('sig/perusahaan/detail_perusahaan/')?>'+ markers[i].id +'" role="button">Lebih Lengkap</a>';
			var m = L.marker([markers[i].lat, markers[i].lng], {icon: myIcon}).bindPopup(conten);
			markerClusters.addLayer(m);
			}
			map.addLayer(markerClusters);

			var control = L.Routing.control(L.extend(window.lrmConfig, {
				waypoints: [
					L.latLng(57.74, 11.94),
					L.latLng(57.6792, 11.949)
				],
				geocoder: L.Control.Geocoder.nominatim(),
				routeWhileDragging: true,
				reverseWaypoints: true,
				showAlternatives: true,
				altLineOptions: {
					styles: [
						{color: 'black', opacity: 0.15, weight: 9},
						{color: 'white', opacity: 0.8, weight: 6},
						{color: 'blue', opacity: 0.5, weight: 2}
					]
				}
			})).addTo(map);

			L.Routing.errorControl(control).addTo(map);
			
			var searchboxControl = createSearchboxControl();
			var control = new searchboxControl({
				sidebarTitleText: 'Header',
				sidebarMenuItems: {
					Items: [{
							type: "link",
							name: "Link 1 (github.com)",
							href: "http://github.com",
							icon: "icon-local-carwash"
						},
						{
							type: "link",
							name: "Link 2 (google.com)",
							href: "http://google.com",
							icon: "icon-cloudy"
						},
						{
							type: "button",
							name: "Button 1",
							onclick: "alert('button 1 clicked !')",
							icon: "icon-potrait"
						},
						{
							type: "button",
							name: "Button 2",
							onclick: "button2_click();",
							icon: "icon-local-dining"
						},
						{
							type: "link",
							name: "Link 3 (stackoverflow.com)",
							href: 'http://stackoverflow.com',
							icon: "icon-bike"
						},

					]
				}
			});

			control._searchfunctionCallBack = function (searchkeywords) {
				if (!searchkeywords) {
					searchkeywords = "The search call back is clicked !!"
				}
				alert(searchkeywords);
			}

			map.addControl(control);
		});

		function button2_click() {
			alert('button 2 clicked !!!');

		}

	</script>
    <script>
    function getControlHrmlContent(){
        return'<div id="controlbox" ><div id="boxcontainer" class="searchbox searchbox-shadow" > <div class="searchbox-menu-container"><button aria-label="Menu" id="searchbox-menubutton" class="searchbox-menubutton"></button> <span aria-hidden="true" style="display:none">Menu</span> </div><div><input id="searchboxinput" type="text" style="position: relative; height: 25px; font-size: 14px;" placeholder="Cari Perusahaan"/></div><div class="searchbox-searchbutton-container"><button aria-label="search" id="searchbox-searchbutton" class="searchbox-searchbutton"></button> <span aria-hidden="true" style="display:none;">search</span> </div></div></div><div class="panel"> <div class="panel-header"> <div class="panel-header-container"> <span class="panel-header-title"></span> <button aria-label="Menu" id="panelbutton" class="panel-close-button"></button> </div></div><div class="panel-content"> </div></div>'
    }
    function generateHtmlContent(a){
        for(var b='<ul class="panel-list">',d=0;d<a.Items.length;d++){
            var c=a.Items[d],b=b+'<li class="panel-list-item"><div>';"link"==c.type?(b+='<span class="panel-list-item-icon '+c.icon+'" ></span>',b+='<a href="'+c.href+'">'+c.name+"</a>"):"button"==c.type&&(b+='<span class="panel-list-item-icon '+c.icon+'" ></span>',b+='<button onclick="'+c.onclick+'">'+c.name+"</button>");b+="</li></div>"}return b+"</ul>"}
    function createSearchboxControl(){
        return L.Control.extend({_sideBarHeaderTitle:"Sample Title",_sideBarMenuItems:{Items:[{type:"link",name:"Link 1 (github.com)",href:"http://github.com",icon:"icon-local-carwash"},{type:"link",name:"Link 2 (google.com)",href:"http://google.com",icon:"icon-cloudy"},{type:"button",name:"Button 1",onclick:"alert('button 1 clicked !')",icon:"icon-potrait"},{type:"button",name:"Button 2",onclick:"alert('button 2 clicked !')",icon:"icon-local-dining"},{type:"link",name:"Link 3 (stackoverflow.com)",
    href:"http://stackoverflow.com",icon:"icon-bike"}],_searchfunctionCallBack:function(a){alert("calling the default search call back")}},options:{position:"topleft"},initialize:function(a){L.Util.setOptions(this,a);a.sidebarTitleText&&(this._sideBarHeaderTitle=a.sidebarTitleText);a.sidebarMenuItems&&(this._sideBarMenuItems=a.sidebarMenuItems)},onAdd:function(a){a=L.DomUtil.create("div");a.id="controlcontainer";var b=this._sideBarHeaderTitle,d=this._sideBarMenuItems,c=this._searchfunctionCallBack;$(a).html(getControlHrmlContent());
    setTimeout(function(){$("#searchbox-searchbutton").click(function(){var a=$("#searchboxinput").val();c(a)});$("#searchbox-menubutton").click(function(){$(".panel").toggle("slide",{direction:"left"},500)});$(".panel-close-button").click(function(){$(".panel").toggle("slide",{direction:"left"},500)});$(".panel-header-title").text(b);var a=generateHtmlContent(d);$(".panel-content").html(a)},1);L.DomEvent.disableClickPropagation(a);return a}})};
    </script>

</head>
<body style="top:0;left:0; right:0;bottom:0; position:absolute">
	<div id="maps" style="width:100%;height:100%"></div>
	
	<?php 
		$data = $dataJSON;
		
		$data_oke = json_decode($data);

		echo $data_oke->id;
		echo password_hash('12',PASSWORD_DEFAULT);

		
		$hasil = ((1*1) + (2*10) + (3*3) + (4*5) + (5*1))/20;
		echo '<br>';
		echo 5/2*100;
	?>
</body>

</html>
