@section('content')
<h1 style="text-align: center; color: cadetblue">Artikelübersicht</h1>

<!-- 🛒 Warenkorb -->
<div class="cart-section">
    <h2>🛒 Dein Warenkorb</h2>
    <ul id="cart" class="cart-list"></ul>
</div>
<!-- Suchformular -->
<form id="suche" method="GET" action="{{ url('/articles') }}">
    <input id="input-suche" type="text" name="search" placeholder="Artikel suchen..." value="{{ request('search') }}"> <!--der eingegebene Suchbegriff nach dem Senden im Feld stehen bleibt-->
    <button id="button-suche" type="submit">Suchen</button>
</form>

<!-- Tabelle mit Artikeln -->
<table border="1" class="article-table" style="width: 100%; border-collapse: collapse; border-color: cadetblue;">
    <thead>
    <tr style="background-color: #f0f0f0;">
        <th>Bild</th>
        <th>Name</th>
        <th>Beschreibung</th>
        <th>Preis (€)</th>
        <th>Erstellt am</th>
        <th>Aktion</th>
    </tr>
    </thead>
    <tbody id="article-list">
    @foreach ($articles as $article)
        <tr class="article" data-id="{{ $article->id}}">
            <td>
                @php
                    $imagePath = "/articelimages/{$article->id}.jpg";
                @endphp
                @if(file_exists(public_path($imagePath)))
                    <img src="{{ asset($imagePath) }}" width="100" alt="bild">
                @else
                    Kein Bild
                @endif
            </td>
            <td><strong>{{ $article->ab_name }}</strong></td>
            <td>{{ $article->ab_description }}</td>
            <td class="price">{{ number_format($article->ab_price/100, 2, ',', '.') }} €</td>
            <td>{{ date('d.m.Y H:i', strtotime($article->ab_createdate)) }}</td>
            <td>
                <button class="add-to-cart">+</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script src="{{ asset('/js/cart.js') }}"></script>
@endsection
@extends('layouts.main')
@if(session('success'))
    <div style="
        background-color: #d4edda;
        color: #155724;
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 6px;
        border: 1px solid #c3e6cb;
        text-align: center;
        max-width: 600px;
        margin: 1rem auto;
    ">
        {{ session('success') }}
    </div>
@endif

