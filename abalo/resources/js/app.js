import './bootstrap';
import {pi, round} from 'mathjs';
import {createApp} from 'vue';

const app = createApp({
    data(){
        return {
            msg: "Hallo Welt",
        }
    }
}).mount('#app');


//
alert(round(pi, 2));


