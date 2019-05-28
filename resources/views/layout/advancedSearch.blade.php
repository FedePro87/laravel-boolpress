@extends('structure')

@section('content')
  <div class="advanced-search">
    <form action="{{route('showAdvancedSearchResults')}}" method="get">
      @csrf
      <div>
        <label for="author">Autore</label>
        <input type="text" name="author" value="">
      </div>
      <div>
        <label for="title">Titolo</label>
        <input type="text" name="title" value="">
      </div>
      <div>
        <label for="content">Contenuto</label>
        <input type="text" name="content" value="">
      </div>
      <div>
        <label for="categories">Categorie</label><br>
        <select name="category">
          @foreach ($categories as $category)
            <option value={{$category->id}}> {{$category->category_name}}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" name="">Search post!</button>
    </form>
    @if (isset($results))
      @if (empty($results))
        <h1>Non ci sono risultati!</h1>
      @else
        <h1>Ci sono risultati!!!!</h1>
      @endif
    @else
      <h1>Non hai cercato nulla!</h1>
    @endif
  </div>
@stop
