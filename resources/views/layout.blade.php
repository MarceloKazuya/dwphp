@php
    @include('Illuminate\Support\Facades\Auth');
@endphp

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Caixa</title>

    <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <style>
        .login-form { width: 340px; margin: 50px auto; font-size: 15px; }
        .login-form form { margin-bottom: 15px; background: #f7f7f7; box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); padding: 30px; }
        .login-form h2 { margin: 0 0 15px; }
        .form-control, .btn { min-height: 38px; border-radius: 2px; }
        .btn { font-size: 15px; font-weight: bold; }
         .footer { position: fixed; left: 0; bottom: 0; width: 100%; background-color: DarkSlateGray; color: white; font-size: 15px; text-align: center; align-self: center; }
    </style>
</head>
<body>
    <div>
        <div class="d-flex align-items-center" style="background-color: DarkSlateGray;">
            <div class="p-2 flex-fill">
                <div class="d-flex flex-wrap">
                    <img src="{{ asset('img/pdv.png') }}" class="rounded d-block">
                </div>
            </div>

            <div class="p-2 flex-fill">
                <div class="text-center text-white">
                    <h5>@yield('titulo')</h5>
                </div>
            </div>

            <div class="p-2 flex-fill text-right">
                @auth
                    <a href="/logout" class="btn btn-dark btn-sm">
                        {{Auth::user()->nome}} / Logout
                    </a>
                @endauth
            </div>
        </div>
    </div>


    @yield('conteudo')

    <div align-items-center >
        <div class="text-center">
            <p style="font-size: 10px; padding-top: 10px;">Copyright 2020 - Marcelo Kariatsumari</p>
        </div>
    </div>


</body>

</html>
