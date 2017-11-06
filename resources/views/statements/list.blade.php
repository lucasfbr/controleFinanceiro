@extends('layouts.default')

@section('title', 'Extratos')

@section('container')
    <div class="container">
        <div class="row">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                       Extratos
                    </h3>
                </div>
                <div class="panel-body">
                    <form class="form-inline text-center" method="post" action="{{url('painel/statements/busca')}}">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label">Início</label>
                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="date_start" value="{{ \Carbon\Carbon::parse()->subDays(31)->format('d/m/Y')}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Fim</label>
                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="date_end" value="{{ \Carbon\Carbon::parse()->format('d/m/Y')}}">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </form>


                    <div class="text-center">
                        <h2>Totais no período</h2>
                        <p>
                            <strong>Recebidos:</strong>
                            R$ {{valorBr($dados['total_receives'])}}
                        </p>
                        <p>
                            <strong>Pagos:</strong>
                            R$ {{valorBr($dados['total_pays'])}}
                        </p>
                        <p>
                            <strong>Saldo</strong>
                            R$ {{valorBr($dados['total_receives'] - $dados['total_pays'])}}
                        </p>
                    </div>

                    <div class="col-md-8 col-md-offset-2">
                        <div class="list-group">
                            @if($dados['statements'])
                                @foreach($dados['statements'] as $statement)

                                    <a href="#" class="list-group-item">
                                        <h4 class="list-group-item-heading">
                                            <span class="glyphicon glyphicon-{{isset($statement['category_name']) ? 'minus' : 'plus'}}">
                                                {{$statement['data_launch']}} - {{$statement['name']}}
                                            </span>
                                        </h4>
                                        @if(isset($statement['category_name']))
                                            <p class="list-group-item-text">
                                                {{$statement['category_name']}}
                                            </p>
                                        @endif
                                        <h4 class="text-right">
                                            <span class="label label-{{isset($statement['category_name']) ? 'danger' : 'success'}}">
                                                R$ {{isset($statement['category_name']) ? '-' : ''}}{{valorBr($statement['value'])}}
                                            </span>
                                        </h4>
                                        <div class="clearfix"></div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection