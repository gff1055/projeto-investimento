<? 
/**
 * ARQUIVO QUE POSSUI O TEMPLATE DOS INPUTS
*/


// ATRIBUINDO O NOME DE ALGUMA CLASSE ?>
<label class="{{$class ?? null}}">

    <? // MOSTRANDO O ROTULO DO INPUT (EXIBE O VALOR DE $label, SENAO EXIBE O VALOR DE $input) ?>
    <span>{{$label ?? $input ?? "ERRO"}}</span>

    <? /* MOSTRA UM CAMPO DO TIPO TEXTO COM ATRIBUTOS name = $input, value = $value (ou null) E
    $attributes (ATRIBUTOS COMO placeholder, required, readonly....) */ ?>
    {!!Form::text($input, $value ?? null, $attributes)!!}

</label>