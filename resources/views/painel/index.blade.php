@extends('layouts.default')

@section('title', 'Painel de controle')

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


                <div class="row">

                        <h1>Paínel de controle</h1>

                        <cad-endereco></cad-endereco>

                </div>
        </div>
    </div>
@endsection