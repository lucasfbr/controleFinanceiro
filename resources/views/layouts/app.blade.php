<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="green lighten-5">
    <div id="app">

        <nav>
            <div class="nav-wrapper green darken-2">
                <a href="#" class="brand-logo">LVI-FINANÇAS</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">

                    @if (!Auth::guest())
                        <li><a href="{{ url('/painel') }}">Home</a></li>
                        <li><a href="{{ url('/painel/category-costs') }}">Categoria de custos</a></li>

                        <ul id="dropdown1" class="dropdown-content">
                            <li><a href="{{ url('/painel/bill-receive') }}">Contas a receber</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/painel/bill-pay') }}">Contas a pagar</a></li>
                            <li class="divider"></li>
                            <li><a href="#!">three</a></li>
                        </ul>

                        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Dropdown<i class="material-icons right">arrow_drop_down</i></a></li>

                        <li><a href="{{ url('/painel/statements') }}">Extratos</a></li>
                        <li><a href="{{ url('/painel/charts') }}">Gráfico de Gastos</a></li>
                        <li><a href="{{ url('/painel/users') }}">Usuários</a></li>
                    @endif

                    @if (Auth::guest())


                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>

                    @else

                        <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Dropdown<i class="material-icons right">arrow_drop_down</i></a></li>

                        <ul id="dropdown3" class="dropdown-content">
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

                    @endif

                </ul>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/scripts.js"></script>
</body>
</html>
