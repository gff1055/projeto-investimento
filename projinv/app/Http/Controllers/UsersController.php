<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Services\UserService;


class UsersController extends Controller{
    protected $repository;

    protected $service;                         // VARIAVEL PARA A CAMADA DE SERVICE


    public function __construct(UserRepository $repository, UserService $service){
        $this->repository   = $repository;
        $this->service      = $service;

    }

    
    public function index(){
        $users = $this->repository->all();      // atribuindo uma colecao de todos(all) os usuarios

        return view('user.index',[              // passando para a view um array com os dados dos usuarios
            'users' => $users
        ]);
    }


    public function store(UserCreateRequest $request){                  // METODO QUE ENVIA OS DADOS PARA O CADASTRO
        $request = $this->service->store($request->all());              // RECEBENDO A RESPOSTA DO SERVICE A RESPEITO DA OPERAÇÃO DE CADASTRO DOS DADOS
        $usuario = $request['success'] ? $request['data'] : null;       // RECEBENDO(OU NAO) OS DADOS DO USUARIO CADASTRADO

        // CRIANDO UMA VARIAVEL DE SESSAO PARA MOSTRAR AO USUARIO SE O USUARIO FOI CADASTRADO OU NAO
        session()->flash('success', [           // METODO(flash) QUE ENVIA A SESSION UMA UNICA VEZ PARA A VIEW. success É O NOME DA VARIAVEL DE SESSAO
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);

       return redirect()->route('user.index');  // redireciona o usuario para a rota 'user.index'
    }

    

    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {
            return response()->json(
                ['data' => $user,]
            );
        }

        return view('users.show', compact('user'));
    }



    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('user.edit',[
            'user' => $user
        ]);
    }



    public function update(Request $request, $id)
    {

        $request = $this->service->update($request->all(), $id);        // RECEBENDO A RESPOSTA DO SERVICE A RESPEITO DA OPERAÇÃO DE CADASTRO DOS DADOS
        $usuario = $request['success'] ? $request['data'] : null;       // RECEBENDO(OU NAO) OS DADOS DO USUARIO CADASTRADO

        // CRIANDO UMA VARIAVEL DE SESSAO PARA MOSTRAR AO USUARIO SE O USUARIO FOI CADASTRADO OU NAO
        session()->flash('success', [           // METODO(flash) QUE ENVIA A SESSION UMA UNICA VEZ PARA A VIEW. success É O NOME DA VARIAVEL DE SESSAO
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);

       return redirect()->route('user.index');  // redireciona o usuario para a rota 'user.index'
    }



    public function destroy($id)
    {
        $request = $this->service->destroy($id);                        // RECEBENDO A RESPOSTA DO SERVICE SOBRE A REMOÇÃO DO ID SELECIONADO

        // CRIANDO UMA VARIAVEL DE SESSAO PARA MOSTRAR AO USUARIO SE O USUARIO FOI EXCLUIDO OU NAO
        session()->flash(                       // METODO QUE ENVIA A SESSION UMA UNICA VEZ PARA A VIEW
            'success',                          // NOME DA SESSAO
            [   'success' => $request['success'],                       // DADOS ARMAZENADOS NESSA SESSAO
                'messages' => $request['messages'],
            ]
        );

        return redirect()->route('user.index'); // MANDA O USUARIO PARA A ROTA APOS A REMOÇAO
    }
}
