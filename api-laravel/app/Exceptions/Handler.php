<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // cấu hình lun trả về json thay vì hiện mã HTML
    protected function shouldReturnJson($request, Throwable $e)
    {
        return true;
    }

    // cấu hình hiển thị Unauthenticated
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return parent::render($request, $exception);
    }
}
