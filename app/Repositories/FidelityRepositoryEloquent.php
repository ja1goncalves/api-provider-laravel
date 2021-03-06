<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Fidelity;

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
    */
    public function validator()
    {

    }


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
