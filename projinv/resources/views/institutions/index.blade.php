
@extends('templates.master')                    <? // CARREGANDO O TEMPLATE DE FORMLARIOS ?>

@section('conteudo-view')                       <? // INCLUINDO A SECAO PARA MOSTRAR (conteudo-view) ?>

@if(session('success'))                         <? // CASO A SESSAO success EXISTA ?>
    <h3> {{ session('success')['messages'] }} </h3>         <? // IMPRIMINDO A VARIAVEL messages DA VARIAVEL DE SESSAO success ?>
@endif

{!!
Form::open([
    'route' => 'institution.store',
    'method' => 'post',
    'class' => 'form-padrao'
])!!}
    <? // ADICIONANDO OS INPUTS DO FORMULARIO

    // include(ENDEREÇO DA VIEW, ARRAY COM OS VALORES DE ATRIBUTO)?>
    @include('templates.formulario.input', [
        'label' => 'Nome da Instituição',
        'input' => 'name',
        'attributes' => [
            'placeholder' => 'Nome'
        ]
    ])

    @include('templates.formulario.submit', [
        'input' => 'cadastrar'
    ])
    
{!! Form::close(); !!}




<table class="default-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome da Instituição</th>
            <th>Opções</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($institutions as $inst)       <!-- utilizando colecao de usuarios vindos do controller(user) -->
            <tr>
                <td>{{ $inst->id }}</td>
                <td>{{ $inst->name }}</td>
                <td>
                    {!! 
                    // FORMULARIO DE REMOCAO
                    Form::open([
                        'route' => [
                            'institution.destroy',
                            $inst->id
                        ],
                        'method' => 'delete'
                    ])!!}
                    {!! Form::submit("Remover") !!}
                    <a href="{{ route('institution.show', $inst->id) }}">Detalhes</a>   <? // Link que mostra os detalhes da instituicao ?>
                    <a href="{{ route('institution.edit', $inst->id) }}">Editar</a> <? // Link que mostra a opcao de editar as informacoes da instituicao ?>
                    <a href="{{ route('institution.product.index', $inst->id)}}">Produtos</a>   <? // Link que exibe os produtos da instituicao?>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection