<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PassengersCreateRequest;
use App\Http\Requests\PassengersUpdateRequest;
use App\Repositories\PassengersRepository;
use App\Validators\PassengersValidator;

/**
 * Class PassengersController.
 *
 * @package namespace App\Http\Controllers;
 */
class PassengersController extends Controller
{
    /**
     * @var PassengersRepository
     */
    protected $repository;

    /**
     * @var PassengersValidator
     */
    protected $validator;

    /**
     * PassengersController constructor.
     *
     * @param PassengersRepository $repository
     * @param PassengersValidator $validator
     */
    public function __construct(PassengersRepository $repository, PassengersValidator $validator)
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
        $passengers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $passengers,
            ]);
        }

        return view('passengers.index', compact('passengers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PassengersCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PassengersCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $passenger = $this->repository->create($request->all());

            $response = [
                'message' => 'Passengers created.',
                'data'    => $passenger->toArray(),
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
        $passenger = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $passenger,
            ]);
        }

        return view('passengers.show', compact('passenger'));
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
        $passenger = $this->repository->find($id);

        return view('passengers.edit', compact('passenger'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PassengersUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PassengersUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $passenger = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Passengers updated.',
                'data'    => $passenger->toArray(),
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
                'message' => 'Passengers deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Passengers deleted.');
    }
}
