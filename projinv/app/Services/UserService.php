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
    
    /* vai gerenciar obj user em aspecto de banco de dados */
    private $repository;
    
    // 
    private $validator;

    // CONSTRUTOR (COM INJECAO DE DEPENDENCIA)
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    // METODO ONDE É FEITO O CADASTRO DE USUARIO
    public function store($data)
    {
        try
        {
            // VALIDANDO OS DADOS DO USUARIO PASSADOS
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            // PEDINDO AO REPOSITORIO FAZER UM CADASTRO NO BANCO DE DADOS COM OS DADOS VALIDADOS
            $usuario = $this->repository->create($data);

            return  [
                        // SUCESSO(OU NAO) NO RETORNO DOS DADOS
                        'success'   => true,
                        // MENSAGEM A SER ENVIADA
                        'messages'   => 'Usuario cadastrado',
                        // DADOS DO USUARIO CADASTRADO
                        'data'      => $usuario,
                    ];
        }
        // EM CASO DE EXCECAO
        catch(Exception $e)
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

    public function update()
    {

    }

    /** METODO PARA REMOÇÃO */
    public function destroy($user_id)
    {
        try
        {
            // EXCLUINDO O USUARIO ASSOCIADO COM O ID
            $this->repository->delete($user_id);

            // RETORNANDO O RESULTADO DA REMOÇAO
            return  [
                        'success' => true,
                        'messages' => 'Usuario removido',
                        'data' => null,
                    ];
        }
        // CASO HAJA ALGUMA EXCECAO
        catch(Exception $e)
        {
            switch(get_class($e))
            {
                case QueryException::class:
                    return  [
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



            /*return
            [
                'success' => false,
                'messages' => 'Erro de execução',
            ];*/
        }
    }
}

?>

