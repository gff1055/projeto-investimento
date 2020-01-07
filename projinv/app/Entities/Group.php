<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Group extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'user_id', 'institution_id'];


    /*** CRIANDO RELACIONAMENTOS ENTRE ENTIDADES ***/
    
    // UM GRUPO TEM UMA PESSOA RESPONSAVEL
    public function owner()
    {
        // DEFININDO QUE A ENTIDADE group PERTENCE A UM user ATRAVES DO METODO (owner)
        return $this->belongsTo(User::class);
    }


    // UM GRUPO PERTENCE A UMA INSTITUIÇÃO
    public function institution()
    {
        // DEFININDO QUE A ENTIDADE group PERTENCE A UM institution ATRAVES DO METODO (owner)
        return $this->belongsTo(Institution::class);
    }

}
