<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryCost;

class PainelController extends Controller
{
    public function index(){

        $categorys = CategoryCost::all();

        return view('painel.index', compact('categorys'));

    }
}
