<?php

namespace App\Services;

use App\Presenters\EmissionPresenter;
use App\Repositories\EmissionRepository;
use App\Services\Traits\CrudMethods;

/**
 * Class EmissionService
 * @package App\Services
 */
class EmissionService extends AppService
{
    use CrudMethods;

    /**
     * @var EmissionRepository
     */
    protected $repository;

    /**
     * EmissionService constructor.
     * @param EmissionRepository $repository
     */
    public function __construct(EmissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getEmissionByProvider($provider)
    {
        $emissions = $this->repository->with('passenger')->with('flight')->findWhere(['provider_id' => $provider->id]);
        $data = [];

        foreach ($emissions as $emission) {
    
        $data[] = [
            'id' => $emission['id'],
            'name_passenger' => $emission['passenger'][0]['fullname'],
            'email_passenger' => $emission['passenger'][0]['email'],
            'phone_passenger' => $emission['passenger'][0]['phone'],
            'sale_date' => \Carbon\Carbon::parse($emission['sale_date'])->format('d/m/Y H:i:s'),
            'date_boarding' => \Carbon\Carbon::parse($emission['flight'][0]['date_boarding'])->format('d/m/Y H:i:s')
        ];
    }

    return $this->returnSuccess($data);
    }
}
