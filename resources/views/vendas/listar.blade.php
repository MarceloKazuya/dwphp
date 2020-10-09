@extends('layout')

@section('titulo')
    Vendas
@endsection
@php
	session(['id_venda' => 0]);
@endphp
@section('conteudo')
    @if(!empty($mensagem))
        <script>
        	id_venda = 7;
            $(document).ready(function(){
                $("#modalMsgSucess").modal();
            });
        </script>
    @endif

    <div class="container-fluid">
    	<div class="row">
        	<div class="col-2 collapse show d-md-flex bg-light pt-2 pl-0 min-vh-100" id="sidebar">
            	<ul class="nav flex-column flex-nowrap overflow-hidden">
                	<li>
                    	<a class="nav-link" href="{{ route('adicionar_vendas') }}"><i class="fa fa-shopping-cart"></i> 
                    		<span class="d-none d-sm-inline">Venda</span>
                    	</a>
                	</li>
                	<li>
                    	<a class="nav-link" href="/produtos" ><i class="fa fa-tag"></i> 
                    		<span class="d-none d-sm-inline">Produtos</span>
                    	</a>
                	<li>
                		<a class="nav-link" href="/users"><i class="fa fa-id-card-alt"></i> 
                			<span class="d-none d-sm-inline">Usuários</span>
                		</a>
                	</li>
                	<li>
                		<a class="nav-link" href="/logout"><i class="fa fa-door-open"></i> 
                			<span class="d-none d-sm-inline">Sair</span>
                		</a>
                	</li>
             	</ul>
        	</div>

	    <div class="col-md-8">
	        <table class="table table-sm table-striped table-bordered mt-2">
	            <thead class="thead-light">
	                <tr>
	                    <th>Número</th>
	                    <th>Data</th>
	                    <th>Subtotal</th>
	                    <th >Desconto</th>
	                    <th >Total</th>
	                    <th class="text-center"><i class="fa fa-wrench"></i></th>
	                </tr>
	            </thead>

	            <tbody>
		            @foreach($vendas as $venda)
		                <tr>
		                    <td>{{$venda->id}}</td>
		                    <td>{{$venda->datavenda}}</td>
		                    <td class="text-right">{{number_format($venda->subtotal,2,',','.')}}</td>
		                    <td class="text-right">{{number_format($venda->desconto,2,',','.')}}</td>
		                    <td class="text-right">{{number_format($venda->total,2,',','.')}}</td>
		                    <td>
		                        <span class="d-flex">
		                            <form method="post" action="/vendas/{{$venda->id}}"
		                                  onsubmit="return confirm('Tem certeza que deseja excluir a venda {{$venda->id}}?')">
		                                @csrf
		                                @method('DELETE')
		                                <button class="btn btn-danger btn-sm mr-2"><i class="fa fa-trash-alt"></i>&nbsp Excluir</button>
		                                <a href="#" onclick="abreModalItens( {{$venda->id}} )" data-toggle="modal" class="btn btn-warning btn-sm mr-2"><i class="fab fa-sistrix"></i>&nbsp Visualizar</a>
		                            </form>
		                        </span>
		                    </td>
		                </tr>
		            @endforeach
	            </tbody>
	        </table>
	   </div> 
    </div>
</div>

@endsection 

<!-- Modal Sucesso  -->
<div id="modalMsgSucess" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">
                    <p class="text-white">{{$mensagem}}</p>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-primary">Ok</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal itens  -->
<div id="modalItens" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">
                	<p id="titulo" class="text-white">Venda nº <script type="text/javascript">id_venda</script></p>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <table class="table table-sm table-striped table-bordered mt-2">
	            <thead class="thead-light">
	                <tr>
	                    <th>id</th>
	                    <th>qtde</th>
	                    <th>preco</th>
	                    <th >Total</th>
	                </tr>
	            </thead>
	            <tbody>

		            @foreach($vendas->find(1)->itens as $item)
		                <tr>
		                    <td>{{$item->produtos_id}}</td>
		                    <td>{{$item->preco}}</td>
		                </tr>
		            @endforeach
	            </tbody>
	        </table>
	        <div class="modal-footer">
        		<a href="#" data-dismiss="modal" class="btn btn-primary">Ok</a>
        	</div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script>
	function abreModalItens(id) {
		id_venda = id;
  		$("#modalItens").modal({
    		show: true
  		});
	}
</script>