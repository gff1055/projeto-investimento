
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
			]
)
!!}

	@include('templates.formulario.input',	[
												'label' => "Nome do Grupo",
												'input' => 'name',
												'attributes' =>	[
																	'placeholder' => "Nome do Grupo"
																]
											]
	)

	@include('templates.formulario.input',	[
												'label' => "User",
												'input' => 'user_id',
												'attributes' => 	[
																		'placeholder' => "User"
																	]
											]
	)
	
	@include('templates.formulario.input',	[
												'label' => "Institution",
												'input' => 'institution_id',
												'attributes' => 	[
																		'placeholder' => "Instituicao"
																	]
											]
	)

	@include('templates.formulario.submit', [
                                                'input' => 'cadastrar'
											]
	)


{!! Form::close() !!}


@endsection