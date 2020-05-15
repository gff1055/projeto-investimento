
@extends('templates.master')

@section('conteudo-view')

	{!! Form::open([							// Abre o formulario
		'route' => 'moviment.application.store',
		'method' => 'post',
		'class' => 'form-padrao'
	])!!}

		@include('templates.formulario.select', [	// Input select para selecionar o grupo
			'label' => 'Grupo',
			'select' => 'group_id',
			'data' => $group_list ?? [],		// Se nao houver dados, ele retorna um array vazio
			'attributes' => [
				'placeholder' => "Grupo"
			]
		])

		@include('templates.formulario.select', [	// Input select para selecionar o produto
			'label' => 'Produto',
			'select' => 'product_id',
			'data' => $product_list ?? [],		// Se nao houver dados, ele retorna um array vazio
			'attributes' => [
				'placeholder' => 'Produtos'
			]
		])

		@include('templates.formulario.input',[	// Input para inserir o valor
			'label' => 'valor',
			'input' => 'name',
			'attributes' => [
				'placeholder' => 'Valor'
			]
		])

		@include('templates.formulario.submit' ,[
			'input' => 'Cadastrar'
		])

	{!! Form::close() !!}

@endsection