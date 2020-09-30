@extends('layout')
@section('titulo')
    Novo produto
@endsection

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-3">
            <form method="post" action="/produtos">
                @csrf
                <div class="form-group">
                    <label for="idProduto" class="col-form-label">Descrição</label>
                    <input type="text" class="form-control" id="idProduto" name="produto" value="{{old('produto')}}" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div class="form-group">
                    <label class ="ml-8 mr-8" for ="idUnidade">Unidade</label>
                    <select id="idUnidade" name ="unidade" class="form-control">
                        <option value=""></option>
                        <option value="UN"{{old('unidade')=='UN' ? 'selected':''}}>UN</option>
                        <option value="KG"{{old('unidade')=='KG' ? 'selected':''}}>KG</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idPreco" class="col-form-label">Preço</label>
                    <input type="number" class="form-control" id="idPreco" name="preco" step="0.01" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)"  value="{{old('preco')}}">
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
