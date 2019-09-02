<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MessagesUserRepository;
use App\Entities\MessagesUser;
use App\Validators\MessagesUserValidator;

/**
 * Class MessagesUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MessagesUserRepositoryEloquent extends BaseRepository implements MessagesUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MessagesUser::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
