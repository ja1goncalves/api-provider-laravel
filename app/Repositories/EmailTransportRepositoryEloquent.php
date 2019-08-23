<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmailTransportRepository;
use App\Entities\EmailTransport;
use App\Validators\EmailTransportValidator;

/**
 * Class EmailTransportRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmailTransportRepositoryEloquent extends BaseRepository implements EmailTransportRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmailTransport::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
