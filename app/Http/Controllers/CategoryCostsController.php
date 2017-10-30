<?php

namespace App\Http\Controllers;

use App\CategoryCosts;
use Illuminate\Http\Request;

class CategoryCostsController extends Controller
{
    protected $categoryCost;

    public function __construct(CategoryCosts $categoryCosts)
    {
        $this->categoryCost = $categoryCosts;
    }

    public function index(){


        $categoryCosts = $this->categoryCost->all();

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
            return redirect('/category-costs')->with('sucesso', 'Categoria cadastrada com sucesso!');
        }else{
            return redirect('/category-costs')->with('erro', 'Ocorreu algum erro ao cadastrar uma nova categoria, tente novamente mais tarde!');
        }

    }

    public function edit($id){

        $category = $this->categoryCost->find($id);

        return view('category-costs.edit', compact('category'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $category = $this->categoryCost->find($id);

        $result = $category->update($request->all());

        if($result){
            return redirect('/category-costs')->with('sucesso', 'Categoria alterada com sucesso!');
        }else{
            return redirect('/category-costs')->with('erro', 'Ocorreu algum erro ao alterar uma categoria, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        $category = $this->categoryCost->find($id);

        if($category->delete()){
            return redirect('/category-costs')->with('sucesso', 'Categoria deletada com sucesso!');
        }else{
            return redirect('/category-costs')->with('erro', 'Ocorreu algum erro ao deletar uma categoria, tente novamente mais tarde!');
        }

    }


}
