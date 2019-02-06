<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\BankService;
use App\Validators\BankValidator;


class BanksController extends Controller
{
    use CrudMethods;

    protected $service;

    protected $validator;

    public function __construct(BankService $service, BankValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function listAll() {
        return $this->service->getAllBanks();
    }
}
