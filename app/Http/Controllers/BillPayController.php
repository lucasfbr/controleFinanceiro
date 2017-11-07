<?php

namespace App\Http\Controllers;

use App\BillPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class BillPayController extends Controller
{
    protected $billPay;
    private $extensoes = ['jpg','jpeg','png','pdf'];
    private $caminhoImg = 'billPay/anexos/';

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

        $input = $request->all();

        if(!empty($request->file('anexo'))){
            //armazena a imagem enviada pelo form
            $image = $request->file('anexo');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $input['anexo'] = $this->moverImagem($image, $extensao);
        }

        $result = $billPay->update($input);

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

        $input = $request->all();

        if(!empty($request->file('anexo'))){
            //armazena a imagem enviada pelo form
            $image = $request->file('anexo');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $input['anexo'] = $this->moverImagem($image, $extensao);
        }

        $result = $billPay->update($input);

        if($result){
            return redirect('painel/bill-pay')->with('sucesso', 'Conta alterada com sucesso!');
        }else{
            return redirect('painel/bill-pay')->with('erro', 'Ocorreu algum erro ao alterar uma Conta, tente novamente mais tarde!');
        }

    }

    public function details($id){

        $billPays = $this->billPay->find($id);

        if(Gate::denies('owner', $billPays))
            return redirect()->back();

        return view('bill-pays.details', compact('billPays'));

    }

    /*
    * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
    */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos: jpg, jpeg, png e pdf');
        } else {
            $filename = 'anexos' . time() . '.' . $extensao;
            $path = public_path($this->caminhoImg . $filename);


            if($extensao == 'pdf'){
                $image->move(public_path($this->caminhoImg), $filename);
            }else{
                Image::make($image->getRealPath())->resize(600,400)->save($path);
            }

            return $this->caminhoImg . $filename;
        }
    }
    /*
   * Metodo responsavel por verificar se a imagem existe no diretorio e remove-lá
   */
    public function removeImagemDir($imagem){
        //verifica se a foto antiga existe no diretorio
        if(File::exists($imagem)) {
            //remove a foto do diretorio
            File::delete($imagem);
        }
    }
}
