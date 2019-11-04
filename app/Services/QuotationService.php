<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:54
 */

namespace App\Services;

use App\Presenters\QuotationsPresenter;
use App\Repositories\QuotationRepository;
use App\Services\Traits\CrudMethods;
use Carbon\Carbon;


/**
 * Class QuotationService
 * @package App\Services
 */
class QuotationService
{
    use CrudMethods;

    /**
     * @var QuotationRepository
     */
    protected $repository;

    /**
     * @var ProviderService
     */
    protected $providerService;

    /**
     * QuotationService constructor.
     * @param QuotationRepository $repository
     */
    public function __construct(QuotationRepository $repository)
    {
        $this->repository  = $repository;
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function getQuotationsByProvider($provider)
    {
        return $this->repository
            ->orderBy('created', 'desc')
            ->setPresenter(QuotationsPresenter::class)
            ->with('programsQuotations.program')
            ->with('orders.status')
            ->with('programsQuotations.paymentForms')
            ->findWhere(['provider_id' => $provider->id,
                ['created', '>', Carbon::now()->subDays(2)]
            ]);
    }

    /**
     * @param $email
     * @param $provider_id
     * @return mixed
     */
    public function updateByProvider($email, $provider_id)
    {
        return $this->repository->updateByProvider($email, $provider_id);
    }

    /**
     * @param $email
     * @param $field
     * @param $before
     * @param $after
     */
    public function updateFieldInRegisterProvider($email, $field, $before, $after)
    {
        $this->repository->updateFieldInRegisterProvider($email, $field, $before, $after);
    }
}
