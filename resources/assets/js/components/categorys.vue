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
                sortProperty: 'name',
                sortDirection: 1,
                busca: '',
                category: {
                    id:'',
                    name:'',
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
            limpar(){

                this.category.id = '';
                this.category.name = '';

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
            edit(e, cat){

                e.preventDefault();

                //limpa o id da categoria
                this.category.id   = '';
                //limpa o name da categoria
                this.category.name = '';

                if(cat.id != '' && cat.name != ''){
                    this.category.id   = cat.id;
                    this.category.name = cat.name;
                }

            },
            //Atualiza os dados no banco de dados
            update(){

                //Armazena o "this" na variavel self, assim não teremos conflitos com o this do vue.resource
                self = this;
                //Limpa o status do erro
                self.erro.status = '';
                //Limpa a msg do erro
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
                            //limpar objeto category
                            self.limpar();

                        } else {

                            //seta o status para true e define a msg de erro
                            self.erro.status = true;
                            self.erro.msg = 'A categoria não pode ser atualizada, tente novamente mais tarde!';

                        }

                    }, response => {

                        //seta o status para true e define a msg de erro
                        self.erro.status = true;
                        self.erro.msg = 'Erro 404, informe a equipe de TI!';

                    });

                }else{

                    //seta o status para true e define a msg de erro
                    self.erro.status = true;
                    self.erro.msg = 'O campo nome deve ser preenchido!';

                }

            },
            create(e){

                e.preventDefault();

                self = this;
                //Limpa o status do erro
                self.erro.status = '';
                //Limpa a msg do erro
                self.erro.msg = '';

                if(self.category.name != ''){

                    //console.log(self.category);

                    this.$http.post('api/categorys/add', self.category, { headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')}}).then(function (response) {


                        //console.log(response.body)

                        if(response.body){

                            //fecha o modal
                            jQuery('#add').modal('close');
                            //atualiza a lista de categorias
                            self.list();
                            //limpar objeto category
                            self.limpar();

                        }else{

                            self.erro.status = true;
                            self.erro.msg = 'A categoria não pode ser criada, tente novamente mais tarde!';

                        }

                    }, response => {

                        self.erro.status = true;
                        self.erro.msg = 'Erro ' + response.status + ', informe a equipe de TI!';

                        //console.log('nao chegou')

                    });

                }else{

                    self.erro.status = true;
                    self.erro.msg = 'O campo obrigatório!';

                }


            },
            deletar(e, id){

                e.preventDefault();

                self = this;

                if(confirm('Você realmente deseja excluir este registro?')){

                    this.$http.get('category-costs/delete/'+id).then(function(response) {

                        if(response.body){

                            this.list();

                            Materialize.toast('Categoria excluída com sucesso!', 5000, 'rounded')

                        }else{

                            console.log('Ocorreu algum erro')

                        }

                    }, response => {

                        Materialize.toast('Erro ' + response.status + ' ao deletar a categoria, informe seu gerente de TI' , 5000, 'rounded')

                    });

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

            <a href="#add" class="btn-floating btn-large halfway-fab waves-effect waves-light green modal-trigger">
                <i class="material-icons" @click="limpar">add</i>
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
                        <a href="#editar" class="btn-floating btn-sm waves-effect waves-light orange modal-trigger" @click='edit($event, cat)'><i class="material-icons">mode_edit</i></a>
                        <a href="#deletar" class="btn-floating btn-sm waves-effect waves-light red modal-trigger" @click='deletar($event,cat.id)'><i class="material-icons">delete</i></a>
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
                                        <input class="validate" id="edit_category_cost" type="text" name="edit_category_cost" value="{{category.name}}" v-model="category.name" placeholder="Categoria de custo">


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
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat btn white darken-1 green-text" @click="update">Editar</a>
                </div>
            </div>
        </div>

        <div id="modalAdd">
            <div id="add" class="modal">
                <div class="modal-content">
                    <form class="login-form" role="form" method="POST" action="">
                        <div class="card">
                            <div class="card-image green darken-2 white-text text-center">
                                <h4 class="center-align titulo-login">Adicione uma categoria</h4>
                            </div>
                            <div class="card-content">

                                <div class="input-field">
                                    <input class="validate" id="add_category_cost" type="text" name="add_category_cost" v-model="category.name">
                                    <label for="add_category_cost">Categoria de custo</label>

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
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat btn white darken-1 green-text" @click="create($event)">Adicionar</a>
                </div>
            </div>
        </div>


    </div>

</template>

<style scoped=""></style>