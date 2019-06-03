@extends('structure')

@section('content')
  @guest
    <h1>Devi essere loggato per vedere i post!!!</h1>
  @else
    <div class="read">
      <table border="1">
        <tr>
          <th>Post</th>
          <th>Autore</th>
          <th>Titolo</th>
          <th>Categorie</th>
          <th>Contenuto</th>
          <th>Modifica</th>
          <th>Elimina</th>
        </tr>
        @foreach ($posts as $post)
          <tr>
            <td>
              <a href="{{route('postShow',$post->id)}}">
                {{$post->id}}
              </a>
            </td>
            <td>
              {{$post->author->author_name}}
            </td>
            <td>{{$post->title}}</td>
            <td>
              @foreach ($post->categories as $category)
                <a href="{{route('getPostByCategory', $category->category_name)}}">
                  {{$category->category_name}}
                </a>
              @endforeach
            </td>
            <td>{!!$post->content!!}</td>
            <td>
              <a href="{{route('adminPostEdit',$post->id)}}">
                <i class="fas fa-edit"></i>
              </a>
            </td>
            <td>
              <a href="{{route('adminPostDelete',$post->id)}}">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
    <a href="{{route('adminPostCreate')}}">Crea un nuovo post!</a><br>
    <a href="{{route('showAdvancedSearchResults')}}">Ricerca avanzata post</a>
    <div id="app"></div>
  @endguest
@stop
