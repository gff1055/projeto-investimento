<? // ADICIONANDO OS INPUTS DO FORMULARIO

// include(ENDEREÇO DA VIEW, ARRAY COM OS VALORES DE ATRIBUTO)?>
@include('templates.formulario.input', [
	'input' => 'cpf',
	'attributes' => ['placeholder' => 'CPF']
])

@include('templates.formulario.input', [
	'input' => 'name',
	'attributes' => ['placeholder' => 'Nome']
])

@include('templates.formulario.input', [
	'input' => 'phone',
	'attributes' => ['placeholder' => 'Telefone']
])

@include('templates.formulario.input', [
	'input' => 'email',
	'attributes' => ['placeholder' => 'E-mail']
])

@include('templates.formulario.password', [
	'input' => 'password',
	'attributes' => ['placeholder' => 'Senha']
])