
<? // CARREGANDO O TEMPLATE DE FORMLARIOS ?>
@extends('templates.master')

<? // INCLUINDO A SECAO PARA MOSTRAR (conteudo-view) ?>
@section('conteudo-view')

<? // CASO A SESSAO success EXISTA ?>
@if(session('success'))
    <? // IMPRIMINDO A VARIAVEL messages DA VARIAVEL DE SESSAO success ?>
    <h3> {{ session('success')['messages'] }} </h3>
@endif

{!!
Form::open( [
                'route' => 'institution.store',
                'method' => 'post',
                'class' => 'form-padrao'
            ])!!}
    <? // ADICIONANDO OS INPUTS DO FORMULARIO

    // include(ENDEREÇO DA VIEW, ARRAY COM OS VALORES DE ATRIBUTO)?>
    @include('templates.formulario.input',  [
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
        <!-- utilizando colecao de usuarios vindos do controller(user) -->
        @foreach ($institutions as $inst)
            <tr>
                <td>{{ $inst->id }}</td>
                <td>{{ $inst->name }}</td>
                <td>
                    {!! 
                    // FORMULARIO DE REMOCAO
                    Form::open( [
                                    'route' =>  [
                                                    'institution.destroy',
                                                    $inst->id
                                                ],
                                    'method' => 'delete'
                                ]
                    )
                    !!}
                    {!! Form::submit("Remover") !!}
                    <a href="{{ route('institution.show', $inst->id) }}">Detalhes</a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection