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
                    <form method="post" action="{{url('painel/bill-pay/update/'.$billPays->id)}}">
                        {{ csrf_field() }}


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

                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection