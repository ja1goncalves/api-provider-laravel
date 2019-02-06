<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;

use App\Http\Requests\ProviderCreateRequest;
use App\Services\ProviderService;
use App\Validators\ProviderValidator;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    use CrudMethods;

    protected $service;

    protected $validator;

    public function __construct(ProviderService $service, ProviderValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function store2(ProviderCreateRequest $request)   {

        return $this->service->create2($request->all());
    }

    public function store(ProviderCreateRequest $request)
    {
        return $provider = $this->service->create($request->all());
    }

    public function getProviderData() {
        $provider = $this->service->getProviderByToken();
        if (isset($provider->id)) {
            return $this->service->getProviderData($provider->id);
        }else{
            return response()->json([
                'error' => true,
                'message' => "User not found"
            ]);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function update(Request $request)
    {
        $provider = $this->service->getProviderByToken();
        if (isset($provider->id)) {
            return $this->service->updateProvider($provider->id, $request->all());
        }else{
            return response()->json([
                'error' => true,
                'message' => "User not found"
            ]);
        }
    }
}
