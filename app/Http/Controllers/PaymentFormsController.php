<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PaymentFormCreateRequest;
use App\Http\Requests\PaymentFormUpdateRequest;
use App\Repositories\PaymentFormRepository;
use App\Validators\PaymentFormValidator;

/**
 * Class PaymentFormsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PaymentFormsController extends Controller
{
    /**
     * @var PaymentFormRepository
     */
    protected $repository;

    /**
     * @var PaymentFormValidator
     */
    protected $validator;

    /**
     * PaymentFormsController constructor.
     *
     * @param PaymentFormRepository $repository
     * @param PaymentFormValidator $validator
     */
    public function __construct(PaymentFormRepository $repository, PaymentFormValidator $validator)
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
        $paymentForms = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $paymentForms,
            ]);
        }

        return view('paymentForms.index', compact('paymentForms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PaymentFormCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PaymentFormCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $paymentForm = $this->repository->create($request->all());

            $response = [
                'message' => 'PaymentForm created.',
                'data'    => $paymentForm->toArray(),
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
        $paymentForm = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $paymentForm,
            ]);
        }

        return view('paymentForms.show', compact('paymentForm'));
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
        $paymentForm = $this->repository->find($id);

        return view('paymentForms.edit', compact('paymentForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PaymentFormUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PaymentFormUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $paymentForm = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PaymentForm updated.',
                'data'    => $paymentForm->toArray(),
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
                'message' => 'PaymentForm deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PaymentForm deleted.');
    }
}
