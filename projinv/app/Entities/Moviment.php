<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Moviment.
 *
 * @package namespace App\Entities;
 */
class Moviment extends Model implements Transformable{
    use TransformableTrait;

    protected $fillable = ['user_id', 'group_id', 'product_id', 'value', 'type'];

    public function scopeApplication($query){
        return $query->where('type', 1);
    }

    public function scopeOutflow($query){
        return $query->where('type', 2);
    }

    public function user(){                     // Metodo para relacionar Moviment e Users
        return $this->belongsTo(User::class);   // Moviment pertence a Users
    }

    public function group(){                    // Metodo para relacionar Moviment e Groups
        return $this->belongsTo(Group::class);  // Moviment pertence a Groups
    }

    public function product(){                  // Metodo para relacionar Moviment e Products
        return $this->belongsTo(Product::class);    // Moviment pertence a Products
    }



}
