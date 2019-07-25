<?php

namespace App\Entities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
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
    protected $fillable=['user_id','social_network','social_id','social_email','social_avatar'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


}
