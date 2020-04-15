
@extends('templates.master')

@section('conteudo-view')
	
	{!! Form::open([
		'route' => [
			'institution.product.store',		// Rota
			$institution->id					// Instituicao associada
		],
		'method' => 'post',						// Metodo de envio
		'class' => 'form-padrao',				// Classe CSS do foemulario
	]) !!}

		@include('templates.formulario.input', [	// template
			'label' => 'Nome do Produto',
			'input' => 'name'
		])

		@include('templates.formulario.input', [
			'label' => 'Descricao',
			'input' => 'description',
		])

		@include('templates.formulario.input', [
			'label' => 'Indexador',
			'input' => 'index',
		])

		@include('templates.formulario.input', [
			'label' => 'Taxa de Juros',
			'input' => 'interest_rate',
		])

		@include('templates.formulario.submit', [
			'input' => 'Cadastrar'
		])

	{!! Form::close() !!}

	<table class = "default-table">
		<thead>
			<th>#</th>
			<th>Nome</th>
			<th>Descricao</th>
			<th>Indexador</th>
			<th>Taxa</th>
			<th>Opções</th>
		</thead>
		<tbody>
			@forelse($institution->products as $product)
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			@empty
			<tr>
				<td>Nada cadastrado</td>
			</tr>

			@endforelse
			
		</tbody>
	</table>


@endsection