<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School of Net - SON Finanças</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
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
                SON Finanças
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav nav">
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a>Olá usuário</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>


    </div>

</nav>

@yield('container')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

</body>
</html>