@extends('layouts.default')

@section('title', 'Pagamento de conta')

@section('container')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Pagamento da conta {{$billPays->name}}
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="col-md-8 col-md-offset-2">
                        <form method="post" action="{{url('painel/bill-pay/updateStatus/'.$billPays->id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input type="text" class="form-control" placeholder="Nome" name="name" value="{{$billPays->name}}" disabled>
                            </div>

                            <div class="form-group{{ $errors->has('data_pay') ? ' has-error' : '' }}">
                                <label class="control-label">Data do pagamento</label>
                                <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="data_pay" value="{{ \Carbon\Carbon::parse()->format('d/m/Y')}}" autofocus>

                                @if ($errors->has('data_pay'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('data_pay') }}</strong>
                                    </span>
                                @endif
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

                            <input type="hidden" name="status" value="pago">

                            <button type="submit" class="btn btn-primary">
                                Pagar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection