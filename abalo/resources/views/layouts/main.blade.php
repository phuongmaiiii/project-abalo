<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Abalo</title>
    <link rel="stylesheet" href="{{ asset('/css/homepage.css') }}">
    <link rel="stylesheet" href="{{asset('/css/cart.css')}}">
</head>
<body>
@include('partials.navbar')

<main>
    @yield('content')
</main>

</body>
</html>
