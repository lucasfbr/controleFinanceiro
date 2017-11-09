<script>

    export default{
        data(){
            return{
                categorys: '',
                sortProperty: 'id',
                sortDirection: 1,
                busca: ''
            }
        },
        methods: {

        }

    }

</script>


<tempalte>

    <div>

        <div class="well">

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">CEP</label>
                        <input type="text" name="cep" id="cep" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-5">
                        <label class="control-label">Logradouro</label>
                        <input type="text" name="logradouro" id="logradouro" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label">Número</label>
                        <input type="text" name="numero" id="numero" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <label class="control-label">Complemento</label>
                        <input type="text" name="complemento" id="complemento" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-5">
                        <label class="control-label">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <label class="control-label">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label">Estado</label>
                        <input type="text" name="estado" id="estado" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

</tempalte>

<style scoped=""></style>