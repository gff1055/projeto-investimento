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
        // atribuindo uma colecao de todos(all) os usuarios
        $users = $this->repository->all();

        // passando para a view um array com os dados dos usuarios
        return view(
            'user.index',
            [
                'users' => $users
            ]
        );
    }


    // METODO ONDE É FEITO A REQUISICAO DE CADASTRO DE USUARIO
    public function store(UserCreateRequest $request)
    {

        // PEGANDO OS DADOS VINDOS DO FORMULARIO ($request) E OS ENVIA PARA O SERVICE PARA CADASTRO (store)
        $request = $this->service->store($request->all());

        // RECEBENDO A RESPOSTA DA ACAO
        $usuario = $request['success'] ? $request['data'] : null;

        session()->flash(
            'success',
            [
                'success' => $request['success'],
                'messages' => $request['messages'],
            ]
        );

        return view(
            'user.index',
            [
                'usuario' => $usuario,
            ]
        );
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
        // acionando o metodo destroy da camada service
        $request = $this->service->destroy($id);

        session()->flash(
            'success',
            [
                'success' => $request['success'],
                'messages' => $request['messages'],
            ]
        );

        return view('user.index');
    }
}
