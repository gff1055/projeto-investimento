<table class="default-table">
	<!-- COLUNAS DA TABELA -->
	<thead>
		<tr>
			<td>#</td>
			<td>CPF</td>
			<td>Nome</td>
			<td>Telefone</td>
			<td>Nascimento</td>
			<td>E-mail</td>
			<td>Status</td>
			<td>Permissao</td>
			<td>Menu</td>
		</tr>
	</thead>

	<!-- COLUNAS DA TABELA -->
	<tbody>
		<!-- utilizando colecao de usuarios vindos do controller(user) -->
		@foreach($user_list as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->formatted_cpf }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->formatted_phone }}</td>
			<td>{{ $user->formatted_birth }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->status }}</td>
			<td>{{ $user->permission }}</td>
			<td>
				<? // CRIANDO O BOTAO REMOVER ?>
				{!! Form::open([
					// ROTA PARA REMOÇAO E O ID A SER EXCLUIDO
					'route' => [
						'user.destroy',
						$user->id
					],
					'method' => 'DELETE'
				])!!}

					{!!Form::submit('Remover')!!}
					<a href="{{ route('user.edit', $user->id) }}">Editar</a>
				
				{!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>