<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    protected $user;

    public function __construct(User $user){

        $this->user = $user;

    }

    public function index(){

        $users = $this->user->all();

        return view('users.list', compact('users'));
    }

    public function add(){
        return view('users.add');
    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $result = $this->user->create($request->all());

        if($result){
            return redirect('/users')->with('sucesso', 'Usuário cadastrada com sucesso!');
        }else{
            return redirect('/users')->with('erro', 'Ocorreu algum erro ao cadastrar um novo usuário, tente novamente mais tarde!');
        }

    }

    public function edit($id){

        $user = $this->user->find($id);

        return view('users.edit', compact('user'));

    }

    public function update(Request $request, $id){

        $dados = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ];

        if($request->input('password')){
            $dados = array_add($dados, 'password', 'required|min:6|confirmed');
        }

        //Efetua validação dos campos
        $this->validate($request, $dados);

        //busca pelo usuário a ser editado
        $user = $this->user->find($id);

        //executa o update e armazena o retorno true ou false em $result
        $result = $user->update($request->all());


        if($result){
            return redirect('/users')->with('sucesso', 'Usuário editado com sucesso!');
        }else{
            return redirect('/users')->with('erro', 'Ocorreu algum erro ao editar um novo usuário, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        $user = $this->user->find($id);

        if($user->delete()){
            return redirect('/users')->with('sucesso', 'Usuário deletado com sucesso!');
        }else{
            return redirect('/users')->with('erro', 'Ocorreu algum erro ao deletar o usuário, tente novamente mais tarde!');
        }

    }
}
