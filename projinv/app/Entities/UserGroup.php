<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model{
    use Notifiable;                             // Possibilita envio de notificacoes ao usuario
    public $timestamps = true;
    protected $table = 'user_groups';
    protected $fillable = ['user_id', 'group_id', 'permission'];
    
    protected $hidden = [];
    
}
