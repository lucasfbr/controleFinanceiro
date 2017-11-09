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

        <div class="well">
            <input type="text" class="form-control" placeholder="Filtrar lista abaixo" v-model="busca">
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width:10px">#</th>
                <th><a href="#" @click="sort($event, 'name')">Nome</a></th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="cat in categorys | filterBy busca | orderBy sortProperty sortDirection">
                <td>{{cat.id}}</td>
                <td>{{cat.name}}</td>
                <td>
                    <a href="/painel/category-costs/edit/{{cat.id}}" title="Editar">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    |
                    <a href="/painel/category-costs/delete/{{cat.id}}" title="Remover">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

</template>

<style scoped=""></style>