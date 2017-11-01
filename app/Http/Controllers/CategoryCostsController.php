<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth;
use App\CategoryCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryCostsController extends Controller
{
    protected $categoryCost;

    public function __construct(CategoryCost $categoryCosts)
    {
        $this->categoryCost = $categoryCosts;
    }

    public function index(){

        $user = Auth()->user();

        $categoryCosts = $user->categoryCosts;

        return view('category-costs.list', compact('categoryCosts'));
    }

    public function add(){

        return view('category-costs.add');

    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $result = $this->categoryCost->create($request->all());

        if($result){
            return redirect('painel/category-costs')->with('sucesso', 'Categoria cadastrada com sucesso!');
        }else{
            return redirect('painel/category-costs')->with('erro', 'Ocorreu algum erro ao cadastrar uma nova categoria, tente novamente mais tarde!');
        }

    }

    public function edit($id){

        $category = $this->categoryCost->find($id);

        if(Gate::denies('owner', $category))
           return redirect()->back();

        return view('category-costs.edit', compact('category'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $category = $this->categoryCost->find($id);

        if(Gate::denies('owner', $category))
            return redirect()->back();

        $result = $category->update($request->all());

        if($result){
            return redirect('painel/category-costs')->with('sucesso', 'Categoria alterada com sucesso!');
        }else{
            return redirect('painel/category-costs')->with('erro', 'Ocorreu algum erro ao alterar uma categoria, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        $category = $this->categoryCost->find($id);

        if(Gate::denies('owner', $category))
            return redirect()->back();

        if($category->delete()){
            return redirect('painel/category-costs')->with('sucesso', 'Categoria deletada com sucesso!');
        }else{
            return redirect('painel/category-costs')->with('erro', 'Ocorreu algum erro ao deletar uma categoria, tente novamente mais tarde!');
        }

    }



}
