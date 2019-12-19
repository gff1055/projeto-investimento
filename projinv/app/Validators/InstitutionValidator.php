<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class InstitutionValidator.
 *
 * @package namespace App\Validators;
 */
class InstitutionValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        // REGRAS DE VALIDAÇÃO AO SER CRIADO UM REGISTRO
        ValidatorInterface::RULE_CREATE =>  [
                                                'name' => 'required',
                                            ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
