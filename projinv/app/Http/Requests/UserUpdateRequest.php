<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /** METODO PARA IMPLEMENTAR REGRA DE NEGOCIOS SOBRE ACESSO A FUNCIONALIDADE:
     * CONTROLE DE PERMISSÃO DE USUARIO SE ELE PODE OU NÃO CADASTRAR ALGUEM.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
