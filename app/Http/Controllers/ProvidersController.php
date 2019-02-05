<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;

use App\Http\Requests\ProviderCreateRequest;
use App\Services\ProviderService;
use App\Validators\ProviderValidator;
use Illuminate\Http\Request;

/**
 * Class ProvidersController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProvidersController extends Controller
{
    use CrudMethods;

    protected $service;

    protected $validator;

    public function __construct(ProviderService $service, ProviderValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
        $this->middleware('guest');
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
        return $this->service->getProviderData($provider->id);
    }

    public function update(Request $request)
    {
        $provider = $this->service->getProviderByToken();
        return $this->service->updateProvider($provider->id, $request->all());
    }

}

