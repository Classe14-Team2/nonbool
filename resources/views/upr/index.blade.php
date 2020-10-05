@extends('layouts.app')

@section('content')

  <h1>Benvenuto {{ $user_auth->name }} questa e la tua homepage(o dashboard)</h1>
  <div class="">
    <h3>clicca <a href="{{route('upr.apartments.index')}}">qui</a> per vedere i tuoi appartamenti </h3>

  </div>
  <div class="">
    <h2>Hai <a href="{{route('upr.messages.index')}}">1</a>  nuovo messaggio da leggere </h2>
  </div>
  <div class="">
    <h3>clicca <a href="#">qui</a> per vedere le tue statistiche </h3>

  </div>

  <a href="{{ route('upr.apartments.create') }}">Crea un nuovo appartamento</a>
  oppure
  <a href="{{ route('apartments.index') }}">Visita gli appartamenti già presenti</a>

  @endsection
