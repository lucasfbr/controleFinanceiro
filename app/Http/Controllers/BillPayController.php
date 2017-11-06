<?php

namespace App\Http\Controllers;

use App\BillPay;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;


class BillPayController extends Controller
{
    protected $billPay;

    public function __construct(BillPay $billPay)
    {
        $this->billPay = $billPay;
    }

    public function index(){

        $user = Auth()->user();

        $billPays = $user->billPays;

        return view('bill-pays.list', compact('billPays'));
    }

    public function add(){

        $user = Auth()->user();

        $categoryCosts = $user->categoryCosts;

        return view('bill-pays.add', compact('categoryCosts'));

    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
            'value' => 'required',
            'data_launch' => 'required',
            'category_cost_id' => 'required',
        ]);

        $result = $this->billPay->create($request->all());

        if($result){
            return redirect('painel/bill-pay')->with('sucesso', 'Conta cadastrada com sucesso!');
        }else{
            return redirect('painel/bill-pay')->with('erro', 'Ocorreu algum erro ao cadastrar uma nova Conta, tente novamente mais tarde!');
        }

    }

    public function edit($id){

        $billPays = $this->billPay->find($id);

        if(Gate::denies('owner', $billPays))
            return redirect()->back();

        $user = Auth()->user();

        $categoryCosts = $user->categoryCosts;

        return view('bill-pays.edit', array('billPays' => $billPays , 'categoryCosts' => $categoryCosts));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|max:255',
            'value' => 'required',
            'data_launch' => 'required',
            'category_cost_id' => 'required',
        ]);

        $billPay = $this->billPay->find($id);

        if(Gate::denies('owner', $billPay))
            return redirect()->back();

        $result = $billPay->update($request->all());

        if($result){
            return redirect('painel/bill-pay')->with('sucesso', 'Conta alterada com sucesso!');
        }else{
            return redirect('painel/bill-pay')->with('erro', 'Ocorreu algum erro ao alterar uma Conta, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        $billPay = $this->billPay->find($id);

        if(Gate::denies('owner', $billPay))
            return redirect()->back();

        if($billPay->delete()){
            return redirect('painel/bill-pay')->with('sucesso', 'Conta deletada com sucesso!');
        }else{
            return redirect('painel/bill-pay')->with('erro', 'Ocorreu algum erro ao deletar uma Conta, tente novamente mais tarde!');
        }

    }

    public function editStatus($id){

        $billPays = $this->billPay->find($id);

        if(Gate::denies('owner', $billPays))
            return redirect()->back();

        $user = Auth()->user();

        $categoryCosts = $user->categoryCosts;

        return view('bill-pays.pay', array('billPays' => $billPays , 'categoryCosts' => $categoryCosts));

    }

    public function updateStatus(Request $request, $id){

        $this->validate($request, [
            'data_pay' => 'required',
        ]);

        $billPay = $this->billPay->find($id);

        if(Gate::denies('owner', $billPay))
            return redirect()->back();

        $result = $billPay->update($request->all());

        if($result){
            return redirect('painel/bill-pay')->with('sucesso', 'Conta alterada com sucesso!');
        }else{
            return redirect('painel/bill-pay')->with('erro', 'Ocorreu algum erro ao alterar uma Conta, tente novamente mais tarde!');
        }

    }
}
