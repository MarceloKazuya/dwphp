@extends('layout')

@section('titulo')
    {{ session('projeto') }}
@endsection

@section('conteudo')
    <div class="login-form">
        <form method="post">
            @csrf
            <h2 class="text-center">Registrar</h2>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" required class="form-control" value="{{ old('nome') }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required min="3" class="form-control" value="{{ old('password') }}">
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
                <a href="{{ URL::previous() }}"><button type="button" class="btn btn-danger">Cancelar</button></a>

                <button type="submit" class="btn btn-primary ">Registrar</button>
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

@endsection
