@extends('layout')
@php session(['projeto' => 'Controle de vendas']); @endphp

@section('titulo')
    {{ session('projeto') }}
@endsection

@section('conteudo')
    <div class="login-form">
        <form method="post" action="{{ url('/login') }}">
            @csrf
            <h2 class="text-center">Login</h2>
            <div class="form-group">
                <input type="text" class="form-control" name="nome" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <a href="/register" class="btn btn-secondary mt-3">Registrar-se</a>
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
