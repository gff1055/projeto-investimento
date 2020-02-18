<?php

// DEFININDO O NAMESPACE
namespace App\Services;

// CLASSES PARA AUXILIAR O DESENVOLVIMENTO DA CLASSE ATUAL
use Illuminate\Database\QueryException;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

// DECLARACAO DA CLASSE
class InstitutionService{

    private $repository;
    private $validator;

    // CONSTRUTOR
    public function __construct(InstitutionRepository $repository, InstitutionValidator $validator){
        /* vai gerenciar obj INSTITUTION em aspecto de banco de dados */
        $this->repository = $repository;
        $this->validator = $validator;
    }

    // METODO PARA FAZER A PERSISTENCIA NO BANCO
    public function store($data){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);   // VALIDANDO OS DADOS DA INSTITUIÇÃO PASSADA
            $institution = $this->repository->create($data);            // PEDINDO AO REPOSITORIO FAZER UM CADASTRO NO BANCO DE DADOS COM OS DADOS VALIDADOS

            // RETORNANDO OS DADOS
            return [
                'success' => true,              // SUCESSO(OU NAO) NO RETORNO DOS DADOS
                'messages'   => 'Instituição cadastrado',   // MENSAGEM A SER ENVIADA
                'data' => $institution,         // DADOS DA INSTITUIÇÃO CADASTRADA
            ];
        }
        // EM CASO DE EXCECAO
        catch(Exception $e){
            switch(get_class($e)){
                // RETORNANDO ARRAY EM CASO DE EXCECAO
                case QueryException::class:
                    return [
                        // NAO OBTEVE SUCESSO
                        'success' => false,
                        'messages' => $e->getMessage()
                    ];
             
                case ValidatorException::class:
                    return [
                        'success' => false,
                        'messages' => $e->getMessagesBag()
                    ];
                
                case Exception::class:
                    return [
                        'success' => false,
                        'messages' => $e->getMessage()
                    ];

                default:
                    return [
                        'success' => false,
                        'messages' => $e->getMessage()
                    ];
            }
        }
    }
}

?>