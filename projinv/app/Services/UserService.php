<?php /* camada para a regras de negocio */

namespace App\Services;

use Illuminate\Database\QueryException;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;


class UserService
{
    private $repository;
    /* vai gerenciar obj user em aspecto de banco de dados */
    
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function store($data)
    {
        try
        {
            
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $usuario    = $this->repository->create($data);

            return
            [
                'success'   => true,
                'messages'   => 'Usuario cadastrado',
                'data'      => $usuario,
            ];
        }
        catch(Exception $e)
        {
            switch(get_class($e))
            {
                case QueryException::class:
                    return
                    [
                        'success' => false,
                        'messages' => $e->getMessage()
                    ];
                
                case ValidatorException::class:
                    return
                    [
                        'success' => false,
                        'messages' => $e->getMessagesBag()
                    ];
                
                case Exception::class:
                    return
                    [
                        'success' => false,
                        'messages' => $e->getMessage()
                    ];
                default:
                    return
                    [
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

    public function update()
    {

    }

    public function delete()
    {

    }
}

?>

