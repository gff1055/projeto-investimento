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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps=true;
    protected $table='users';
    protected $fillable = ['cpf', 'name', 'phone','birth','gender','notes','email','password','status','permission'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /*Metodo para trabalhar o registro da senha*/
    /** metodo para definir a senha
     * Toda vez que for definido um password para o objeto, esse metodo será acionado
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value;
    }


}