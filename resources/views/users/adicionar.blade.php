@extends('layout')
@section('titulo')
    Novo usuário
@endsection

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-2">
            <form method="post" action="/users">
                @csrf

                <div class="form-group">
                    <label for="idNome" class="col-form-label">Nome</label>
                    <input type="text" class="form-control" id="idNome" name="nome" value="{{old('nome')}}">
                </div>

                <div class="form-group">
                    <label for="idPassword" class="col-form-label">Password</label>
                    <input type="password" class="form-control" id="idPassword" name="password" value="{{old('password')}}">
                </div>

                <div class="form-group">
                    <label class ="ml-8 mr-8" for ="nivel">Nível</label>
                    <select id="nivel" name ="nivel" class="form-control">
                        <option value=""></option>
                        <option value="1"{{old('nivel')=='1' ? 'selected':''}}>1</option>
                        <option value="2"{{old('nivel')=='2' ? 'selected':''}}>2</option>
                        <option value="3"{{old('nivel')=='3' ? 'selected':''}}>3</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('listar_users')}}"><button type="button" class="btn btn-danger">Cancelar</button></a>
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
