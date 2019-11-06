<?php /* camada para a regras de negocio */

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;

class UserService
{
    private $repository;
    /* vai gerenciar obj user em aspecto de banco de dados */
    
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store()
    {
        
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}

?>

