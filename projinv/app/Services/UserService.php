<?php
/* camada para a regras de negocio */

namespace App\Services;                         // DEFININDO O NAMESPACE

use Illuminate\Database\QueryException;         // CLASSES PARA AUXILIAR O DESENVOLVIMENTO DA CLASSE ATUAL
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserService                               // DECLARACAO DA CLASSE
{
    private $repository;                        /* vai gerenciar obj user em aspecto de banco de dados */
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator){  // CONSTRUTOR (COM INJECAO DE DEPENDENCIA)
        $this->repository = $repository;
        $this->validator = $validator;
    }


    public function store($data){               // METODO ONDE É FEITO O CADASTRO DE USUARIO
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);   // VALIDANDO OS DADOS DO USUARIO PASSADOS
            $usuario = $this->repository->create($data);                // PEDINDO AO REPOSITORIO FAZER UM CADASTRO NO BANCO DE DADOS COM OS DADOS VALIDADOS

            return [
                'success' => true,              // SUCESSO(OU NAO) NO RETORNO DOS DADOS
                'messages' => 'Usuario cadastrado',                     // MENSAGEM A SER ENVIADA
                'data' => $usuario,             // DADOS DO USUARIO CADASTRADO
            ];
        }
        
        catch(Exception $e){                    // EM CASO DE EXCECAO
            switch(get_class($e)){              // RETORNANDO ARRAY EM CASO DE EXCECAO
                case QueryException::class:
                    return [                    // NAO OBTEVE SUCESSO
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

    public function update($data, $id){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);   // VALIDANDO OS DADOS DO USUARIO PASSADOS
            $usuario = $this->repository->update($data, $id);                // PEDINDO AO REPOSITORIO FAZER a atualizacao NO BANCO DE DADOS COM OS DADOS VALIDADOS

            return [
                'success' => true,              // SUCESSO(OU NAO) NO RETORNO DOS DADOS
                'messages' => 'Usuario atualizado',         // MENSAGEM A SER ENVIADA
                'data' => $usuario,             // DADOS DO USUARIO CADASTRADO
            ];
        }
        
        catch(Exception $e){                    // EM CASO DE EXCECAO
            switch(get_class($e)){              // RETORNANDO ARRAY EM CASO DE EXCECAO
                case QueryException::class:
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

    public function destroy($user_id){          /** METODO PARA REMOÇÃO */
        try{
            $this->repository->delete($user_id);                    // EXCLUINDO O USUARIO ASSOCIADO COM O ID
            
            return [                            // RETORNANDO O RESULTADO DA REMOÇAO
                'success' => true,
                'messages' => 'Usuario removido',
                'data' => null,
            ];
        }
        
        catch(Exception $e){                    // CASO HAJA ALGUMA EXCECAO
            switch(get_class($e)){
                case QueryException::class:
                    return [
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

