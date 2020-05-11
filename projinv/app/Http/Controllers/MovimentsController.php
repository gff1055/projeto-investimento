<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovimentCreateRequest;
use App\Http\Requests\MovimentUpdateRequest;
use App\Repositories\MovimentRepository;
use App\Validators\MovimentValidator;
use App\Entities\{Group, Product};

class MovimentsController extends Controller{
    protected $repository;
    protected $validator;

    public function __construct(MovimentRepository $repository, MovimentValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    public function application(){              // Metodo para jogar a view 'moviment.application' na tela

        $group_list = Group::all()->pluck('name','id'); // Associa nome nome do grupo com o ID
        $product_list = Product::all()->pluck('name','id'); // Associa nome nome do grupo com o ID

        return view('moviment.application', [
            'group_list' => $group_list,
            'product_list' => $product_list
        ]);
    }
    
}
