<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;

class GroupsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(GroupRepository $repository, GroupValidator $validator, GroupService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    public function index()
    {
        // Recebendo todos os grupos cadastrados
        $groups = $this->repository->all();

        // Retornando os dados dos grupos cadastrados
        return view('groups.index', [
                                        'groups' => $groups,
                                    ]
        );
    }

    // Metodo para cadastro do grupo
    public function store(GroupCreateRequest $request)
    {
        // Recebendo a resposta do service a respeito da operação de cadastro dos dados
        $request = $this->service->store($request->all());

        // Recebendo (ou nao) os dados do grupo cadastrado
        $group = $request['success'] ? $request['data'] : null;

        // Criando uma variavel de sessao para mostrar na tela se o grupo foi cadastrado ou nao
        // Metodo (FLASH) que envia a session uma unica vez para a view. SUCCESS é o nome da variavel de sessao
        session()->flash('success', [
                                        'success' => $request['success'],
                                        'messages' => $request['messages'],
                                    ]
        );

        // Retoanando os dados do grupo
        return redirect()->route('group.index');
    }

    public function show($id)
    {
        $group = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $group,
            ]);
        }

        return view('groups.show', compact('group'));
    }

    public function edit($id)
    {
        $group = $this->repository->find($id);

        return view('groups.edit', compact('group'));
    }

    public function update(GroupUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $group = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Group updated.',
                'data'    => $group->toArray(),
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

    // Metodo para excluir um grupo
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return redirect()->route("group.index");
    }
}
