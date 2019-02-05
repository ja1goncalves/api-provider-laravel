<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:54
 */

namespace App\Services;

use App\Repositories\SegmentRepository;
use App\Services\Traits\CrudMethods;


/**
 * Class SegmentService
 * @package App\Services
 */
class SegmentService
{
    use CrudMethods;

    /**
     * @var SegmentRepository
     */
    protected $repository;

    /**
     * AddressService constructor.
     * @param SegmentRepository $repository
     */
    public function __construct(SegmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $bankId
     * @return mixed
     */
    public function findByBank($bankId)
    {
        return $this->repository->findWhere(['bank_id' => $bankId]);
    }
}
