<script>
import Impressum from "./Impressum.vue";
import ArtikelSuche from "./ArtikelSuche.vue";

export default {
    name: "SiteBody.vue",
    props: {
        showImpressum: {
            type: Boolean,
            default: false,
        }
    },
    components: {Impressum, ArtikelSuche}
}
</script>

<template>
    <main class="main">
        <Impressum v-if="showImpressum" @zurueck="$emit('zurueck')" />
        <template v-else>
            <h1 style="text-align: center; color: #004080">Welcome to Abalo</h1>
            <ArtikelSuche />
        </template>
    </main>
</template>

<style scoped>
.main {
    flex: 1;
    padding: 20px;
}
</style>
