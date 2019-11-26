<!-- usando o template master da pasta 'template' -->
@extends('templates.master')


@section('css-view')

@endsection


@section('js-view')

@endsection


@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    <!-- Definindo a abertura do formulario -->
    {!! Form::open(
            [
                'route' => 'user.store',
                'method' => 'post',
                'class' => 'form-padrao'
            ]
    ) !!}

        @include(
            'templates.formulario.input', 
            [
                'input' => 'cpf', 
                'attributes' => ['placeholder' => 'CPF']
            ]
        )

        @include(
            'templates.formulario.input',
            [
                'input' => 'name',
                'attributes' => [
                    'placeholder' => 'Nome'
                ]
            ]
        )

        @include(
            'templates.formulario.input',
            [
                'input' => 'phone',
                'attributes' => [
                    'placeholder' => 'Telefone'
                ]
            ]
        )
        
        @include(
            'templates.formulario.input',
            [
                'input' => 'email',
                'attributes' => [
                    'placeholder' => 'E-mail'
                ]
            ]
        )

        @include(
            'templates.formulario.password',
            [
                'input' => 'password',
                'attributes' => [
                    'placeholder' => 'Senha'
                ]
            ]
        )
        
        @include(
            'templates.formulario.submit',
            [
                'input' => 'Cadastrar'
            ]
        )

    <!-- Definindo a abertura do formulario -->
    {!! Form::close() !!}

    <table class="default-table">
        <thead>
            <tr>
                <td>#</td>
                <td>CPF</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Nascimento</td>
                <td>E-mail</td>
                <td>Status</td>
                <td>Permissao</td>
            </tr>
        </thead>
        <tbody>
            <!-- utilizando colecao de usuarios vindos do controller(user) -->
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->cpf }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->birth }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

