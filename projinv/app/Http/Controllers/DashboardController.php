<?php
/**
 * Controller para politica de acesso e autenticacado do usuario
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// pacote re depositorio
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
        return view('user.dashboard');          // Retornando a view Dashboard da pasta View
    }


    /** metodo de autenticacao. Ela recebe o request (dados enviados inseridos pelo usuario)*/
    public function auth(Request $request)
    {
        /* Dados enviados pelo usuario */
        $data = [
            'email' => $request->get('username'),
            'password' => $request->get('password')
        ];

        try
        {
            /* Testando se a criptografia esta ativada*/
            if(env('PASSWORD_HASH'))    
                Auth::attempt($data, false);    /* Fazendo uma tentativa de autenticação */
            
            else{
                $user = $this->repository->findWhere(['email' => $request->get('username')])->first();  /* buscando o email inserido e atribui o username usuario se existir*/
                
                /* Testa se o usuario existe */
                if(!$user)
                    throw new Exception("E-mail informado é invalido...."); // Lançando exceção O EMAIL NAO EXISTE

                // Verificando se a senha está correta
                if($user->password != $request->get('password'))
                    throw new Exception("A senha informada é invalida..."); // Lançando uma exceção

                Auth::login($user);             /* Fazendo autenticacao do usuario a partir do proprio objeto */
                
            }

            return redirect()->route('user.dashboard');                 /* Redirecionamento para a oagina inicial do sistema (Dashboard) */

        }
        catch(Exception $e){
            return $e->getMessage();
        }

        /* dump and die() [var_dump and die]*/
        dd($request->all()); 

        echo "Auth method";

    }

}
