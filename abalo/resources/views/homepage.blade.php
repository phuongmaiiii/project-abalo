<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abalo</title>
    @vite('resources/css/homepage.css')
    @vite('resources/js/homepage.js')
    @vite('resources/js/cookiecheck.js')
    @vite('resources/js/app.js')
</head>
<body>
    <nav id="navbar">
        <img src="{{asset('/images/abalo.png')}}" alt="logo" class="logo">
    </nav>
    <main>
        <h1 style="text-align: center; color: cadetblue">Welcome to Abalo</h1>
        <div id="app">
            <input v-model="searchTerm" @input="performSearch" placeholder="Artikel suchen..." />
            <hr>

            <p v-if="searchTerm.length >= 3 && articles.length === 0">Keine Ergebnisse gefunden.</p>
            <!-- Tabelle mit Artikeln -->
            <table border="1" class="article-table" style="width: 100%; border-collapse: collapse; border-color: cadetblue;">
                <thead>
                <tr style="background-color: #f0f0f0;">
                    <th>Bild</th>
                    <th>Name</th>
                    <th>Beschreibung</th>
                    <th>Preis (€)</th>
                    <th>Erstellt am</th>
                </tr>
                </thead>
                <tbody id="article-list">
                <tr v-for="article in articles" :key="article.id">
                    <td>
                        <img v-if="article.has_image" :src="`/articelimages/${article.id}.jpg`" width="100" alt="bild" />
                        <span v-else>Kein Bild</span>
                    </td>
                    <td><strong>@{{ article.ab_name }}</strong></td>
                    <td>@{{ article.ab_description }}</td>
                    <td>@{{ formatPrice(article.ab_price) }}</td>
                    <td>@{{ formatDate(article.ab_createdate) }}</td>
                </tr>
                </tbody>
            </table>
        </div>

    </main>


</body>
</html>
