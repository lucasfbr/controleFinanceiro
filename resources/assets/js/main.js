import Vue from 'vue';

import VueResource from 'vue-resource';

Vue.use(VueResource);

import FinCategorys from './components/categorys.vue';

import CadEndereco from './components/cep.vue';

new Vue({
    el:'#conteudo',

    components:{
        FinCategorys,
        CadEndereco
    },

});


