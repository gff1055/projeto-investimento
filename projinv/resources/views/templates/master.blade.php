<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Investindo</title>
        @yield('css-view')
        <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">
    </head>

    <body>
        @include('templates.menu-lateral')
        @yield('conteudo-view')
        @yield('js-view')
    </body>
</html>