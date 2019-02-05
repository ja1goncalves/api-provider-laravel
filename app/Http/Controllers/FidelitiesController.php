<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FidelityCreateRequest;
use App\Http\Requests\FidelityUpdateRequest;
use App\Repositories\FidelityRepository;
use App\Validators\FidelityValidator;

/**
 * Class FidelitiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class FidelitiesController extends Controller
{
    /**
     * @var FidelityRepository
     */
    protected $repository;

    /**
     * @var FidelityValidator
     */
    protected $validator;

    /**
     * FidelitiesController constructor.
     *
     * @param FidelityRepository $repository
     * @param FidelityValidator $validator
     */
    public function __construct(FidelityRepository $repository, FidelityValidator $validator)
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
        $fidelities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $fidelities,
            ]);
        }

        return view('fidelities.index', compact('fidelities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FidelityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FidelityCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $fidelity = $this->repository->create($request->all());

            $response = [
                'message' => 'Fidelity created.',
                'data'    => $fidelity->toArray(),
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
        $fidelity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $fidelity,
            ]);
        }

        return view('fidelities.show', compact('fidelity'));
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
        $fidelity = $this->repository->find($id);

        return view('fidelities.edit', compact('fidelity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FidelityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FidelityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $fidelity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Fidelity updated.',
                'data'    => $fidelity->toArray(),
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
                'message' => 'Fidelity deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Fidelity deleted.');
    }
}
