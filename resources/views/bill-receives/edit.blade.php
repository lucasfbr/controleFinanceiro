@extends('layouts.default')

@section('title', 'Editar Categoria de custos')

@section('container')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Editar conta a receber
                    </h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('painel/bill-receive/update/'.$billReceives->id)}}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label">Nome</label>
                            <input type="text" class="form-control" placeholder="Nome" name="name" value="{{$billReceives->name}}" autofocus>
                            <input type="hidden" name="user_id" value="{{ $billReceives->user->id  }}">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                            <label class="control-label">Valor</label>
                            <input type="text" class="form-control" placeholder="0.000,00" name="value" value="{{$billReceives->value}}" autofocus>

                            @if ($errors->has('value'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('data_launch') ? ' has-error' : '' }}">
                            <label class="control-label">Data Lançamento</label>
                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="data_launch" value="{{$billReceives->data_launch}}" autofocus>

                            @if ($errors->has('data_launch'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('data_launch') }}</strong>
                                </span>
                            @endif

                        </div>

                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection