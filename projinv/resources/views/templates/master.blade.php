<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Investindo</title>
        @yield('css-view')
        <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    </head>

    <body>
        @include('templates.menu-lateral')
        @yield('conteudo-view')
        @yield('js-view')
    </body>
</html>