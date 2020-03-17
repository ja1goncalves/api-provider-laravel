<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FlightRepository;
use App\Entities\Flight;
use App\Validators\FlightValidator;

/**
 * Class FlightRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FlightRepositoryEloquent extends BaseRepository implements FlightRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Flight::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FlightValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
