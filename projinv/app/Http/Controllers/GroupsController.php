<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\UserRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;

class GroupsController extends Controller
{
    protected $userRepository;
    protected $institurionRepository;
    protected $repository;
    protected $validator;
    protected $service;
    
    public function __construct(GroupRepository $repository, GroupValidator $validator, GroupService $service, InstitutionRepository $institutionRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->institutionRepository = $institutionRepository;
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    public function index()
    {
        $groups = $this->repository->all(); // Recebendo todos os grupos cadastrados
        $user_list = $this->userRepository->selectBoxList();    // Recebendo a lista de todos os usuarios
        $institution_list = $this->institutionRepository->selectBoxList();  // Recebendo a lista de todas as instituicoes
        
        return view('groups.index', [   // Retornando os dados ...
                                        'groups' => $groups,    // ... dos grupos
                                        'user_list' => $user_list,  // ... dos usuarios
                                        'institution_list' => $institution_list,    // ... das instituicoes
        ]);
    }

    // Metodo para cadastro do grupo
    public function store(GroupCreateRequest $request)
    {
        $request = $this->service->store($request->all());  // Recebendo a resposta do service a respeito da operação de cadastro dos dados
        $group = $request['success'] ? $request['data'] : null; // Recebendo (ou nao) os dados do grupo cadastrado

        // Criando uma variavel de sessao para mostrar na tela se o grupo foi cadastrado ou nao
        // Metodo (FLASH) que envia a session uma unica vez para a view. SUCCESS é o nome da variavel de sessao
        session()->flash('success', [   
                                        'success' => $request['success'],
                                        'messages' => $request['messages'],
        ]);

        return redirect()->route('group.index');    // Retoanando os dados do grupo
    }

    public function show($id){
        $group = $this->repository->find($id);
        return view('groups.show',  ['group' => $group]);
    }

    public function edit($id){
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

    public function destroy($id){    // Metodo para excluir um grupo
        $deleted = $this->repository->delete($id);

        return redirect()->route("group.index");
    }
}
