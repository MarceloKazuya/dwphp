<?php

namespace App\Http\Controllers;

use App\Vendas;
use App\Itens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller {

    public function __construct() {
        return $this->middleware('auth');
    }

    public function index(Request $request) {
        $vendas = Vendas::query()
            ->orderBy('id','desc')
            ->Get();
        $mensagem = $request->session()->get('mensagem');
        return view('vendas.listar',['vendas' => $vendas, 'mensagem' => $mensagem]);

    }

    public function create() {
        return view('vendas.adicionar');
    }

    public function store(Request $request) {
        DB::beginTransaction();
        $vendas = new Vendas($request->all());
        $vendas->subtotal = $request->vendas_subtotal;
        $vendas->desconto = $request->desconto;
        $vendas->total = $request->total;
        $vendas->save();
        $msg = "mensagem: ";
        for ($i=0; $i < count($request->produtos_id); $i++){
            $itens = new Itens();
            $itens->vendas_id = $vendas->id;
            $itens->produtos_id = $request->produtos_id[$i];
            $itens->quantidade = $request->qtde[$i];
            $itens->preco = $request->preco[$i];
            $itens->total = $request->subtotal[$i];
            $itens->save();
        }

        DB::commit();
        $request->session()->flash('mensagem', 'Venda efetuada com sucesso!');
        return redirect()->route('listar_vendas');
    }

    public function destroy($id) {
        $vendas = Vendas::find($id);
        $vendas->delete();
        return redirect()->route('listar_vendas');
    }

    public function edit($id) {
        $vendas = Vendas::find($id);
        return view('vendas.editar', ['vendas' => $vendas]);
    }

}
