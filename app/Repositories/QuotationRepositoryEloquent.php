<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Quotation;
use App\Validators\QuotationValidator;

/**
 * Class QuotationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class QuotationRepositoryEloquent extends BaseRepository implements QuotationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Quotation::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return QuotationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function updateByProvider($email, $provider_id)
    {
        return $this->model->newQuery()
            ->where('email', '=', $email)
            ->update(['provider_id' => $provider_id]);
    }

    public function updateFieldInRegisterProvider($email, $field, $before, $after)
    {
        return $this->model->newQuery()
            ->where('email', '=', $email)
            ->where($field, '=', $before)
            ->update([$field => $after]);
    }

}
