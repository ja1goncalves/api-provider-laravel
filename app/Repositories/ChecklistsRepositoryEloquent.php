<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ChecklistsRepository;
use App\Entities\Checklists;
use App\Validators\ChecklistsValidator;

/**
 * Class ChecklistsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ChecklistsRepositoryEloquent extends BaseRepository implements ChecklistsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Checklists::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
