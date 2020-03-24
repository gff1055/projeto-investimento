
@extends('templates.master')					<? // Template da view?>

@section('conteudo-view')						<? // Conteudo da view?>

	{!! 
	Form::model($group, [
		'route' => [
			'group.update',						// Rota de destno
			$group->id							// Id cuja informacoes serao alteradas
		],
		'method' => 'put',						// Metodo de envio
		'class' => 'form-padrao'

	])
	!!}
	
		@include('templates.formulario.input',[
			'label' => 'Nome do Grupo',
			'input' => 'name',
			'attributes' => [
				'placeholder' => 'Nome do Grupo'
			]
		])

		@include('templates.formulario.select',[
			'label' => 'User',
			'select' => 'user_id',
			'data' => $user_list,
			'attributes' => [
				'placeholder' => 'User',
			]
		])

		@include('templates.formulario.select',[
			'label' => 'Instituição',
			'select' => 'institution_id',
			'data' => $institution_list,
			'attributes' => [
				'placeholder' => 'Instituição'
			]
		])

		@include('templates.formulario.submit',[
			'input' => 'Atualizar'
		])

@endsection