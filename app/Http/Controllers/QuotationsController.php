<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\ProviderService;
use App\Services\QuotationService;
use App\Validators\QuotationValidator;

/**
 * Class QuotationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class QuotationsController extends Controller
{
    use CrudMethods;

    /**
     * @var QuotationService
     */
    protected $service;

    /**
     * @var ProviderService
     */
    protected $providerService;

    /**
     * @var QuotationValidator
     */
    protected $validator;

    /**
     * QuotationsController constructor.
     *
     * @param QuotationService $service
     * @param ProviderService $providerService
     * @param QuotationValidator $validator
     */
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
