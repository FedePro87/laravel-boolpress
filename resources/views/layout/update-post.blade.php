@extends('structure')

@section('content')
  <div class="update">
    <form action="{{route('posts.update',$post->id)}}" method="post">
      @csrf
      @method('PATCH')
      <div>
        <label for="author">Autore</label>
        <input type="text" name="author" value="{{$post->author}}">
      </div>
      <div>
        <label for="title">Titolo</label>
        <input type="text" name="title" value="{{$post->title}}">
      </div>
      <div>
        <label for="content">Contenuto</label>
        <input type="text" name="content" value="{{$post->content}}">
      </div>
      <div>
        <label for="category">Categorie</label><br>
        @foreach ($categories as $category)
          <input type="checkbox" name="categories[]" value={{$category->id}}
          @foreach ($post->categories as $postCategory)
            @if ($category->category_name==$postCategory->category_name)
              {{'checked'}}
            @endif
          @endforeach
          > {{$category->category_name}}
        @endforeach
      </div>
      <button type="submit" name="">Update post!</button>
    </form>
  </div>
@stop
