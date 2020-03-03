<?php

namespace App\Entities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    //
    use SoftDeletes;
    use Notifiable;                             // Possibilita envio de notificacoes ao usuario

    
    public $timestamps=true;
    protected $table='users';
    protected $fillable = ['cpf', 'name', 'phone','birth','gender','notes','email','password','status','permission'];

    
    protected $hidden = ['password', 'remember_token'];

    public function groups(){
        return $this->belongsToMany(Group::class, 'user_groups');       // Relacionamento N:N
    }



    /*Metodo para trabalhar o registro da senha*/
    /** metodo para definir a senha
     * Toda vez que for definido um password para o objeto, esse metodo será acionado
    */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value; // Verifica se o Hash esta ativado ou não
    }



    public function getFormattedCpfAttribute(){ /* Acessor para a formatação do CPF */
        $cpf = $this->attributes['cpf'];        // recebendo o CPF
        return substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 7, 3).'-'.substr($cpf, -2);   // retornando o cpf formatado
    }



    public function getFormattedPhoneAttribute(){                       /* Acessor para a formatação do telefone */
        $phone = $this->attributes['phone'];    // recebendo o telefone
        return "(" . substr($phone, 0, 2) . ") " . substr($phone, 2, 4) . "-" . substr($phone, -4); // retornando o telefone formatado
    }


    
    public function getFormattedBirthAttribute(){                       // Acessor para a formatacao da data
        $birth = explode("-", $this->attributes['birth']);              // Desmembrando a string usando o '-' como delimitador
     
        if(count($birth) != 3)                  // Verificando se a data é valida
            return "";
        
        $birth = $birth[2] . '/' . $birth[1] . '/' . $birth[0];
        return $birth;
    }


}