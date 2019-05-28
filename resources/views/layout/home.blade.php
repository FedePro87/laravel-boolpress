@extends('structure')

@section('content')
  <div class="read">
    <table border="1">
      <tr>
        <th>Autore</th>
        <th>Titolo</th>
        <th>Categorie</th>
        <th>Contenuto</th>
      </tr>
      @foreach ($posts as $post)
        <tr>
          <td>{{$post->author->author_name}}</td>
          <td>{{$post->title}}</td>
          <td>
            @foreach ($post->categories as $category)
              {{$category->category_name}}
            @endforeach
          </td>
          <td>{!!$post->content!!}</td>
        </tr>
      @endforeach
    </table>
  </div>
@stop
