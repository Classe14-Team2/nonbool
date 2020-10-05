function cerca() {
  var getInput = document.querySelector('#address').value;

}

(function() {
  var placesAutocomplete = places({
  appId: 'pl72UD0E1RWC',
  apiKey: '6f2ccdf8214af2f289be15103d07cf1c',
  container: document.querySelector('#address')
});
})();

localStorage.getItem("storageName");

var place = document.querySelector('#address').value = localStorage.getItem("storageName");
