<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\user;
use App\Http\Requests\UsuarioRequest;

class UsersController extends Controller {

    public function index(Request $request) {
        $users = User::query()
            ->orderBy('id')
            ->Get();
        $mensagem = $request->session()->get('mensagem');
        return view('users.listar', ['users' => $users, 'mensagem' => $mensagem]);
    }

    public function create() {
        return view('users.adicionar');
    }

    public function edit($id) {
        $users = User::find($id);
        return view('users.editar', ['users' => $users]);
    }

    public function store(UsuarioRequest $request) {
        //$request->validate(['nome' => 'required','password' => 'required|max:6','nivel' => 'required']);
        User::create($request->all());
        $request->session()->flash('mensagem', 'Usuário "' . $request->nome . '" cadastrado com sucesso!');

        return redirect()->route('listar_users');
    }

    public function destroy($id) {
        $users = User::find($id);
        $users->delete();
        return redirect()->route('listar_users');
    }

    public function update(UsuarioRequest $request, $id) {
        $users = User::find($id);
        $users->nome = $request->nome;
        $users->nivel = $request->nivel;
        $users->save();
        $request->session()->flash('mensagem', 'Usuário "' . $request->nome . '" alterado com sucesso!');
        return redirect()->route('listar_users');
    }

    public function __construct() {
        return $this->middleware('auth');
    }
}
