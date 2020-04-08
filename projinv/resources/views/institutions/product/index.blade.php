
@extends('templates.master')

@section('conteudo-view')
	
	{!! Form::open([
		'route' => [
			'institution.product.store',
			$institution->id
		],
		'method' => 'post',
		'class' => 'form-padrao',		
	]) !!}

		@include('templates.formulario.input', [
			'label' => 'Nome do Produto',
			'input' => 'name'
		])

		@include('templates.formulario.input', [
			'label' => '',
			'' => '',
			'' => '',
		])

		@include('templates.formulario.input', [
			'label' => '',
			'' => '',
			'' => '',
		])

		@include('templates.formulario.input', [
			'label' => '',
			'' => '',
			'' => '',
		])

	{!! Form::close() !!}
@endsection