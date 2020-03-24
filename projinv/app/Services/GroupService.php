<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

use Illuminate\Database\QueryException;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;


class GroupService{
	private $repository;
	private $validator;


	public function __construct(GroupRepository $repository, GroupValidator $validator){	// funcao cnstrutora
		$this->repository = $repository;
		$this->validator = $validator;
	}


	public function store(array $data) : array{	// Metodo para cadastro de dados
		try{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);	// Efetuando a validacao dos dados passados
			$group = $this->repository->create($data);					// Variavel recebendo a resposta do cadastro dos dados passados
			
			return [							// Retornando os dados da resposta		
				'success' => true,
				'messages' => "Grupo Cadastrado",
				'data' => $group,
			];
		}

		catch(Exception $e){					// Tratando erros em caso gerem excecoes
			switch(get_class($e)){
				case QueryException::class:
					return [
						'success' => false,
						'messages' => $e->getMessage()
					];
				
				case ValidatorException::class:
					return [
						'success' =>false,
						'messages' => $e->getMessageBag()
					];

				case Exception::class:
					return [
						'success' => false,
						'messages' => $e->getMessage()
					];

				default:
					return [
						'success' => false,
						'message' => $e->getMessage()
					];						
			}
		}
	}


	public function userStore($group_id, $data){						// Metodo que faz o relacionamento usuario no grupo
		try{
			$group = $this->repository->find($group_id);				// Instancia de um objeto grupo
			$user_id = $data['user_id'];		// Recebendo a ID do usuario fornecida no formulario de grupos
			$group->users()->attach($user_id);	/* Pega o objeto grupo e insere no relacionamento N:N como uma
												entrada entre o usuario e o grupo*/
			
			return[								// Retornando os dados da resposta
				'success' 	=> true,
				'messages' 	=> "Usuario relacionado com sucesso",
				'data' 		=> $group,
			];
		}

		catch(Exception $e){					// Tratando erros em caso gerem excecoes
			dd($e);
			switch(get_class($e)){
				case QueryException::class:
					return [
						'success' => false,
						'messages' => $e->getMessage()
					];
				
				case ValidatorException::class:
					return [
						'success' =>false,
						'messages' => $e->getMessageBag()
					];

				case Exception::class:
					return [
						'success' => false,
						'messages' => $e->getMessage()
					];

				default:
					return [
						'success' => false,
						'message' => $e->getMessage()
					];						
			}
		}
	}


	public function update($group_id, array $data) : array{	// Metodo que efetua a atualizacao dos dados do grupo

		try{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);	// Valida os dados passados
			$group = $this->repository->update($data, $group_id);	// Faz a atualizacao

			return[								// Retorna os dados
				'success' => true,				// Houve sucesso
				'messages' => "Grupo Atualizado",	// Mensagem
				'data' => $group,				// Dados do grupo
			];
		}

		catch(Exception $e){					// Tratando erros em caso gerem excecoes
			switch(get_class($e)){
				case QueryException::class:
					return [					// Retorno de dados
						'success' => false,		// Nao houve sucesso
						'messages' => $e->getMessage()	// Mensagem de erro
					];
				
				case ValidatorException::class:
					return [
						'success' =>false,
						'messages' => $e->getMessageBag()
					];

				case Exception::class:
					return [
						'success' => false,
						'messages' => $e->getMessage()
					];

				default:
					return [
						'success' => false,
						'message' => $e->getMessage()
					];						
			}
		}
	}

}


?>