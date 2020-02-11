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
    {!! Form::open([
        'route' => 'user.store', // ROTA QUE O FORMULARIO VAI ACIONAR AO SER ENVIADO
        'method' => 'post', //METODO DE ENVIO
        'class' => 'form-padrao'    // CLASSE DOR FORMULARIO
    ])
    !!}
        
        <? // ADICIONANDO OS INPUTS DO FORMULARIO

        // include(ENDEREÇO DA VIEW, ARRAY COM OS VALORES DE ATRIBUTO)?>
        @include('templates.formulario.input', [
            'input' => 'cpf',
            'attributes' => ['placeholder' => 'CPF']
        ])

        @include('templates.formulario.input', [
            'input' => 'name',
            'attributes' => ['placeholder' => 'Nome']
        ])

        @include('templates.formulario.input', [
            'input' => 'phone',
            'attributes' => ['placeholder' => 'Telefone']
        ])
        
        @include('templates.formulario.input', [
            'input' => 'email',
            'attributes' => ['placeholder' => 'E-mail']
        ])

        @include('templates.formulario.password', [
            'input' => 'password',
            'attributes' => ['placeholder' => 'Senha']
        ])
        
        @include('templates.formulario.submit', [
            'input' => 'Cadastrar'
        ])

    <!-- Definindo a FECHAMENTO do formulario -->
    {!! Form::close() !!}

    @include('user.list',	['user_list' => $group->users])

@endsection

