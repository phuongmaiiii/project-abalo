<script>
import Impressum from "./Impressum.vue";

export default {
    name: "SiteBody.vue",
    props: {
        showImpressum: {
            type: Boolean,
            default: false,
        }
    },
    components: {Impressum}
}
</script>

<template>
    <main class="main">
        <Impressum v-if="showImpressum" @zurueck="$emit('zurueck')" />
        <template v-else>
        <p>Willkommen zur neuen Vue-Seite für Abalo!</p>
        </template>
    </main>
</template>

<style scoped>
.main {
    flex: 1;
    padding: 20px;
}
</style>
