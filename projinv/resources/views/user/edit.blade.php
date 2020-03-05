<!-- usando o template master da pasta 'template' -->
@extends('templates.master')


@section('css-view')

@endsection


@section('js-view')

@endsection


@section('conteudo-view')

    @if(session('success'))                     <? // CASO A SESSAO success EXISTA ?>
        <h3>{{ session('success')['messages'] }}</h3>      <? // IMPRIMINDO A VARIAVEL messages DA VARIAVEL DE SESSAO success ?>
    @endif

    <!-- Definindo a abertura do formulario -->
    {!! Form::model($user,[                     // Objeto da classe modelo
        'route' => [
            'user.update',                      // Nome da rota
            $user->id                           // Inicia os parametros que a rota espera
        ],
        'method' => 'put',                      // METODO DE ENVIO (put = manutencao de dados)
        'class' => 'form-padrao'                // CLASSE DOR FORMULARIO
    ])
    !!}
        
        @include('user.form-fields')
        
        @include('templates.formulario.submit', [
            'input' => 'Atualizar'
        ])

    {!! Form::close() !!}                       <!-- Definindo a FECHAMENTO do formulario -->
    
@endsection

