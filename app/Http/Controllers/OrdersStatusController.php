<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrdersStatusCreateRequest;
use App\Http\Requests\OrdersStatusUpdateRequest;
use App\Repositories\OrdersStatusRepository;
use App\Validators\OrdersStatusValidator;

/**
 * Class OrdersStatusesController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrdersStatusController extends Controller
{
    /**
     * @var OrdersStatusRepository
     */
    protected $repository;

    /**
     * @var OrdersStatusValidator
     */
    protected $validator;

    /**
     * OrdersStatusesController constructor.
     *
     * @param OrdersStatusRepository $repository
     * @param OrdersStatusValidator $validator
     */
    public function __construct(OrdersStatusRepository $repository, OrdersStatusValidator $validator)
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
        $ordersStatuses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $ordersStatuses,
            ]);
        }

        return view('ordersStatuses.index', compact('ordersStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrdersStatusCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrdersStatusCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $ordersStatus = $this->repository->create($request->all());

            $response = [
                'message' => 'OrderStatus created.',
                'data'    => $ordersStatus->toArray(),
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
        $ordersStatus = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $ordersStatus,
            ]);
        }

        return view('ordersStatuses.show', compact('ordersStatus'));
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
        $ordersStatus = $this->repository->find($id);

        return view('ordersStatuses.edit', compact('ordersStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrdersStatusUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrdersStatusUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $ordersStatus = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrderStatus updated.',
                'data'    => $ordersStatus->toArray(),
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
                'message' => 'OrderStatus deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrderStatus deleted.');
    }
}
