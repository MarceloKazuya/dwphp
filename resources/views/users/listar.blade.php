@extends('layout')

@section('titulo')
    Usuários
@endsection

@section('conteudo')
    @if(!empty($mensagem))
        <script>
            $(document).ready(function(){
                $("#modalMsgSucess").modal();
            });
        </script>
    @endif
    <div class="justify-content-center align-items-center row mt-2">
        <table class="table table-sm table-striped table-bordered col-md-4">
            <thead class="thead-light">
            <tr>
                <th>Código</th>
                <th class="col-md-auto">Nome</th>
                <th>
                    <a href="{{ route('adicionar_users') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbspNovo</a>
                    <a href="{{ route('listar_vendas') }}" class="btn btn-secondary"><i class="fa fa-undo"></i>&nbsp Voltar</a>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $usu)
                <tr>
                    <td>{{$usu->id}}</td>
                    <td>{{$usu->nome}}</td>
                    <td>
                        <span class="d-flex">
                            <form method="post" action="/users/{{$usu->id}}"
                                  onsubmit="return confirm('Tem certeza que deseja remover {{$usu->nome}}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm mr-2"><i class="fa fa-trash-alt"></i>&nbsp Excluir</button>
                                <a href="/users/{{$usu->id}}/edit" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil-alt"></i>&nbsp Editar</a>
                            </form>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

<!-- Modal Mensagens  -->
<div id="modalMsgSucess" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">
                    <p class="text-white">Sucesso</p>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <p id="msgConteudo">{{$mensagem}}</p>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-primary">Ok</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

