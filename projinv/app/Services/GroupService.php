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
			// Efetuando a validacao dos dados passados
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			// Variavel recebendo a resposta do cadastro dos dados passados
			$group = $this->repository->create($data);

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

	public function userStore($group_id, $data){
		try{

			// Retornando os dados da resposta
			return [
				'success' 	=> true,
				'messages' 	=> "Usuario relacionado com sucesso",
				'data' 		=> null,
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

}


?>