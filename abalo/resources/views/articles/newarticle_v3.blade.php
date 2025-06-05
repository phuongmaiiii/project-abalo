<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Neuer Artikel</title>
    @vite('resources/css/newarticle.css')
    @vite('resources/css/homepage.css')
    @vite('resources/js/vue/newarticle.js')
</head>
<body>
@include('partials.navbar')
<h1 style="color: cadetblue; text-align: center">Neuen Artikel eingeben</h1>
<div id="app">
    <form @submit.prevent="submitForm">
        <label>Artikelname *:</label>
        <input type="text" v-model="form.name" required>

        <br>

        <label>Preis (€) *:</label>
        <input type="number" v-model.number="form.price" step="0.01" min="0.01" required>

        <br>

        <label>Beschreibung:</label>
        <textarea v-model="form.description"></textarea>

        <br>

        <p v-if="successMessage" style="color: green;">@{{successMessage}}</p>
        <p v-if="errorMessage" style="color: red;">@{{errorMessage}}</p>

        <br>

        <button type="submit">Speichern</button>

        <br>

        <p style="font-style: italic; font-size: 0.9em;">(Note: * ist Pflichtfeld)</p>

    </form>

</div>
</body>
</html>

