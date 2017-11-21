@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3 form-login">

                <form class="login-form" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-image green darken-2 text-center">
                            <h5 class="center-align white-text titulo-login">Redefinir Senha</h5>
                        </div>
                        <div class="card-content">

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="input-field">

                                <input id="email" type="email" name="email" class="validate" value="{{ $email or old('email') }}" required autofocus>
                                <label for="name">email</label>

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
                                    <div class="input-field">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                        <label for="password-confirm">Confirma senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action green darken-2">
                            <div class="center-align">
                                <button type="submit" class="btn waves-effect waves-light">Redefinir</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
