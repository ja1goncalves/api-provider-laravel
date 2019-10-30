<?php


namespace App\Services;


use App\Repositories\PaymentFormRepository;
use App\Services\Traits\CrudMethods;

class PaymentFormsService
{
    use CrudMethods;

    /**
     * QuotationService constructor.
     * @param PaymentFormRepository $repository
     */
    public function __construct(PaymentFormRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($limit = 20)
    {
        return $this->repository->findWhere(['parent_id' => null], ['title', 'id']);
    }
}
