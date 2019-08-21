<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PendingEditionRepository;
use App\Entities\PendingEdition;
use App\Validators\PendingEditionValidator;

/**
 * Class PendingEditionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PendingEditionRepositoryEloquent extends BaseRepository implements PendingEditionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PendingEdition::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
