@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="title m-b-md">
            HOME PAGE CON L INPUT DI RICERCA
            <div class="">

                <div class="">
                  <input type="search" id="address" class="form-control" placeholder="Where are we going?" />
                </div>
                <div class="">
                  <input id="roomSelected" type="number" name="rooms" value="">
                  <label for="beds"> Numero di stanze </label>
                </div>
                <div class="">
                  <input type="number" name="beds" value="">
                  <label for="beds"> Numero di posti letto </label>
                </div>
                <div class="">
                  <select class="" name="radius">
                    <option value="20">20Km</option>
                    <option value="40">40km</option>
                    <option value="60">60Km</option>
                    <option value="80">80Km</option>
                    <option value="100">100Km</option>
                  </select>
                </div>
                <div class="">
                  @foreach ($services as $service)
                    <input type="checkbox" id="service" name="services[]" value="{{ $service->id }}">
                    <label for="service"> {{ $service->type }} </label>
                  @endforeach
                </div>
                <div class="">
                  <button onclick="loadCitta()">Cerca</button>
                </div>
            </div>
        </div>
        <div id="apartment_list"></div>
      </div>
    </div>
  </div>

{{-- JS --}}



  <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>


  <script id="apartment-template" type="text/x-handlebars-template">
    <div >
      <h2> <a href="/apartments/@{{ id }}">Titolo : @{{ title }}</a> </h2>
      <ul>
       <li>Descrizione : @{{ description }}</li>
       <li>Indirizzo : @{{ address }}</li>
       <li><img src=" {{ asset('storage') . '/'}}@{{{image}}} " alt=""></li>
      </ul>
    </div>
  </script>

  <script>
  function loadCitta() {
    var citta = $('#address').val();
    $('#apartment_list').html('');
      $.ajax({
        url: 'https://places-dsn.algolia.net/1/places/query?query=' + citta,
        method: 'GET',
        success: function(data) {
          var coord = data.hits[0]._geoloc;
          var lat = coord.lat;
          var lng = coord.lng;
          searchCitta(lat, lng);
        },
        error: function() {
        }
      });
  }

  function searchCitta(lat, lng) {
    $.ajax(
      {
        url: 'http://localhost:8000/api/apisearch',
        method: 'GET',
        success: function(dataResponse) {
          console.log(dataResponse.apartments[0].id);

          var allApartments = dataResponse.apartments;
          var searchResult =[];
          var errore = '<h2>Nessun appartamento presente</h2>';

          var source = $("#apartment-template").html();
          var template = Handlebars.compile(source);

          for (var i = 0; i < allApartments.length; i++) {
            var thisApartment = allApartments[i];
            if(lat == thisApartment.lat && lng == thisApartment.lon) {
              console.log(thisApartment.id);
              if (thisApartment.rooms != $("#roomSelected").val()) {
                console.log('stanza ok');
              } else {
                console.log('stanza non ok');
              }

              searchResult.push(thisApartment);
              var html = template(thisApartment);
              $('#apartment_list').append(html);
            } else {

            }
          }
          if (searchResult.length == 0) {
            $('#apartment_list').append(errore);
          }
        },
        error: function() {
          alert('error');
        }
      }
    );
  }
  </script>

@endsection
