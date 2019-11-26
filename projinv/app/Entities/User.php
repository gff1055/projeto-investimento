<?php

namespace App\Entities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // 
    use SoftDeletes;
    // Possibilita envio de notificacoes ao usuario
    use Notifiable;

    
    public $timestamps=true;
    protected $table='users';
    protected $fillable = ['cpf', 'name', 'phone','birth','gender','notes','email','password','status','permission'];

    
    protected $hidden = ['password', 'remember_token'];

    /*Metodo para trabalhar o registro da senha*/
    /** metodo para definir a senha
     * Toda vez que for definido um password para o objeto, esse metodo será acionado
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value;
    }

    /* Mutator para a formatação do CPF */
    public function getCpfAttribute()
    {
        // recebendo o CPF
        $cpf = $this->attributes['cpf'];
        // retornando o cpf formatado
        return substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 7, 3).'-'.substr($cpf, -2);
    }

    /* Mutator para a formatação do telefone */
    public function getPhoneAttribute()
    {
        // recebendo o telefone
        $phone = $this->attributes['phone'];
        // retornando o telefone formatado
        return "(" . substr($phone, 0, 2) . ") " . substr($phone, 2, 4) . "-" . substr($phone, -4);
    }

    // Mutator para a formatacao da data
    public function getBirthAttribute()
    {
        // Desmembrando a string usando o '-' como delimitador
        $birth = explode("-", $this->attributes['birth']);
        // Verificando se a data é valida
        if(count($birth) != 3)
            return "";
        $birth = $birth[2] . '/' . $birth[1] . '/' . $birth[0];
        return $birth;
    }


}