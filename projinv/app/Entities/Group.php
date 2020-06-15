<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Group extends Model implements Transformable{
    use TransformableTrait;

    protected $fillable = ['name', 'user_id', 'institution_id'];


    public function getTotalValueAttribute(){   // Metodo Acessor para retornar o valor total investido no grupo
        return $this->moviments()->applications()->sum('value') - $this->moviments()->outflows()->sum('value');  // Retorna o total de valores
    }

    /*** CRIANDO RELACIONAMENTOS ENTRE ENTIDADES ***/
    public function owner(){                    // UM GRUPO TEM UMA PESSOA RESPONSAVEL
        return $this->belongsTo(User::class, 'user_id');                // DEFININDO QUE A ENTIDADE group PERTENCE A UM user ATRAVES DO METODO (owner)
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_groups');        // Relacionamento N:N
    }
    
    // UM GRUPO PERTENCE A UMA INSTITUIÇÃO
    public function institution(){
        return $this->belongsTo(Institution::class);                    // DEFININDO QUE A ENTIDADE group PERTENCE A UM institution ATRAVES DO METODO (owner)
    }

    public function moviments(){                // Metodo para relacionar os grupos e movimentos
        return $this->hasMany(Moviment::class); // Grupo tem muitos movimentos
    }

}
