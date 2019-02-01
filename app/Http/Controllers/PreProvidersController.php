<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\PreProviderService;
use App\Validators\PreProviderValidator;

/**
 * Class PreProvidersController.
 *
 * @package namespace App\Http\Controllers;
 */
class PreProvidersController extends Controller
{
    use CrudMethods;

    /**
     * @var PreProviderService
     */
    protected $service;

    /**
     * @var PreProviderValidator
     */
    protected $validator;

    /**
     * PreProvidersController constructor.
     *
     * @param PreProviderService $service
     * @param PreProviderValidator $validator
     */
    public function __construct(PreProviderService $service, PreProviderValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

//    public function checkToken(CheckTokenRequest $request)
//    {
//        try {
//            $preProvider = $this->service->checkToken($request->get('token'));
//
//            if (is_null($preProvider)) {
//                throw new \Exception('Token inválido!');
//            }
//
//        } catch (\Exception $e) {
//            return response()->json([
//                'error' => true,
//                'message' => $e->getMessage()
//            ]);
//        }
//
//        return response()->json([
//            'error' => false,
//            'message' => 'Token válidado com sucesso!',
//            'data' => $preProvider
//        ]);
//    }
}
