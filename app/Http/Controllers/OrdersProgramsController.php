<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrdersProgramCreateRequest;
use App\Http\Requests\OrdersProgramUpdateRequest;
use App\Repositories\OrdersProgramRepository;
use App\Validators\OrdersProgramValidator;

/**
 * Class OrdersProgramsController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrdersProgramsController extends Controller
{
    /**
     * @var OrdersProgramRepository
     */
    protected $repository;

    /**
     * @var OrdersProgramValidator
     */
    protected $validator;

    /**
     * OrdersProgramsController constructor.
     *
     * @param OrdersProgramRepository $repository
     * @param OrdersProgramValidator $validator
     */
    public function __construct(OrdersProgramRepository $repository, OrdersProgramValidator $validator)
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
        $ordersPrograms = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $ordersPrograms,
            ]);
        }

        return view('ordersPrograms.index', compact('ordersPrograms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrdersProgramCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrdersProgramCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $ordersProgram = $this->repository->create($request->all());

            $response = [
                'message' => 'OrdersProgram created.',
                'data'    => $ordersProgram->toArray(),
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
        $ordersProgram = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $ordersProgram,
            ]);
        }

        return view('ordersPrograms.show', compact('ordersProgram'));
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
        $ordersProgram = $this->repository->find($id);

        return view('ordersPrograms.edit', compact('ordersProgram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrdersProgramUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrdersProgramUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $ordersProgram = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrdersProgram updated.',
                'data'    => $ordersProgram->toArray(),
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
                'message' => 'OrdersProgram deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrdersProgram deleted.');
    }
}
