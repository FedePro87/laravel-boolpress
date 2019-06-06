@extends('structure')

@section('content')
  @guest
    <h1>Devi essere loggato per vedere i post!!!</h1>
  @else
    <div class="read">
      {{-- <table border="1">
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
              {{$post->user->name}}
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
      </table> --}}
      @include ('components.post-card')

      <div class="container-fluid">
        <div id="component-vue" class="row flex-wrap">
          @foreach ($posts as $post)
            <post-card post-id="{{$post->id}}" title="{{$post->title}}" content="{{$post->content}}" author="{{$post->user->name}}" likes="{{$post->likes}}"></post-card>
          @endforeach
        </div>
      </div>
    </div>
    <a href="{{route('adminPostCreate')}}">Crea un nuovo post!</a><br>
    <a href="{{route('showAdvancedSearchResults')}}">Ricerca avanzata post</a>
    <div id="app"></div>

    <a href="{{route('showMailForm')}}">Contattaci!</a>
  @endguest
@stop
