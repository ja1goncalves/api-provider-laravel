<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\SegmentService;
use App\Validators\SegmentValidator;

/**
 * Class SegmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SegmentsController extends Controller
{
    use CrudMethods;

    protected $service;

    protected $validator;

    public function __construct(SegmentService $service, SegmentValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function listByBank($bankId)
    {
        return $this->service->findByBank($bankId);
    }
}
