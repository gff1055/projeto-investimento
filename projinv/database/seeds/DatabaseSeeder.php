<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cpf'           =>'12345678901',
            'name'          =>'Guilherme',
            'phone'         =>'98765432109',
            'birth'         =>'1987-05-01',
            'gender'        =>'M',
            'email'         =>'guilherme@sistema.com',
            'password'      =>bcrypt('123456'), //bcript => helper que criptografa a string
        ]);
    }
}
