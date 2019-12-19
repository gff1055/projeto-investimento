<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login | Investindo</title>
        <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
        <!-- ASSET -> traz o endereco da raiz na pasta PUBLIC (http://localhost:8000) -->
    </head>
    <body>

        <div class="background">
        </div>

        <section id="conteudo-view" class="login">
            
            <h1>Investindo</h1>
            <h3>O nosso gerenciador de investimento</h3>

            <!-- Abrindo o formulario -->
            {!! 
            Form::open( [
                            'route' => 'user.login',
                            'method' => 'post'
                        ]
            )
            !!}

                <p>Acesse o sistema</p>

                <label>
                    <!-- IMPRIME CAMPO DE TEXTO -->
                    {!! Form::text(
                        // NOME DO INPUT
                        'username',
                        // VALOR PADRAO
                        null,
                        // ATRIBUTOS DESSE INPUT
                        [
                            'class' => 'input',
                            'placeholder' => 'usuario'
                        ]
                    ) !!} 
                </label>

                <label>
                    <!-- MOSTRA O CAMPO DE TEXTO TIPO password -->
                    {!! Form::password(
                        // NOME DO INPUT
                        'password',
                        // ATRIBUTOS DO INPUT
                        [
                            'placeholder' => 'senha'
                        ]
                    ) !!}
                </label>

                {!! Form::submit('Entrar') !!}
                           
            <!-- Fechando o formulario -->
            {!! Form::close() !!}

        </section>

    </body>
</html>