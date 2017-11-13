@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div id="login" class="col s8 offset-s2">
                    <h1>Login</h1>
                    <form role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}


                        <div class="col s12">
                            <div class="row">
                                <div class="input-field">
                                <label for="email">E-mail</label>
                                <input id="email" name="email" type="text" class="validate">

                                @if ($errors->has('email'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="text" class="validate">

                                @if ($errors->has('password'))
                                    <span class="red-text">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                                </div>
                            </div>


                            <div class="row">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                <label for="remember">Remember</label>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn waves-effect waves-light">
                                    Logar
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Esqueceu sua senha?
                                </a>
                            </div>
                        </div>

                    </form>

        </div>
    </div>
</div>
@endsection
