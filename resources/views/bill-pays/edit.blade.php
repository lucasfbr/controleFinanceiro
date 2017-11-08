@extends('layouts.default')

@section('title', 'Editar conta a pagar')

@section('container')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Editar conta a pagar
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="col-md-8 col-md-offset-2">

                        <form method="post" action="{{url('painel/bill-pay/update/'.$billPays->id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            @if($billPays->status == 'paga')
                                <div class="form-group">
                                    <label class="control-label">Status da conta</label>
                                    <select class="form-control" name="status">
                                        <option value="pendente" {{$billPays->status == 'pendente' ? 'selected' : ''}}>pendente</option>
                                        <option value="paga" {{$billPays->status == 'paga' ? 'selected' : ''}}>paga</option>
                                        <option value="atrasada" {{$billPays->status == 'atrasada' ? 'selected' : ''}}>atrasada</option>
                                    </select>
                                </div>
                            @endif

                            <div class="form-group{{ $errors->has('category_cost_id') ? ' has-error' : '' }}">
                                <label class="control-label">Categoria</label>

                                <select class="form-control" name="category_cost_id" autofocus>
                                    <option value="">Selecione uma categoria</option>
                                    @foreach($categoryCosts as $category)
                                        <option value="{{$category->id}}" {{$category->id == $billPays->category_cost_id ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category_cost_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_cost_id') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="control-label">Nome</label>
                                <input type="text" class="form-control" placeholder="Nome" name="name" value="{{$billPays->name}}" autofocus>
                                <input type="hidden" name="user_id" value="{{ $billPays->user->id  }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <label class="control-label">Valor</label>
                                <input type="text" class="form-control" placeholder="0.000,00" name="value" value="{{valorBr($billPays->value)}}" autofocus>

                                @if ($errors->has('value'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('data_launch') ? ' has-error' : '' }}">
                                <label class="control-label">Data Lançamento</label>
                                <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="data_launch" value="{{$billPays->data_launch}}" autofocus>

                                @if ($errors->has('data_launch'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('data_launch') }}</strong>
                                    </span>
                                @endif
                            </div>

                            @if($billPays->status == 'paga')
                            <div class="form-group">
                                <label class="control-label">Data do pagamento</label>
                                <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="data_pay" value="{{$billPays->data_pay}}" autofocus>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Observações</label>
                                <textarea class="form-control" rows="4" name="observacoes">{{$billPays->observacoes}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="anexo">Anexar comprovante</label>
                                <input type="file" id="anexo" name="anexo">
                                <p class="help-block">Insira seu comprovante aqui.</p>
                            </div>
                            @endif

                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-floppy-disk"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection