@extends('layout')

@section('titulo')
    Vendas
@endsection

@section('conteudo')

    <div class="form-row justify-content-center">
        <div class="row col-md-8 table-primary">
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
                <button class="btn btn-primary btn-lg" onclick="addItens()"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="/vendas" class="text-center">
                @csrf
                <div class="d-flex" style="padding-top: 10; padding-bottom: 10px;">
                    <div class="p-2">
                        <button type="button" class="btn btn-danger btn-lg mr-3" data-toggle="modal"
                                data-target="#modalMsgSair">
                            Cancela venda
                        </button>
                    </div>
                    <div class="p-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Finalizar venda
                        </button>
                    </div>
                   <div class="ml-auto col-md-3">
                        <div class="form-group" >
                            <label for="idTotal" class="font-weight-bold">TOTAL</label>
                            <input type="number" id="idTotal" name="total" class="btn-lg text-white font-weight-bold form-control form-control-lg" readonly step="0.01" style="background: Green; text-align: right">
                        </div>
                    </div>
                </div>

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
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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

<!-- Modal Mensagens  -->
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
                <a href="{{ route('main') }}"  class="btn btn-primary">OK</a>
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
            cols += '<td>' + id + '</td>';
            cols += '<td col-md-4>' + produto + '</td>';
            cols += '<td>' + qtde + '</td>';
            cols += '<td>' + unidade + '</td>';
            cols += '<td class="text-right">' + preco + '</td>';
            cols += '<td class="subtotal text-right">' + subtotal + '</td>';
            cols += '<td>';
            cols += '<button type="button" class="btn btn-danger btn-sm mr-2" onclick="deleteItens(this)"><i class="fa fa-trash-alt"></i></button>';
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
            $( ".subtotal" ).each( function() {
                soma += Number( $( this ).html() );
            } );
            $("#idTotal").val(parseFloat(soma).toFixed(2));
            //$( "#idTotal" ).text( parseFloat(soma).toFixed(2) );
        }


    })(jQuery);
</script>



