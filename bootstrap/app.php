<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions
            ->render(function (NotFoundHttpException $e, Request $request) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'message' => 'Not found',
                    ], 404);
                }
            })
            ->render(function (Exception $e, Request $request) {
                if ($request->is('api/*')) {
                    Log::error('Error occured', [
                        'message' => $e->getMessage(),
                    ]);

                    return response()->json([
                        'message' => $e->getMessage()
                    ], 500);
                }
            });
    })->create();
