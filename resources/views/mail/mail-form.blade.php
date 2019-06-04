@extends('structure')

@section('content')
  @guest
    <h1>Devi essere loggato per inviare una mail!!!</h1>
  @else
    <div class="send-mail">
      <h1>Send mail</h1>
      <form action="{{route('sendMail')}}" method="post">
        @csrf
        @method('POST')
        <div>
          <label for="title">Title:</label>
          <input type="text" name="title" value="">
        </div>
        <div>
          <label for="description">Description:</label>
          <input type="text" name="description" value="">
        </div>
        <button type="submit">SEND MAIL</button>
      </form>
    </div>
  @endguest
@stop
