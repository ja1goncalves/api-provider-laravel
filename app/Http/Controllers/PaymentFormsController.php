<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;

use App\Services\PaymentFormsService;
use App\Validators\PaymentFormValidator;
use Illuminate\Http\Request;

/**
 * Class PaymentFormsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PaymentFormsController extends Controller
{
    use CrudMethods;

    /**
     * @var PaymentFormsService
     */
    protected $service;

    /**
     * @var PaymentFormValidator
     */
    protected $validator;

    /**
     * PaymentFormsController constructor.
     *
     * @param PaymentFormsService $service
     * @param PaymentFormValidator $validator
     */
    public function __construct(PaymentFormsService $service, PaymentFormValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }
}
