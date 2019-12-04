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
                // ROTA QUE O FORMULARIO VAI ACIONAR AO SER ENVIADO
                'route' => 'user.store',
                //METODO DE ENVIO
                'method' => 'post',
                // CLASSE DOR FORMULARIO
                'class' => 'form-padrao'
            ]
    ) !!}

        @include(
            // ENDEREÇO DA VIEW
            'templates.formulario.input', 
            // ARRAY COM AS VARIAVEIS
            [
                'input' => 'cpf', 
                'attributes' => ['placeholder' => 'CPF']
            ]
        )

        @include(
            // ENDEREÇO DA VIEW
            'templates.formulario.input',
            // ARRAY COM AS VARIAVEIS
            [
                'input' => 'name',
                'attributes' => [
                    'placeholder' => 'Nome'
                ]
            ]
        )

        @include(
            // ENDEREÇO DA VIEW
            'templates.formulario.input',
            // ARRAY COM AS VARIAVEIS
            [
                'input' => 'phone',
                'attributes' => [
                    'placeholder' => 'Telefone'
                ]
            ]
        )
        
        @include(
            // ENDEREÇO DA VIEW
            'templates.formulario.input',
            // ARRAY COM AS VARIAVEIS
            [
                'input' => 'email',
                'attributes' => [
                    'placeholder' => 'E-mail'
                ]
            ]
        )

        @include(
            // ENDEREÇO DA VIEW
            'templates.formulario.password',
            // ARRAY COM AS VARIAVEIS
            [
                'input' => 'password',
                'attributes' => [
                    'placeholder' => 'Senha'
                ]
            ]
        )
        
        @include(
            // ENDEREÇO DA VIEW
            'templates.formulario.submit',
            // ARRAY COM AS VARIAVEIS
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
                <td>Menu</td>
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
                <td>
                    {!! Form::open(
                        [
                            'route' =>  [
                                'user.destroy',
                                $user->id
                            ]
                        ]
                    ) !!}
                    {!!Form::submit('Remover')!!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

