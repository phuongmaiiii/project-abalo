<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ABALO</title>
        @vite('resources/js/app.js')
    </head>
    <body>
        <div id="app">
            <input v-model="searchTerm" @input="performSearch" placeholder="Artikel suchen...">
            <ul>
                <li v-for="article in articles" :key="article.id">@{{article.ab_name}}</li>
            </ul>
        </div>
    </body>
</html>
