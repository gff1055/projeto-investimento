<?php /* camada para a regras de negocio */

namespace App\Services;

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
                'message'   => 'Usuario cadastrado',
                'data'      => $usuario,
            ];
        }
        catch(\Exception $e)
        {
            return
            [
                'success' => false,
                'message' => 'Erro de execução',
            ];
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

