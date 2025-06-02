<script>
export default {
    name: "SiteFooter.vue"
}
</script>

<template>
    <footer class="footer">
        <small>&copy; 2025 Abalo - Nguyen development. All rights reserved.</small>
        <a href="#" @click.prevent="$emit('show-impressum')">Impressum</a>
    </footer>
</template>

<style scoped>
.footer {
    background: #eee;
    text-align: center;
    padding: 15px;
}
a {
    display: block;
    margin-top: 8px;
    color: #004080;
    text-decoration: underline;
    cursor: pointer;
}
</style>
