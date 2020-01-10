<?// Template para os inputs do tipo select?>
<label class="{{ $class ?? null }}">
	<span>{{ $label ?? $select ?? "ERRO" }}</span>
	
	<? //  {!! Form::select('NOME DO SELECT', ['VALUE' => 'DESCRICAO']) !!}?>
	{!! Form::select($select, $data ?? []) !!}
</label>