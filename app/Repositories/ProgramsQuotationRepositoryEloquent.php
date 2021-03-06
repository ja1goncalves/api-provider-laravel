<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\ProgramsQuotation;

/**
 * Class ProgramsQuotationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProgramsQuotationRepositoryEloquent extends BaseRepository implements ProgramsQuotationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProgramsQuotation::class;
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
