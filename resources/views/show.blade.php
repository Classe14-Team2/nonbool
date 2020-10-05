@extends('layouts.app')

@section('content')

  <h1>Appartamento {{ $apartment->id }}</h1>

  <div class="">
    <ul>
      <li><h3>Titolo:</h3>{{ $apartment->title }}</li>
      <li><h3>Descrizione:</h3>{{ $apartment->description }}</li>
      <li><h3>Stanze:</h3>{{ $apartment->rooms }}</li>
      <li><h3>Letti:</h3>{{ $apartment->beds }}</li>
      <li><h3>Bagni:</h3>{{ $apartment->baths }}</li>
      <li><h3>Mq:</h3>{{ $apartment->square_meters }}</li>
      <li><h3>Indirizzo:</h3>{{ $apartment->address }}</li>
      <li><h3>Latitudine:</h3>{{ $apartment->lat }}</li>
      <li><h3>Longitudine:</h3>{{ $apartment->lon }}</li>
      <li><h3>Prezzo:</h3>{{ $apartment->price }} €</li>
      <li><img src=" {{ asset('storage') . '/' . $apartment->image }} " alt="{{$apartment->title}}"></li>
      <li><h3>Proprietario:</h3>{{ $apartment->user->name }}</li>
      <li><h3>Città:</h3>{{ $apartment->city }}</li>
      <li><h3>Stato:</h3>{{ $apartment->country }}</li>
    </ul>
  </div>


@php
$isUserAuth = isset($user_auth);
@endphp

  {{-- <input type="text" hidden id="address-input" name="" value=""> --}}
  <div id="mymap" style="width:700px; height:700px;" ></div>
    <script type="text/javascript">
    var keyTomTom = 'w7lk4ZC9OYOkfawksaGrc64OmDI3LAAH';

    var apartment = [{{$apartment->lon}},{{$apartment->lat}}];

    var map = tt.map({
      key: keyTomTom,
      container: document.getElementById('mymap'),
      center: apartment,
      zoom: 12,
      style: "tomtom://vector/1/basic-main"
    });
    var marker = new tt.Marker().setLngLat(apartment).addTo(map);
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
    var popup = new tt.Popup({offset: popupOffsets, className: 'my-class'}).setLngLat(apartment).setHTML("{{$apartment->title}}").addTo(map);

    </script>


@if ($isUserAuth === false || $user_auth->id !== $apartment->user_id)
  <div class="">
    <form class="" action="{{ route('message.store' , $apartment) }}" method="post">
      @csrf
      @method('POST')

      <div>
        <input  type="hidden" name="apartment_id" value= {{ $apartment->id }}>
      </div>

      <div>
        <label for="email">Email</label>
        <input  type="email" name="email" value= '' placeholder="Inserisci la mail">
      </div>

      <div>
        <label for="content">Content</label>
        <textarea name="content" rows="8" cols="80" placeholder="Inserisci il messaggio"></textarea>
      </div>

      <div>
        <input type="submit" name="" value="Send">
      </div>

    </form>
  </div>
@else
  @if ($user_auth->id === $apartment->user_id)
    <a href="{{ route('upr.messages.index') }}">Leggi i messaggi ricevuti</a>
  @endif
@endif

  <a href="{{ route('search') }}">Torna alla ricerca</a>

@endsection
