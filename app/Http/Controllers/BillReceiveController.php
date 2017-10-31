<?php

namespace App\Http\Controllers;

use App\BillReceive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BillReceiveController extends Controller
{
    protected $billReceive;

    public function __construct(BillReceive $billReceive)
    {
        $this->billReceive = $billReceive;
    }

    public function index(){

        $user = Auth()->user();

        $billReceives = $user->billReceives;

        return view('bill-receives.list', compact('billReceives'));
    }

    public function add(){

        return view('bill-receives.add');

    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
            'value' => 'required',
            'data_launch' => 'required',
        ]);

        $result = $this->billReceive->create($request->all());

        if($result){
            return redirect('painel/bill-receive')->with('sucesso', 'Conta cadastrada com sucesso!');
        }else{
            return redirect('painel/bill-receive')->with('erro', 'Ocorreu algum erro ao cadastrar uma nova Conta, tente novamente mais tarde!');
        }

    }

    public function edit($id){

        $billReceives = $this->billReceive->find($id);

        if(Gate::denies('owner', $billReceives))
            return redirect()->back();

        return view('bill-receives.edit', compact('billReceives'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $billReceive = $this->billReceive->find($id);

        if(Gate::denies('owner', $billReceive))
            return redirect()->back();

        $result = $billReceive->update($request->all());

        if($result){
            return redirect('painel/bill-receive')->with('sucesso', 'Conta alterada com sucesso!');
        }else{
            return redirect('painel/bill-receive')->with('erro', 'Ocorreu algum erro ao alterar uma Conta, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        $billReceive = $this->billReceive->find($id);

        if(Gate::denies('owner', $billReceive))
            return redirect()->back();

        if($billReceive->delete()){
            return redirect('painel/bill-receive')->with('sucesso', 'Conta deletada com sucesso!');
        }else{
            return redirect('painel/bill-receive')->with('erro', 'Ocorreu algum erro ao deletar uma Conta, tente novamente mais tarde!');
        }

    }

}
