<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\OrderStatus;

/**
 * Class OrdersStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrdersStatusRepositoryEloquent extends BaseRepository implements OrdersStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderStatus::class;
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
