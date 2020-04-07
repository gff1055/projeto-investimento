
@extends('templates.master')

@section('conteudo-view')
	
	{!! Form::open([
		'route' => [
			'institution.product.store',

		],

		
	]) !!}


	{!! Form::close() !!}
@endsection