<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller {

    public function index(Request $request) {
        $produtos = Produtos::query()
            ->orderBy('produto')
            ->Get();
        $mensagem = $request->session()->get('mensagem');
        return view('produtos.listar', ['produtos' => $produtos, 'mensagem' => $mensagem]);
    }

    public function create() {
        return view('produtos.adicionar');
    }

    public function edit($id) {
        $produtos = Produtos::find($id);
        return view('produtos.editar', ['produtos' => $produtos]);
    }

    public function store(ProdutoRequest $request) {
        Produtos::create($request->all());
        $request->session()->flash('mensagem', 'Produto "' . $request->produto . '" cadastrado com sucesso!');
        return redirect()->route('listar_produtos');
    }

    public function destroy($id) {
        $produtos = Produtos::find($id);
        $produtos->delete();
        return redirect()->route('listar_produtos');
    }

    public function update(ProdutoRequest $request, $id) {

        $produtos = Produtos::find($id);
        $produtos->produto = $request->produto;
        $produtos->unidade = $request->unidade;
        $produtos->preco = $request->preco;
        $produtos->save();
        $request->session()->flash('mensagem', 'Produto "' . $request->produto . '" alterado com sucesso!');
        return redirect()->route('listar_produtos');
    }

    public function __construct() {
        return $this->middleware('auth');
    }

}
