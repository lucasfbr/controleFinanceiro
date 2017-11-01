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
                </div>
            </div>

        </div>
    </div>
@endsection