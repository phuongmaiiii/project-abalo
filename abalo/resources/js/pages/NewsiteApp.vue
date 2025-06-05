<script>
import SiteHeader from "../components/SiteHeader.vue";
import SiteBody from "../components/SiteBody.vue";
import SiteFooter from "../components/SiteFooter.vue";

export default {
    name: "NewsiteApp",
    components: {
        SiteHeader,
        SiteBody,
        SiteFooter,
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
        <SiteBody v-bind:showImpressum="showImpressum" @zurueck="showImpressum=false"/>
        <SiteFooter @show-impressum="showImpressum = true"/>
    </div>
</template>

<style  lang="scss">
    @use "../../scss/app";
</style>
