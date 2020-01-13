<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProvidersChecklistsRepository;
use App\Entities\ProvidersChecklists;
use App\Validators\ProvidersChecklistsValidator;

/**
 * Class ProvidersChecklistsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProvidersChecklistsRepositoryEloquent extends BaseRepository implements ProvidersChecklistsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProvidersChecklists::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
