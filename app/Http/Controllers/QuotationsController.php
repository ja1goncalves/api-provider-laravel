<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\QuotationCreateRequest;
use App\Http\Requests\QuotationUpdateRequest;
use App\Repositories\QuotationRepository;
use App\Validators\QuotationValidator;

/**
 * Class QuotationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class QuotationsController extends Controller
{
    /**
     * @var QuotationRepository
     */
    protected $repository;

    /**
     * @var QuotationValidator
     */
    protected $validator;

    /**
     * QuotationsController constructor.
     *
     * @param QuotationRepository $repository
     * @param QuotationValidator $validator
     */
    public function __construct(QuotationRepository $repository, QuotationValidator $validator)
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
        $quotations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $quotations,
            ]);
        }

        return view('quotations.index', compact('quotations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  QuotationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(QuotationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $quotation = $this->repository->create($request->all());

            $response = [
                'message' => 'Quotation created.',
                'data'    => $quotation->toArray(),
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
        $quotation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $quotation,
            ]);
        }

        return view('quotations.show', compact('quotation'));
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
        $quotation = $this->repository->find($id);

        return view('quotations.edit', compact('quotation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  QuotationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(QuotationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $quotation = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Quotation updated.',
                'data'    => $quotation->toArray(),
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
                'message' => 'Quotation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Quotation deleted.');
    }
}
