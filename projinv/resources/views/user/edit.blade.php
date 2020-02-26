<!-- usando o template master da pasta 'template' -->
@extends('templates.master')


@section('css-view')

@endsection


@section('js-view')

@endsection


@section('conteudo-view')

    <? // CASO A SESSAO success EXISTA ?>
    @if(session('success'))
        <? // IMPRIMINDO A VARIAVEL messages DA VARIAVEL DE SESSAO success ?>
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    <!-- Definindo a abertura do formulario -->
    {!! Form::model($user,[
        'route' => [
            'user.update',                      // ROTA QUE O FORMULARIO VAI ACIONAR AO SER ENVIADO
            $user->id
        ],
        'method' => 'put',                      // METODO DE ENVIO
        'class' => 'form-padrao'                // CLASSE DOR FORMULARIO
    ])
    !!}
        
        @include('user.form-fields')
        
        @include('templates.formulario.submit', [
            'input' => 'Atualizar'
        ])

    <!-- Definindo a FECHAMENTO do formulario -->
    {!! Form::close() !!}
    
@endsection

