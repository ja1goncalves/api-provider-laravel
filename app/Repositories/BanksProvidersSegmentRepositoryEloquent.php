<?php

namespace App\Repositories;

use App\Validators\BanksProvidersSegmentValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\BanksProvidersSegment;


/**
 * Class BanksProvidersSegmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BanksProvidersSegmentRepositoryEloquent extends BaseRepository implements BanksProvidersSegmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BanksProvidersSegment::class;
    }

    /**
    * Specify Validator class name
    */
    public function validator()
    {
        return BanksProvidersSegmentValidator::class;
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
