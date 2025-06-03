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
            timeoutId: null
        }
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
    </div>
</template>

<style scoped>
.add-to-cart {
    background-color: #004080;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 4px;
    cursor: pointer;
}

.add-to-cart:hover{
    background-color: #0d2b49;
}

.add-to-cart:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

</style>
