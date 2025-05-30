<script setup>
import SiteHeader from "../components/SiteHeader.vue";
import SiteBody from "../components/SiteBody.vue";
import SiteFooter from "../components/SiteFooter.vue";
</script>

<template>
    <div class="wrapper">
        <SiteHeader />
        <SiteBody />
        <SiteFooter />
    </div>
</template>

<style scoped>
.wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
</style>
