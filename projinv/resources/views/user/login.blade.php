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

        <section id="conteudo-view" class="login">
            
            <h1>Investindo</h1>
            <h3>O nosso gerenciador de investimento</h3>

            {!! Form::open(['route'=>'user.login','method'=>'post']) !!}

            <p>Acesse o sistema</p>

            <label>
                <!-- imprime campo de texto -->
                {!! Form::text('username',null, ['class'=>'input', 'placeholder'=>'usuario']) !!} 
                <!--TEXT -> imprime campo de texto
                    USERNAME -> nome do input
                    NULL -> valor padrao
                    ['CLASS'=>'INPUT', 'PLACEHOLDER'=>'USUARIO'] -> Array de atributos para p input
                -->
            </label>

            <label>
                {!! Form::password('password', ['placeholder'=>'senha']) !!}
                <!--PASSWORD -> imprime campo de senha
                    PASSWORD -> nome do input
                    ['PLACEHOLDER'=>'SENHA'])  Array de atributos para p input
                -->
            </label>

            {!! Form::submit('Entrar') !!}
            <!--SUBMIT -> imprime campo de submissao
                ENTRAR -> nome exibido no botao
            -->
                
           

            {!! Form::close() !!}

        </section>

    </body>
</html>