<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\BillReceive;
use App\BillPay;


class StatementsController extends Controller
{
    public function index(){

        $dados = [
            'statements' => '',
            'total_pays' => '',
            'total_receives' => ''
        ];

        return view('statements.list', compact('dados'));

    }

    public function busca(Request $request){


        $data_start = dataStart($request->input('date_start'));

        $data_end = dataEnd($request->input('date_end'));


        $billPays = BillPay::query()
                        ->selectRaw('bill_pays.*, category_costs.name as category_name')
                        ->leftJoin('category_costs', 'category_costs.id', '=', 'bill_pays.category_cost_id')
                        ->whereBetween('data_launch',[$data_start,$data_end])
                        ->where('bill_pays.user_id', Auth()->user()->id)
                        ->get();

        $billReceives = BillReceive::query()
                                ->whereBetween('data_launch',[$data_start,$data_end])
                                ->where('user_id', Auth()->user()->id)
                                ->get();

        $collections = new Collection(array_merge_recursive($billPays->toArray(), $billReceives->toArray()));
        $statements = $collections->sortByDesc('data_launch');

        $dados = [
            'statements' => $statements,
            'total_pays' => $billPays->sum('value'),
            'total_receives' => $billReceives->sum('value')
        ];



        return view('statements.list', compact('dados'));

    }
}
