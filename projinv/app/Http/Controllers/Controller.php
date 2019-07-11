<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homep(){
    	$var = "Homepage do sistema para grupos de investimento";
    	return view("welcome", ['title'=>$var]);
    }


    public function cad(){
    	echo "Tela de Cadastro";
    }


    public function fazLog(){
    	echo "tela de Login";
    }


}
