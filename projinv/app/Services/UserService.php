<?php
/* camada para a regras de negocio */

// DEFININDO O NAMESPACE
namespace App\Services;

// CLASSES PARA AUXILIAR O DESENVOLVIMENTO DA CLASSE ATUAL
use Illuminate\Database\QueryException;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

// DECLARACAO DA CLASSE
class UserService
{
    
    
    private $repository;                        /* vai gerenciar obj user em aspecto de banco de dados */
    private $validator;

    // CONSTRUTOR (COM INJECAO DE DEPENDENCIA)
    public function __construct(UserRepository $repository, UserValidator $validator){
        $this->repository = $repository;
        $this->validator = $validator;
    }



    // METODO ONDE É FEITO O CADASTRO DE USUARIO
    public function store($data){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);   // VALIDANDO OS DADOS DO USUARIO PASSADOS
            $usuario = $this->repository->create($data);                // PEDINDO AO REPOSITORIO FAZER UM CADASTRO NO BANCO DE DADOS COM OS DADOS VALIDADOS

            return [
                'success' => true,              // SUCESSO(OU NAO) NO RETORNO DOS DADOS
                'messages' => 'Usuario cadastrado',                     // MENSAGEM A SER ENVIADA
                'data' => $usuario,             // DADOS DO USUARIO CADASTRADO
            ];
        }
        // EM CASO DE EXCECAO
        catch(Exception $e)
        {
            switch(get_class($e))
            {
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

    public function update($data, $id){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);   // VALIDANDO OS DADOS DO USUARIO PASSADOS
            $usuario = $this->repository->update($data, $id);                // PEDINDO AO REPOSITORIO FAZER UM CADASTRO NO BANCO DE DADOS COM OS DADOS VALIDADOS

            return [
                'success' => true,              // SUCESSO(OU NAO) NO RETORNO DOS DADOS
                'messages' => 'Usuario atualizado',                     // MENSAGEM A SER ENVIADA
                'data' => $usuario,             // DADOS DO USUARIO CADASTRADO
            ];
        }
        // EM CASO DE EXCECAO
        catch(Exception $e)
        {
            switch(get_class($e))
            {
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

    /** METODO PARA REMOÇÃO */
    public function destroy($user_id){
        try{
            $this->repository->delete($user_id);                    // EXCLUINDO O USUARIO ASSOCIADO COM O ID

            // RETORNANDO O RESULTADO DA REMOÇAO
            return [
                'success' => true,
                'messages' => 'Usuario removido',
                'data' => null,
            ];
        }
        // CASO HAJA ALGUMA EXCECAO
        catch(Exception $e){
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

