<?php

use App\Exceptions\EntityNotFound;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function (Response $response, $e) {
            if ($e instanceof EntityNotFound) {
                return response()->json([ 'success' => false, 'errors' => [ 'Une erreur est survenue.' ] ], 404);
            }

            if (config('app.env') === 'local') {
                return $response;
            }

            return response()->json([ 'success' => false, 'errors' => [ 'Une erreur est survenue.' ] ], 500);
        });
    })
    ->withSchedule(function (Schedule $schedule) {
    })
    ->create();
