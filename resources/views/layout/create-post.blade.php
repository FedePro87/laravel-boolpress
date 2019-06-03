@extends('structure')

@section('content')
  @guest
    <h1>Devi essere loggato per creare post!!!</h1>
  @else
    <div class="create">
      <form action="{{route('posts.store')}}" method="post">
        @csrf
        <div>
          <label for="title">Titolo</label>
          <input type="text" name="title" value="">
        </div>
        <div>
          <label for="content">Contenuto</label>
          <input type="text" name="content" value="">
        </div>
        <div>
          <label for="category">Categorie</label><br>
          @foreach ($categories as $category)
            <input type="checkbox" name="categories[]" value={{$category->id}}> {{$category->category_name}}
          @endforeach
        </div>
        <button type="submit" name="">Submit new post!</button>
      </form>
    </div>
  @endguest
@stop
