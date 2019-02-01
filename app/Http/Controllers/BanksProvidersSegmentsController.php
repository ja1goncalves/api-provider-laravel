<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BanksProvidersSegmentCreateRequest;
use App\Http\Requests\BanksProvidersSegmentUpdateRequest;
use App\Repositories\BanksProvidersSegmentRepository;
use App\Validators\BanksProvidersSegmentValidator;

/**
 * Class BanksProvidersSegmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BanksProvidersSegmentsController extends Controller
{
    /**
     * @var BanksProvidersSegmentRepository
     */
    protected $repository;

    /**
     * @var BanksProvidersSegmentValidator
     */
    protected $validator;

    /**
     * BanksProvidersSegmentsController constructor.
     *
     * @param BanksProvidersSegmentRepository $repository
     * @param BanksProvidersSegmentValidator $validator
     */
    public function __construct(BanksProvidersSegmentRepository $repository, BanksProvidersSegmentValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $banksProvidersSegments = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $banksProvidersSegments,
            ]);
        }

        return view('banksProvidersSegments.index', compact('banksProvidersSegments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BanksProvidersSegmentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BanksProvidersSegmentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $banksProvidersSegment = $this->repository->create($request->all());

            $response = [
                'message' => 'BanksProvidersSegment created.',
                'data'    => $banksProvidersSegment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banksProvidersSegment = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $banksProvidersSegment,
            ]);
        }

        return view('banksProvidersSegments.show', compact('banksProvidersSegment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banksProvidersSegment = $this->repository->find($id);

        return view('banksProvidersSegments.edit', compact('banksProvidersSegment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BanksProvidersSegmentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BanksProvidersSegmentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $banksProvidersSegment = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BanksProvidersSegment updated.',
                'data'    => $banksProvidersSegment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'BanksProvidersSegment deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BanksProvidersSegment deleted.');
    }
}
