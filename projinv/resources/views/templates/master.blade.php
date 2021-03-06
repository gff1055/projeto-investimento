<?php //Arquivo onde tem a base do HTML(tag HEAD, abertura do arquivo HTML,...) ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Investindo</title>
        <? // Criando seções que serão preenchidas ?>
        @yield('css-view')
        <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    </head>

    <body>
        <? // INCLUI O TEMPLATE DO MENU LATERAL ?>
        @include('templates.menu-lateral')

        <section id="view-conteudo">
            
            @yield('conteudo-view')
        </section>
        
        @yield('js-view')
    </body>
</html>