<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ProviderValidator.
 *
 * @package namespace App\Validators;
 */
class ProviderValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'                      => 'required|max:150',
            'cpf'                       => 'required|unique:providers,cpf|max:15',
            'email'                     => 'required|email|unique:providers,email|max:100',
            'password'                  => 'required|max:60',
            'phone'                     => 'max:15',
            'cellphone'                 => 'max:15',
            'birthday'                  => 'date',
            'provider_status_id'        => 'required|numeric',
            'status_modified'           => 'required|date',
            'company'                   => 'nullable|max:100',
            'company_phone'             => 'nullable|max:100',
            'gender'                    => 'nullable|min:1',
            'occupation'                => 'nullable|min:1',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'                      => 'sometimes|max:150',
            'cpf'                       => 'sometimes|unique:providers,cpf|max:15',
            'email'                     => 'sometimes|email|unique:providers,email|max:100',
            'phone'                     => 'sometimes|nullable|max:15',
            'cellphone'                 => 'required|max:15',
            'password'                  => 'sometimes|max:60',
            'provider_status_id'        => 'sometimes|numeric',
            'birthday'                  => 'sometimes|date',
            'company'                   => 'sometimes|nullable|max:100',
            'company_phone'             => 'sometimes|nullable|max:100',
            'gender'                    => 'sometimes|min:1',
            'occupation'                => 'sometimes|nullable|min:1',
        ],
    ];
}
