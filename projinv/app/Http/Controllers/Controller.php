<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homepage(){
    	$var = "Homepage do sistema para grupos de investimento";
    	return view("welcome", [
            'title'=>$var
            ]);
    }


    public function cadastrar(){
    	echo "Tela de Cadastro";
    }

    /*
        Metodos para o login do usuario na view
    */

    public function fazerLogin(){
        return view('user.login');
    	echo "tela de Login";
    }


}
