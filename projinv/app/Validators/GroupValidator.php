<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class GroupValidator.
 *
 * @package namespace App\Validators;
 */
class GroupValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        // Cria regras de validação
        ValidatorInterface::RULE_CREATE =>  [   // Condicoes na hora da criacao
            'name' => 'required',
            'user_id' => 'required|exists:users,id',
            'institution_id' => 'required|exists:institutions,id'
        ],

        ValidatorInterface::RULE_UPDATE => [    // Condicoes na hora da atualizacao
            'name' => 'required',
        ],
    ];
}
