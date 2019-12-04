<? 
/**
 * ARQUIVO QUE POSSUI O TEMPLATE DE PASSWORDS
*/

// ATRIBUINDO O NOME DE ALGUMA CLASSE ?>
<label class="{{$class ?? null}} submit">

    <? /* MOSTRA UM CAMPO DO TIPO SUBMIT COM ATRIBUTO name = $input */ ?>
    {!! Form::submit($input) !!}

</label>