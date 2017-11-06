<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryCost;
use App\BillPay;

class ChartsController extends Controller
{
    public function index(){

        $categories = [];

        return view('charts.list',compact('categories'));

    }

    public function busca(Request $request){

        $data_start = dataStart($request->input('date_start'));

        $data_end = dataEnd($request->input('date_end'));

        $categories = CategoryCost::query()
            ->selectRaw('category_costs.name, sum(bill_pays.value) as value')
            ->leftJoin('bill_pays', 'bill_pays.category_cost_id', '=', 'category_costs.id')
            ->whereBetween('bill_pays.data_launch',[$data_start,$data_end])
            ->where('category_costs.user_id', Auth()->user()->id)
            ->whereNotNull('bill_pays.category_cost_id')
            ->groupBy('category_costs.name')
            ->get();

        //dd($categories);

        return view('charts.list', compact('categories'));

    }
}
