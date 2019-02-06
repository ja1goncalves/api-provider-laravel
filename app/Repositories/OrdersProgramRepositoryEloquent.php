<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\OrdersProgram;


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
