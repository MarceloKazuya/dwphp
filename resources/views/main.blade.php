@extends('layout')
@section('titulo')
    {{ session('projeto') }}
@endsection
@section('conteudo')
    <div style="margin-top: 50px;" >
        <div class="d-flex justify-content-center align-items-center">
            <div class="p-2 bg-dark">
                <a href="/vendas" class="btn btn-outline-light">
                    <i class="fa fa-shopping-cart fa-3x">
                        <p style="font-size: 15px; padding-top: 10px;">Vendas</p>
                    </i>
                </a>
            </div>
            <div class="p-2 bg-dark">
                <a href="/produtos" class="btn btn-outline-light">
                    <i class="fa fa-tag fa-3x">
                        <p style="font-size: 15px; padding-top: 10px;">Produtos</p>
                    </i>
                </a>
            </div>
            <div class="p-2 bg-dark">
                <a href="/users" class="btn btn-outline-light">
                    <i class="fa fa-id-card-alt fa-3x">
                        <p style="font-size: 15px; padding-top: 10px;">Usuários</p>
                    </i>
                </a>
            </div>
            <div class="p-2 bg-dark">
                <a href="/logout" class="btn btn-outline-light">
                    <i class="fa fa-door-open fa-3x">
                        <p style="font-size: 15px; padding-top: 10px;">Sair</p>
                    </i>
                </a>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <!--
            <div class="p-2 bg-dark">
                <a href="#" class="btn btn-outline-light">
                    <i class="fa fa-clipboard-list fa-3x">
                        <p style="font-size: 15px; padding-top: 10px;">Consultas</p>
                    </i>
                </a>
            </div>
            <div class="p-2 bg-dark">
                <a href="#" class="btn btn-outline-light">
                    <i class="fa fa-file-alt fa-3x">
                        <p style="font-size: 15px; padding-top: 10px;">Relatórios</p>
                    </i>
                </a>
            </div>
            -->

        </div>
    </div>
@endsection

