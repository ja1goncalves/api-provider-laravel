<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProgramsQuotationRepository;
use App\Entities\ProgramsQuotation;
use App\Validators\ProgramsQuotationValidator;

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
    *
    * @return mixed
    */
    public function validator()
    {

        return ProgramsQuotationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
