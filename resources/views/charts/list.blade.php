@extends('layouts.default')

@section('title', 'Gráficos de custos')

@section('container')
    <div class="container">
        <div class="row">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Gráfico de custos
                    </h3>
                </div>
                <div class="panel-body">
                    <form class="form-inline text-center" method="post" action="{{url('painel/charts/busca')}}">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label">Início</label>
                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="date_start" value="{{ \Carbon\Carbon::parse()->subDays(31)->format('d/m/Y')}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Fim</label>
                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="date_end" value="{{ \Carbon\Carbon::parse()->format('d/m/Y')}}">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </form>

                    <div class="col-md-8 col-md-offset-2">
                        <div id="chart-div"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('google-charts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Categoria');
            data.addColumn('number', 'Valor');
            data.addRows([
                @foreach($categories as $cat)
                    ['{{$cat->name}}', {{valorChart($cat->value)}}],
                @endforeach
            ]);

            var chart = new google.visualization.PieChart(document.getElementById('chart-div'));
            chart.draw(data, {
                width:'100%',
                height:300
            });
        }
    </script>
@endsection