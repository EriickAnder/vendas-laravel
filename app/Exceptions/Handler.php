<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {});
    }

    public function render($request, Throwable $exception)
    {
        $request->headers->set('Accept', 'application/json');

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'message' => 'Método não permitido para esta rota.'
            ], 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => $exception->errors(),
            ], 422);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Não autorizado.',
                'errors' => $exception->errors(),
            ], 403);
        }

        return parent::render($request, $exception);
    }

    public function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'message' => 'Os dados fornecidos são inválidos.',
            'errors' => $exception->errors(),
        ], $exception->status);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['message' => 'Unauthorized '], 401);
    }
}
