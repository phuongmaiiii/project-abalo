<script>
export default {
    name: "ArtikelSuche",
    data(){
        return {
            searchTerm: '',
            articles: [],
            timeoutId: null
        }
    },
    mounted() {
        this.performSearch(); //load all the articles, when client opens the web
    },
    methods:{
        performSearch() {
            clearTimeout(this.timeoutId);
            /*
            //ktra phía client
            if (this.searchTerm.length < 3) {
                this.articles = [];
                return;
            }
            */
            this.timeoutId = setTimeout(() => {
                //if length < 3 -> return all articles
                const query = this.searchTerm.length < 3 ? '' : this.searchTerm;
                const xhr = new XMLHttpRequest();
                // encodeURIComponent() will encode this string to be URI safe (avoid errors if there are spaces...)
                xhr.open("GET", `/api/articles?search=${encodeURIComponent(query)}`, true);

                xhr.onload = () => {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        const res = JSON.parse(xhr.responseText);
                        this.articles = res.data;
                    } else {
                        console.error("Fehler beim Laden der Artikel:", xhr.statusText);
                    }
                };
                xhr.onerror = () => {
                    console.error("Netzwerkfehler beim Laden der Artikel");
                };
                xhr.send();
            }, 300);
        },
        formatPrice(value) {
            return (value / 100).toFixed(2).replace('.', ',') + " €";
        },
        formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('de-DE') + ' ' + date.toLocaleTimeString('de-DE', { hour: '2-digit', minute: '2-digit' });
        }
    }
}
</script>

<template>
    <div id="app">
        <input v-model="searchTerm" @input="performSearch" placeholder="Artikel suchen..." />
        <hr>

        <p v-if="searchTerm.length >= 3 && articles.length === 0">Keine Ergebnisse gefunden.</p>
        <!-- Tabelle mit Artikeln -->
        <table border="1" class="article-table" style="width: 100%; border-collapse: collapse; border-color: #004080;">
            <thead>
            <tr style="background-color: #f0f0f0; color: #004080">
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
                <td><strong>{{ article.ab_name }}</strong></td>
                <td>{{ article.ab_description }}</td>
                <td>{{ formatPrice(article.ab_price) }}</td>
                <td>{{ formatDate(article.ab_createdate) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
