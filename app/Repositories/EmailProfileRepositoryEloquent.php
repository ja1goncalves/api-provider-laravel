<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmailProfileRepository;
use App\Entities\EmailProfile;
use App\Validators\EmailProfileValidator;

/**
 * Class EmailProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmailProfileRepositoryEloquent extends BaseRepository implements EmailProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmailProfile::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
