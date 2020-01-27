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
    {!! Form::open( [
                        // ROTA QUE O FORMULARIO VAI ACIONAR AO SER ENVIADO
                        'route' => 'user.store',
                        //METODO DE ENVIO
                        'method' => 'post',
                        // CLASSE DOR FORMULARIO
                        'class' => 'form-padrao'
    ])
    !!}
        
        <? // ADICIONANDO OS INPUTS DO FORMULARIO

        // include(ENDEREÇO DA VIEW, ARRAY COM OS VALORES DE ATRIBUTO)?>
        @include('templates.formulario.input',  [
                                                    'input' => 'cpf', 
                                                    'attributes' => ['placeholder' => 'CPF']
        ])

        @include('templates.formulario.input',  [
                                                    'input' => 'name',
                                                    'attributes' => ['placeholder' => 'Nome']
        ])

        @include('templates.formulario.input',  [
                                                    'input' => 'phone',
                                                    'attributes' => ['placeholder' => 'Telefone']
        ])
        
        @include('templates.formulario.input',  [
                                                    'input' => 'email',
                                                    'attributes' => ['placeholder' => 'E-mail']
        ])

        @include('templates.formulario.password',   [
                                                        'input' => 'password',
                                                        'attributes' => ['placeholder' => 'Senha']
        ])
        
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])

    <!-- Definindo a FECHAMENTO do formulario -->
    {!! Form::close() !!}


    <table class="default-table">
        <!-- COLUNAS DA TABELA -->
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

        <!-- COLUNAS DA TABELA -->
        <tbody>
            <!-- utilizando colecao de usuarios vindos do controller(user) -->
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->formatted_cpf }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->formatted_phone }}</td>
                <td>{{ $user->formatted_birth }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->permission }}</td>
                <td>
                    <? // CRIANDO O BOTAO REMOVER ?>
                    {!! Form::open( [
                                        // ROTA PARA REMOÇAO E O ID A SER EXCLUIDO
                                        'route' =>  ['user.destroy',$user->id],
                                        'method' => 'DELETE'
                                    ])!!}

                        {!!Form::submit('Remover')!!}
                    
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

