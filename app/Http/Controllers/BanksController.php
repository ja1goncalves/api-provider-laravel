<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\BankService;
use App\Validators\BankValidator;

/**
 * Class BanksController.
 *
 * @package namespace App\Http\Controllers;
 */
class BanksController extends Controller
{
    use CrudMethods;

    /**
     * @var BankService
     */
    protected $service;

    /**
     * @var BankValidator
     */
    protected $validator;

    /**
     * BanksController constructor.
     *
     * @param BankService $service
     * @param BankValidator $validator
     */
    public function __construct(BankService $service, BankValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function listAll() {
        return $this->service->getAllBanks();
    }
}
