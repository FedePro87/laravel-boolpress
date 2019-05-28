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
        <table border="1">
          <tr>
            <th>Autore</th>
            <th>Titolo</th>
            <th>Categorie</th>
            <th>Contenuto</th>
          </tr>
          @foreach ($results as $result)
            <tr>
              <td>{{$result->author}}</td>
              <td>{{$result->title}}</td>
              <td>
                @foreach ($result->categories as $category)
                  {{$category->category_name}}
                @endforeach
              </td>
              <td>{!!$result->content!!}</td>
            </tr>
          @endforeach
        </table>
      @endif
    @else
      <h1>Non hai cercato nulla!</h1>
    @endif
  </div>
@stop
