<?php

namespace App\Http\Controllers;

use App\Services\PasswordResetService;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{

    protected $service;

    public function __construct(PasswordResetService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request)
    {
        return $this->service->create($request);
    }

    public function find($token)
    {
        return $this->service->find($token);
    }

    public function reset(Request $request)
    {
        return $this->service->reset($request);
    }
}
