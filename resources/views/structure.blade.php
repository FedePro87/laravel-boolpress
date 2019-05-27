<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</head>
<body>
  <div class="wrapper">
    @include('layout.header')
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @yield('content')
    @include('layout.footer')
  </div>
</body>
</html>
