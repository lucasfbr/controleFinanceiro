@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3 form-login">
                <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-image green darken-2 text-center">
                            <h5 class="center-align white-text titulo-login">Tela de Login</h5>
                        </div>
                        <div class="card-content">
                            <div class="input-field">
                                <input class="validate" id="email" type="text" name="email" value="{{ old('email') }}">
                                <label for="email">Email</label>

                                @if ($errors->has('email'))
                                    <span class="red-text">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif

                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="password" type="password" name="password">
                                        <label for="password">Senha</label>

                                        @if ($errors->has('password'))
                                            <span class="red-text">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <p>
                                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : ''}}/>
                                        <label for="remember">Lembrar</label>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card-action green darken-2">
                            <div class="center-align">

                                <button type="submit" class="btn green darken-1"><i class="material-icons left">vpn_key</i> Acessar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col s4">
                        <a href="{{ url('/register') }}" class="btn green darken-1">Registrar</a>
                    </div>
                    <div class="col s8 right-align">
                        <a href="{{ url('/password/reset') }}" class="btn green darken-1">Esqueci a senha</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
