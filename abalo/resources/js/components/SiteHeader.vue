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
      <nav id="narbar">
          <img src="../assets/logo_cat.png" alt="logo" class="logo" />
          <ul>
            <MenuItem v-for="(item, index) in menuData" :key="index" :item="item" />
          </ul>
      </nav>
  </header>
</template>

<style scoped>
nav {
    display: flex;
    align-items: center;
    background-color: #f0f0f0;
    color: #004080;
    font-weight: bold;
    font-size: larger;
    box-shadow: 0px 2.98px 7.46px rgba(0, 0, 0, 0.1);
}

.logo {
    width: 70px;
    object-fit: contain;
    margin-left: 5px;
    margin-right: auto;
    border-radius: 50%;
}
</style>
<style>
nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 1rem;
}

nav li {
    position: relative;
    padding: 1rem;
    cursor: pointer;
}

nav li ul {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #ffffff;
    border: 1px solid #ddd;
    padding: 0.5rem;
    flex-direction: column;
}
/*hien khi luot chuot vao menu chinh*/
nav li:hover  ul {
    display: flex;
}
/* Hover item chlidren -> background color*/
nav li ul li {
    padding: 0.5rem 1rem;
    white-space: nowrap;
}

nav li:hover {
    background-color: #e0e0e0;
}

</style>
