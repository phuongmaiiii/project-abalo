<script>
export default {
    name: "Warenkorb",
    props: {
        cartItems: Array,
        shoppingcartid: Number
    },
    emits: ['update-cart'],
    methods: {
        removeItem(articleId) {
            fetch(`/api/shoppingcart/${this.shoppingcartid}/articles/${articleId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.$emit('update-cart', Array.isArray(data.items) ? data.items : []); // emit updated list
                    }
                });
        }
    }
}
</script>

<template>
    <div class="cart-section">
        <h2>🛒 Dein Warenkorb</h2>
        <ul id="cart" class="cart-list">
            <li v-for="item in cartItems" :key="item.ab_article_id">
                {{item.ab_name}}
                <button class="remove-button" @click="removeItem(item.ab_article_id)">-</button>
            </li>
        </ul>
    </div>
</template>

<style lang="scss" scoped>
    @use '../../scss/warenkorb';
</style>
