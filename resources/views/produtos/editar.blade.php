@extends('layout')

@section('titulo')
    Alterar produto
@endsection

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-2">
            <form method="post" action="/produtos/{{$produtos->id}}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="idId" class="col-form-label">ID</label>
                    <input type="text" class="form-control" id="idId" name="id" readonly value="{{$produtos->id}}">
                </div>

                <div class="form-group">
                    <label for="idProduto" class="col-form-label">Descrição</label>
                    <input type="text" class="form-control" id="idProduto" name="produto" value="{{$produtos->produto}}" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div class="form-group">
                    <label class ="ml-8 mr-8" for ="unidade">Unidade</label>
                    <select id="idUnidade" name ="unidade" class="form-control">
                        <option value=""></option>
                        <option value="UN"{{$produtos->unidade=='UN' ? 'selected':''}}>UN</option>
                        <option value="KG"{{$produtos->unidade=='KG' ? 'selected':''}}>KG</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idPreco" class="col-form-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" id="idPreco" name="preco" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" value="{{$produtos->preco}}">
                </div>

                <div class="modal-footer">
                    <a href="{{ route('listar_produtos')}}"><button type="button" class="btn btn-danger">Cancelar</button></a>
                    <button type="submit" class="btn btn-success submitBtn">Salvar</button>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
