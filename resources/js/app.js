require('./bootstrap');
require('./algolia');
require('./tomTom');

// require('./search');

var $ = require('jquery');
var Handlebars = require("handlebars");

$(document).ready(function() {

  $(document).on('click', 'i', function(){
    $('#mymap').hide(250);


  });


  function getApartments(rooms, beds, baths, square_meters, city) {
    $.ajax({
      url: 'http://127.0.0.1:8000/api/apartments',
      method: 'GET',
      data: {
        'rooms': rooms,
        'beds': beds,
        'baths': baths,
        'square_meters': square_meters,
        'city': city,
  		},
      success: function (data) {
        console.log(data);

      },
      error: function () {
        alert ('Ops qualcosa e andato storto');

      }
    })
  };

  console.log(getApartments(1, 2, 1, 50,palermo));





});
