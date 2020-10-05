@extends('layouts.app')

@section('content')

  <h1>Ecco i tuoi appartamenti registrati</h1>

  <a href="{{ route('upr.apartments.create') }}">Crea un nuovo appartamento</a>
  oppure
  <a href="{{ route('apartments.index') }}">Visita gli appartamenti già presenti</a>

  @foreach ($apartments as $apartment)
    @if ($user->id == $apartment->user_id)
      <div class="">
        <h2>
          <a href="{{route('upr.apartments.show', $apartment)}}">Appartamento {{ $apartment->id }}</a>
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
        <div>
          <form class="delete" action="{{ route('upr.apartments.destroy', $apartment) }}" method="post">
          @csrf
          @method('DELETE')
            <input type="submit" value="Elimina">
          </form>
        </div>
      </div>
    @endif
  @endforeach

@endsection
