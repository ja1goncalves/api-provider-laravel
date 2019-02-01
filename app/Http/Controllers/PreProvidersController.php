<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PreProviderCreateRequest;
use App\Http\Requests\PreProviderUpdateRequest;
use App\Repositories\PreProviderRepository;
use App\Validators\PreProviderValidator;

/**
 * Class PreProvidersController.
 *
 * @package namespace App\Http\Controllers;
 */
class PreProvidersController extends Controller
{
    /**
     * @var PreProviderRepository
     */
    protected $repository;

    /**
     * @var PreProviderValidator
     */
    protected $validator;

    /**
     * PreProvidersController constructor.
     *
     * @param PreProviderRepository $repository
     * @param PreProviderValidator $validator
     */
    public function __construct(PreProviderRepository $repository, PreProviderValidator $validator)
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
        $preProviders = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $preProviders,
            ]);
        }

        return view('preProviders.index', compact('preProviders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PreProviderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PreProviderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $preProvider = $this->repository->create($request->all());

            $response = [
                'message' => 'PreProvider created.',
                'data'    => $preProvider->toArray(),
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
        $preProvider = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $preProvider,
            ]);
        }

        return view('preProviders.show', compact('preProvider'));
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
        $preProvider = $this->repository->find($id);

        return view('preProviders.edit', compact('preProvider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PreProviderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PreProviderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $preProvider = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PreProvider updated.',
                'data'    => $preProvider->toArray(),
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
                'message' => 'PreProvider deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PreProvider deleted.');
    }
}
