<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionCreateRequest;
use App\Http\Requests\InstitutionUpdateRequest;
use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use App\Services\InstitutionService; /** */


class InstitutionsController extends Controller{
    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(InstitutionRepository $repository, InstitutionValidator $validator, InstitutionService $service)    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    public function index(){
        $institutions = $this->repository->all();
        
        return view('institutions.index', [     // PASSANDO AS VARIAVEIS PARA A VIEW VIA ARRAY
            'institutions' => $institutions,
        ]);
    
    }
    
    public function store(InstitutionCreateRequest $request){           // METODO QUE ENVIA OS DADOS PARA O CADASTRO
        $request = $this->service->store($request->all());  // RECEBENDO A RESPOSTA DO SERVICE A RESPEITO DA OPERAÇÃO DE CADASTRO DOS DADOS
        $institution = $request['success'] ? $request['data'] : null;   // RECEBENDO(OU NAO) OS DADOS DA INSTITUICAO CADASTRADA

        // CRIANDO UMA VARIAVEL DE SESSAO PARA MOSTRAR NA TELA SE A INSTITUICAO FOI CADASTRADO OU NAO
        session()->flash('success', [           // METODO(flash) QUE ENVIA A SESSION UMA UNICA VEZ PARA A VIEW. success É O NOME DA VARIAVEL DE SESSAO
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);

        return redirect()->route('institution.index');      // RETORNANDO OS DADOS DA INSTITUICAO
    }
    

    public function show($id){                   // Metodo para mostrar os detalhes da instituicao
        $institution = $this->repository->find($id);        // Variavel INSTITUTION recebe a chave primaria da tabela
        return view("institutions.show", ['institution' => $institution]);      // Retorna o valor de INSTITUTION para a view
    }
    
    public function edit($id){                  // Metodo que possibilita o acesso e edição dos dados
        $institution = $this->repository->find($id);                    // Busca os dados da instituicao associada ao ID

        return view('institutions.edit', [      // Retorna a view de edição juntamente com os dados da pesquisa
            'institution' => $institution
        ]);

    }

    public function update(Request $request, $id){                      // Metodo para atualizar a instituicao
        $request = $this->service->update($request->all(), $id);        // Recebe a resposta da rotina de atualizacao
        $institution = $request['success'] ? $request['data'] : null;   // Institution recebe a resposta

        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('institution.index');                  // faz o redirecionamento para a INDEX
    }

    public function destroy($id){
        $deleted = $this->repository->delete($id);
        return redirect()->route("institution.index");
    }
}