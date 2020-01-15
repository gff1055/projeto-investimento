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
        return $this->belongsTo(User::class, 'user_id');    // DEFININDO QUE A ENTIDADE group PERTENCE A UM user ATRAVES DO METODO (owner)
    }


    // UM GRUPO PERTENCE A UMA INSTITUIÇÃO
    public function institution()
    {
        return $this->belongsTo(Institution::class);    // DEFININDO QUE A ENTIDADE group PERTENCE A UM institution ATRAVES DO METODO (owner)
    }

}
