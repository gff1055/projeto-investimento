<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Product extends Model implements Transformable{
    use TransformableTrait;

    protected $fillable = [                     // Possibilita cadastro sem instanciar atributo por atributo
        'institution_id', 'name', 'description', 'index', 'interest_rate'
    ];

    public function institution(){              // Metodo para o relacionamento com a tabela products
        return $this->belongsTo(Institution::class);    //Indica que o 'Product' pertence a uma institution
    }



    
}

