<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;

use App\Http\Requests\ProviderCreateRequest;
use App\Services\ProviderService;
use App\Validators\ProviderValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ProvidersController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProvidersController extends Controller
{
    use CrudMethods;

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
    }

    /**
     * @param ProviderCreateRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(ProviderCreateRequest $request)
    {
        return $this->service->create($request->all());
    }

//    /**
//     * @param Request $request
//     * @return mixed
//     * @throws \pmill\AwsCognito\Exception\TokenVerificationException
//     */
//    public function getProviderData(Request $request) {
//        $provider = $this->service->getProviderByToken($request->header('Authorization'), ['id']);
//        return $this->service->getProviderData($provider->id);
//    }
//
//    /**
//     * @param Request $request
//     * @return mixed
//     * @throws \pmill\AwsCognito\Exception\TokenVerificationException
//     */
//    public function update(Request $request)
//    {
//        $provider = $this->service->getProviderByToken($request->header('Authorization'), ['id']);
//        return $this->service->updateProvider($provider->id, $request->all());
//    }
}
