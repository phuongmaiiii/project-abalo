import './bootstrap';
import {pi, round} from 'mathjs';
import {createApp} from 'vue';

createApp({
    data(){
        return {
            searchTerm: '',
            articles: [],
            timeoutId: null
        }
    },
    methods:{
        performSearch() {
            clearTimeout(this.timeoutId);
            //ktra phía client
            if (this.searchTerm.length < 3) {
                this.articles = [];
                return;
            }

            this.timeoutId = setTimeout(() => {
                const xhr = new XMLHttpRequest();
                // encodeURIComponent() will encode this string to be URI safe (avoid errors if there are spaces...)
                xhr.open("GET", `/api/articles?search=${encodeURIComponent(this.searchTerm)}`, true);

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
}).mount('#app');


//
alert(round(pi, 2));


