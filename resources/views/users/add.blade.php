@extends('layouts.default')

@section('title', 'Adicionar usuários')

@section('container')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Adicionar novo usuário
                    </h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('painel/users/create')}}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label">Nome</label>
                            <input type="text" class="form-control" placeholder="Nome" name="name" value="{{ old('name') }}" autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label">E-mail</label>
                            <input type="text" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}" autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="control-label">Senha</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" autofocus>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Confirma senha</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation">
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