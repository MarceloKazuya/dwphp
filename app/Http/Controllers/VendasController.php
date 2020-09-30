<?php

namespace App\Http\Controllers;

use App\Vendas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller {

    public function __construct() {
        return $this->middleware('auth');
    }

    public function index() {
        return view('vendas/vendas');
    }

    public function store(Request $request) {
        DB::beginTransaction();
        $vendas = new Vendas($request->all());
        $vendas->subtotal = $request->total;
        $vendas->desconto = 0;
        $vendas->total = $request->total;
        $vendas->save();
        DB::commit();
        $id = $vendas->id;

        $request->session()->flash('mensagem', 'Venda "' . $vendas->id . '" efeturada com sucesso!');
        return redirect()->route('main');
    }

    public function destroy($id) {
        $vendas = Vendas::find($id);
        $vendas->delete();
        return redirect()->route('vendas');
    }

}
