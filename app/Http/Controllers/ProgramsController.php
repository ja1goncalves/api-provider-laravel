<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProgramCreateRequest;
use App\Http\Requests\ProgramUpdateRequest;
use App\Repositories\ProgramRepository;
use App\Validators\ProgramValidator;

/**
 * Class ProgramsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProgramsController extends Controller
{
    /**
     * @var ProgramRepository
     */
    protected $repository;

    /**
     * @var ProgramValidator
     */
    protected $validator;

    /**
     * ProgramsController constructor.
     *
     * @param ProgramRepository $repository
     * @param ProgramValidator $validator
     */
    public function __construct(ProgramRepository $repository, ProgramValidator $validator)
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
        $programs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $programs,
            ]);
        }

        return view('programs.index', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProgramCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProgramCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $program = $this->repository->create($request->all());

            $response = [
                'message' => 'Program created.',
                'data'    => $program->toArray(),
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
        $program = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $program,
            ]);
        }

        return view('programs.show', compact('program'));
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
        $program = $this->repository->find($id);

        return view('programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProgramUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProgramUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $program = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Program updated.',
                'data'    => $program->toArray(),
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
                'message' => 'Program deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Program deleted.');
    }
}
