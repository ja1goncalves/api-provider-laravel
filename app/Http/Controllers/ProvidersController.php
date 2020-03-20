<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;

use App\Http\Requests\ProviderCreateRequest;
use App\Services\ProviderService;
use App\Validators\ProviderValidator;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Services\Service;

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

    public function getProviderFidelities() {
        $provider = $this->service->getProviderByToken();
        if (isset($provider->id)) {
            return $this->service->getProviderFidelities($provider->id);
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


    public function listEmission(Request $request)
    {

        $page = $request->get('page');
        $limit = $request->get('limit');
        $cpf = $request->get('cpf');

        $endpoint = "https://api.buscaaereo.com.br/provider/emissions?cpf=".$cpf."&limit=".$limit."&page=".$page;
        $method = 'GET';
        $options =[
            'headers' => [
                'content-type' => 'application/json',
                'authorization' => 'Bearer ' .env('BUSCAAEREO_AUTHORIZATION'),
                'accept'    =>  'application/json'
            ],
        ];

        try {
            $response = Service::processRequest($method, $endpoint, $options);
            $response = $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            $response = response()->json([
                'message' => 'Não foi possível pegar as emissões do fornecedor',
                'error' => true
            ], 500);
        }

        return $response;
    }
}
