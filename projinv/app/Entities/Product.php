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

    public function valueFromUser(User $user){  // Metodo para calcular o valor que um produto tem de investimento baseado no usuario        
        $inflows = $this->moviments()->product($this)->applications()->sum('value');    // soma das aplicacoes de um determinado produto
        $outflows = $this->moviments()->product($this)->outflows()->sum('value');   // soma dos resgates de um determinado produto
        return $inflows - $outflows;            // retorna o saldo
    }

    public function moviments(){
        return $this->hasMany(Moviment::class);
    }



    
}

