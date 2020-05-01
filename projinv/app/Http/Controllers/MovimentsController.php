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

class MovimentsController extends Controller{
    protected $repository;
    protected $validator;

    public function __construct(MovimentRepository $repository, MovimentValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    public function application(){
        return view('moviment.application');
    }
    
}
