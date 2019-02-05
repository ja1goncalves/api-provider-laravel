<?php

namespace App\Http\Controllers;

use App\Services\ProgramService;
use App\Http\Controllers\Traits\CrudMethods;
use App\Validators\ProgramValidator;


class ProgramsController extends Controller
{
    use CrudMethods;

    protected $service;

    protected $validator;

    public function __construct(ProgramService $service, ProgramValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }
}
