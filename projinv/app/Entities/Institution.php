<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Institution extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name'];
    
    public $timestamp = true;

    public function groups(){                   // Metodo que Retorna os grupos de uma instituição
        return $this->hasMany(Group::class);    // Retorna os grupos que estao relacionados com a instituicao
    }

}
