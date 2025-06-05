<script>
export default {
    name: "ArtikelSuche",
    props: {
        cartItems: Array,
        shoppingcartid: Number,
    },
    emits: ['update-cart', 'update-cart-id'],
    data(){
        return {
            searchTerm: '',
            articles: [],
            timeoutId: null,
            page: 1,
            pageSize: 5,
            totalArticles: 0
        };
    },
    mounted() {
        this.performSearch(); //load all the articles on start
        this.fetchCart(); // load cart in init
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
                const offset = (this.page - 1) * this.pageSize;
                const xhr = new XMLHttpRequest();
                // encodeURIComponent() will encode this string to be URI safe (avoid errors if there are spaces...)
                xhr.open("GET", `/api/articles?search=${encodeURIComponent(query)}&&limit=${this.pageSize}&&offset=${offset}`, true);

                xhr.onload = () => {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        const res = JSON.parse(xhr.responseText);
                        this.articles = res.data;
                        this.totalArticles = res.total;
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
        },
        fetchCart() {
            fetch('/api/shoppingcart', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(res => res.json())
                .then(data => {
                    this.$emit('update-cart', data.items);
                    this.$emit('update-cart-id', data.shoppingcartid);
                    console.log("Items: "+ JSON.stringify(data.items, null,2));
                    console.log("ShoppingCartId: "+data.shoppingcartid);
                });
        },
        addToCart(article) {
            fetch('/api/shoppingcart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ ab_article_id: article.id })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.fetchCart(); // update cart from server
                    }
                });
        },
        goToPage(pageNumber) {
            if(pageNumber <1 || pageNumber > this.totalPages) return;
            this.page = pageNumber;
            this.performSearch();
        }
    },
    computed: {
        totalPages(){
            return Math.ceil(this.totalArticles / this.pageSize);
        }
    },
    //reactive data -> execute a callback funtion when that data changes
    watch: {
        searchTerm() {
            this.page = 1; // mỗi khi search term đổi, quay lại trang 1
            this.performSearch();
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
                <th>Aktion</th>
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
                <td>
                    <button class="add-to-cart" :disabled="Array.isArray(cartItems) && cartItems.some(i => i.ab_article_id == article.id)" @click="addToCart(article)">+</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button :disabled="page === 1" @click="goToPage(page - 1)">← Zurück</button>
            <span>Seite {{ page }} von {{ totalPages }}</span>
            <button :disabled="page === totalPages" @click="goToPage(page + 1)">Weiter →</button>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    @use '../../scss/articlelist'
</style>
