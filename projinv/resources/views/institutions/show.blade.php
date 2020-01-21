

@extends('templates.master')	<? // Extendendo o template ?>

@section('conteudo-view')	<? // Secao de conteudo ?>


<? // Mostra o nome da instituicao ?>
<header>
	<h1>{{ $institution->name }}</h1>
</header>


@include('groups.list',	['group_list' => $institution->groups])

@endsection