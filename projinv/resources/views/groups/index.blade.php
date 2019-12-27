@extends('templates.master')

@section('conteudo-view')

{!! Form::open(	[
					'route' => '',
					'method' => 'post',
					'class' => 'form-padrao'
				]

) !!}



{!! Form::close() !!}

name
user_id
institution_id

@endsection