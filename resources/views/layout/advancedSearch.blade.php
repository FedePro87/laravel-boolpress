@extends('structure')

@section('content')
  <div class="advanced-search">
    <form action="{{route('showAdvancedSearchResults')}}" method="get">
      @csrf
      <div>
        <label for="author">Autore</label>
        <select name="author_id">
          @foreach ($authors as $author)
            <option value="{{$author->id}}"
              @if(isset($searchedAuthor))
                @if($author->id==$searchedAuthor)
                  {{'selected'}}
                @endif
              @endif
              >{{$author->author_name}}</option>
          @endforeach
        </select>
        {{-- <input type="text" name="author" @if(isset($author))@if($author!="")value={{$author}}@endif @endif> --}}
        </div>
        <div>
          <label for="title">Titolo</label>
          <input type="text" name="title" @if(isset($title))@if($title!="")value={{$title}}@endif @endif>
          </div>
          <div>
            <label for="content">Contenuto</label>
            <input type="text" name="content" @if(isset($content))@if($content!="")value={{$content}}@endif @endif>
            </div>
            <div>
              <label for="categories">Categoria</label><br>
              <select name="category_id">
                @foreach ($categories as $category)
                  <option value={{$category->id}}
                    @if (isset($searchedCategory))
                      @if ($searchedCategory==$category->id))
                        {{"selected"}}
                      @endif
                    @endif
                    > {{$category->category_name}}</option>
                  @endforeach
                </select>
              </div> <br>
              <button type="submit" name="">Search post!</button>
            </form><br>
            @if (isset($results))
              @if (empty($results))
                <h1>Non ci sono risultati!</h1>
              @else
                @include('layout.showSearchResults')
              @endif
            @else
              <h1>Immetti dei parametri di ricerca...</h1>
            @endif
          </div>
        @stop
