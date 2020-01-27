
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
				<td>{{ $group->institution->name }}</td>
				<td>{{ $group->owner->name }}</td>
				<td>
					{!! Form::open(	[
										'route' => ['group.destroy', $group->id],
										'method' => 'DELETE'
					]) !!}
						{!! Form::submit('Remover') !!}
					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>