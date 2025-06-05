<script>
import MenuItem from "./MenuItem.vue";

export default {
name: "SiteHeader.vue",
    components: {MenuItem},
    data(){
    return {
        menuData: [
            {title: "Home"},
            {title: "Kategorien", dynamic: true},
            {title: "Verkaufen"},
            {
                title: "Unternehmen",
                children: [
                    { title: "Philosophie" },
                    { title: "Karriere" }
                ]
            }
        ]
    };
    },
    mounted() {
    this.fetchCategories();
    },
    methods: {
        async fetchCategories() {
            try {
                const res = await fetch('/api/categories');
                if (!res.ok) throw new Error(res.statusText);
                const categories = await res.json();
                console.log("Categories geladen:", categories);
                //console.log("Aktuelles menuData:", this.menuData);
                const kategorien = this.menuData.findIndex(item => item.title === "Kategorien");
                if (kategorien) {
                    const children = categories.map(cat => ({
                        title: cat.ab_name
                    }));
                    //reaktiv
                    this.menuData.splice(kategorien,1,{ ...this.menuData[kategorien], children});
                }
            } catch (e) {
                console.error('Fehler beim Laden der Kategorien:', e);
            }
        }
    }
}
</script>

<template>
  <header>
      <nav class="menu">
          <img src="../assets/logo_cat.png" alt="logo" class="menu__logo" />
          <ul class="menu__list">
            <MenuItem v-for="(item, index) in menuData" :key="index" :item="item" />
          </ul>
      </nav>
  </header>
</template>

<style lang="scss">
    @use "../../scss/navbar";
</style>
