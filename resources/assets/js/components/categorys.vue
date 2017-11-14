<script>

    export default{

        //props: ['categorys'],

        data(){
            return{
                categorys: '',
                sortProperty: 'id',
                sortDirection: 1,
                busca: ''
            }
        },

        methods: {
            sort (e, property) {

                e.preventDefault();

                this.sortProperty = property;

                if(this.sortDirection == 1){
                    this.sortDirection = -1
                }else{
                    this.sortDirection = 1
                }
            }
        },

        ready(){

            this.$http.get('api/categorys/listar').then(function(response) {
                    this.categorys = response.body
            });

        }

    }

</script>

<template>

    <div>


        <div class="input-field col s4">
            <select>
                <option value="" disabled selected>Ações</option>
                <option value="1">Editar</option>
                <option value="2">Excluir</option>
            </select>
        </div>

        <div class="input-field col s4">
            <input type="text" class="validate" id="busca" name="busca"  v-model="busca">
            <i class="material-icons prefix">search</i>
            <label for="busca">Filtrar</label>

        </div>


        <table class="bordered">
            <thead>
            <tr>
                <th>#</th>
                <th><a href="#" @click="sort($event, 'name')">Nome</a></th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="cat in categorys | filterBy busca | orderBy sortProperty sortDirection">
                <td>{{cat.id}}</td>
                <td>{{cat.name}}</td>
            </tr>

            </tbody>
        </table>
    </div>

</template>

<style scoped=""></style>