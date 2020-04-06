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

class DashboardController extends Controller{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index(){
        return view('user.dashboard');          // Retornando a view Dashboard da pasta View
    }

    public function auth(Request $request){      /** metodo de autenticacao. Ela recebe o request (dados enviados inseridos pelo usuario)*/
        $data = [                               /* Dados enviados pelo usuario */
            'email' => $request->get('username'),
            'password' => $request->get('password')
        ];

        try{
            if(env('PASSWORD_HASH'))            /* Testando se a criptografia esta ativada*/
                Auth::attempt($data, false);    /* Fazendo uma tentativa de autenticação */
            
            else{
                $user = $this->repository->findWhere(['email' => $request->get('username')])->first();  /* buscando o email inserido e atribui o username usuario se existir*/
                
                if(!$user)                      /* Testa se o usuario existe */
                    throw new Exception("E-mail informado é invalido...."); // Lançando exceção O EMAIL NAO EXISTE

                if($user->password != $request->get('password'))        // Verificando se a senha está correta
                    throw new Exception("A senha informada é invalida..."); // Lançando uma exceção

                Auth::login($user);             /* Fazendo autenticacao do usuario a partir do proprio objeto */     
            }

            return redirect()->route('user.dashboard');                 /* Redirecionamento para a oagina inicial do sistema (Dashboard) */
        }
        catch(Exception $e){
            return $e->getMessage();
        }

        dd($request->all());                    /* dump and die() [var_dump and die]*/
        echo "Auth method";
    }
}
