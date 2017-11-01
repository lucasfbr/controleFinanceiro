@extends('layouts.default')

@section('title', 'Contas a pagar')

@section('container')
    <div class="container">
        <div class="row">

            @if (session('sucesso'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {{ session('sucesso') }}
                </div>
                <br/>
            @elseif(session('erro'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {{ session('erro') }}
                </div>
                <br/>
            @endif

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Administração de contas a pagar
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{url('painel/bill-pay/add')}}" class="btn btn-default">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width:10px">#</th>
                                <th>Categoria</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Data Lançamento</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($billPays as $bill)
                            <tr>
                                <td>{{$bill->id}}</td>
                                <td></td>
                                <td>{{$bill->name}}</td>
                                <td>{{$bill->value}}</td>
                                <td>{{$bill->data_launch}}</td>
                                <td>
                                    <a href="{{url('painel/bill-pay/edit/'.$bill->id)}}" title="Editar">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    |
                                    <a href="{{url('painel/bill-pay/delete/'.$bill->id)}}" title="Remover">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection