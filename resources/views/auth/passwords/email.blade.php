@extends('layouts.app')

<!-- Main Content -->
@section('content')

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3 form-login">

                <form class="login-form" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-image green darken-2 text-center">
                            <h5 class="center-align white-text titulo-login">Redefinir Senha</h5>
                        </div>
                        <div class="card-content">

                            <div class="input-field">

                                <input id="email" type="email" name="email" class="validate" value="{{ $email or old('email') }}" autofocus>
                                <label for="email">E-mail</label>

                                @if ($errors->has('email'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-action green darken-2">
                            <div class="center-align">
                                <button type="submit" class="btn green darken-1">Enviar link para definir senha</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
