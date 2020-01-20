
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

@include('groups.list', ['group_list' => $groups])

@endsection