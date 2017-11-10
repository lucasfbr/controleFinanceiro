<script>

    export default{

        data(){
            return{
                cep: '',
                endereco: {},
                naoLocalizado: false,
            }
        },
        attached(){
            jQuery(this.$els.cep).mask('00000-000');
        },
        methods:{
            buscar: function () {

                self = this;

                self.endereco = {};

                if(/^[0-9]{5}-[0-9]{3}$/.test(this.cep)){

                    jQuery.getJSON('http://viacep.com.br/ws/'+self.cep+'/json/', function (endereco) {

                        if(endereco.erro){

                            jQuery(self.$els.logradouro).focus();
                            self.naoLocalizado = true;
                            return;

                        }else{

                            self.endereco = endereco;
                            self.naoLocalizado = false;
                            jQuery(self.$els.numero).focus();

                        }

                    })

                }

            }
        },
        ready(){

        }

    }

</script>


<template>

    <div>

        <div class="well">


            <h3>Cadastro de endereço</h3>
            <br>
            <br>

            <div class="row">
                <div class="form-group col-md-5">
                    <label>CEP</label>
                    <input type="text" class="form-control" id="cep" v-model="cep" v-on:keyup="buscar" v-el:cep>

                    <p class="text-danger" v-show="naoLocalizado">O campo cep esta incorreto</p>

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-5">
                    <label>Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" v-model="endereco.logradouro" v-el:logradouro>
                </div>

                <div class="form-group col-md-2">
                    <label>Número</label>
                    <input type="text" class="form-control" id="numero" v-el:numero>
                </div>

                <div class="form-group col-md-5">
                    <label>Complemento</label>
                    <input type="text" class="form-control" id="complemento">
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-5">
                    <label>Bairro</label>
                    <input type="text" class="form-control" id="bairro" v-model="endereco.bairro">
                </div>

                <div class="form-group col-md-5">
                    <label>Cidade</label>
                    <input type="text" class="form-control" id="cidade" v-model="endereco.localidade">
                </div>

                <div class="form-group col-md-2">
                    <label>Estado</label>
                    <input type="text" class="form-control" id="estado" v-model="endereco.uf">
                </div>
            </div>

        </div>

    </div>

</template>

<style scoped=""></style>