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


	// funcao cnstrutora
	public function __construct(GroupRepository $repository, GroupValidator $validator){
		$this->repository = $repository;
		$this->validator = $validator;
	}


	// Metodo para cadastro de dados
	public function store(array $data) : array{
		try{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);	// Efetuando a validacao dos dados passados
			$group = $this->repository->create($data);					// Variavel recebendo a resposta do cadastro dos dados passados
			
			// Retornando os dados da resposta
			return [
				'success' => true,
				'messages' => "Grupo Cadastrado",
				'data' => $group,
			];
		}

		// Tratando erros em caso gerem excecoes
		catch(Exception $e){
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


	// Metodo que faz o relacionamento usuario no grupo
	public function userStore($group_id, $data){
		try{

			$group = $this->repository->find($group_id);				// Instancia de um objeto grupo
			$user_id = $data['user_id'];		// Recebendo a ID do usuario fornecida no formulario de grupos
			$group->users()->attach($user_id);	/* Pega o objeto grupo e insere no relacionamento N:N como uma
												entrada entre o usuario e o grupo*/
			
			// Retornando os dados da resposta
			return [
				'success' 	=> true,
				'messages' 	=> "Usuario relacionado com sucesso",
				'data' 		=> $group,
			];
		}

		// Tratando erros em caso gerem excecoes
		catch(Exception $e){
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

}


?>