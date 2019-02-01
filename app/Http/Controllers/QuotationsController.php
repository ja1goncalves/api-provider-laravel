<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\ProviderService;
use App\Services\QuotationService;
use App\Validators\QuotationValidator;
use Illuminate\Http\Request;

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

//    /**
//     * @param Request $request
//     * @return mixed
//     * @throws \pmill\AwsCognito\Exception\TokenVerificationException
//     */
//    public function listQuotationsByProvider(Request $request)
//    {
//        $provider = $this->providerService->getProviderByToken($request->header('Authorization'), ['id']);
//        return $this->service->getQuotationsByProvider($provider);
//    }
}
