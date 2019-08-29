<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Prettus\Validator\Exceptions\ValidatorException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->renderValidationException($exception);
        }

        if ($exception instanceof ValidatorException) {
            return $this->renderValidatorException($exception);
        }

        if ($exception instanceof Exception) {
            return $this->renderException($exception);
        }

        return parent::render($request, $exception);
    }

    private function renderValidationException($exception)
    {
        $bag = $exception->validator->getMessageBag();

        $response = [
            'error'   => true,
            'message'    => implode("\n", $this->parseMessages($bag)),
            'data' => $bag
        ];

        return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function renderValidatorException($exception)
    {
        $bag = $exception->getMessageBag();

        $response = [
            'error'   => true,
            'message' => implode("\n", $this->parseMessages($bag)),
            'data'    => $bag
        ];

        return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function renderException($exception)
    {
        $bag = $exception->getMessage();

        $response = [
            'error'   => true,
            'message'    => implode("\n", $this->parseMessages($bag)),
            'data' => $bag
        ];

        return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function parseMessages($bag)
    {
        $messages = [];

        if(is_object($bag)){
            $bag = json_decode(json_encode($bag), true);
            foreach($bag as $field){
                foreach($field as $m){
                    $messages[] = $m;
                }
            }
        }

        return $messages;
    }
}
