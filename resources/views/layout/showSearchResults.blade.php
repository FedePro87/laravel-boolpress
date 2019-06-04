<table border="1">
  <tr>
    <th>Autore</th>
    <th>Titolo</th>
    <th>Categorie</th>
    <th>Contenuto</th>
  </tr>
  @foreach ($results as $result)
    <tr>
      <td>{{$result->user->name}}</td>
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
