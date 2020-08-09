<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $ERROR_CODES = [
        'ER_FILA_CON_REFERENCIAS' => [ 1451, "No se puede realizar la operación porque el registro tiene datos asociados"],
    ];
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof QueryException) {
            if($exception->errorInfo[1] == $this->ERROR_CODES['ER_FILA_CON_REFERENCIAS'][0]) {
                // dd($this->ERROR_CODES['ER_FILA_CON_REFERENCIAS'][1]);
                return back()->with('error', $this->ERROR_CODES['ER_FILA_CON_REFERENCIAS'][1]);
            } else {
                return parent::render($request, $exception);
            }
        }
        return parent::render($request, $exception);
    }
}
