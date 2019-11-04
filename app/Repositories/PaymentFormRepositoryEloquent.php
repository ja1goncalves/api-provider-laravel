<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PaymentFormRepository;
use App\Entities\PaymentForm;
use App\Validators\PaymentFormValidator;

/**
 * Class PaymentFormRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentFormRepositoryEloquent extends BaseRepository implements PaymentFormRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PaymentForm::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
