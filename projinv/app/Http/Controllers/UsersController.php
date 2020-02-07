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

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{

    protected $repository;

    // VARIAVEL PARA A CAMADA DE SERVICE
    protected $service;


    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository   = $repository;
        $this->service      = $service;

    }

    
    public function index()
    {
        $users = $this->repository->all();  // atribuindo uma colecao de todos(all) os usuarios

        // passando para a view um array com os dados dos usuarios
        return view('user.index',[
            'users' => $users
        ]);
    }


    // METODO QUE ENVIA OS DADOS PARA O CADASTRO
    public function store(UserCreateRequest $request){

        $request = $this->service->store($request->all());  // RECEBENDO A RESPOSTA DO SERVICE A RESPEITO DA OPERAÇÃO DE CADASTRO DOS DADOS
        $usuario = $request['success'] ? $request['data'] : null;   // RECEBENDO(OU NAO) OS DADOS DO USUARIO CADASTRADO

        // CRIANDO UMA VARIAVEL DE SESSAO PARA MOSTRAR AO USUARIO SE O USUARIO FOI CADASTRADO OU NAO
        session()->flash('success', [   // METODO(flash) QUE ENVIA A SESSION UMA UNICA VEZ PARA A VIEW. success É O NOME DA VARIAVEL DE SESSAO
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);

       return redirect()->route('user.index');  // redireciona o usuario para a rota 'user.index'
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                                            'error'   => true,
                                            'message' => $e->getMessageBag()
                                        ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = $this->service->destroy($id);    // RECEBENDO A RESPOSTA DO SERVICE SOBRE A REMOÇÃO DO ID SELECIONADO

        // CRIANDO UMA VARIAVEL DE SESSAO PARA MOSTRAR AO USUARIO SE O USUARIO FOI EXCLUIDO OU NAO
        session()->flash(   // METODO QUE ENVIA A SESSION UMA UNICA VEZ PARA A VIEW
            'success',  // NOME DA SESSAO
            [   // DADOS ARMAZENADOS NESSA SESSAO
                'success' => $request['success'],
                'messages' => $request['messages'],
            ]
        );

        return redirect()->route('user.index'); // MANDA O USUARIO PARA A ROTA APOS A REMOÇAO
    }
}
