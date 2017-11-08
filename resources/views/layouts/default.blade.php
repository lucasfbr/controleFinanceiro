<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LVI Finanças</title>
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-default navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#">
                LVI Finanças
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav nav">

                @if (!Auth::guest())
                    <li><a href="{{ url('/painel') }}">Home</a></li>
                    <li><a href="{{ url('/painel/category-costs') }}">Categoria de custos</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Contas <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/painel/bill-receive') }}">Contas a receber</a></li>
                            <li><a href="{{ url('/painel/bill-pay') }}">Contas a pagar</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/painel/statements') }}">Extratos</a></li>
                    <li><a href="{{ url('/painel/charts') }}">Gráfico de Gastos</a></li>
                    <li><a href="{{ url('/painel/users') }}">Usuários</a></li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>


    </div>

</nav>

@yield('container')

<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@yield('google-charts')

</body>
</html>