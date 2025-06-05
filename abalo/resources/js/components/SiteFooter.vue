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

<style lang="scss" scoped>
    @use'../../scss/footer'
</style>
