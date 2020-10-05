// require('./app');

import tt from '@tomtom-international/web-sdk-maps';

import tts from '@tomtom-international/web-sdk-services';

var madrid = [-3.703790,40.416775];

var keyTomTom = 'w7lk4ZC9OYOkfawksaGrc64OmDI3LAAH';

var map = tt.map({
  key: keyTomTom,
  container: document.getElementById('mymap'),
  center: madrid,
  zoom: 12,
  style: "tomtom://vector/1/basic-main"
});

function handleResults(result) {

  if (result.results) {
    moveMap(result.results[0].position);
    var ll = new tt.LngLat(-73.9749, 40.7736);
    ll.toBounds(100).toArray();
    console.log(ll); // = [[-73.97501862141328, 40.77351016847229], [-73.97478137858673, 40.77368983152771]]
    var marker = new tt.Marker().setLngLat(result.results[0].position).addTo(map)
    var markerHeight = 50, markerRadius = 10, linearOffset = 25;
    var popupOffsets = {
     'top': [0, 0],
      'top-left': [0,0],
      'top-right': [0,0],
      'bottom': [0, -markerHeight],
      'bottom-left': [linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
      'bottom-right': [-linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
      'left': [markerRadius, (markerHeight - markerRadius) * -1],
      'right': [-markerRadius, (markerHeight - markerRadius) * -1]
      };
    var popup = new tt.Popup({offset: popupOffsets, className: 'my-class'}).setLngLat(result.results[0].position).setHTML("<span>ciao</span>").addTo(map);

  }
};

function moveMap(lnglat) {
  map.flyTo({
    center: lnglat,
    zoom: 14
  })
};

function search(query) {
  tts.services.fuzzySearch ({
    key: keyTomTom,
    query: query

  }).go().then(handleResults)
};

$('#address-input').on('change', function(){
  search($(this).val());
});
