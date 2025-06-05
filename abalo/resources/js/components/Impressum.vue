<script>
export default {
    name: "Impressum"
}
</script>

<template>
    <div class="impressum">
    <p><strong>Impressum</strong></p>
    <p>Anbiter:<br />Max Mustermann<br />Musterstraße 1<br />12345 Musterstadt</p>
    <p>Kontakt:<br />Telefon: 089/1234567-8<br />Telefax: 089/1234567-9<br />E-Mail: mail@mustermann.de<br />Website: www.mustermann.de</p>
    <p></p>
    <p>Bei redaktionellen Inhalten:</p>
    <p>Verantwortlich nach § 55 Abs.2 RStV<br />Moritz Schreiberling<br />Musterstraße 2<br />12345 Musterstadt</p>

     <button @click="$emit('zurueck')">Zurück zur Startseite</button>
    </div>
</template>

<style scoped>
    .impressum{
        margin-top: 20px;
        padding: 20px;
        background-color: #eee;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    button{
        margin-top: 20px;
        padding: 10px 16px;
        background-color: #004080;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }
</style>
