
<? // Arquivo para listagem de dados ?>

<table class = "default-table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome do Grupo</th>
			<th>Instituicao</th>
			<th>Nome do responsavel</th>
			<th>Opções</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($group_list as $group)
			<tr>
				<td>{{ $group->id }}</td>
				<td>{{ $group->name }}</td>
				<td>R$ {{ number_format($group->total_value, 2, ',', '.') }}</td>
				<td>{{ $group->institution->name }}</td>
				<td>{{ $group->owner->name }}</td>
				<td>
					{!! Form::open([
						'route' => [
							'group.destroy', $group->id
						],
						'method' => 'DELETE'
					]) !!}
						{!! Form::submit('Remover') !!}
						<a href="{{ route('group.show', $group->id) }}">Detalhes</a>	<? // Detalhes do grupo ?>
						<a href="{{ route('group.edit', $group->id) }}">Editar</a>	<? // Edita o grupo ?>
					{!! Form::close() !!}
					
				</td>
			</tr>
		@endforeach
	</tbody>
</table>