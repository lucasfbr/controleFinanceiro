@extends('templates.default')

@section('title', 'Adicionar Categoria de custos')

@section('container')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Adicionar categoria de custos
                    </h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('category-costs/create')}}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label">Nome</label>
                            <input type="text" class="form-control" placeholder="Nome" name="name">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
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