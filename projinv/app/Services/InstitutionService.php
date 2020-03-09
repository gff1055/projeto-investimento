<?php

namespace App\Services;                         // DEFININDO O NAMESPACE

use Illuminate\Database\QueryException;         // CLASSES PARA AUXILIAR O DESENVOLVIMENTO DA CLASSE ATUAL
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use Prettus\Validator\Contracts\ValidatorInterface;


class InstitutionService{                       // DECLARACAO DA CLASSE

    private $repository;
    private $validator;

    public function __construct(InstitutionRepository $repository, InstitutionValidator $validator){    // CONSTRUTOR
        $this->repository = $repository;        /* vai gerenciar obj INSTITUTION em aspecto de banco de dados */
        $this->validator = $validator;
    }

    public function store($data){               // METODO PARA FAZER A PERSISTENCIA NO BANCO
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);   // VALIDANDO OS DADOS DA INSTITUIÇÃO PASSADA
            $institution = $this->repository->create($data);            // PEDINDO AO REPOSITORIO FAZER UM CADASTRO NO BANCO DE DADOS COM OS DADOS VALIDADOS

            return [                            // RETORNANDO OS DADOS
                'success' => true,              // SUCESSO(OU NAO) NO RETORNO DOS DADOS
                'messages'   => 'Instituição cadastrado',   // MENSAGEM A SER ENVIADA
                'data' => $institution,         // DADOS DA INSTITUIÇÃO CADASTRADA
            ];
        }
        
        catch(Exception $e){                    // EM CASO DE EXCECAO
            switch(get_class($e)){
                case QueryException::class:     // RETORNANDO ARRAY EM CASO DE EXCECAO
                    return [
                        'success' => false,     // NAO OBTEVE SUCESSO
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

    public function update(array $data, $id){
    
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $institution = $this->repository->update($data, $id);

            return[
                'success' => true,
                'messages' => "Instituicao atualizada",
                'data' => $institution
            ];
        }
        
        catch(Exception $e){                    // EM CASO DE EXCECAO
            switch(get_class($e)){
                case QueryException::class:     // RETORNANDO ARRAY EM CASO DE EXCECAO
                    return [
                        'success' => false,     // NAO OBTEVE SUCESSO
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