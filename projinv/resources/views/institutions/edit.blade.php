
@extends('templates.master')				<? // Inserindo o template ?>


@section('conteudo-view')

	@if(session('success'))                         <? // CASO A SESSAO success EXISTA ?>
    	<h3> {{ session('success')['messages'] }} </h3>         <? // IMPRIMINDO A VARIAVEL messages DA VARIAVEL DE SESSAO success ?>
	@endif

	{!!
	Form::model($institution, [
    	'route' => [
			'institution.update',				// rota
			$institution->id					// instituicao a ser atualizada
		],
	    'method' => 'put',						// metodo de envio
    	'class' => 'form-padrao'
	])!!}
    	<? // ADICIONANDO OS INPUTS DO FORMULARIO

	    // include(ENDEREÇO DA VIEW, ARRAY COM OS VALORES DE ATRIBUTO)?>
    	@include('templates.formulario.input', [
        	'label' => 'Nome da Instituição',
	        'input' => 'name',
    	    'attributes' => [
        	    'placeholder' => 'Nome'
	        ]
    	])

	    @include('templates.formulario.submit', [
    	    'input' => 'Atualizar'
	    ])
    
	{!! Form::close(); !!}
@endsection()