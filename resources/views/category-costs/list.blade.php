@extends('layouts.default')

@section('title', 'Categoria de custos')

@section('container')


    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 card-principal-categoria">

                <div class="card white">
                    <div class="card-image green lighten-4 green-text">

                       <h5 class="card-top-default">
                           Categorias de custo
                       </h5>

                        <a href="{{url('painel/category-costs/add')}}" class="btn-floating btn-large halfway-fab waves-effect waves-light green">
                            <i class="material-icons">add</i>
                        </a>

                    </div>
                    <div class="card-content">

                        <fin-categorys></fin-categorys>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection