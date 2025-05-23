import {createApp} from "vue";
import axios from "axios";

createApp({
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
}).mount('#app');
