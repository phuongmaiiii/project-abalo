<script>
import NewArticle from "../components/NewArticle.vue";
import SiteHeader from "../components/SiteHeader.vue";
import SiteFooter from "../components/SiteFooter.vue";
import SiteBody from "../components/SiteBody.vue";

export default {
    name: "Verkaufen",
    components: {
        SiteBody,
        NewArticle, SiteHeader, SiteFooter
    },
    data() {
        return {
            showImpressum: false,
        };
    },
}
</script>

<template>
    <div class="wrapper">
        <SiteHeader />
        <NewArticle v-bind:showImpressum="showImpressum" @zurueck="showImpressum=false"/>
        <SiteFooter @show-impressum="showImpressum = true"/>
    </div>
</template>

<style lang="scss">
    @use "../../scss/app";
</style>
