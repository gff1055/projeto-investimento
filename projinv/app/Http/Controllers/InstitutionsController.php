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


class InstitutionsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(InstitutionRepository $repository, InstitutionValidator $validator, InstitutionService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    public function index()
    {
        
        $institutions = $this->repository->all();
        
        return view('institutions.index', [     // PASSANDO AS VARIAVEIS PARA A VIEW VIA ARRAY
            'institutions' => $institutions,
        ]);
    }

    
    public function store(InstitutionCreateRequest $request){           // METODO QUE ENVIA OS DADOS PARA O CADASTRO
        
        $request = $this->service->store($request->all());              // RECEBENDO A RESPOSTA DO SERVICE A RESPEITO DA OPERAÇÃO DE CADASTRO DOS DADOS
        $institution = $request['success'] ? $request['data'] : null;   // RECEBENDO(OU NAO) OS DADOS DA INSTITUICAO CADASTRADA

        // CRIANDO UMA VARIAVEL DE SESSAO PARA MOSTRAR NA TELA SE A INSTITUICAO FOI CADASTRADO OU NAO
        session()->flash('success', [                                   // METODO(flash) QUE ENVIA A SESSION UMA UNICA VEZ PARA A VIEW. success É O NOME DA VARIAVEL DE SESSAO
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);

        return redirect()->route('institution.index');                  // RETORNANDO OS DADOS DA INSTITUICAO
    }
    

    public function show($id)                   // Metodo para mostrar os detalhes da instituicao
    {
        $institution = $this->repository->find($id);                    // Variavel INSTITUTION recebe a chave primaria da tabela
        return view("institutions.show", ['institution' => $institution]);  // Retorna o valor de INSTITUTION para a view
    }

    
    public function edit($id)
    {
        $institution = $this->repository->find($id);
        return view('institutions.edit', compact('institution'));
    }


    public function update(InstitutionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institution = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Institution updated.',
                'data'    => $institution->toArray(),
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
        $deleted = $this->repository->delete($id);

        return redirect()->route("institution.index");
    }
}
