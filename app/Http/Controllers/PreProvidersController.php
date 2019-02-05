<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests\CheckTokenRequest;
use App\Services\PreProviderService;
use App\Validators\PreProviderValidator;


class PreProvidersController extends Controller
{
    use CrudMethods;

    protected $service;

    protected $validator;

    public function __construct(PreProviderService $service, PreProviderValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function checkToken(CheckTokenRequest $request)
    {
       return $this->service->checkToken($request->get('token'));
    }
}
