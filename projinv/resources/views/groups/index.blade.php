
<?php // Extendendo o TEMPLATES.MASTER (template do site)  ?>
@extends('templates.master')

<?php // Setando a secao de conteudo da pagina  ?>
@section('conteudo-view')

<?php // Formulario para cadastrar os grupos de investimento  ?>
{!!
Form::open(	[
				'route' => 'group.store',
				'method' => 'post',
				'class' => 'form-padrao'
])
!!}

	@include('templates.formulario.input',	[
												// Atributos usados no template
												'label' => "Nome do Grupo",
												'input' => 'name',
												'attributes' =>	['placeholder' => "Nome do Grupo"]
	])

	@include('templates.formulario.select',	[
												// Atributos usados no template
												'label' => "User",
												'select' => 'user_id',
												'data' => $user_list,	// Dados para <option> de <select>
												'attributes' => ['placeholder' => "User"]
	])
	
	@include('templates.formulario.select',	[
												// Atributos usados no template
												'label' => "Institution",
												'select' => 'institution_id',
												'data' => $institution_list, // Dados para <option> de <select>
												'attributes' => ['placeholder' => "Instituicao"	]
	])

	@include('templates.formulario.submit', [
												// Atributos usados no template
                                                'input' => 'cadastrar'
	])


{!! Form::close() !!}


<table class="default-table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome do grupo</th>
			<th>Instituicao</th>
			<th>Nome do responsável</th>
			<th>Opções</th>
		</tr>
	</thead>
	<tbody>
		@foreach($groups as $group)
			<tr>
				<td>{{ $group->id }}</td>
				<td>{{ $group->name }}</td>
				<td>{{ $group->institution->name }}</td>
				<td>{{ $group->owner->name }}</td>
				<td>
					{!! Form::open(	[
										'route' =>	['group.destroy', $group->id],
										'method' => 'DELETE'
					]) !!}
						{!! Form::submit('Remover') !!}
					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection