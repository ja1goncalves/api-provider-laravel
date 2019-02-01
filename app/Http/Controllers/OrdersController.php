<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\OrderService;
use App\Services\ProviderService;
use App\Validators\OrderValidator;

/**
 * Class OrdersController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrdersController extends Controller
{
    use CrudMethods;

    /**
     * @var ProviderService
     */
    protected $providerService;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * OrdersController constructor.
     *
     * @param OrderService $service
     * @param ProviderService $providerService
     * @param OrderValidator $validator
     */
    public function __construct(OrderService $service, ProviderService $providerService, OrderValidator $validator)
    {
        $this->service = $service;
        $this->providerService = $providerService;
        $this->validator  = $validator;
    }

//    /**
//     * @param Request $request
//     * @return array
//     * @throws \pmill\AwsCognito\Exception\TokenVerificationException
//     */
//    public function store(Request $request)
//    {
//        $provider = $this->providerService->getProviderByToken($request->header('Authorization'));
//        return $this->service->createOp($request->all(), $provider);
//    }
}
