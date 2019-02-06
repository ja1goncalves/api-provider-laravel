<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\OrderService;
use App\Services\ProviderService;
use App\Validators\OrderValidator;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    use CrudMethods;

    protected $providerService;

    protected $validator;

    public function __construct(OrderService $service, ProviderService $providerService, OrderValidator $validator)
    {
        $this->service = $service;
        $this->providerService = $providerService;
        $this->validator  = $validator;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $provider = $this->providerService->getProviderByToken();
        return $this->service->createOp($request->all(), $provider);
    }
}
