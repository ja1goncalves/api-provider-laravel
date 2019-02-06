<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:48
 */

namespace App\Services;

use App\Presenters\BankPresenter;
use App\Repositories\BankRepository;
use App\Services\Traits\CrudMethods;

/**
 * Class BankService
 * @package App\Services
 */
class BankService
{
    use CrudMethods;

    /**
     * @var BankRepository
     */
    protected $repository;

    /**
     * AddressService constructor.
     * @param BankRepository $repository
     */
    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllBanks()
    {
        return $this->repository
            ->setPresenter(BankPresenter::class)
            ->all();
    }

}
