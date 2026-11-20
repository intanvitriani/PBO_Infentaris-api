<?php

namespace App\Middleware;

use App\Core\Response;
use App\Exceptions\NotFoundException;
use InvalidArgumentException;
use Throwable;

class ErrorHandler
{
    public static function register(): void
    {
        set_exception_handler(function (Throwable $e): void {
            error_log((string) $e);

            if ($e instanceof NotFoundException) {
                Response::error($e->getMessage(), 404);
            }

            if ($e instanceof InvalidArgumentException) {
                Response::error($e->getMessage(), 422);
            }

 Response::error('Error: ' . $e->getMessage() . ' di ' . basename($e->getFile()) . ':' . $e->getLine(), 500);
        });
    }
}