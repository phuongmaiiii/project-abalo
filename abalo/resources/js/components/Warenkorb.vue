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
                <button @click="removeItem(item.ab_article_id)">-</button>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.cart-section {
    margin-bottom: 30px;
    padding: 15px;
    background-color: #f0f0f0;
    border-radius: 8px;
    border: 1px solid #004080;
}

.cart-list {
    list-style: none;
    padding-left: 0;
}

.cart-list li {
    background-color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    margin-bottom: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-list button {
    background-color: #f44336;
    color: #fff;
    border: none;
    padding: 4px 8px;
    border-radius: 4px;
    cursor: pointer;
}

.cart-list button:hover {
    background-color: #c62828;
}
</style>
