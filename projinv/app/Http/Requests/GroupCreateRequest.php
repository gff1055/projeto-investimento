<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupCreateRequest extends FormRequest
{
    // Metodo que autoriza ações do usuario 
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
