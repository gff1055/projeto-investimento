
@extends('templates.master')                    <? // CARREGANDO O TEMPLATE DE FORMLARIOS ?>

@section('conteudo-view')                       <? // INCLUINDO A SECAO PARA MOSTRAR (conteudo-view) ?>

@if(session('success'))                         <? // CASO A SESSAO success EXISTA ?>
    <h3> {{ session('success')['messages'] }} </h3>         <? // IMPRIMINDO A VARIAVEL messages DA VARIAVEL DE SESSAO success ?>
@endif

<table class="default-table">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Nome da Instituição</th>
            <th>Valor investido</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($product_list as $product)       <!-- utilizando colecao de usuarios vindos do controller(user) -->
            <tr>
                
            </tr>
        @endforeach
    </tbody>
</table>

@endsection