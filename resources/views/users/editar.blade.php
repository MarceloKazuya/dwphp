@extends('layout')

@section('titulo')
    Alterar usuário
@endsection

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-2">
            <form method="post" action="/users/{{$users->id}}">
                @csrf
                @method('PUT')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="idId" class="col-form-label">ID</label>
                    <input type="text" class="form-control" id="idId" name="id" readonly value="{{$users->id}}">
                </div>

                <div class="form-group">
                    <label for="idNome" class="col-form-label">Nome</label>
                    <input type="text" class="form-control" id="idNome" name="nome" value="{{$users->nome}}">
                </div>

                <div class="form-group">
                    <label class ="ml-8 mr-8" for ="nivel">Nível</label>
                    <select id="nivel" name ="nivel" class="form-control">
                        <option value="1"{{$users->nivel==1 ? 'selected':''}}>1</option>
                        <option value="2"{{$users->nivel==2 ? 'selected':''}}>2</option>
                        <option value="3"{{$users->nivel==3 ? 'selected':''}}>3</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('listar_users')}}"><button type="button" class="btn btn-danger">Cancelar</button></a>
                    <button type="submit" class="btn btn-success submitBtn">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
