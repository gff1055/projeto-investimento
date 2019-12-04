<? 
/**
 * ARQUIVO QUE POSSUI O TEMPLATE DE PASSWORDS
*/


// ATRIBUINDO O NOME DE ALGUMA CLASSE ?>
<label class="{{$class ?? null}}">

    <? // MOSTRANDO O ROTULO DO PASSWORD (EXIBE O VALOR DE $label, SENAO EXIBE O VALOR DE $input) ?>
    <span>{{$label ?? $input ?? "ERRO"}}</span>

    <? /* MOSTRA UM CAMPO DO TIPO PASSWORD COM ATRIBUTOS name = $input E
    $attributes (ATRIBUTOS COMO placeholder, required, readonly....) */ ?>
    {!!Form::password($input, $attributes)!!}

</label>