<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EmissionCreateRequest;
use App\Http\Requests\EmissionUpdateRequest;
use App\Repositories\EmissionRepository;
use App\Validators\EmissionValidator;
use App\Services\EmissionService;
use App\Services\ProviderService;

/**
 * Class EmissionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EmissionsController extends Controller
{
    /**
     * @var EmissionRepository
     */
    protected $repository;

    /**
     * @var EmissionValidator
     */
    protected $validator;

    protected $providerService;

    /**
     * EmissionsController constructor.
     *
     * @param EmissionRepository $repository
     * @param EmissionValidator $validator
     */
    public function __construct(EmissionRepository $repository, ProviderService $providerService, EmissionValidator $validator, EmissionService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->providerService = $providerService;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function emissionByProvider(Request $request)
    {
        $provider = $this->providerService->getProviderByToken();
        return $this->service->getEmissionByProvider($provider);
    }
}
