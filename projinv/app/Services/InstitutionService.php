<?php

// DEFININDO O NAMESPACE
namespace App\Services;

// CLASSES PARA AUXILIAR O DESENVOLVIMENTO DA CLASSE ATUAL
use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

// DECLARACAO DA CLASSE
class InstitutionService
{

    private $repository;
    private $validator;

    // CONSTRUTOR
    public function __construct(InstitutionRespository $repository, InstitutionValidator $validator)
    {
        /* vai gerenciar obj INSTITUTION em aspecto de banco de dados */
        $this->repository = $repository;
        $this->validator = $validator;
    }

    // METODO PARA FAZER A PERSISTENCIA NO BANCO
    public function store(array $data)
    {
        try
        {
            // VALIDANDO OS DADOS DA INSTITUIÇÃO PASSADA
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            // PEDINDO AO REPOSITORIO FAZER UM CADASTRO NO BANCO DE DADOS COM OS DADOS VALIDADOS
            $institution = $this->repository->create($data);

            // RETORNANDO OS DADOS
            return  [
                        // SUCESSO(OU NAO) NO RETORNO DOS DADOS
                        'success'   => true,
                        // MENSAGEM A SER ENVIADA
                        'messages'   => 'Instituição cadastrado',
                        // DADOS DA INSTITUIÇÃO CADASTRADA
                        'data'      => $institution,
                    ];
        }
        // EM CASO DE EXCECAO
        catch(Exception $exception)
        {
            switch(get_class($e))
            {
                // RETORNANDO ARRAY EM CASO DE EXCECAO
                case QueryException::class:
                    return  [
                                // NAO OBTEVE SUCESSO
                                'success' => false,
                                'messages' => $e->getMessage()
                            ];
             
                case ValidatorException::class:
                    return  [
                                'success' => false,
                                'messages' => $e->getMessagesBag()
                            ];
                
                case Exception::class:
                    return  [
                                'success' => false,
                                'messages' => $e->getMessage()
                            ];
                default:
                    return  [
                                'success' => false,
                                'messages' => $e->getMessage()
                            ];
            }
        }
    }
}

?>