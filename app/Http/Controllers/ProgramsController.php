<?php

namespace App\Http\Controllers;

use App\Services\ProgramService;
use App\Http\Controllers\Traits\CrudMethods;

use App\Validators\ProgramValidator;

/**
 * Class ProgramsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProgramsController extends Controller
{
    use CrudMethods;

    /**
     * @var ProgramService
     */
    protected $service;

    /**
     * @var ProgramValidator
     */
    protected $validator;

    /**
     * ProgramsController constructor.
     *
     * @param ProgramService $service
     * @param ProgramValidator $validator
     */
    public function __construct(ProgramService $service, ProgramValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }
}
