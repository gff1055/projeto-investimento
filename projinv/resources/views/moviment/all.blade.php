
@extends('templates.master')                    <? // CARREGANDO O TEMPLATE DE FORMLARIOS ?>

@section('conteudo-view')                       <? // INCLUINDO A SECAO PARA MOSTRAR (conteudo-view) ?>

@if(session('success'))                         <? // CASO A SESSAO success EXISTA ?>
    <h3> {{ session('success')['messages'] }} </h3>         <? // IMPRIMINDO A VARIAVEL messages DA VARIAVEL DE SESSAO success ?>
@endif

<table class="default-table">
    <thead>
        <tr>
            <th>Data</th>
            <th>Tipo</th>
            <th>Produto</th>
            <th>Grupo</th>
            <th>Valor</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($moviment_list as $moviment)       <!-- utilizando colecao de movimentos vindos do controller -->
            <tr>
                <td>{{ $moviment->created_at->format("d/m/Y H:i") }}</td>   <? //Data do movimento ?>
                <td>{{ $moviment->type == 1 ? "Aplicacao" : "Resgate" }}</td>   <? //Tipo de movimento ?>
                <td>{{ $moviment->product->name }}</td> <? //Nome do produto ?>
                <td>{{ $moviment->group->name }}</td>   <? //Nome do Grupo ?>
                <td>{{ $moviment->value }}</td> <? //Valor do movimento ?>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection