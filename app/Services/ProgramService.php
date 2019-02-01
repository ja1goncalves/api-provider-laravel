<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:51
 */

namespace App\Services;

use App\Repositories\ProgramRepository;
use App\Services\Traits\CrudMethods;


/**
 * Class ProgramService
 * @package App\Services
 */
class ProgramService
{
    use CrudMethods;

    /**
     * @var ProgramRepository
     */
    protected $repository;

    /**
     * ProgramService constructor.
     * @param ProgramRepository $repository
     */
    public function __construct(ProgramRepository $repository)
    {
        $this->repository = $repository;
    }

}
