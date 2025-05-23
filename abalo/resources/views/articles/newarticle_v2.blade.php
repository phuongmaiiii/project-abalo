<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Neuer Artikel</title>
    @vite('resources/css/newarticle.css')
    @vite('resources/css/homepage.css')
    @vite('resources/js/newarticle.js')

</head>
<body>
@include('partials.navbar')
<h1 style="color: cadetblue; text-align: center">Neuen Artikel eingeben</h1>
<div id="result"></div>
</body>
</html>

