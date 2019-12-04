<?php

use Illuminate\Database\Seeder;

// Classe modelo de usuarios
use App\Entities\User;

//
class DatabaseSeeder extends Seeder
{
   
    // Todas as seeds passam por esse metodo
    public function run()
    {
        // Criando um usuario
        User::create(
            [
                'cpf' =>'12345678902',
                'name' =>'Guilherme',
                'phone' =>'98765432109',
                'birth' =>'1987-05-01',
                'gender' =>'M',
                'email' =>'guilherme2@sistema.com',
                'password' => env('PASSWORD_HASH') ? bcrypt('123456') : '123456',
                //bcript => helper que criptografa a string
                //env('PASSWORD_HASH') >> testando se a criptografia esta habilitada
            ]
        );
    }
}
