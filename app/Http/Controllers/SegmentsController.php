<?php

namespace App\Http\Controllers;

use App\Services\SegmentService;
use App\Validators\SegmentValidator;

/**
 * Class SegmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SegmentsController extends Controller
{
    /**
     * @var SegmentService
     */
    protected $service;

    /**
     * @var SegmentValidator
     */
    protected $validator;

    /**
     * SegmentsController constructor.
     *
     * @param SegmentService $service
     * @param SegmentValidator $validator
     */
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
