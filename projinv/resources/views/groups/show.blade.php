
@extends('templates.master')

@section('conteudo-view')

<header>
	<h1>Nome do grupo: {{ $group->name }}</h1>
	<h2>Instituição: {{ $group->institution->name }}</h2>
	<h2>Nome do responsavel: {{ $group->owner->name }}</h2>
</header>

{!! Form::open([
	'route' => [
		'group.user.store',
		$group->id
	],
	'method' => 'post',
	'class' => 'form-padrao'
]) !!}

	@include('templates.formulario.select', [
		'label' => "Usuário",
		'select' => 'user_id',
		'data' => $user_list,
		'attributes' => [
			'placeholder' => "Usuário"
		]
	])

	@include('templates.formulario.submit', [
		'input' => 'Relacionar ao grupo ' . $group->name
	])
	
{!! Form::close() !!}

<? // Fazendo o include do arquivo LIST.BLADE.PHP da pasta GROUPS para reutilização da tabela  ?>
@include('user.list',	['user_list' => $group->users])

@endsection