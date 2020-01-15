<?// Template para os inputs do tipo select?>
<label class="{{ $class ?? null }}">
	<span>{{ $label ?? $select ?? "ERRO" }}</span>
	
	<? //Cria um select (necessario passar nome e dados) ?>	
	{!! Form::select($select, $data ?? []) !!}
</label>
