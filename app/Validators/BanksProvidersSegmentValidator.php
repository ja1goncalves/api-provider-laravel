<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class BanksProvidersSegmentValidator.
 *
 * @package namespace App\Validators;
 */
class BanksProvidersSegmentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'bank_id'                   => 'required|numeric|exists:banks,id',
            'provider_id'               => 'required|numeric|exists:providers,id',
            'agency'                    => 'required|max:25|string',
            'account'                   => 'required|max:25|string',
            'account_digit'             => 'required|max:2|string',
            'agency_digit'              => 'required|max:2|string',
            'main'                      => 'required|numeric',
            'type'                      => 'required|string',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'bank_id'                   => 'numeric|exists:banks,id',
            'provider_id'               => 'numeric|exists:providers,id',
            'agency'                    => 'max:25|string',
            'account'                   => 'max:25|string',
            'account_digit'             => 'max:2|string',
            'agency_digit'              => 'max:2|string',
            'main'                      => 'numeric',
            'type'                      => 'string',
        ],
    ];
}
