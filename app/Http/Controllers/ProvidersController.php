<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;

use App\Http\Requests\ProviderCreateRequest;
use App\Services\ProviderService;
use App\Validators\ProviderValidator;
use Illuminate\Http\Request;
use App\Services\Service;
use Illuminate\Support\Facades\Log;

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


    public function listEmission(Request $request, $cpf)
    {
       
        $page = $request->get('page');
        $limit = $request->get('limit');

        $endpoint = "https://api.buscaaereo.com.br/provider/emissions?cpf=".$cpf."&limit=".$limit."&page=".$page;
        $method = 'GET';
        $options =[
            'headers' => [
                'content-type' => 'application/json',
                'authorization' => 'Bearer we8sfh98weghfwegf87wegf7geedfiF1J6E3qkND0AxtFY0KDJ6WfCwwe90f8ywe978gfg98ewfyh657SQhVbVkn28H9NNU3wr9CGVnffctIEEnDhRga1D2HbsgG98wehf98wew9efh8ge8wgf87',
                'accept'    =>  'application/json'
            ],
        ];
        
        $response = Service::processRequest($method, $endpoint, $options);

        if ($response->getStatusCode() !== 200) {
            Log::alert("Nenhuma emisssssão recente.");
        }

        return $response->getBody()->getContents();
    }
}
