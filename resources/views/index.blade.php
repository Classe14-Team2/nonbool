@extends('layouts.app')

@section('content')

  <h1>Benvenuto</h1>

  @foreach ($apartments as $apartment)
    <div class="">
      <h2>
        <a href="{{route('apartments.show', $apartment)}}">Appartamento {{ $apartment->id }}</a>
      </h2>
      <ul>
        <li>
          <h3>Titolo:</h3>
          {{ $apartment->title }}
        </li>
        <li>
          <h3>Prezzo:</h3>
          {{ $apartment->price }} €
        </li>
        <li>
          <img src=" {{ asset('storage') . '/' . $apartment->image }} " alt="{{$apartment->title}}">
        </li>
        <li>
          <h3>Città:</h3>
          {{ $apartment->city }}
        </li>
        <li>
          <h3>Stato:</h3>
          {{ $apartment->country }}
        </li>
      </ul>
    </div>
  @endforeach

@endsection
