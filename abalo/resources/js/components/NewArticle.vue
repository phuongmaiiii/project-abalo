<script>
import axios from "axios";
import Impressum from "./Impressum.vue";

export default {
    name: "NewArticle",
    props: {
        showImpressum: {
            type: Boolean,
            default: false,
        }
    },
    components: {
      Impressum
    },
    data(){
        return{
            form:{
                name: "",
                price: null,
                description: "",
            },
            successMessage: "",
            errorMessage: "",
        }
    },
    methods:{
        async submitForm(){
            this.successMessage = "";
            this.errorMessage = "";
            try{
                //await: pause the async function until the Promise (like calling api, querying DB, waiting for response from server) resolves, then get the result
                const response = await axios.post('/api/articles', this.form,{
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if(response.status === 201 && response.data.success){
                    this.successMessage = `Artikel erfolgreich gespeichert mit ID: ${response.data.data}`;
                    this.form.name = "";
                    this.form.price = null;
                    this.form.description = "";
                }
            } catch(error){
                if(error.response &&error.response.status === 422){
                    this.errorMessage = "Fehler: Bitte alle Pflichtfelder korrekt ausfüllen";
                }else {
                    this.errorMessage = "Fehler: " + error.message;
                }
            }
        }

    }
}
</script>

<template>
    <main class="main">
        <Impressum v-if="showImpressum" @zurueck="$emit('zurueck')" />
        <template v-else>
            <h1 style="color: #004080; text-align: center">Neuen Artikel eingeben</h1>
            <form @submit.prevent="submitForm">
                <label>Artikelname *:</label>
                <input type="text" v-model="form.name" required>

                <br>

                <label>Preis (€) *:</label>
                <input type="number" v-model.number="form.price" step="0.01" min="0.01" required>

                <br>

                <label>Beschreibung:</label>
                <textarea v-model="form.description"></textarea>

                <br>

                <p v-if="successMessage" style="color: green;">@{{successMessage}}</p>
                <p v-if="errorMessage" style="color: red;">@{{errorMessage}}</p>

                <br>

                <button type="submit">Speichern</button>

                <br>

                <p style="font-style: italic; font-size: 0.9em;">(Note: * ist Pflichtfeld)</p>

            </form>
        </template>
    </main>
</template>

<style lang="scss" scoped>
    @use '../../scss/newarticle';
</style>
