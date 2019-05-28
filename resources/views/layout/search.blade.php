@extends('structure')

@section('content')
  <div class="search">
    <table border="1">
      <tr>
        <th>Autore</th>
        <th>Titolo</th>
        <th>Categorie</th>
        <th>Contenuto</th>
      </tr>
      @foreach ($relatedPosts as $relatedPost)
        <tr>
          <td>{{$relatedPost->author}}</td>
          <td>{{$relatedPost->title}}</td>
          <td>
            @foreach ($relatedPost->categories as $category)
              {{$category->category_name}}
            @endforeach
          </td>
          <td>{!!$relatedPost->content!!}</td>
        </tr>
      @endforeach
    </table>
  </div>
@stop
