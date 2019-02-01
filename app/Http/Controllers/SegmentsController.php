<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SegmentCreateRequest;
use App\Http\Requests\SegmentUpdateRequest;
use App\Repositories\SegmentRepository;
use App\Validators\SegmentValidator;

/**
 * Class SegmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SegmentsController extends Controller
{
    /**
     * @var SegmentRepository
     */
    protected $repository;

    /**
     * @var SegmentValidator
     */
    protected $validator;

    /**
     * SegmentsController constructor.
     *
     * @param SegmentRepository $repository
     * @param SegmentValidator $validator
     */
    public function __construct(SegmentRepository $repository, SegmentValidator $validator)
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
        $segments = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $segments,
            ]);
        }

        return view('segments.index', compact('segments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SegmentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SegmentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $segment = $this->repository->create($request->all());

            $response = [
                'message' => 'Segment created.',
                'data'    => $segment->toArray(),
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
        $segment = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $segment,
            ]);
        }

        return view('segments.show', compact('segment'));
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
        $segment = $this->repository->find($id);

        return view('segments.edit', compact('segment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SegmentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SegmentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $segment = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Segment updated.',
                'data'    => $segment->toArray(),
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
                'message' => 'Segment deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Segment deleted.');
    }
}
