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
        try {
            $preProvider = $this->service->checkToken($request->get('token'));

            if (is_null($preProvider)) {
                throw new \Exception('Token inválido!');
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Token válidado com sucesso!',
            'data' => $preProvider
        ]);
    }
}
