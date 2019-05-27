@extends('structure')

@section('content')
  <div class="create">
    <form action="{{route('posts.store')}}" method="post">
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
        <label for="category">Categorie</label><br>
        @foreach ($categories as $category)
          <input type="checkbox" name="categories[]" value={{$category->id}}> {{$category->category_name}}
        @endforeach
      </div>
      <button type="submit" name="">Submit new post!</button>
    </form>
  </div>
@stop
