<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrdersProgramRepository;
use App\Entities\OrdersProgram;
use App\Validators\OrdersProgramValidator;

/**
 * Class OrdersProgramRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrdersProgramRepositoryEloquent extends BaseRepository implements OrdersProgramRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrdersProgram::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrdersProgramValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
