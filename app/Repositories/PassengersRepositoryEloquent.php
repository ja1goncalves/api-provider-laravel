<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PassengersRepository;
use App\Entities\Passengers;
use App\Validators\PassengersValidator;

/**
 * Class PassengersRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PassengersRepositoryEloquent extends BaseRepository implements PassengersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Passengers::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PassengersValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
