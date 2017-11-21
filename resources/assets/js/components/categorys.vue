<script>

    export default{


        /* Variaveis utilizadas no projeto
         *
          * categorys : armazena todas as categorias vindas do banco de dados
          * sortProperty : propriedade inicial para ordenação
          * sortDirection : direção ascendente ou descendente da ordenação
          * busca: armazena os caracteres para realizar a busca
          * category: armazena os dados de uma categoria especifica
          * erro: armazena o status e a mensagem, por default o status = false e msg = ''
         */
        data(){
            return{
                categorys: '',
                sortProperty: 'id',
                sortDirection: 1,
                busca: '',
                category: {
                    id:'',
                    name:''
                },
                erro: {
                    status:false,
                    msg:''
                }

            }
        },

        methods: {
            //Lista todas as categorias, utilizado no inicio e quando precisamos de um refresh na página
            list(){

                this.$http.get('api/categorys/listar').then(function(response) {
                    this.categorys = response.body
                });

            },
            //Faz a ordenação das categorias
            sort (e, property) {

                e.preventDefault();

                this.sortProperty = property;

                if(this.sortDirection == 1){
                    this.sortDirection = -1
                }else{
                    this.sortDirection = 1
                }
            },
            //Exibem os dados a serem editados no formulário
            edit(id, name){

                //limpa o id da categoria
                this.category.id   = '';
                //limpa o name da categoria
                this.category.name = '';

                if(id != '' && name != ''){
                    this.category.id   = id;
                    this.category.name = name;
                }

            },
            //Atualiza os dados no banco de dados
            update(){

                //Armazena o "this" na variavel self, assim não teremos conflitos com o this do vue.resource
                self = this;
                //Limpa o status
                self.erro.status = '';
                //Limpa a msg
                self.erro.msg = '';

                //verifica se o name da categoria não esta vazio
                if(self.category.name != ''){

                    //Faz um envio post via AJAX, passando os dados recebidos e os headers, necessários para o laravel aceitar transações via post
                    //O csrf-token referido no header, esta localizado nos metas do template.
                    this.$http.post('api/categorys/update', self.category, { headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')}}).then(function (response) {

                        //verifica se o retorno é true
                        if (response.body) {

                            //fecha o modal
                            jQuery('#editar').modal('close');
                            //atualiza a lista de categorias
                            self.list();

                        } else {

                            //seta o status para true e define a msg de erro
                            self.erro.status = true;
                            self.erro.msg = 'O campo não foi atualizado, tente novamente mais tarde';

                        }

                    }, response => {

                        //seta o status para true e define a msg de erro
                        self.erro.status = true;
                        self.erro.msg = 'Erro 404, informe a equipe de TI';

                    });

                }else{

                    //seta o status para true e define a msg de erro
                    self.erro.status = true;
                    self.erro.msg = 'O campo nome deve ser preenchido!';

                }

            },
            deletar(id, name){

                self = this;

                if(confirm('Você realmente deseja excluir este registro?')){

                    this.$http.get('category-costs/delete/'+id).then(function(response) {

                        if(response.body){

                            this.list();

                            Materialize.toast('A categoria ' + name + ' foi excluída com sucesso!', 3000, 'rounded')

                        }else{

                            console.log('Ocorreu algum erro')

                        }

                    });

                }else{



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

        <div class="card-image green lighten-4 green-text">

            <h5 class="card-top-default">
                Categorias de custo
            </h5>

            <a href="#" class="btn-floating btn-large halfway-fab waves-effect waves-light green" @click="add">
                <i class="material-icons">add</i>
            </a>

        </div>
        <div class="card-content">

        <div class="input-field col s6">
            <input type="text" class="validate" id="busca" name="busca"  v-model="busca">
            <i class="material-icons prefix">search</i>
            <label for="busca">Filtrar</label>
        </div>


            <table class="bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 80%"><a href="#" @click="sort($event, 'name')">Nome</a></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="cat in categorys | filterBy busca | orderBy sortProperty sortDirection">
                    <td>{{cat.id}}</td>
                    <td style="width: 80%">{{cat.name}}</td>
                    <td>
                        <a href="#editar" class="btn-floating btn-sm waves-effect waves-light orange modal-trigger" @click='edit(cat.id,cat.name)'><i class="material-icons">mode_edit</i></a>
                        <a href="#deletar" class="btn-floating btn-sm waves-effect waves-light red modal-trigger" @click='deletar(cat.id, cat.name)'><i class="material-icons">delete</i></a>
                    </td>
                </tr>

                </tbody>

            </table>

        </div>

        <div id="modalEditar">
            <div id="editar" class="modal">
                <div class="modal-content">
                        <form class="login-form" role="form" method="POST" action="">
                            <div class="card">
                                <div class="card-image green darken-2 white-text text-center">
                                    <h4 class="center-align titulo-login">Editar categoria de custo</h4>
                                </div>
                                <div class="card-content">

                                    <div class="input-field">
                                        <input class="validate" id="category_cost" type="text" name="category_cost" value="{{category.name}}" v-model="category.name" placeholder="Categoria de custo">


                                        <span class="red-text">
                                            <strong v-show="erro.status" transition="expand">{{erro.msg}}</strong>
                                        </span>

                                    </div>

                                </div>
                            </div>
                        </form>

                </div>
                <div class="modal-footer green darken-2">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat btn white lighten-1 green-text">Fechar</a>
                    <a href="#!" class="waves-effect waves-green btn-flat btn white darken-1 green-text" @click="update">Editar</a>
                </div>
            </div>
        </div>


    </div>

</template>

<style scoped=""></style>