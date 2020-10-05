@extends('layouts.app')

@section('content')


   <div class="content">
      <div class="title m-b-md">
          Dove vuoi andare
          <i id="SearchIcon" class="fa fa-search" aria-hidden="true"></i>
          <input type="search" id="address-input" placeholder="Where are we going?" />
          <div class="text-center">
            <div id="mymap" style="width:700px; height:700px;" ></div>
          </div>

      </div>
  </div>

@endsection


{{-- @push('child-scripts')
  <script type="text/javascript" src="{{asset('js/algolia.js')}}" > </script>
@endpush --}}
