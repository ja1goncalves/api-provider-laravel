<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\ProviderService;
use App\Services\QuotationService;
use App\Validators\QuotationValidator;


class QuotationsController extends Controller
{
    use CrudMethods;

    protected $service;

    protected $providerService;

    protected $validator;

    public function __construct(QuotationService $service, ProviderService $providerService, QuotationValidator $validator)
    {
        $this->service = $service;
        $this->providerService = $providerService;
        $this->validator  = $validator;
    }

    public function listQuotationsByProvider()
    {
        $provider = $this->providerService->getProviderByToken();
        return $this->service->getQuotationsByProvider($provider);
    }
}
