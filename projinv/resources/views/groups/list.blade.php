
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
		<?// Listando os grupos?>
		@foreach ($group_list as $group)
			<tr>
				<td>{{ $group->id }}</td> 		<? // id do grupo ?>
				<td>{{ $group->name }}</td>		<? // nome do grupo ?>
				<td>R$ {{ number_format($group->total_value, 2, ',', '.') }}</td>	<? // valor total investido no grupo ?>
				<td>{{ $group->institution->name }}</td>	<? // Instituicao do grupo ?>
				<td>{{ $group->owner->name }}</td>	<? // nome do proprietario grupo ?>
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