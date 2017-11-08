@extends('layouts.default')

@section('title', 'Detalhes da conta')

@section('container')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Detalhes da conta {{$billPays->name}}
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="col-md-8 col-md-offset-2">

                        <div class="text-center">
                            <p>
                                <strong>Categoria:</strong>
                                {{$billPays->categoryCosts->name}}
                            </p>
                            <p>
                                <strong>Nome:</strong>
                                {{$billPays->name}}
                            </p>
                            <p>
                                <strong>Valor:</strong>
                                R$ {{valorBr($billPays->value)}}
                            </p>
                            <p>
                                <strong>Data do Lançamento:</strong>
                                {{$billPays->data_launch}}
                            </p>
                            <p>
                                <strong>Data do pagamento:</strong>
                                {{$billPays->data_pay}}
                            </p>
                            <p>
                                <strong>Observações:</strong>
                                {{$billPays->observacoes}}
                            </p>
                            @if($billPays->anexo)
                            <p>
                                <strong>Comprovante:</strong>
                                <a href="{{asset($billPays->anexo)}}" target="_blank">Comprovante</a>

                            </p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection