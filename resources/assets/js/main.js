import Vue from 'vue';

import VueResource from 'vue-resource';

Vue.use(VueResource);

import FinCategorys from './components/categorys.vue';

import FinEnderecos from './components/enderecos.vue';

new Vue({
    el:'#conteudo',

    components:{
        FinEnderecos,
        FinCategorys,

    },

});


