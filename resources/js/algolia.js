// require('./app');

  var places = require('places.js');
  var autocomplete = require('autocomplete.js');
  var apiAlgolia = 'pl72UD0E1RWC';
  var keyAlgolia = '6f2ccdf8214af2f289be15103d07cf1c';

  var placesAutocomplete = places({
    appId: apiAlgolia,
    apiKey: keyAlgolia,
    container: document.querySelector('#address-input')
  });


  placesAutocomplete.on('change', function resultSelected(e) {
    document.querySelector('#form-city').value = e.suggestion.city || '';
    document.querySelector('#form-country').value = e.suggestion.country || '';
    document.querySelector('#form-lat').value = e.suggestion.latlng.lat || '';
    document.querySelector('#form-lon').value = e.suggestion.latlng.lng || '';
    console.log(e.suggestion);
  });
