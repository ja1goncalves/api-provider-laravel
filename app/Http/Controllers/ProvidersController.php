<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;

use App\Http\Requests\ProviderCreateRequest;
use App\Services\ProviderService;
use App\Validators\ProviderValidator;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;

/**
 * Class ProvidersController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProvidersController extends Controller
{
    use CrudMethods;
    use RedirectsUsers;

    /**
     * @var ProviderService
     */
    protected $service;

    /**
     * @var ProviderValidator
     */
    protected $validator;

    /**
     * ProvidersController constructor.
     *
     * @param ProviderService $service
     * @param ProviderValidator $validator
     */
    public function __construct(ProviderService $service, ProviderValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
        $this->middleware('guest');
    }

    /**
     * @param ProviderCreateRequest $request
     * @return mixed
     * @throws \Exception
     */
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

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     * @throws \Exception
     */
    public function update(Request $request)
    {
        $provider = $this->service->getProviderByToken();
        return $this->service->updateProvider($provider->id, $request->all());
    }

    public function signupActivate($token)
    {
        return $this->service->signupActivate($token);
    }

}

