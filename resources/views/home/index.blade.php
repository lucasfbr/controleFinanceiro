@extends('layouts.default')

@section('container')

    <div class="container">
        <div class="row cards-default">
            <div class="col s4">
                <div class="card white">
                    <div class="card-content grey-text">
                        <span>A receber hoje</span>
                        <h4 class="light-green-text">R$ 1,200.00</h4>
                    </div>
                    <div class="card-action grey-text">
                        Restante no mês
                    </div>
                </div>
            </div>
            <div class="col s4">
                <div class="card white">
                    <div class="card-content grey-text">
                        <span>A pagar hoje</span>
                        <h4 class="red-text">R$ 1,200.00</h4>
                    </div>
                    <div class="card-action grey-text">
                        Restante no mês
                    </div>
                </div>
            </div>
            <div class="col s4">
                <div class="card white">
                    <div class="card-content grey-text">
                        <span>Contas bancárias</span>
                    </div>
                </div>
            </div>

            <div class="col s8">
                <div class="card white">
                    <div class="card-content grey-text">
                        <span>Fluxo de caixa</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
