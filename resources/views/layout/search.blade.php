@extends('structure')

@section('content')
  @guest
    <h1>Devi essere loggato per vedere i post!!!</h1>
  @else
    <div class="search">
      @include('layout/showSearchResults')
    </div>
  @endguest
@stop
