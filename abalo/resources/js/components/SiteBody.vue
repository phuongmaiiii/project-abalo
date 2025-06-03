<script>
import Impressum from "./Impressum.vue";
import ArtikelSuche from "./ArtikelSuche.vue";
import Warenkorb from "./Warenkorb.vue";

export default {
    name: "SiteBody.vue",
    props: {
        showImpressum: {
            type: Boolean,
            default: false,
        }
    },
    components: {Impressum, ArtikelSuche, Warenkorb},
    data(){
        return {
            cartItems: [],
            shoppingcartid: null
        };
    },
    methods: {
        updateCart(items) {
            if(!Array.isArray(items)){
                console.warn("Received invalid cart items, defaulting to []", items);
                this.cartItems = [];
            } else {
                this.cartItems = items;
            }
        },
        updateCartId(id) {
            this.shoppingcartid = id;
        }
    }
}
</script>

<template>
    <main class="main">
        <Impressum v-if="showImpressum" @zurueck="$emit('zurueck')" />
        <template v-else>
            <h1 style="text-align: center; color: #004080">Welcome to Abalo</h1>
            <Warenkorb
                :cart-items="cartItems"
                :shoppingcartid="shoppingcartid"
                @update-cart="updateCart"
            />
            <ArtikelSuche
                :cart-items="cartItems"
                :shoppingcartid = "shoppingcartid"
                @update-cart="updateCart"
                @update-cart-id="updateCartId"
            />
        </template>
    </main>
</template>

<style scoped>
.main {
    flex: 1;
    padding: 20px;
}
</style>
