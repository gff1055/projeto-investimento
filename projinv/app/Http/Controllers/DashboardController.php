<?php
/**
 * Controller para politica de acesso e autenticacado do usuario
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Auth;

class DashboardController extends Controller
{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        return view('user.dashboard');
    }

    /** metodo de autenticacao */
    public function auth(Request $request)
    {
        $data=[
            'email' => $request->get('username'),
            'password' => $request->get('password')
        ];

        try
        {

            if(env('PASSWORD_HASH'))
                Auth::attempt($data, false); 
                /** fazendo uma tentativa de autenticação */
            
            else
            {
                $user = $this->repository->findWhere(['email' => $request->get('username')])->first();
                /* buscando o email */
                if(!$user)
                /* Caso não encontre o usuario*/
                    throw new Exception("E-mail informado é invalido....");
                if($user->password != $request->get('password'))
                /** Testando a senha inserida */
                    throw new Exception("A senha informada é invalida...");
                Auth::login($user);
                /* Fazendo autenticacao do usuario a partir do proprio objeto */
            }
            return redirect()->route('user.dashboard');
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
        dd($request->all()); /* dump and die() [var_dump and die]*/
        echo "Auth method";
    }
}
