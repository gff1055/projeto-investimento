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

    // Retorna os grupos de uma instituição
    public function groups()
    {
        return $this->hasMany(Group::class);    // Retorna os grupos que estao relacionados com a instituicao
    }

}
