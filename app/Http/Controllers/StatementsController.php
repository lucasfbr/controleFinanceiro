<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class StatementsController extends Controller
{
    public function index(){

        return view('statements.list');

    }

    public function busca(Request $request){


        $date_start = $request->input('date_start') ? $request->input('date_start') : (new \DateTime())->modify('-1 month');
        $date_start = $date_start instanceof \DateTime ? $date_start->format('Y-m-d') : \DateTime::createFromFormat('d/m/Y', $request->input('date_start'))->format('Y-m-d');

        $date_end = $request->input('date_end') ? $request->input('date_end') : new \DateTime();
        $date_end = $date_end instanceof \DateTime ? $date_end->format('Y-m-d') : \DateTime::createFromFormat('d/m/Y', $request->input('date_end'))->format('Y-m-d');

        //dd($date_start . ' - ' .$date_end);


        return view('statements.list');

    }
}
