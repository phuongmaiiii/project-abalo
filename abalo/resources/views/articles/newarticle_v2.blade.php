<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Neuer Artikel</title>
    <link rel="stylesheet" href="{{ asset('/css/newarticle.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/homepage.css') }}">

</head>
<body>
@include('partials.navbar')
<h1 style="color: cadetblue; text-align: center">Neuen Artikel eingeben</h1>
<div id="result"></div>
<script src="{{ asset('/js/newarticle.js') }}"></script>
</body>
</html>

