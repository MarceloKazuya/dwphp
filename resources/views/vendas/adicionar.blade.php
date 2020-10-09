@extends('layout')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@section('titulo')
    Vendas
@endsection

@section('conteudo')
    <form method="post" action="/vendas" class="text-center">
        @csrf
        <div class="form-row justify-content-center mt-1">
            <div class="d-flex col-md-8 rounded-top border border-bottom-0 border-dark mt-2">
                <div class="flex-fill col-md-auto">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="form-group float-right">
                            <p>Data: <strong>{{ date("d/m/Y") }}</strong></p>
                            @php
                                $rec = App\Vendas::all();
                                if($rec->isEmpty()){
                                    $num = 1;
                                } else {
                                    $num = App\Vendas::orderBy('id', 'desc')->first()->id + 1;
                                }
                            @endphp
                            <p>Número: <strong>{{ $num }}</strong></p>
                        </div>   
                    </div>
                </div>

                <div class="p-2 flex-fill bd-highlight col-md-2">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="form-group float-righ">
                            <label for="idSubtotal" class="font-weight-bold">SUBTOTAL</label>
                            <input type="number" id="idVendasSubtotal" name="vendas_subtotal" class="btn-lg font-weight-bold form-control form-control-sm" readonly step="0.01" style="text-align: right" placeholder="0.00">
                        </div>   
                    </div>
                </div>

                <div class="p-2 flex-fill bd-highlight col-md-2">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="form-group float-right">
                            <label for="idDesconto" class="font-weight-bold">DESCONTO</label>
                            <div class="input-group">
                            <input type="number" id="idDesconto" name="desconto" class="btn-lg font-weight-bold form-control form-control-sm" readonly step="0.01"style="text-align: right" placeholder="0.00">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#modalDesconto" data-toggle="modal">Informar desconto</a>
                                    <a class="dropdown-item" href="#" onclick="limpaDesconto()">Limpar</a>
                                </div>
                            </div>
                        </div>
                        </div>   
                    </div>
                </div>
                
                <div class="p-2 flex-fill bd-highlight col-md-2">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="form-group float-right">
                            <label for="idTotal" class="font-weight-bold">TOTAL</label>
                            <input type="number" id="idTotal" name="total" class="btn-lg font-weight-bold form-control form-control-sm" readonly step="0.01"style="text-align: right" placeholder="0.00">
                        </div>   
                    </div>
                </div>

                <div class="d-flex p-2 justify-content-end align-items-center col-md-3">
                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#modalMsgSair">
                            <i class="fa fa-times"><strong style="font-family:Arial, Helvetica, sans-serif;">&nbspCancela</strong></i>
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" onclick="return checaPost()">
                            <i class="fa fa-check"><strong style="font-family:Arial, Helvetica, sans-serif;">&nbspFinalizar</strong></i>
                        </button>
                </div>
            </div>

            <div class="row col-md-8 rounded-bottom border border-dark">
                <div class="form-group col-md-6">
                    <label for="idProduto">Produto</label>
                    <select class="form-control" id="idProduto">
                        <option value="" disabled selected>selecione...</option>
                        @foreach (App\Produtos::query()->orderBy('produto')->get('*') as $prod)
                            <option value="{{$prod->id}}" data-produto="{{$prod->produto}}" data-preco="{{$prod->preco}}" data-unidade="{{$prod->unidade}}" >{{ $prod->produto }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="idPreco">Preço $</label>
                    <input type="number" id="idPreco" step="0.01" class="form-control" disabled>
                </div>
                <div class="form-group col-md-1">
                    <label for="idUnidade">UN</label>
                    <input type="text" id="idUnidade" class="form-control" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="idQtde">QTDE</label>
                    <input type="number" class="form-control" id="idQtde">
                </div>
                <div class="form-group" style="margin-top: 4%;" >
                    <button type="button" class="btn btn-primary btn-lg" onclick="addItens()"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-sm table-striped table-bordered col-md-12" id="tbItens">
                    <thead class="thead-light">
                        <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>QTDE</th>
                        <th>UN</th>
                        <th>Preço</th>
                        <th>Subtotal</th>
                        <th>#</th>
                    </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        $("#idProduto").on('change', function(e){
            $("#idCodProduto").val($(this).val());
            $("#idUnidade").val($(this).find(":selected").data("unidade"));
            $("#idPreco").val(parseFloat($(this).find(":selected").data("preco")).toFixed(2));
            document.getElementById('idQtde').focus();
            return false;
        });
    </script>

@endsection

<!-- Modal Sair  -->
<div id="modalMsgSair" class="modal fade">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">
                    <p class="text-white">Confirma cancelamento da venda?</p>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Não</button>
                <a href="{{ route('listar_vendas') }}"  class="btn btn-success">Sim</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Desconto  -->
<div id="modalDesconto" class="modal fade bd-example-modal-sm">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">
                    <p class="text-white">Desconto</p>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="idValorDesconto" class="col-form-label">Valor:</label>
                    <input type="number" class="form-control" id="idValorDesconto">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancela</button>
                <button class="btn btn-success" data-dismiss="modal" onclick="pegaDesconto()">Confirma</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script language="javascript">
    (function($) {
        addItens = function() {
            id = $('#idProduto').val();
            if(id == null){
                alert('Informe o PRODUTO!');
                return false;
            }
            qtde = $('#idQtde').val();
            if(qtde == ''){
                alert('Informe a QTDE');
                document.getElementById('idQtde').focus();
                return false;
            }
            produto = $('#idProduto :selected').text();
            unidade = document.getElementById('idUnidade').value;
            preco = document.getElementById('idPreco').value;
            subtotal = (parseFloat(qtde) * parseFloat(preco)).toFixed(2);
            var newRow = $("<tr>");
            var cols = "";
            
            cols += '<td class="td-id">' + id +'</td>';
            cols += '<td class="td-produto">' + produto + '</td>';
            cols += '<td class="td-qtde">' + qtde + '</td>';
            cols += '<td>' + unidade + '</td>';
            cols += '<td class="td-preco text-right">' + preco + '</td>';
            cols += '<td class="subtotal text-right">' + subtotal + '</td>';
            cols += '<td>';
            cols += '<button type="button" class="btn btn-danger btn-sm mr-2" onclick="deleteItens(this)"><i class="fa fa-trash-alt"></i></button>';
            cols += '<input type="hidden" name="produtos_id[]" value="' + id + '">';
            cols += '<input type="hidden" name="qtde[]" value="' + qtde + '">';
            cols += '<input type="hidden" name="preco[]" value="' + preco + '">';
            cols += '<input type="hidden" name="subtotal[]" value="' + subtotal + '">';
            cols += '</td>';
            
            newRow.append(cols);
            $("#tbItens").append(newRow);
            // limpar os campos
            document.getElementById('idProduto').value="";
            document.getElementById('idPreco').value="";
            document.getElementById('idUnidade').value="";
            document.getElementById('idPreco').value="";
            document.getElementById('idQtde').value="";
            document.getElementById('idProduto').focus();
            somaTotal();
            return false;
        };

        deleteItens = function(item) {
            var tr = $(item).closest('tr');
            tr.fadeOut(400, function() {
                tr.remove();
                somaTotal();
            });
            return false;
        }

        somaTotal = function() {
            var soma = 0;
            var desconto = document.getElementById('idDesconto').value;
            $( ".subtotal" ).each( function() {
                soma += Number( $( this ).html() );
            } );
            $("#idVendasSubtotal").val(parseFloat(soma).toFixed(2));
            $("#idTotal").val(parseFloat(soma-desconto).toFixed(2));
        }
    })(jQuery);

    function pegaDesconto(){
        var desconto = parseFloat(document.getElementById('idValorDesconto').value);
        var subtotal = parseFloat(document.getElementById('idVendasSubtotal').value);
        var total = parseFloat(document.getElementById('idTotal').value);
        if ((subtotal-desconto) < 0){
            alert('Desconto maior que o permitido! Total=' + subtotal.toString() + ' Desconto=' + desconto.toString());
            return false;
        } else {
            $("#idDesconto").val(desconto.toFixed(2));
            somaTotal();
            return true;
        }
    }

    function limpaDesconto(){
        $("#idDesconto").val(parseFloat(0).toFixed(2));
        somaTotal();
        return false;
    }

    function checaPost(){
        var num = 0;
        $( ".subtotal" ).each( function() {
            num++;
        } );
        
        if(num == 0){
            alert('Nenhum produto na lista!');
            return false;
        } else {
            return true;
        }
    }

</script>

