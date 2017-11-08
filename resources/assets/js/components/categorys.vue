<script>

    export default{

        props: ['categorys'],

        data(){
            return{
                list:[],
                sortProperty: 'id',
                sortDirection: 1
            }
        },

        ready(){
            this.list = JSON.parse(this.categorys)
        }

    }

</script>

<template>

    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width:10px">#</th>
                <th>Nome</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="cat in list | orderBy sortProperty sortDirection">
                <td>{{cat.id}}</td>
                <td>{{cat.name}}</td>
                <td> Editar | Deletar</td>
            </tr>

            </tbody>
        </table>
    </div>

</template>

<style scoped=""></style>