<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

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
     * @param \Throwable $exception
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
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'Data not found!',
                'errors' => [
                    'id' => 'Data not found with this id!'
                ],
            ], 404);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return error_out($exception->getMessage(), $exception->getStatusCode(), 'Unauthorized Http');
        }

        if ($exception instanceof NotFoundHttpException) {
            return error_out($exception->getMessage(), $exception->getStatusCode(), 'Route not found');
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return error_out($exception->getMessage(), $exception->getStatusCode(), 'Method not allowed');
        }

        if ($exception instanceof QueryException) {
            return error_out(['message' => 'Query Exception'], 422, $exception->getMessage());
        }

        if ($exception instanceof RoleDoesNotExist) {
            return error_out(['message' => 'User created without role'], 422, $exception->getMessage());
        }

//        if ($exception instanceof \ErrorException) {
//            return error_out(['message' => 'Error Exception'], 500, $exception->getMessage());
//        }

        return parent::render($request, $exception);
    }
}
