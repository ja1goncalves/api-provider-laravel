<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FidelityRepository;
use App\Entities\Fidelity;
use App\Validators\FidelityValidator;

/**
 * Class FidelityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FidelityRepositoryEloquent extends BaseRepository implements FidelityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Fidelity::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FidelityValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
