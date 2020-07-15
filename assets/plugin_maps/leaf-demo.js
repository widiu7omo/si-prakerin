// See post: http://asmaloney.com/2015/06/code/clustering-markers-on-leaflet-maps

var map = L.map( 'map', {
  center: [10.0, 5.0],
  minZoom: 2,
  zoom: 2
});

L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
 attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
 subdomains: ['a','b','c']
}).addTo( map );


var markerClusters = L.markerClusterGroup();

for ( var i = 0; i < markers.length; ++i ){
  var popup = markers[i].name +
              '<br/>' + markers[i].city +
              '<br/><b>IATA/FAA:</b>' + markers[i].iata_faa +
              '<br/><b>ICAO:</b>' + markers[i].icao +
              '<br/><b>Altitude:</b>' + Math.round( markers[i].alt * 0.3048 ) + ' m' +
              '<br/><b>Timezone:</b>' + markers[i].tz;

  var m = L.marker([markers[i].lat, markers[i].lng],)
	.bindPopup( popup );
  markerClusters.addLayer( m );
}
map.addLayer( markerClusters );
