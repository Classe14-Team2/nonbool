@extends('layouts.app')

@section('content')

  <h1>Edit apartment</h1>
  {{-- Validazione form --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Add new car form --}}
  <form action="{{route('upr.apartments.update', $apartment)}}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')

    <div>
      <label for="title">Title:</label><br>
      <input type="text" name="title" value="{{ ($apartment->title) ? $apartment->title : old('title') }}" placeholder="Inserisci il titolo">
    </div>

    <div>
      <label for="description">Description:</label><br>
      <textarea name="description" rows="8" cols="80" placeholder="Inserisci la descrizione">{{ ($apartment->description) ? $apartment->description : old('description') }}</textarea>
    </div>

    <div>
      <label for="rooms">Rooms:</label><br>
      <input type="number" name="rooms" value="{{ ($apartment->rooms) ? $apartment->rooms : old('rooms') }}" placeholder="Inserisci il numero di stanze">
    </div>

    <div>
      <label for="beds">Beds:</label><br>
      <input type="number" name="beds" value="{{ ($apartment->beds) ? $apartment->beds : old('beds') }}" placeholder="Inserisci il numero di letti">
    </div>

    <div>
      <label for="baths">Baths:</label><br>
      <input type="number" name="baths" value="{{ ($apartment->baths) ? $apartment->baths : old('baths') }}" placeholder="Inserisci il numero di bagni">
    </div>

    <div>
      <label for="square_meters">Square meters:</label><br>
      <input type="number" name="square_meters" value="{{ ($apartment->square_meters) ? $apartment->square_meters : old('square_meters') }}" placeholder="Inserisci i mq">
    </div>

    <div>
      <label for="address">Address:</label><br>
      <input name="address" type="search" id="address-new" class="form-control" placeholder="Inserisci l'indirizzo" value="{{ old('address')}}" required/>
    </div>

    <div>
      <input id="lat" type="hidden" name="lat">
    </div>

    <div>
      <input id="lon" type="hidden" name="lon">
    </div>

    <div class="chekboxes">
      <span>Services:</span>
      @foreach ($services as $service)
        <div>
          <input type="checkbox" name="services[]" value="{{ $service->id }}" {{($apartment->services->contains($service)) ? 'checked' : ''}}>
          <label>{{$service->type}}</label>
        </div>
      @endforeach
    </div>

    <div>
      <label for="image">Upload image</label>
      <input type="file" name="image" accept="image/*" required>
    </div>

    <div>
      <input type="submit" name="" value="save">
    </div>
  </form>

  <a href="{{ route('upr.apartments.index') }}">Torna alla lista</a>


@endsection
