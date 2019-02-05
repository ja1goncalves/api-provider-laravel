<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\PreProvider;
use App\Validators\PreProviderValidator;

/**
 * Class PreProviderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PreProviderRepositoryEloquent extends BaseRepository implements PreProviderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PreProvider::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PreProviderValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByToken($token)
    {
        $query = $this->model->newQuery();
        return $query->where('token', '=', $token)->get()->first();
    }
    
}
