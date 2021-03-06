<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth;
use App\CategoryCost;
use GuzzleHttp\Psr7\Response;
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

        return view('category-costs.list');
    }

    public function listar(){

        $categoryCosts = CategoryCost::query()
            ->selectRaw('category_costs.*')
            ->where('user_id', Auth()->user()->id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($categoryCosts);

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

    public function apiAdd(Request $request){

        $categoryCosts = new CategoryCost();

        $categoryCosts->name = $request->input('name');
        $categoryCosts->user_id = Auth()->user()->id;

        /*$result = $this->categoryCost->create($request->all());*/

        if($categoryCosts->save()){
            return response()->json(true);
        }else{
            return response()->json(false);
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

    public function apiUpdate(Request $request){

        $category = $this->categoryCost->find($request->input('id'));

        if(Gate::denies('owner', $category))
            return redirect()->back();

        $result = $category->update($request->all());

        if($result){
            return response()->json(true);
        }else{
            return response()->json(false);
        }

        //return response()->json($request->input('id'));

    }

    public function delete($id){

        $category = $this->categoryCost->find($id);

        if(Gate::denies('owner', $category))
            return redirect()->back();

        if($category->delete()){
            //return redirect('painel/category-costs')->with('sucesso', 'Categoria deletada com sucesso!');
            return response()->json(true);
        }else{
            //return redirect('painel/category-costs')->with('erro', 'Ocorreu algum erro ao deletar uma categoria, tente novamente mais tarde!');
            return response()->json(false);
        }

    }



}
