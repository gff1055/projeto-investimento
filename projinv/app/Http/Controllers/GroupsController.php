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
use App\Entities\Group;

class GroupsController extends Controller{
    protected $userRepository;
    protected $institurionRepository;
    protected $repository;
    protected $validator;
    protected $service;
    
    public function __construct(GroupRepository $repository, GroupValidator $validator, GroupService $service, InstitutionRepository $institutionRepository, UserRepository $userRepository){
        $this->userRepository = $userRepository;
        $this->institutionRepository = $institutionRepository;
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    public function index(){
        $groups = $this->repository->all();     // Recebendo todos os grupos cadastrados
        $user_list = $this->userRepository->selectBoxList();            // Recebendo a lista de todos os usuarios
        $institution_list = $this->institutionRepository->selectBoxList();  // Recebendo a lista de todas as instituicoes
        
        return view('groups.index', [           // Retornando os dados ...
            'groups' => $groups,                // ... dos grupos
            'user_list' => $user_list,          // ... dos usuarios
            'institution_list' => $institution_list,                    // ... das instituicoes
        ]);

    }

    // Metodo para cadastro do grupo
    public function store(GroupCreateRequest $request){
        $request = $this->service->store($request->all());              // Recebendo a resposta do service a respeito da operação de cadastro dos dados
        $group = $request['success'] ? $request['data'] : null;         // Recebendo (ou nao) os dados do grupo cadastrado

        // Criando uma variavel de sessao para mostrar na tela se o grupo foi cadastrado ou nao
        session()->flash('success', [           // Metodo (FLASH) que envia a session uma unica vez para a view. SUCCESS é o nome da variavel de sessao
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);

        return redirect()->route('group.index');                        // Retoanando os dados do grupo
    }

    public function userStore(Request $request, $group_id){
        $request = $this->service->userStore($group_id, $request->all());   // Recebendo a resposta do service a respeito da operação de cadastro dos dados
        
        // Criando uma variavel de sessao para mostrar na tela se o grupo foi cadastrado ou nao
        session()->flash('success', [           /* Metodo (FLASH) que envia a session uma unica vez para a view.*/
            'success' => $request['success'],   //SUCCESS é o nome da variavel de sessao
            'messages' => $request['messages'],
        ]);

        return redirect()->route('group.show', [$group_id]);    // Retoanando os dados do grupo
    }

    public function show($id){                  // Metodo para mostrar os dados de um grupo
        $group = $this->repository->find($id);  // Buscando o registro do grupo(id) no banco
        $user_list = $this->userRepository->selectBoxList();    // Recebendo todos os usuarios

        return view('groups.show',[             // Retorna os dados do grupo
            'group' => $group,                  // Grupo selecionado
            'user_list' => $user_list           // Lista de usuarios
        ]);

    }

    public function edit($id){                  // Metodo para editar um grupo
        $group = Group::find($id);              // Busca o grupo associado ao ID
        $user_list = $this->userRepository->selectBoxList();    // Recebe uma lista de todos os usuarios
        $institution_list = $this->institutionRepository->selectBoxList();  // Recebe uma lista de todas as instituicoes
        
        return view('groups.edit', [            // Retornando os dados
            'group' => $group,                  // .. do grupo
            'user_list' => $user_list,          // ... lista de usuario
            'institution_list' => $institution_list // ... lista de instituicoes
        ]);

    }

    public function update(Request $request, $group_id){    // Metodo para atualizar os dados do grupo
        $request = $this->service->update($group_id, $request->all());  // recebe resposta da atualizacao na camada de serviços

        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);

        return redirect()->route('group.index');    // Redireciona para a listagem de grupos
    }

    public function destroy($id){               // Metodo para excluir um grupo
        $deleted = $this->repository->delete($id);
        return redirect()->route("group.index");
    }
}
